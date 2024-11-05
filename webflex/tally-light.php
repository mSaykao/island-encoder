<?php
include("head.php");
?>
<style>
    .form-group {
        padding-bottom: 2em;
    }
</style>
<div id="alert"></div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default">
            <div class="title">
                <h3 class="panel-title">
                    vMix tally link
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="vmix" role="form">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Status</label>
                        <div class="col-md-6 col-sm-8">
                            <select id="vMixStatus" class="form-control">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                            <!-- <input type="checkbox" class="switch form-control"> -->
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">vMix IP</label>
                        <div class="col-md-6 col-sm-8">
                            <input id="vMixIp" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Device name</label>
                        <div class="col-md-6 col-sm-8">
                            <input id="deviceName" type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">vMix input</label>
                        <div class="col-md-6 col-sm-8">
                            <select id="vMixInput" class="form-control">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="thin2">
        <div class="row">
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did1" class="intercomBtn"><i class="fa fa-microphone hide"></i>1</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did2" class="intercomBtn"><i class="fa fa-microphone hide"></i>2</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did3" class="intercomBtn "><i class="fa fa-microphone hide"></i>3</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did4" class="intercomBtn"><i class="fa fa-microphone hide"></i>4</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row ">
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did5" class="intercomBtn"><i class="fa fa-microphone hide"></i>5</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did6" class="intercomBtn"><i class="fa fa-microphone hide"></i>6</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did7" class="intercomBtn"><i class="fa fa-microphone hide"></i>7</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-3">
                        <div class="panel panel-default">
                            <div class="panel-body text-center">
                                <div id="did8" class="intercomBtn"><i class="fa fa-microphone hide"></i>8</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-3" style="display:none;">
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <div id="did0" class="intercomBtn"><i class="fa fa-microphone hide"></i>0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 col-sm-12">
        <div class="panel panel-default hidden" id="LedLightPanel">
            <div class="title">
                <h3 class="panel-title">Island LED light</h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" id="ledLight" role="form">

                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Status</label>
                        <div class="col-md-6 col-sm-8">
                            <select class="form-control" id="targetEnable">
                                <option value="1">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Mode</label>
                        <div class="col-md-6 col-sm-8">
                            <select class="form-control" id="targetMode">
                                <option value="tally">Tally</option>
                                <option value="signal">Signal</option>
                                <option value="tallyArbiter">Tally Arbiter</option>
                                <option value="record">Record</option>
                                <option value="push">Push</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-sm-4 control-label">Brightness</label>
                        <div class="col-md-6 col-sm-8">
                            <select class="form-control" id="targetBright">
                                <option value="0.1">10%</option>
                                <option value="0.2">20%</option>
                                <option value="0.3">30%</option>
                                <option value="0.4">40%</option>
                                <option value="0.5">50%</option>
                                <option value="0.6">60%</option>
                                <option value="0.7">70%</option>
                                <option value="0.8">80%</option>
                                <option value="0.9">90%</option>
                                <option value="1.0">100%</option>
                            </select>
                        </div>
                    </div>
                </form>
                <div class="col-md-12">
                    Changing LED light settings currently requires a restart of the system
                    for the new settings to take effect. This will cause a short interruption
                    to streaming and recording.<br>
                    <div class="col-lg-2 col-md-4 col-sm-4"><button class="btn btn-warning" id="restartEncoderSoftware" onclick="restartEncoderSoftware()">Software Reset</button></div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr style="margin-top:10px; margin-bottom: 10px;" />
<div class="text-center">
    <button type="button" id="saveBtn" class="btn btn-primary">Save</button>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalTest">Test</button>
</div>


<div class="modal fade" id="modalTest" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="test">
                <div class="row">
                    <form class="form-horizontal" id="tallyTest" role="form">
                        <div class="form-group">
                            <label class="col-sm-2 col-xs-6 control-label">PVM</label>
                            <div class="col-sm-2 col-xs-6">
                                <select id="tally_PVM" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>

                            <label class="col-sm-2 col-xs-6 control-label">PGM</label>
                            <div class="col-sm-2 col-xs-6">
                                <select id="tally_PGM" class="form-control">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <button type="button" id="tally_test" class="btn btn-warning col-md-4 col-md-offset-3">Test</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="vendor/switch/bootstrap-switch.min.js"></script>

<script>
    var config;
    var myid;
    var myname;
    var hardwareModel = "<? echo $hardware["model"]; ?>"

    function getTallyConfig() {
        fetch("/config/led/config.json").then(r => r.json()).then(data => {
            document.querySelector("#targetEnable").value = data["enable"] ? "1" : "0";
            document.querySelector("#targetMode").value = data["func"];
            document.querySelector("#targetBright").value = data["brightness"];
            config = data;
        });
    }

    function getIntercomStatus() {
        fetch("/config/intercom.json").then(r => r.json()).then(data => {
            myid = data.intercom.did;
            myname = data.intercom.name;
            if (data.intercom["enable"] && data.server["enable"] && data.tally["enable"] && data.vmix["enable"]) {
                document.querySelector("#vMixStatus").value = "1";
            } else {
                document.querySelector("#vMixStatus").value = "0";
            }

            document.querySelector("#vMixIp").value = data.vmix["ip"];
            document.querySelector("#vMixInput").value = data.intercom["did"];
            document.querySelector("#deviceName").value = data.intercom["name"];
        });
    }

    function initialSetup() {
        if (hardwareModel == "ENCS1") {
            document.querySelector("#LedLightPanel").classList.remove("hidden");
            getTallyConfig();
        }
        getIntercomStatus();
        document.querySelector("#saveBtn").addEventListener("click", saveConfig);
    }

    function saveConfig() {
        saveVmixConfig();
        if (hardwareModel == "ENCS1") {
            saveTallyConfig();
        }
    }

    function saveVmixConfig() {
        fetch("/config/intercom.json").then(r => r.json()).then(data => {
            overallEnabled = document.querySelector("#vMixStatus").value == "1";
            data.intercom["enable"] = overallEnabled;
            data.server["enable"] = overallEnabled;
            data.tally["enable"] = overallEnabled;
            data.vmix["enable"] = overallEnabled;
            data.intercom["name"] = document.querySelector("#deviceName").value;
            data.intercom["did"] = document.querySelector("#vMixInput").value;
            data.intercom["tid"] = -1;
            data.vmix["mode"] = "vmix";
            data.vmix["ip"] = document.querySelector("#vMixIp").value;
            rpc("intercom.update", [data], function(res) {
                if (typeof(res.error) != "undefined") {
                    htmlAlert("#alert", "danger", "Save failed!", "", 10000);
                } else {
                    myid = data.intercom.did;
                    myname = data.intercom.name;
                    htmlAlert("#alert", "success", "Config saved", "", 2000);
                }
            });
        });
    }

    function saveTallyConfig() {
        if (config === undefined) {
            alert("Config not loaded yet");
            return;
        }
        config["enable"] = document.querySelector("#targetEnable").value === "1";
        config["func"] = document.querySelector("#targetMode").value;
        config["brightness"] = document.querySelector("#targetBright").value;
        func("saveTallyConfig", {
            config: config
        }, function(result) {
            if (result.error != undefined && result.error != "") {
                htmlAlert("#alert", "danger", "Error", result.error);
            } else {
                htmlAlert("#alert", "success", "Saved", "", 5000);
            }
        });
    }

    if (document.readyState !== 'loading') {
        initialSetup();
    } else {
        document.addEventListener('DOMContentLoaded', initialSetup);
    }

    function restartEncoderSoftware() {
        callback = function(result) {
            if (result.error != undefined && result.error != "") {
                htmlAlert("#alert", "danger", "Error", result.error);
            } else {
                htmlAlert("#alert", "success", "Success", "Restarting...", 3000);
            }
        }
        if (confirm("This will interrupt streaming! Are you sure?")) {
            func("restartEncoderSoftware", undefined, callback);
        }
    }

    $(function() {
        navIndex(5);
        $.fn.bootstrapSwitch.defaults.size = 'small';
        $.fn.bootstrapSwitch.defaults.onColor = 'warning';

        $("#tally_test").click(function() {
            var list = [];
            for (var i = 1; i <= 8; i++) {
                var v = 0;
                if ($("#tally_PVM").val() == i)
                    v = 2;
                if ($("#tally_PGM").val() == i)
                    v = 1;
                list.push(v);
            }
            rpc("intercom.setTally", [list]);
        });

        function getState() {
            rpc("intercom.getState", null, function(res) {
                // console.log(res);
                var intercom = res.intercom;
                var tally = res.tally;
                var ids = [];
                ids.push(Number(myid));
                $("#did" + myid).addClass("alive");
                if (res.talking)
                    $("#did" + myid + " i").removeClass("hide");
                else
                    $("#did" + myid + " i").addClass("hide");

                for (var i = 0; i < intercom.length; i++) {
                    var chn = intercom[i];
                    ids.push(Number(chn.id));
                    $("#did" + chn.id).addClass("alive");
                    if (chn.talking)
                        $("#did" + chn.id + " i").removeClass("hide");
                    else
                        $("#did" + chn.id + " i").addClass("hide");
                }

                for (var i = 0; i <= 8; i++) {
                    if (ids.indexOf(i) < 0) {
                        $("#did" + i).removeClass("alive");
                        $("#did" + i + " i").addClass("hide");
                    }

                    if (i < 8) {
                        if (tally && i < tally.length && tally[i] > 0) {
                            var x = tally[i];

                            if (x == 1) {
                                $("#did" + (i + 1)).removeClass("green");
                                $("#did" + (i + 1)).addClass("red");
                            } else if (x == 2) {
                                $("#did" + (i + 1)).removeClass("red");
                                $("#did" + (i + 1)).addClass("green");
                            }
                        } else {
                            $("#did" + (i + 1)).removeClass("green");
                            $("#did" + (i + 1)).removeClass("red");
                        }
                    }
                }

                setTimeout(getState, 500);
            });
        }
        getState();
    });
</script>

<?php
include("foot.php");
?>
