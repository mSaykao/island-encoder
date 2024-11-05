var configDisk = {};

function getMountedPath() {
    func("getMountedPath", [], function (ret) {
        var mountedPath = "None"
        $("#diskSpace").html('<span>-- / --</span>');
        if (ret.result != null) {
            mountedPath = ret.result;
            func("getDiskSpace", [], function (res) {
                $("#diskSpace").html('Used <span> ' + res.used + ' / ' + res.total + '</span>')
            });
        }
        document.querySelectorAll("#mountStatus").forEach(el => el.innerHTML = mountedPath);
        $(".disk").show();
    })
}

function openDiskModal(isAdmin) {
    func("getLocalDisk", [], function (data) {
        for (var i = 0; i < data.result.length; i++) {
            var item = data.result[i];
            if (item.name == "/dev/mmcblk0p6") {
                if (isAdmin) {
                    $("#diskDevices").append('<option value="' + item.name + '">device storage  ( ' + item.size + ' )</option>')
                }
            } else {
                $("#diskDevices").append('<option value="' + item.name + '">' + item.name + '  ( ' + item.size + ' )</option>')
            }
        }

        $.getJSON("config/misc/disk.json", function (res) {
            configDisk = res;
            zcfg("#disk", configDisk);
            getMountedPath();
        }).fail(function (error) {
            configDisk = {
                enable: false,
                used: "local",
                shared: {
                    ip: "",
                    type: "cifs",
                    path: "",
                    auth: {
                        uname: "",
                        passwd: "",
                    }
                },
                local: {
                    device: ""
                }
            }
            zcfg("#disk", configDisk);
            getMountedPath();
        });
    });
}

function diskModalSetup() {
    $("#eyeBtn").click(function () {
        if ($(this).children().hasClass("fa-eye-slash")) {
            $(this).prev().attr("type", "text");
            $(this).children().removeClass("fa-eye-slash").addClass("fa-eye");
        } else {
            $(this).prev().attr("type", "password");
            $(this).children().removeClass("fa-eye").addClass("fa-eye-slash");
        }
    });

    $("#unmount").click(function () {
        $.confirm({
            title: '<h4 style="font-weight: 600">Unmount Disk</h4>',
            content: "Confirm recording is disabled before unmounting disk",
            buttons: {
                ok: {
                    text: "Unmount",
                    btnClass: 'btn-warning',
                    keys: ['enter'],
                    action: function () {
                        func("umountDisk", [], function (res) {
                            if (res.error != "") {
                                htmlAlert("#alert", "danger", res.error, "", 3000);
                                return;
                            }
                            getMountedPath();
                        })
                    }
                },
                cancel: {
                    text: "Cancel"
                }
            }
        });
    });

    $("#saveDisk").click(function () {
        func("saveConfigFile", { path: "config/misc/disk.json", data: JSON.stringify(configDisk, null, 2) }, function (res) {
            if (res.result == "OK") {
                htmlAlert("#alert", "success", "Saved successfully", "", 3000);
                func("mountDisk", [], function (data) {
                    getMountedPath();
                })
            }
        });
    });
}