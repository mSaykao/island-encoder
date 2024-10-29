<?php
include("head.php");
?>
<div id="alert"></div>
<div class="col-md-12">
  <div class="panel panel-default">
    <div class="title">
      <h3 class="panel-title">
        Receive SRT Stream
        <a href="#" class="show-srt-help-text"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
      </h3>
    </div>
    <div class="panel-body">
      <table class="table">
        <thead>
          <tr>
            <th class="col-lg-2 col-md-1 col-sm-2 col-xs-1">Channel name</th>
            <th class="col-lg-1 col-md-2 col-sm-2 col-xs-2">Mode</th>
            <th class="col-lg-4 col-md-3 col-sm-3 col-xs-3">Address</th>
            <th class="col-lg-1 col-md-2 col-sm-2 col-xs-2">Network port</th>
            <th class="col-lg-1 col-md-2 col-sm-2 col-xs-2">Latency (ms)</th>
            <th class="col-lg-2 col-md-2 col-sm-2 col-xs-1">Enabled</th>
          </tr>
        </thead>
        <tbody id="templateStreams">
          <tr>
            <td>
              <input type="text" zcfg="[#].name" class="form-control">
            </td>
            <td>
              <select zcfg="[#].mode" class="form-control srt-mode-select">
                <option value="caller">Caller</option>
                <option value="listener">Listener</option>
                <option value="rendezvous">Rendezvous</option>
              </select>
            </td>
            <td>
              <input zcfg="[#].hostname" type="text" class="form-control srt-ip-input">
            </td>
            <td>
              <input zcfg="[#].port" type="text" class="form-control">
            </td>
            <td>
              <input zcfg="[#].latency" type="text" class="form-control">
            </td>
            <td>
              <input type="checkbox" zcfg="[#].enabled" class="switch form-control">
            </td>
          </tr>
        </tbody>
      </table>

      <? include "srt-help-text.php"; ?>
      <hr style="margin-top:10px; margin-bottom: 10px;" />
      <div class="row">
        <div class="col-md-12 text-center">
          <button id="save" type="button" class="btn btn-warning col-xs-4 col-xs-offset-4 col-md-2 col-md-offset-5">Save</button>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="vendor/switch/bootstrap-switch.min.js"></script>
<script type="text/javascript" language="javascript" src="js/confirm/jquery-confirm.min.js"></script>
<script src="js/zcfg.js"></script>
<script src="js/networkInterfaces.js"></script>
<script>
  function srtModeChangeHandler() {
    var newMode = this.value;
    if (newMode == "listener") {
      var neigh = $(this).parent().parent().find(".srt-ip-input");
      neigh.val("0.0.0.0");
      neigh.trigger("change");
    }
    return true;
  }

  function decodeSrtUrl(url) {
    // url = "srt://127.0.0.1:9001?mode=caller&latency=2000";
    let config = {
      "hostname": "0.0.0.0",
      "port": 9000,
      "mode": "caller",
      "latency": 200,
    };

    if (url == null || url.length <= 1) {
      return config;
    }

    u = new URL(url);
    console.log(u);

    if (u.protocol != "srt:") {
      console.log(`Was not a SRT URL: ${url}`);
      return config;
    }

    if (u.hostname != "") {
      config["hostname"] = u.hostname;
    }
    if (u.port != "") {
      config["port"] = u.port;
    }

    if (u.host == "" && u.pathname != "") {
      // cope with some javascript compatibility issue?
      result = url.match(/^srt:\/\/([^:]+):([0-9]{2,5})/);
      if (result && result[1] && result[2]) {
        config["hostname"] = result[1];
        config["port"] = result[2];
      }
    }

    mode = u.searchParams.get("mode");
    if (mode && mode == "caller") {
      config["mode"] = "caller";
    } else if (mode && mode == "listener") {
      config["mode"] = "listener";
    } else if (mode && mode == "rendezvous") {
      config["mode"] = "rendezvous";
    }

    latency = parseInt(u.searchParams.get("latency"));
    if (latency > 0) {
      config["latency"] = latency;
    }

    return config;
  }


  $(function() {
    navIndex(2);
    var config;
    var streams;
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $.fn.bootstrapSwitch.defaults.onColor = 'warning';

    getSelfIPAddress();

    function getStreamConfig() {
      streams = new Array();
      $.getJSON("config/config.json", function(result) {
        config = result;
        console.log(config);
        for (var i = 0; i < config.length; i++) {
          if (config[i].type == "net") {
            item = decodeSrtUrl(config[i].net.path);
            item["name"] = config[i].name;
            item["configIdx"] = i;
            item["enabled"] = config[i].enable;
            streams.push(item);
          }
        }

        console.log(streams);
        zctemplet("#templateStreams", streams);

        $(".switch").bootstrapSwitch();

        // Set up the automatic change to 0.0.0.0 when listener is selected:
        // Find neighbour with class srt-ip-input
        $('.srt-mode-select').on("change", srtModeChangeHandler);
        postZfgSetupSrtHelpText();
      });
    }

    getStreamConfig();

    $("#save").click(function(e) {
      // console.log(streams);

      streams.forEach(s => {
        // Strip srt:// off the front of the hostname, if the user thought they had to add it.
        s.hostname.replace(/^srt:\/\//, "");
        latency = s.latency; // SRT library uses microseconds, not millis, so wondered if this needs to /1000?
        path = `srt://${s.hostname}:${s.port}?latency=${latency}&mode=${s.mode}`;

        config[s.configIdx]["name"] = s.name;
        config[s.configIdx]["enable"] = s.enabled;
        config[s.configIdx]["net"]["path"] = path;
        config[s.configIdx]["net"]["framerate"] = -1;
        config[s.configIdx]["net"]["bufferMode"] = 0;
        config[s.configIdx]["net"]["minDelay"] = s.latency;
        config[s.configIdx]["net"]["protocol"] = "udp";
        config[s.configIdx]["net"]["decodeV"] = true;
        config[s.configIdx]["net"]["decodeA"] = true;

      });

      // console.log(config);

      rpc("enc.update", [JSON.stringify(config, null, 2)], function(data) {
        if (typeof(data.error) != "undefined") {
          htmlAlert("#alert", "danger", "Error", "Save failed!");
        } else {
          htmlAlert("#alert", "success", "", "Save successful", 2000);
          getStreamConfig();
        }
      });
    });

  });
</script>
<?php
include("foot.php");
?>
