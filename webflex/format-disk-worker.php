<?php
include("session.php");

header("Cache-Control: no-cache");
header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    fetchAvailableDisks();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    formatDisk($_GET['device'], $_GET['mode']);
}

function findDevices()
{
    $deviceNames = array_values(array_filter(scandir("/dev"), function ($f) {
        return preg_match("/^sd[a-z]$/", $f);
    }));

    $deviceInfo = array();

    foreach ($deviceNames as $dev) {
        $devpath = "/dev/$dev";
        $output = "";
        exec("fdisk -l $devpath | head -n 1 | cut -d , -f 1", $output);
        exec("grep -q '$devpath' /proc/mounts", $ignored, $resultCode);
        $info = array(
            "device" => $devpath,
            "info" => $output[0],
            "id" => md5($devpath),
            "mounted" => ($resultCode == 0)
        );
        $deviceInfo[] = $info;
    }
    return $deviceInfo;
}

function fetchAvailableDisks()
{
    $devices = findDevices();
    echo json_encode(array("devices" => $devices));
}

function formatDisk($deviceId, $mode)
{
    # deviceId contains an id as sent from fetchAvailableDisks()
    $devices = findDevices();
    $foundDevices = array_values(array_filter($devices, function ($d) use ($deviceId) {
        return $d["id"] == $deviceId;
    }));

    if (count($foundDevices) == 0) {
        echo json_encode(array("message" => "Invalid device id ($deviceId)"));
        return;
    }
    $foundDev = $foundDevices[0];

    # Note that the system always mounts disks and remounts them after fdisk
    if ($foundDev["mounted"]) {
        $resultCode = unmountDisk($foundDev["device"]);
        if ($resultCode == 0) {
            echo json_encode(array("message" => "Disk could not be unmounted - please stop recording and playback before trying again."));
            return;
        }
    }

    $devpath = $foundDev["device"];

    $ext4Commands = array("o\n", "n\n", "p\n", "1\n", "2048\n", "\n", "w\n");
    $fat32Commands = array("o\n", "n\n", "p\n", "1\n", "2048\n", "\n", "t\n", "c\n", "w\n");

    $result = -1;
    if ($mode == "ext4") {
        $result = driveFDisk($devpath, $ext4Commands);
    } elseif ($mode == "fat32") {
        $result = driveFDisk($devpath, $fat32Commands);
    }
    if ($result != 0) {
        echo json_encode(array("message" => "Error partitioning disk"));
        return;
    }

    sleep(1);
    exec("[ -e /sbin/mdev ] && /sbin/mdev -s"); # Needed on Alpine
    exec("[ -e /bin/udevadm ] && /bin/udevadm settle"); # Equivalent for udev

    # The Encoder automatically remounts the device after fdisk completes.
    unmountDisk($devpath);

    $result = -1;
    $output = "";
    $devpath .= "1";
    if ($mode == "ext4") {
        exec("mkfs.ext4 -L EXT4_disk $devpath", $output, $result);
    } elseif ($mode == "fat32") {
        exec("mkfs.vfat -n FAT32_disk $devpath", $output, $result);
    }
    if ($result != 0) {
        echo json_encode(array("message" => "Error formatting disk"));
        return;
    }

    echo json_encode(array("message" => "Disk formatted"));
}

function unmountDisk($dev)
{
    # Attempt to unmount the disk
    exec("umount $dev > /dev/null 2>&1");
    for ($i = 1; $i <= 4; $i++) {
        exec("umount $dev$i > /dev/null 2>&1");
    }
    exec("grep -q '$dev' /proc/mounts", $ignored, $resultCode);
    return $resultCode;
}


function driveFDisk($devpath, $commands)
{
    $descriptorspec = array(
        0 => array("pipe", "r"),
        1 => array("pipe", "w"),
        2 => array("pipe", "r")
    );

    $process = proc_open("/sbin/fdisk $devpath", $descriptorspec, $pipes, null, null);
    foreach ($commands as $c) {
        fwrite($pipes[0], $c);
    }

    return proc_close($process);
}
