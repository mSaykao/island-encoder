<?php
include("head.php");
?>
<style>
    .modal .modal-body {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .modal .modal-body::-webkit-scrollbar {
        display: none;
        /* Safari and Chrome */
    }

    .spinBox {
        width: 57px;
        height: 20px;
        font-size: 20px;
        color: white;
        transition: .3s color, .3s border;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        font-weight: bold;
    }

    .spin {
        display: inline-block;
        width: 1em;
        height: 1em;
        color: inherit;
        vertical-align: middle;
        pointer-events: none;
        border-top: .1em solid currentcolor;
        border-right: .1em solid transparent;
        -webkit-animation: spin 1s linear infinite;
        animation: spin 1s linear infinite;
        border-radius: 100%;
        position: relative;
    }

    @-webkit-keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .front {
        backface-visibility: hidden;
        transform-style: preserve-3d;
        transition: transform 1s;
        -webkit-backface-visibility: hidden;
        -webkit-transform-style: preserve-3d;
        -webkit-transition: transform 1s;
    }

    .rear {
        position: absolute;
        top: 0;
        backface-visibility: hidden;
        transform-style: preserve-3d;
        transition: transform 1s;
        -webkit-backface-visibility: hidden;
        -webkit-transform-style: preserve-3d;
        -webkit-transition: transform 1s;
    }

    .front180 {
        transform: rotateY(180deg);
        -webkit-transform: rotateY(180deg);
    }

    .rear0 {
        transform: rotateY(0deg);
        -webkit-transform: rotateY(0deg);
    }

    .front0 {
        transform: rotateY(0deg);
        -webkit-transform: rotateY(0deg);
    }

    .rear180 {
        transform: rotateY(-180deg);
        -webkit-transform: rotateY(-180deg);
    }
</style>
<link href="vendor/table/bootstrap-table.min.css" rel="stylesheet">
<link href="vendor/fileinput/css/fileinput.min.css" rel="stylesheet">
<div id="alert"></div>
<div class="row">
    <div class="col-md-6">
        <div id="alertnet"></div>
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab">
                    <cn>网口1</cn>
                    <en>LAN1</en>
                </a>
            </li>
            <?php
            if ($hardware["capability"]["eth1"]) {
            ?>
                <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab">
                        <cn>网口2</cn>
                        <en>LAN2</en>
                    </a>
                </li>
            <?php
            }
            ?>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active" id="tab1">
                <form class="form-horizontal" id="net" role="form" style="margin-top: 20px;">
                    <?php
                    if ($hardware["function"]["dhcp"]) {
                    ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">DHCP</label>
                            <div class="col-sm-6">
                                <input type="checkbox" zcfg="dhcp" class="switch form-control">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">IP</label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="ip" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>掩码</cn>
                            <en>Mask</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="mask" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>网关</cn>
                            <en>Gateway</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="gateway" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            DNS
                        </label>

                        <div class="col-sm-6">
                            <input type="text" zcfg="dns" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            MAC
                        </label>
                        <div class="col-sm-6">
                            <input type="text" readonly id="mac" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="button" id="saveNet" class=" save btn btn-warning">
                                <cn>保存</cn>
                                <en>Save</en>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane fade in" id="tab2">
                <form class="form-horizontal" id="net2" role="form" style="margin-top: 20px;">
                    <?php
                    if ($hardware["function"]["dhcp"]) {
                    ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">DHCP</label>
                            <div class="col-sm-6">
                                <input type="checkbox" zcfg="dhcp" class="switch form-control">
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">IP</label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="ip" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>掩码</cn>
                            <en>Mask</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="mask" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>网关</cn>
                            <en>Gateway</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" zcfg="gateway" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            DNS
                        </label>

                        <div class="col-sm-6">
                            <input type="text" zcfg="dns" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            MAC
                        </label>
                        <div class="col-sm-6">
                            <input type="text" readonly id="mac2" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="button" id="saveNet2" class=" save btn btn-warning">
                                <cn>保存</cn>
                                <en>Save</en>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="title">
                <h3 class="panel-title">
                    <cn>密码设置</cn>
                    <en>Password</en>
                </h3>
            </div>
            <div class="panel-body">
                <div id="alertpw"></div>
                <form class="form-horizontal" role="form" id="passwd">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>旧密码</cn>
                            <en>Current</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="old" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>新密码</cn>
                            <en>New</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="new1" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>确认密码</cn>
                            <en>Confirm</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="password" name="new2" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6 col-sm-offset-3">
                            <button type="button" id="savePasswd" class=" save btn btn-warning">
                                <cn>保存</cn>
                                <en>Save</en>
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">

        <div class="panel panel-default" style="margin-top: 34px;">
            <div class="panel-heading">
                <h3 class="panel-title">
                    NTP & Auto reboot
                </h3>
            </div>
            <div class="panel-body">
                <div id="alerttm"></div>
                <form class="form-horizontal" role="form" id="time">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>系统时间</cn>
                            <en>system time</en>
                        </label>
                        <div class="col-sm-6">
                            <input type="text" name="time" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="sync" class="btn btn-warning ">
                                <cn>本地同步</cn>
                                <en>Sync to PC</en>
                            </button>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form" id="ntp">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            NTP <cn>同步</cn>
                            <en>sync</en>
                        </label>

                        <div class="col-sm-6">
                            <input type="text" zcfg="server" class="form-control" />
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" zcfg="enable" class="switch form-control">
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form" id="timeZone">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>时区设置</cn>
                            <en>time zone</en>
                        </label>
                        <div class="col-sm-3">
                            <select id="timeArea" zcfg="timeArea" class="selectpicker form-control">
                                <option value="Africa">Africa</option>
                                <option value="America">Americas</option>
                                <option value="Antarctica">Antarctica</option>
                                <option value="Asia">Asia</option>
                                <option value="Atlantic">Atlantic Ocean</option>
                                <option value="Australia">Australia</option>
                                <option value="Europe">Europe</option>
                                <option value="Indian">Indian Ocean</option>
                                <option value="Pacific">Pacific Ocean</option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select id="timeCity" zcfg="timeCity" class="selectpicker form-control" style="padding: 0"></select>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" role="form" id="cron">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            <cn>维护时间</cn>
                            <en>reboot time</en>
                        </label>
                        <div class="col-sm-3">
                            <select id="cron_day" name="day" class="selectpicker form-control">
                                <option cn="从不" en="never" value="x"></option>
                                <option cn="每天" en="everyday" value="*"></option>
                                <option cn="每周一" en="monday" value="1"></option>
                                <option cn="每周二" en="tuesday" value="2"></option>
                                <option cn="每周三" en="wednesday" value="3"></option>
                                <option cn="每周四" en="thursday" value="4"></option>
                                <option cn="每周五" en="friday" value="5"></option>
                                <option cn="每周六" en="saturday" value="6"></option>
                                <option cn="每周日" en="sunday" value="0"></option>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <select id="cron_time" name="time" class="selectpicker form-control" style="padding: 0">
                                <option value="0">0:00</option>
                                <option value="1">1:00</option>
                                <option value="2">2:00</option>
                                <option value="3">3:00</option>
                                <option value="4">4:00</option>
                                <option value="5">5:00</option>
                                <option value="6">6:00</option>
                                <option value="7">7:00</option>
                                <option value="8">8:00</option>
                                <option value="9">9:00</option>
                                <option value="10">10:00</option>
                                <option value="11">11:00</option>
                                <option value="12">12:00</option>
                                <option value="13">13:00</option>
                                <option value="14">14:00</option>
                                <option value="15">15:00</option>
                                <option value="16">16:00</option>
                                <option value="17">17:00</option>
                                <option value="18">18:00</option>
                                <option value="19">19:00</option>
                                <option value="20">20:00</option>
                                <option value="21">21:00</option>
                                <option value="22">22:00</option>
                                <option value="23">23:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8 col-sm-offset-3">
                            <button id="save" type="button" class="btn btn-warning" style="margin-right:20px;">
                                Save
                            </button>
                            <button id="reboot" type="button" class="btn btn-warning" style="margin-right:20px;">
                                Reboot
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row col-md-6">
        <div class="panel panel-default" style="margin-top: 34px;">
            <div class="panel-heading">
                <h3 class="panel-title">Set Encoder name</h3>
            </div>
            <div class="panel-body">
                <div id="alert-box-name"></div>
                <form class="form-horizontal" role="form" id="box-name">
                    <div class="form-group">
                        <label class="control-label col-sm-3">Name</label>
                        <div class="col-sm-5">
                            <input type="text" name="new-box-name" class="form-control"></input>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" id="change-name" class="btn btn-warning">Change</button>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script src="js/zcfg.js"></script>
<script src="vendor/switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" src="js/confirm/jquery-confirm.min.js"></script>
<script src="js/fontawesome-iconpicker.min.js"></script>
<script src="vendor/table/bootstrap-table.min.js"></script>
<script src="js/handlebars-v4.7.6.js"></script>
<script src="js/jszip.js"></script>
<script src="js/filesaver.min.js"></script>
<script src="vendor/fileinput/js/fileinput.min.js"></script>

<script>
    var updatePatchs = "";
    var facAliase = "";
    var hadUpdate = false;




    $(function() {
        navIndex(6);
        $.fn.bootstrapSwitch.defaults.size = 'small';
        $.fn.bootstrapSwitch.defaults.onColor = 'warning';
        $(".switch").bootstrapSwitch();

        $.ajax({
            url: "config/mac",
            success: function(data) {
                var mac = data.replace(/[\r\n]/g, "").toUpperCase();
                var macStr = "";
                for (var i = 0; i < mac.length; i += 2) {
                    macStr += mac.substr(i, 2);
                    if (i + 2 < mac.length)
                        macStr += ":";
                }
                $("#mac").val(macStr);
            }
        }).responseText;


        $.ajax({
            url: "config/mac2",
            success: function(data) {
                var mac = data.replace(/[\r\n]/g, "").toUpperCase();
                var macStr = "";
                for (var i = 0; i < mac.length; i += 2) {
                    macStr += mac.substr(i, 2);
                    if (i + 2 < mac.length)
                        macStr += ":";
                }
                $("#mac2").val(macStr);
            }
        }).responseText;


        $("#change-name").click(function(e) {
            var newName = $("input[name='new-box-name']").val();
            if (newName == undefined || newName == "") {
                htmlAlert("#alert", "danger", "Error", "Name must not be empty", 10000);
                return;
            }

            func("setBoxName", {
                name: newName
            }, function(res) {
                htmlAlert("#alert-box-name", "success", "Result", res.result, 5000);
            });
            return false;
        });


        var ntpCfg;
        $.getJSON("config/ntp.json", function(result) {
            ntpCfg = result;
            zcfg("#ntp", ntpCfg);
        });
        <?php
        if ($hardware["function"]["portCtrl"]) {
        ?>
            var portCfg;
            $.getJSON("config/port.json", function(result) {
                portCfg = result;
                zcfg("#port", portCfg);
            });

            $("#savePort").click(function(e) {
                rpc3("update", [JSON.stringify(portCfg, null, 2)], function(data) {
                    if (typeof(data.error) != "undefined") {
                        htmlAlert("#alertPort", "danger", "<cn>保存设置失败！</cn><en>Save config failed!</en>", "", 2000);
                    } else {
                        htmlAlert("#alertPort", "success", "<cn>保存设置成功！</cn><en>Save config success!</en>", "", 2000);
                    }
                });
            });
        <?
        }
        ?>
        var netConfig;
        $.getJSON("config/net.json", function(result) {
            netConfig = result;
            zcfg("#net", netConfig);
        });

        var netConfig2;
        $.getJSON("config/net2.json", function(result) {
            netConfig2 = result;
            zcfg("#net2", netConfig2);
        });

        var wifiConfig;
        $.getJSON("config/wifi.json", function(result) {
            wifiConfig = result;
            zcfg("#wifi", wifiConfig);
        });

        $.getJSON("config/ssid.json", function(ssid) {
            $("#wifi #ssid").val(ssid.ssid);
        });

        var videoBuffer;
        $.getJSON("config/version.json", function(ver) {
            $("#ver_app").text(ver.app);
            $("#ver_sdk").text(ver.sdk);
            $("#ver_sys").text(ver.sys);
        });

        var timeZone;
        $.getJSON("/timezone/tzselect.json", function(result) {
            timeZone = result;
            $.getJSON("/timezone/zoneinfo/" + result.timeArea + "/", function(res) {
                $("#timeCity").html("");
                for (var i = 0; i < res.length; i++)
                    $("#timeCity").append('<option value="' + res[i].name + '">' + res[i].name + '</option>');
                zcfg("#timeZone", result);
            })
        })

        $.getJSON("config/videoBuffer.json", function(vb) {
            videoBuffer = vb;
            for (var key in vb) {
                if (key == "used")
                    continue;
                $("#scene").append('<option value="' + key + '">' + key + '</option>');
            }
            zcfg(".scene", vb);
        });

        function ajax(url, options, callback) {
            window.URL = window.URL || window.webkitURL
            var xhr = new XMLHttpRequest()
            if (options.responseType) {
                xhr.responseType = options.responseType
            }
            xhr.open('get', 'http://' + location.hostname + '/config/' + url, true)
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    callback(xhr, url);
                }
            }
            xhr.send()
        }

        $("#packageConfs").click(function(e) {
            var confs = ["lang.json"];
            $("#upConfig").find("input").each(function(index, ele) {
                if ($(ele)[0].checked) {
                    var cfg_path = $(ele).attr("conf");
                    if (cfg_path == "cron") {
                        confs.push("ntp.json");
                        confs.push("auto/root.cron");
                        confs.push("misc/timezone/tzselect.json");
                    } else if (cfg_path == "videoBuffer.json") {
                        confs.push("board.json");
                        confs.push("videoBuffer.json");
                    } else {
                        confs.push(cfg_path);
                    }
                }
            });

            var zip = new JSZip();
            for (var i = 0; i < confs.length; i++) {
                ajax(confs[i], {
                    responseType: 'blob'
                }, function(xhr, fileName) {
                    zip.file(fileName, xhr.response, {
                        binary: true
                    });
                })
            }

            setTimeout(function() {
                if (Object.keys(zip.files).length > 0) {
                    zip.generateAsync({
                        type: 'blob'
                    }).then((blob) => {
                        saveAs(blob, 'configs.zip');
                    });
                } else {
                    console.log('下载全部失败')
                }
            }, 300);
        });

        $("#change").click(function(e) {
            func("setVideoBuffer", videoBuffer, function(res) {
                if (res.error != "") {
                    htmlAlert("#alertvb", "danger", "<cn>保存设置失败</cn><en>Save config failed</en>！", "", 2000);
                } else {
                    htmlAlert("#alertvb", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
                }
            });
        });

        function isValidIP(ip) {
            var reg = /^(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$/
            return reg.test(ip);
        }

        function isValidNet(cfg) {
            return isValidIP(cfg.ip) && isValidIP(cfg.mask) && isValidIP(cfg.gateway) && isValidIP(cfg.dns);
        }

        $("#saveNet").click(function(e) {
            if (isValidNet(netConfig)) {
                func("setNetwork", netConfig, function(res) {
                    if (res.error != "") {
                        htmlAlert("#alertnet", "danger", "<cn>保存设置失败</cn><en>Save config failed</en>！", "", 2000);
                    } else {
                        htmlAlert("#alertnet", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
                    }
                });
                setTimeout('window.location.href="http://' + netConfig.ip + '/sys.php";', 1000);
            } else
                htmlAlert("#alertnet", "danger", "<cn>不正确的输入格式</cn><en>Invalid ip address</en>！", "", 2000);
        });

        $("#saveNet2").click(function(e) {
            if (isValidNet(netConfig2)) {
                func("setNetwork2", netConfig2, function(res) {
                    if (res.error != "") {
                        htmlAlert("#alertnet", "danger", "<cn>保存设置失败</cn><en>Save config failed</en>！", "", 2000);
                    } else {
                        htmlAlert("#alertnet", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
                    }
                });
            } else
                htmlAlert("#alertnet", "danger", "<cn>不正确的输入格式</cn><en>Invalid ip address</en>！", "", 2000);
        });

        $("#saveWifi").click(function(e) {
            rpc2("wifi.update", [wifiConfig], function(data) {
                if (typeof(data.error) != "undefined") {
                    htmlAlert("#alertnet", "danger", "<cn>保存设置失败</cn><en>Save config failed</en>！", "", 2000);
                } else {
                    htmlAlert("#alertnet", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
                }
            });
            //setTimeout( 'window.location.href="http://' + wifiConfig.ip + '/sys.php";', 1000 );
        });

        $("#addWifi").click(function() {
            $('#modalAdd').modal('show');
            scanWifi();
        });
        $("#setWifi").click(function() {
            $('#modalSet').modal('show');
            wifiList();
        });
        $("#scanWifi").click(function() {
            scanWifi();
        });

        $("#connectWifi").click(function() {
            connectWifi();
        });

        function connectWifi() {
            rpc2("wifi.addWifi", [$("#add select[name='ssid']").val(), $("#add input[name='passwd']").val()], function(data) {

                if (typeof(data.error) != "undefined") {
                    $("#tab2").myAlert("danger", "<cn>通信错误</cn><en>Connect faild</en>:", data.error);
                    return;
                }

                $("#add").myAlert("success", "<cn>添加成功</cn><en>Add success</en>:", "<cn>若未连接，请确认密码，删除后重新添加。</cn><en>If didn't connect, confirm password, delete and add again.</en>");
            });
        }

        function scanWifi() {
            rpc2("wifi.scanWifi", null, function(data) {

                if (typeof(data.error) != "undefined") {
                    $("#tab2").myAlert("danger", "<cn>通信错误</cn><en>Connect faild</en>:", data.error);
                    return;
                }

                $("#add select[name='ssid']").html('');

                $.each(data, function(i, d) {
                    var text = d.ssid;
                    if (d.flags == "open")
                        text += '[open]';

                    $("#add select[name='ssid']").append($('<option>', {
                        value: d.ssid,
                        text: text
                    }));
                });


            });

        }

        $("#savePasswd").click(function() {
            func("setPasswd", $("#passwd").serialize(), function(res) {
                if (res.error != "")
                    htmlAlert("#alertpw", "danger", res.error, "", 2000);
                else
                    htmlAlert("#alertpw", "success", "<cn>修改密码成功</cn><en>Save password success</en>！", "", 2000);
            });

        });

        $("#timeArea").change(function() {
            $.getJSON("/timezone/zoneinfo/" + $(this).val() + "/", function(res) {
                $("#timeCity").html("");
                for (var i = 0; i < res.length; i++) {
                    if (i == 0)
                        timeZone.timeCity = res[0].name;
                    $("#timeCity").append('<option value="' + res[i].name + '">' + res[i].name + '</option>')
                }
            })
        });

        $("#save").click(function(e) {
            func("setNTP", ntpCfg);
            func("setTimeZone", timeZone);
            func("setCron", $("#cron").serialize(), function(res) {
                if (res.result == "OK") {
                    htmlAlert("#alerttm", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
                } else {
                    htmlAlert("#alerttm", "danger", "<cn>保存设置失败</cn><en>Save config failed</en>！", "", 2000);
                }
            });
        });

        $("#startHelp").click(function(e) {
            var authCode = Math.floor(Math.random() * 1000);
            $("#authCode").val(authCode);
            func("startHelp", {
                authCode: authCode
            }, function(res) {
                if (res.result == "OK") {
                    htmlAlert("#alertHelp", "success", "<cn>连接成功，请向客服提供授权码以便控制您的编码器。</cn><en>Connect success, please provide auth code to customer service to control your encoder</en>！", "", 3000);
                }
            });
        });

        $("#stopHelp").click(function(e) {
            func("stopHelp", null, function(res) {
                if (res.result == "OK") {
                    htmlAlert("#alertHelp", "success", "<cn>已断开连接</cn><en>Disconnect success</en>！", "", 2000);
                }
            });
        });

        func("setCron", null, function(result) {
            if (result.result == null || result.result.split(" ").length != 6) {
                $('#cron_time').val('0');
                $('#cron_day').val('x');
            } else {
                $('#cron_time').val(result.result.split(" ")[1]);
                $('#cron_day').val(result.result.split(" ")[4]);
            }
        });

        Date.prototype.Format = function(fmt) { //author: meizz 
            var o = {
                "M+": this.getMonth() + 1, //月份 
                "d+": this.getDate(), //日 
                "h+": this.getHours(), //小时 
                "m+": this.getMinutes(), //分 
                "s+": this.getSeconds(), //秒 
                "q+": Math.floor((this.getMonth() + 3) / 3), //季度 
                "S": this.getMilliseconds() //毫秒 
            };
            if (/(y+)/.test(fmt)) fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
            for (var k in o)
                if (new RegExp("(" + k + ")").test(fmt)) fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
            return fmt;
        }
        func("getTime", null, function(res) {
            if (res.error == "")
                $('input[name="time"]').val(res.result);
        });

        $("#sync").click(function(e) {
            var now = new Date();
            var tm = now.Format("yyyy-MM-dd hh:mm:ss");
            var tm2 = now.Format("yyyy/MM/dd/hh/mm/ss");
            $('input[name="time"]').val(tm);
            func("setTime", {
                time: tm2,
                time2: tm
            }, function(res) {
                htmlAlert("#alerttm", "success", "<cn>保存设置成功</cn><en>Save config success</en>！", "", 2000);
            });
        });

        $("#netTest").click(function(e) {
            func("testNet", netConfig, function(res) {
                var str = res.result.join();
                if (str == "") {
                    htmlAlert("#alertNetTest", "danger", "<cn>域名解析超时</cn><en>DNS timeout</en>！", "", 2000);
                } else if (str.indexOf(" 0%") > 0) {
                    htmlAlert("#alertNetTest", "success", "<cn>网络可用</cn><en>Network available</en>！", "", 2000);
                } else
                    htmlAlert("#alertNetTest", "danger", "<cn>网络不可用</cn><en>Network Unavailable</en>！", "", 2000);

            });

        });

        $("#reboot").click(function(e) {
            onConfirmReboot("是否立即重启系统?");
        });


        $(".btn-primary").addClass("btn-warning");
        $(".file-preview").css("border", "none");
        $(".fileinput-remove").hide();
        $(".file-caption-main").css("padding", "0px 16px");
    });
</script>
<?php
include("foot.php");
?>
