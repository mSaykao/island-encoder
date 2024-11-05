<?php
include("session.php");

header("Cache-Control: no-cache");
header("Content-Type: application/json");
set_time_limit(60);

if (isset($_GET['target']) && trim($_GET['target']) != "")
    calcLatency($_GET['target']);
else {
    http_response_code(400);
    echo json_encode(array("error" => "Bad target address"));
}

function calcLatency($target)
{
    $first = ping($target);
    if ($first == false) {
        echo json_encode(array("error" => "Could not ping target"));
        return;
    }
    $results = array();
    for ($x = 0; $x <= 12; $x++) {
        $r = ping($target);
        if ($r != false) {
            $results[] = $r;
            usleep(10000);
        }
    }
    echo json_encode(array("results" => $results));
    return;
}

function ping($target)
{
    $latency = false;
    $host = preg_replace("/[^a-zA-Z0-9\.\-]+/", "", $target);
    $exec_string = '/bin/ping -n -c 1 -W 2 ' . $host . ' 2>&1';

    exec($exec_string, $output, $return);
    foreach ($output as $line) {
        $found = preg_match("/time=([\.0-9]+)\s*ms/", $line, $matches);
        if ($found > 0) {
            return floatval($matches[1]);
        }
    }

    return $latency;
}
