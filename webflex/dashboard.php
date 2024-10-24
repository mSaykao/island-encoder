<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
 <head>
     <?php include ("./public/head.inc") ?>
 </head>
  <body>

  <?php include ("./public/menu.inc") ?>
    <div data-simplebar>
        <main class="page-content dashboard" id="app" v-cloak>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="p-2 mb-0 d-flex align-items-end">
                            <en>H1 Test Island</en>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="p-2 mb-0 d-flex align-items-end">
                            <en>Preview</en>
                            <small style="color: #AAA">
                                <en>Note: Preview only, not realtime</en>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.chip !== 'SS626V100'">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>Input Status</en>
                            </div>
                        </div>
                    <div class="card-body iface py-3">
                        <div v-for="(item,index) in input" :key="index" :class="[{'ms-5':index > 0},{'hdmi':item.protocol==='HDMI'},{'sdi':item.protocol==='SDI' || item.protocol==='AHD'},{'vga':item.protocol==='VGA'},{'disable':!item.avalible}]">
                            <span class="info">{{item.info}}</span>
                            <div :class="['icon']"></div>
                            <span class="name">{{item.name}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div>
                            <en>Encoder/Streaming Status</en>
                        </div>
                    </div>
                    <div class="panel-body" style="padding: 20px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Encoding</th>
                                    <th>Streaming</th>
                                </tr>
                            </thead>
                            <tbody id="streamStatus"></tbody>
                        </table>
                    </div>
                </div>
            </div>                
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-transparent">
                        <div class="p-2 mb-0 d-flex align-items-end">
                            <en>Recording Status</en>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 20px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Channel</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <cn>ç³»ç»ŸçŠ¶æ€</cn>
                                <en>System state</en>
                            </div>
                        </div>
                        <div class="panel-body" style="padding: 20px;">
                            <div class="row row-cols-3 text-center">
                                <div class="col-lg-4 ">
                                    <pie-chart v-if="theme_color" v-model="cpu" :active-color="theme_color"></pie-chart>
                                    <div>
                                        <cn>CPUä½¿ç”¨çŽ‡</cn>
                                        <en>CPU MADNESS</en>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <pie-chart v-if="theme_color" v-model="mem" :active-color="theme_color"></pie-chart>
                                    <div>
                                        <cn>å†…å­˜ä½¿ç”¨çŽ‡</cn>
                                        <en>Memory usage</en>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center">
                                    <tmp-compt v-if="theme_color" v-model="tmp" :active-color="theme_color"></tmp-compt>
                                    <div>
                                        <cn>æ ¸å¿ƒæ¸©åº¦</cn>
                                        <en>Core temperature</en>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <cn>ç½‘ç»œçŠ¶æ€</cn>
                                <en>Network Traffic</en>
                            </div>
                        </div>
                        <div class="card-body">
                            <net-chart v-if="theme_color && tx.length > 0" :maxy="maxy" :data1="tx" :data2="rx" :key="netFlotKey"
                                       :line1-color="theme_color" :line2-color="line2_color" :tick-color="tickColor" :border-color="borderColor"
                                       :tip-border-color="tipBorderColor" :tip-bg-color="tipBgColor" :tip-txt-color="tipTxtColor"></net-chart>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>Network Interface</en>
                            </div>
                        </div>
                        <div class="card-body" id="networkInterfaces">
                        </div>
                    </div>
                </div>                
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>Maintenance</en>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="row">
                                <div class="col-md-12">Sometimes you just want to try turning it off and on again.</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button class="btn btn-warning" id="restartEncoderSoftware">Software Reset</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-3">
                                    <button class="btn btn-warning make-me-orange" id="restartTailscale">VPN Reset</button>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <button class="btn btn-danger" id="rebootEncoderBox">Reboot Encoder</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
  <?php include ("./public/foot.inc") ?>
  <script src="assets/plugins/easyPieChart/jquery.easypiechart.js" type="module"></script>
  <script src="assets/plugins/flotChart/jquery.flot.js" type="module"></script>
  <script src="assets/plugins/flotChart/jquery.flot.resize.js" type="module"></script>

  <script type="module">
      import { rpc,isEmpty } from "./assets/js/lp.utils.js";
      import {useDefaultConf, useHardwareConf, useThemeConf} from "./assets/js/vue.hooks.js";
      import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,statusPieChartComponent,statusTemperatureComponent,netFlotChartComponent } from "./assets/js/vue.helper.js"
      import vue from "./assets/js/vue.build.js";
      import mutationObserver from './assets/plugins/polyfill/mutationobserver.esm.js';

      const { createApp,ref,reactive,watchEffect,nextTick,onMounted } = vue;
      const app  = createApp({
          components:{
              "bs-switch":bootstrapSwitchComponent,
              "net-chart":netFlotChartComponent,
              "pie-chart":statusPieChartComponent,
              "tmp-compt":statusTemperatureComponent
          },
          setup(prop,context){

              const state = {
                  cpu: ref(0), tmp: ref(0),
                  mem: ref(0), maxy: ref(0),
                  tx : reactive([]),
                  rx : reactive([]),
                  netFlotKey:ref(0),
                  data1:[],
                  data2:[],
                  preview : reactive([]),
                  hadPreView: ref(false),
                  input : reactive([]),
                  volume: [],
                  theme_color:ref(""),
                  line2_color:ref("#555555"),
                  tipBorderColor:ref("#ffbb00"),
                  tipBgColor:ref("#ffffff"),
                  tipTxtColor:ref("#555555"),
                  tickColor:ref("#eeeeee"),
                  borderColor:ref("#cccccc"),
                  useTheme: ""
              }

              const { defaultConf } = useDefaultConf();
              const { hardwareConf } = useHardwareConf();
              const { themeConf,handleThemeActiveLinkStyle } = useThemeConf();

              watchEffect(()=>{
                  if(themeConf.mod === 'style') {
                      if(!isEmpty(themeConf) && state.useTheme) {
                          const activeTheme = themeConf.themeActives.find(item => item.active === themeConf.active);
                          state.theme_color.value = activeTheme.colors["bs-active-bg-color"];
                          if(state.useTheme === "default")
                              state.tipBorderColor.value = activeTheme.colors["bs-active-bg-color"];
                          else
                              state.tipBorderColor.value = "#aaa";
                      }
                  } else {
                      handleThemeActiveLinkStyle().then(themeActiveConf =>{
                          state.theme_color.value = themeActiveConf["bs-active-bg-color"];
                          if(state.useTheme === "default")
                              state.tipBorderColor.value = themeActiveConf["bs-active-bg-color"];
                          else
                              state.tipBorderColor.value = "#aaa";
                      })
                  }
              })

              const getData1 = (d) => {
                  state.data1.shift();
                  state.data1.push( d );
                  state.tx.splice(0);
                  for (let i = 0; i < 100; i++)
                      state.tx.push([i,state.data1[i]]);
              }

              const getData2 = (d) => {
                  state.data2.shift();
                  state.data2.push( d );
                  state.rx.splice(0);
                  for (let i = 0; i < 100; i++)
                      state.rx.push([i,state.data2[i]]);
              }

              const updateNetState = () => {
                  if(state.data1.length === 0 && state.data2.length === 0) {
                      for ( let i = 0; i < 100; i++ ) {
                          state.data1.push( 0 );
                          state.data2.push( 0 );
                      }
                  }
                  rpc("enc.getNetState").then(data => {
                      getData1(data.tx);
                      getData2(data.rx);
                      if ( data.tx * 1.3 > state.maxy.value )
                          state.maxy.value = data.tx * 1.3;
                      if ( data.rx * 1.3 > state.maxy.value )
                          state.maxy.value = data.rx * 1.3;
                      if ( state.maxy.value < 1024 )
                          state.maxy.value = Math.ceil( state.maxy.value / 100 ) * 100;
                      else
                          state.maxy.value = Math.ceil( state.maxy.value / 1024 ) * 1024;
                      if ( state.maxy.value > 1024000 )
                          state.maxy.value = 1024000;
                      setTimeout(updateNetState, 500);
                  });
              }

              const updateSysState = () => {
                  const getSysState = () => {
                      rpc("enc.getSysState").then(data => {
                          state.cpu.value = data.cpu;
                          state.mem.value = data.mem;
                          state.tmp.value = data.temperature;
                      }).finally(() => {
                          setTimeout(getSysState, 2000);
                      });
                  };
                  setTimeout(getSysState,80);
              }

              const handleImgStyle = (width, height) => {
                  width = Number(width) > 0 ? Number(width) : 1920;
                  height = Number(height) > 0 ? Number(height) : 1080;
                  let ww = "100%";
                  let hh = (16 * height) / (width * 9) * 100 + "%";
                  if (width < height) {
                      hh = "100%";
                      ww = (9 * width) / (height * 16) * 100 + "%";
                  }
                  return `position: absolute;width: ${ww};height: ${hh};`;
              };

              const updatePreview = () => {
                  if(state.preview.length === 0) {
                      for(let i=0;i<defaultConf.length;i++) {
                          if (!defaultConf[i].enable || defaultConf[i].type === "ndi" || (defaultConf[i].type === "net" && !defaultConf[i].net.decodeV))
                              continue;
                          state.preview.push(defaultConf[i]);
                      }
                  }

                  rpc("enc.snap").then(() => {
                      setTimeout(() => {
                          document.querySelectorAll("img.preview").forEach((img,index) => {
                              if(state.preview.length > 0) {
                                  const preChn = state.preview[index];
                                  img.src = "snap/snap" + preChn.id + ".jpg" + "?rnd=" + Math.floor(Date.now());
                                  img.style.cssText = handleImgStyle(preChn.encv.width,preChn.encv.height);
                              }
                          })
                      },100);
                  })
                  setTimeout(updatePreview,500);
              }

              function restartEncoderSoftware() {
                  callback = function(result) {
                      if (result.error != undefined && result.error != "") {
                          htmlAlert("#alert", "danger", "Error", result.error);
                      } else {
                          htmlAlert("#alert", "success", "Success", "Restarting...", 5000);
                      }
                  }
                  if (confirm("This will interrupt streaming! Are you sure?")) {
                      func("restartEncoderSoftware", undefined, callback);
                  }
              }


              const handleChnVolume = (chnId,type) => {
                  let volume = state.volume.filter((item,index)=>{
                      return chnId === index;
                  })
                  let retVal = 0;
                  if(volume.length > 0)
                      retVal = volume[0][type] * 100/96;
                  return retVal + "%";
              }

              const updateVolume = () => {
                  rpc( "enc.getVolume").then(data => {
                      state.volume.splice(0,state.volume.length,...data);
                  });

                  if(window.location.host === "wx.linkpi.cn")
                      setTimeout(updateVolume,1000);
                  else
                      setTimeout(updateVolume,500);
              }

              const updateInputState = () => {
                  rpc("enc.getInputState").then(ret => {
                      state.input.splice(0, state.input.length, ...ret);
                      for(let i=0;i<state.input.length;i++) {
                          let ipt = state.input[i];
                          ipt.info = "- - -";
                          if(ipt.avalible)
                              ipt.info = "" + ipt.height + ( ipt.interlace ? "I" : "P" ) + ipt.framerate;
                          state.input[i] = ipt;
                      }
                  });
                  setTimeout(updateInputState,3000);
              }

              const onListenThemeChange = () => {
                  const html = document.querySelector('html');
                  const observer = new mutationObserver(mutations => {
                      mutations.forEach(mutation => {
                          if (mutation.type === 'attributes') {
                              if(mutation.attributeName === "data-bs-theme") {
                                  const theme = mutation.target.getAttribute("data-bs-theme");
                                  state.useTheme = theme;
                                  if(theme === "default") {
                                      state.tickColor.value = '#eee';
                                      state.borderColor.value = '#ccc';
                                      state.tipBgColor.value = '#fff';
                                      state.tipTxtColor.value = '#555';
                                      state.line2_color.value = '#555';
                                  }
                                  if(theme === "dark") {
                                      state.tickColor.value = '#555';
                                      state.borderColor.value = '#555';
                                      state.tipBgColor.value = '#333';
                                      state.tipTxtColor.value = '#adb5bd';
                                      state.line2_color.value = '#999';
                                  }
                                  state.netFlotKey.value++;
                              }
                              if(mutation.attributeName === "data-bs-theme-active") {
                                  const active = mutation.target.getAttribute("data-bs-theme-active");
                                  if(!isEmpty(themeConf)) {
                                      const activeTheme = themeConf.themeActives.find(item => item.active === active);
                                      state.theme_color.value = activeTheme.colors["bs-active-bg-color"];
                                      state.netFlotKey.value++;
                                  }
                              }

                          }
                      });
                  });
                  const config = {
                      attributes: true,
                      attributeFilter: ["data-bs-theme",["data-bs-theme-active"]],
                      subtree: false
                  };
                  observer.observe(html, config);
              }

              onMounted(()=>{
                  updateSysState();
                  updateNetState();
                  updatePreview();
                  updateInputState();
                  updateVolume();
                  onListenThemeChange();
                }
              )

              return {...state,hardwareConf,handleChnVolume}
          }
      })
      app.use(ignoreCustomElementPlugin);
      app.use(filterKeywordPlugin);
      app.mount('#app')
  </script>
  <script src="vendor/flot-chart/jquery.flot.js"></script>
  <script src="vendor/flot-chart/jquery.flot.tooltip.js"></script>
  <script src="vendor/flot-chart/jquery.flot.resize.js"></script>
  <script src="vendor/flot-chart/jquery.flot.pie.resize.js"></script>
  <script src="vendor/flot-chart/jquery.flot.selection.js"></script>
  <script src="vendor/flot-chart/jquery.flot.stack.js"></script>
  <script src="vendor/flot-chart/jquery.flot.time.js"></script>
  <script src="vendor/pie/jquery.easypiechart.js"></script>
  <script src="vendor/switch/bootstrap-switch.min.js"></script>
  <script src="js/networkInterfaces.js"></script>
  <script src="js/streamStatus.js"></script>
  <script src="js/recordStatus.js"></script>
  <script>
      function restartTailscale() {
          callback = function(result) {
              if (result.error != undefined && result.error != "") {
                  htmlAlert("#alert", "danger", "Error", result.error);
              } else {
                  htmlAlert("#alert", "success", "Success", "Restarting VPN", 2000);
              }
          }
          if (confirm("This will temporarily interrupt VPN access! Are you sure?")) {
              func("tailscaleUp", undefined, callback);
          }
      }

      function restartEncoderSoftware() {
          callback = function(result) {
              if (result.error != undefined && result.error != "") {
                  htmlAlert("#alert", "danger", "Error", result.error);
              } else {
                  htmlAlert("#alert", "success", "Success", "Restarting...", 5000);
              }
          }
          if (confirm("This will interrupt streaming! Are you sure?")) {
              func("restartEncoderSoftware", undefined, callback);
          }
      }

      function rebootEncoderBox() {
          callback = function(result) {
              if (result.error != undefined && result.error != "") {
                  htmlAlert("#alert", "danger", "Error", result.error);
              } else {
                  htmlAlert("#alert", "success", "Success", "Rebooting...", 2000);
              }
          }
          if (confirm("This will interrupt streaming! Are you sure?")) {
              func("rebootEncoderBox", undefined, callback);
          }
      }

      function checkNotifications() {
          fetch("/notifications.php").then(r => r.text()).then(text => {
              if (text.trim().length > 0) {
                  document.querySelector("#notification-text").innerHTML = text;
                  document.querySelector('#notifications').classList.remove("hidden");

                  document.querySelector("#notification-ack-btn").addEventListener('click', dismissNotifications);
              }
          });
      }

      function dismissNotifications() {
          document.querySelector('#notifications').classList.add("hidden");
          fetch("/notifications.php", {
              method: "DELETE"
          });
      }

      $(function() {
          navIndex(0);
          $.fn.bootstrapSwitch.defaults.size = 'mini';
          $.fn.bootstrapSwitch.defaults.onColor = 'warning';
          var timerVol = 0;
          var timerSnap = 0;
          var highUsage = false;

          checkNotifications();
          setTimeout(updateStreamStatus, 1000);
          getNetworkInterfaces(); // Automatically repeats
          initRecordInfo();

          $("#restartEncoderSoftware").click(restartEncoderSoftware);
          $("#rebootEncoderBox").click(rebootEncoderBox);
          $("#restartTailscale").click(restartTailscale);

          $(".switch").bootstrapSwitch();
          if ($.cookie('preview') == undefined) {
              $.cookie('preview', 'on', {
                  expires: 365
              });
          }

          if ($.cookie('preview') == 'on') {
              $("#previewSwitch").bootstrapSwitch('state', true, true);
          } else
              $("#previewSwitch").bootstrapSwitch('state', false, true);

          $("#previewSwitch").on("switchChange.bootstrapSwitch", function(evt) {
              if ($(this).is(":checked"))
                  $.cookie('preview', 'on', {
                      expires: 365
                  });
              else
                  $.cookie('preview', 'off', {
                      expires: 365
                  });
          });

          var interfaceCount = 6;
          try {
              $.ajaxSetup({
                  cache: false
              });
              $('.chart').easyPieChart({
                  easing: 'easeOutElastic',
                  delay: 2000,
                  barColor: '#aaa',
                  trackColor: '#eee',
                  scaleColor: false,
                  lineWidth: 20,
                  trackWidth: 16,
                  lineCap: 'butt',
                  width: 50,
                  onStep: function(from, to, percent) {
                      $(this.el).parent().find('.percent').text(Math.round(percent) + "%");
                  }
              });
          } catch (e) {

          }


          {
              var cnt = 0;
              var config;
              $.getJSON("config/hardware.json", function(data) {
                  var ifaceV = data.interfaceV;
                  var htmlStr = "";
                  for (var i = 0; i < ifaceV.length; i++) {
                      var pro = ifaceV[i].type;
                      var name = ifaceV[i].name;

                      if (pro == "HDMI")
                          htmlStr += '<div class="hdmi disable"> <span class="info">NO SIGNAL</span>\n' +
                          '<div></div>\n' +
                          '<span class="name">' + name + '</span> </div>';
                      else if (pro == "SDI" || pro == "AHD")
                          htmlStr += '<div class="sdi disable"> <span class="info">NO SIGNAL</span>\n' +
                          '<div></div>\n' +
                          '<span class="name">' + name + '</span> </div>';
                  }

                  $("#iface").html(htmlStr);

                  $.getJSON("config/config.json", function(data) {
                      config = data;
                      show();
  
                      timerVol = setInterval(getVolume, 300);

                      update();
                      for (var i = 0; i < config.length; i++) {
                          if (config[i].type != "vi")
                              continue;
                          $("#iface .name").eq(i).text(config[i].name);
                      }
                  });
              });
              var first = true;
 
              function getVolume() {
                  if (!$("#previewSwitch").is(":checked"))
                      return;
 
                  rpc("enc.getVolume", null, function(data) {
                      var k = 0;
                      for (var i = 0; i < config.length; i++) {

                          if (config[i].enable) {
                              $("#preview #L").eq(k).css("width", (data[i].L * 100 / 96) + "%");
                              $("#preview #R").eq(k).css("width", (data[i].R * 100 / 96) + "%");
                              k++;
                          }


                      }
                  });
              }



              function show() {
                  if (!$("#previewSwitch").is(":checked")) {
                      $("#preview").html("");
                      cnt = 0;
                      return;
                  }

                  rpc("enc.snap", null, function(ret) {
                      if (first) {
                          first = false;
                          return;
                      }

                      if (config.length != cnt) {
                          cnt = config.length;
                          $("#preview").html("");
                          var str = "";
                          config.forEach(channel => {
                              if (channel.enable && !(channel.type == "net" && !channel.net.decodeV)) {
                                  let target = "/sendsettings.php";
                                  if (channel.type == "net")
                                      target = "/receivesettings.php";
                                  str += `<a href="${target}">` +
                                      '<div class="col-xs-6 col-sm-6 col-md-3">' +
                                      `<div class="thumbnail text-center" id="preview-${channel.id}">` +
                                      '<div id="L" style="width:0; background-color:#88BB4A; height:5px;"></div>' +
                                      '<div id="R" style="width:0; background-color:#88BB4A; height:5px;"></div>' +
                                      '<div class="caption text-center">' +
                                      channel.name +
                                      '</div></div></div></a>';
                              }
                          });
                          $("#preview").html(str);
                      }

                      var k = 0;
                      for (var i = 0; i < config.length; i++) {
                          if (!config[i].enable || (config[i].type == "net" && !config[i].net.decodeV))
                              continue;

                          if (config[i].type == "usb" && config[i].encv.codec == "close") {
                              var icon = document.querySelector(`#preview-${i}-img`);
                              if (icon == undefined) {
                                  img = document.createElement("img");
                                  img.setAttribute("id", `preview-${i}-img`);
                                  img.setAttribute("src", "img/mic-icon.png");
                                  document.querySelector(`#preview-${i}`).prepend(img);
                                  document.querySelector(`#preview-${i} div.caption`).innerHTML = config[i].name + " (Audio Only)";
                              }
                          } else {
                              var img = document.querySelector(`#preview-${i}-img`);
                              if (img == undefined) {
                                  img = document.createElement("img");
                                  img.setAttribute("id", `preview-${i}-img`);
                                  document.querySelector(`#preview-${i}`).prepend(img);
                                  document.querySelector(`#preview-${i} div.caption`).innerHTML = config[i].name;
                              }
                              img.setAttribute("src", "snap/snap" + config[i].id + ".jpg?rnd=" + Math.random());
                          }

                          k++;
                      }
                  });
  
              }
              timerSnap = setInterval(show, 500);
          }



          function update() {
              rpc("enc.getSysState", null, function(data) {
                  try {
                      $("#usage #cpu").data('easyPieChart').update(data.cpu);
                      $("#usage #mem").data('easyPieChart').update(data.mem);
                      $("#usage #temperature #bar").css("background", '#ccc');
                      $("#usage #temperature #mask").css("bottom", data.temperature + "%");
  
                  } catch (e) {
  
                  }
                  if (data.cpu > 60 && !highUsage) {
                      highUsage = true;
                      clearInterval(timerVol);
                      clearInterval(timerSnap);
                      timerSnap = setInterval(show, 2000);
                      timerVol = setInterval(getVolume, 1000);
                  }
                  $("#usage #cpu .percent .p").text(data.cpu + "%");
                  $("#usage #mem .percent .p").text(data.mem + "%");
                  $("#usage #temperature .percent").text(data.temperature + "?");

              });

              rpc("enc.getInputState", null, function(data) {
                  var hdmi = [];
                  var sdi = [];

                  for (var i = 0; i < data.length; i++) {
                      if (data[i].protocol == "HDMI")
                          hdmi.push(data[i]);
                      else
                          sdi.push(data[i]);
                  }

                  for (var i = 0; i < hdmi.length; i++) {
                      if (hdmi[i].avalible) {
                          $(".hdmi").eq(i).removeClass("disable");
                          $(".hdmi").eq(i).find(".info").html(hdmi[i].height + (hdmi[i].interlace ? "I" : "P") + hdmi[i].framerate);
                          $(".hdmi").eq(i).attr("title", hdmi[i].width + "x" + hdmi[i].height + (hdmi[i].interlace ? "I" : "P") + hdmi[i].framerate);
                      } else {
                          $(".hdmi").eq(i).addClass("disable");
                          $(".hdmi").eq(i).find(".info").html("NO SIGNAL");
                          $(".hdmi").eq(i).find(".name").html(hdmi[i].name);
                          $(".hdmi").eq(i).attr("title", "");
                      }

                  }

                  for (var i = hdmi.length; i < $(".hdmi").length; i++) {
                      $(".hdmi").eq(i).hide();
                  }

                  for (var i = 0; i < sdi.length; i++) {
                      if (sdi[i].avalible) {
                          $(".sdi").eq(i).removeClass("disable");
                          $(".sdi").eq(i).find(".info").html(sdi[i].height + (sdi[i].interlace ? "I" : "P") + sdi[i].framerate);
                      } else {
                          $(".sdi").eq(i).addClass("disable");
                          $(".sdi").eq(i).find(".info").html("NO SIGNAL");
                          $(".sdi").eq(i).find(".name").html(sdi[i].name);
                      }
 
                  }
  
                  for (var i = sdi.length; i < $(".sdi").length; i++) {
                      $(".sdi").eq(i).hide();
                  }

              });

              getRecordStatus();

              setTimeout(update, 3000);
          }


          var data1 = [];
          var data2 = [];

          var maxy = 800;
          for (var i = 0; i < 100; i++) {
              data1.push(0);
              data2.push(0);
          }

          function GetData1(d) {
              data1.shift();
              data1.push(d);
              var rt = [];
              for (var i = 0; i < 100; i++)
                  rt.push([i, data1[i]]);
              return rt;
          }

          function GetData2(d) {
              data2.shift();
              data2.push(d);
              var rt = [];
              for (var i = 0; i < 100; i++)
                  rt.push([i, data2[i]]);
              return rt;
          }

          var plot = null;
          try {
              plot = $.plot($("#netState"), [{
                  data: GetData1(0),
                  lines: {
                      fill: true
                  }
              }, {
                  data: GetData2(0),
                  lines: {
                      show: true
                  }
              }], {
                  series: {
                      lines: {
                          show: true,
                          fill: true
                      },
                      shadowSize: 0
                  },
                  yaxis: {
                      min: 0,
                      max: 800,
                      tickSize: 160,
                      tickFormatter: function(v, axis) {
 
                          if (axis.max < 1024)
                              return v + "Kb/s";
                          else {
                              v /= 1024;
  
                              if (axis.max < 10240)
                                  return v.toFixed(2) + "Mb/s";
                              else
                                  return Math.floor(v) + "Mb/s";
                          }
                      }
                  },
                  xaxis: {
                      show: false
                  },
                  grid: {
                      hoverable: true,
                      clickable: true,
                      tickColor: "#eeeeee",
                      borderWidth: 1,
                      borderColor: "#cccccc"
                  },
                  colors: ['#ccf', "#fcc"],
                  tooltip: false
              });
          } catch (e) {}
  
          //???
          function showTooltip(x, y, color, contents) {
              $('<div id="tooltip">' + contents + '</div>').css({
                  position: 'absolute',
                  display: 'none',
                  top: y - 40,
                  left: x - 120,
                  border: '2px solid ' + color,
                  padding: '3px',
                  'font-size': '9px',
                  'border-radius': '5px',
                  'background-color': '#555',
                  color: '#eee',
                  'font-family': 'Roboto, sans-serif',
                  opacity: 0.9
              }).appendTo("body").fadeIn(200);
          }

          //??hover??
          $.fn.tooltip = function() {
              let prePoint = null,
                  preLabel = null;
              $(this).bind("plothover", function(event, pos, item) {
                  if (item) {
                      if ((preLabel !== item.series.label) || (prePoint !== item.dataIndex)) {
                          prePoint = item.dataIndex;
                          preLabel = item.series.label;
                          $("#tooltip").remove();
  
                          $(this).css({
                              "cursor": "pointer"
                          })

                          let data = item.series.data[item.dataIndex][1];
                          if (data > 1024)
                              data = parseInt(data / 1024) + "Mb/s";
                          else
                              data += "kb/s";
  
                          if (item.seriesIndex === 0)
                              showTooltip(item.pageX + 100, item.pageY - 10, '#fff', "Up: " + data);
                          if (item.seriesIndex === 1)
                              showTooltip(item.pageX + 100, item.pageY - 10, '#fff', "Down: " + data);
                      }
                  } else {
                      prePoint = null;
                      preLabel = null;
                      $(this).css({
                          "cursor": "auto"
                      });
                      $("#tooltip").remove();
                  }
              });
          }

          $("#netState").tooltip();

          function updateNetState() {
              rpc("enc.getNetState", null, function(data) {
                  try {
                      plot.setData([GetData1(data.tx), GetData2(data.rx)]);
                      plot.draw();
                      if (data.tx * 1.3 > maxy)
                          maxy = data.tx * 1.3;
                      if (data.rx * 1.3 > maxy)
                          maxy = data.rx * 1.3;
                      if (maxy < 1024)
                          maxy = Math.ceil(maxy / 100) * 100;
                      else
                          maxy = Math.ceil(maxy / 1024) * 1024;
                      if (maxy > 1024000)
                          maxy = 1024000;
                      plot.getOptions().yaxes[0].max = maxy;
                      plot.getOptions().yaxes[0].tickSize = Math.floor(maxy / 5);
                      plot.setupGrid();
                      setTimeout(updateNetState, 500);
                  } catch (e) {
                      $('#netState').text("TX: " + data.tx + " kbps RX: " + data.rx + " kbps");
                  }
              });
          }
          updateNetState();
      });
  </script>

<?php
include("foot.php");
?>

  </body>
</html>
