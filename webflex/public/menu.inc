<div id="menu">
    <menu :class="['menu',{'sidebar-hovered': isSidebarHovered}]">
        <header class="top-header">
            <nav class="navbar navbar-expand justify-content-between">
                <div v-if="isMenuToggled" class="btn-toggle-menu" @click="onToggleMenu">
                    <i class="fa-solid fa-bars"></i>
                </div>
                <div v-else class="sidebar-close" @click="onCloseSidebar">
                    <i class="fa-solid fa-xmark"></i>
                </div>
                <search-setting></search-setting>
                <ul class="navbar-nav top-right-menu gap-2">
                    <li class="nav-item">
                        <a class="nav-link" v-if="Object.keys(themeConf).length > 0 && themeConf.mod  === 'link'">
                            <i v-if="themeConf.used==='default'" class="fa-regular fa-moon" @click="updateThemeConf('dark')"></i>
                            <i v-else class="fa-regular fa-sun" @click="updateThemeConf('default')"></i>
                        </a>
                    </li>
                    <li class="nav-item" v-if="Object.keys(webVerConf).length > 0 && webVerConf.switch">
                        <a class="nav-link" style="font-size: 19px;" @click="changeWeb">
                            <i class="fa-solid fa-arrow-right-arrow-left"></i>
                        </a>
                    </li>
                    <li class="nav-item" v-if="hadLed">
                        <led-option></led-option>
                    </li>
                    <li class="nav-item">
                        <usb-option></usb-option>
                    </li>
                    <li class="nav-item" v-if="Object.keys(themeConf).length > 0 && themeConf.mod === 'style'">
                        <theme-color></theme-color>
                    </li>
<!--                    <li class="nav-item">-->
<!--                        <a class="nav-link" data-bs-toggle="offcanvas" href="#ThemeCustomizer"><i class="fa fa-gear"></i></a>-->
<!--                    </li>-->
                </ul>
            </nav>

        </header>

        <aside class="sidebar-wrapper" @mouseenter="onMouseEnter" @mouseleave="onMouseLeave">
            <div class="sidebar-header">
                <div class="logo-icon lp-cursor-pointer" @click="onHrefDash">
                    <img src="img/logo.png" class="mt-1" style="max-height: 33px;">
                </div>
                <div class="logo-name flex-grow-1">
<!--                    <h5 class="mb-0 fw-bold">LinkPi</h5>-->
                </div>
            </div>
            <div class="sidebar-nav" ref="simplebarEle">
                <ul class="metismenu" ref="metismenuEle">
                    <li>
                        <a href="dashboard.php">
                            <div class="parent-icon"><i class="fa fa-tachometer"></i></div>
                            <div class="menu-title"><cn>????</cn><en>Dashboard</en></div>
                        </a>
                    </li>
                    <li>
                        <a href="sendsettings.php">
                            <div class="parent-icon"><i class="fa fa-upload"></i></div>
                            <div class="menu-title"><cn>????</cn><en>Send</en></div>
                        </a>
                    </li>
                    <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.chip !== 'HI3516CV610'">
                        <a href="decode.php">
                            <div class="parent-icon"><i class="fa-solid fa-download"></i></div>
                            <div class="menu-title"><cn>????</cn><en>Receive</en></div>
                        </a>
                    </li>
                    <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.videoOut">
                        <a href="output.php">
                            <div class="parent-icon"><i class="fa fa-external-link menuIcon"></i></div>
                            <div class="menu-title"><cn>????</cn><en>Output</en></div>
                        </a>
                    </li>
                    <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.record">
                        <a href="island-record.php">
                            <div class="parent-icon"><i class="fa-solid fa-floppy-disk"></i></div>
                            <div class="menu-title"><en>Record</en></div>
                        </a>
                    </li>
                    <li>
                        <a href="tally.php">
                            <div class="parent-icon"><i class="fa-solid fa-lightbulb"></i></div>
                            <div class="menu-title"><en>Tally</en></div>
                        </a>
                    </li>
                    <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.chip !== 'HI3516CV610'">
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="fa-solid fa-gears"></i></div>
                            <div class="menu-title"><cn>????</cn><en>Settings</en></div>
                        </a>
                        <ul class="ps-3">
                            <li>
                                <a href="tailscale.php">
                                    <i class="fa-solid fa-plug"></i>
                                    <div class="menu-title"><en>VPN & ATEM Link</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="sys.php">
                                    <i class="fa-solid fa-gear"></i>
                                    <div class="menu-title"><cn>????</cn><en>System</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="nosignal.php">
                                    <i class="fa fa-image"></i>
                                    <div class="menu-title"><en>Change No Signal graphic</en></div>
                                </a>
                            </li>
                            <li><a href="updates.php"><i class="fa fa-wrench"></i><div class="menu-title"><en>Updates</en></div></a></li>
                            <li><a href="syncer-live.php"><i class="fa-solid fa-clock"></i><div class="menu-title"><en>Syncer</en></div></a></li>
                            <?
                            if ($_SESSION['login'] == "admin") {
                            ?>
                            <li><a href="sys.php"><i class="fa fa-gear"></i><div class="menu-title"><en>System</en></div></a></li>
                            <?
                            } else {
                            ?>
                            <li><a href="sys-user.php"><i class="fa fa-gear"></i><div class="menu-title"><en>Network settings</en></div></a></li>
                            <?
                            }
                            ?>
                            <? if ($chip == "SS524V100" || $chip == "SS528V100") { ?>
                            <li><a href="format-disk.php"><i class="fa fa-floppy-o"></i></i><div class="menu-title"><ev>Format Disk</en></div></a></li>
                            <? } ?>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="has-arrow">
                            <div class="parent-icon"><i class="fa-solid fa-mug-saucer"></i></div>
                            <div class="menu-title"><en>Advanced</en></div>
                        </a>
                        <ul class="ps-3">
<!--                            <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.ndi">-->
<!--                                <a href="ndi.php">-->
<!--                                    <i class="fa-solid fa-desktop"></i>-->
<!--                                    <div class="menu-title"><cn>NDI??</cn><en>NDI Decode</en></div>-->
<!--                                </a>-->
<!--                            </li>-->
                            <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.record">
                                <a href="record.php">
                                    <i class="fa-solid fa-folder-open"></i>
                                    <div class="menu-title"><cn>????</cn><en>Record</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="player.php">
                                    <i class="fa-solid fa-circle-play"></i>
                                    <div class="menu-title"><en>H5 Player</en></div>
                                </a>
                            </li>
                            <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.intercom">
                                <a href="intercom.php">
                                    <i class="fa-solid fa-headset"></i>
                                    <div class="menu-title"><en>Intercom</en></div>
                                </a>
                            </li>
                            <li v-if="Object.keys(hardwareConf).length > 0 && (hardwareConf.function.remote)">
                                <a href="remote.php">
                                    <i class="fa-brands fa-cloudsmith"></i>
                                    <div class="menu-title"><en>Remote</en></div>
                                </a>
                            </li>
                            <li v-if="Object.keys(hardwareConf).length > 0 && (hardwareConf.function.serialport || hardwareConf.function.button)">
                                <a href="uart.php">
                                    <i class="fa-solid fa-link"></i>
                                    <div class="menu-title"><en>Serial Port</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="gb28181.php">
                                    <i class="fa-solid fa-cloud"></i>
                                    <div class="menu-title"><en>GB28181</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="roi.php">
                                    <i class="fa-solid fa-circle-user"></i>
                                    <div class="menu-title"><en>ROI</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="insta360.php">
                                    <i class="fa-solid fa-camera"></i>
                                    <div class="menu-title"><en>Insta360 Link</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="onvif.php">
                                    <i class="fa fa-video-camera"></i>
                                    <div class="menu-title"><en>Onvif PTZ</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="colorKey.php">
                                    <i class="fa fa-cut"></i>
                                    <div class="menu-title"><en>ColorKey</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="sync.php">
                                    <i class="fa-solid fa-bars-staggered"></i>
                                    <div class="menu-title"><en>Synchronization</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="group.php">
                                    <i class="fa-solid fa-server"></i>
                                    <div class="menu-title"><en>Group</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="rproxy.php">
                                    <i class="fa-solid fa-comments"></i>
                                    <div class="menu-title"><en>Reverse Proxy</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="disk.php">
                                    <i class="fa fa-database"></i>
                                    <div class="menu-title"><en>Mount Disk</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="explorer.php">
                                    <i class="fa-regular fa-folder-open"></i>
                                    <div class="menu-title"><en>USB Disk</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="ndi.php">
                                    <i class="fa fa-television"></i>
                                    <div class="menu-title"><en>NDI decode</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="encode.php">
                                    <i class="fa fa-image"></i>
                                    <div class="menu-title"><en>Encode</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="service.php">
                                    <i class="fa-solid fa-cloud"></i>
                                    <div class="menu-title"><en>Service</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="carousel.php">
                                    <i class="fa-solid fa-square-caret-right"></i>
                                    <div class="menu-title"><en>Video Carousel</en></div>
                                </a>
                            </liv>
                            <li>
                                <a href="push.php">
                                    <i class="fa-solid fa-circle-arrow-up"></i>
                                    <div class="menu-title"><en>Mulitple Push</en></div>
                                </a>
                            </li>
                            <li v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.overlay">
                                <a href="overlay.php">
                                    <i class="fa-solid fa-wand-magic-sparkles"></i>
                                    <div class="menu-title"><en>Overlay</en></div>
                                </a>
                            </li>
                            <li>
                                <a href="stream.php">
                                    <i class="fa fa-upload"></i>
                                    <div class="menu-title"><en>Stream</en></div>
                                </a>
                            </li>
                            <li><a href="output-v1.php"><i class="fa fa-upload"></i><div class="menu-title"><en>Output (Advanced)</en></div></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="sidebar-bottom">
                <div class="d-flex align-items-center px-3 gap-3 w-100 h-100" data-bs-toggle="dropdown">
                    <div class="user-icon">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="user-info">
                        <h5 class="mb-0 user-name">Admin</h5>
                        <p class="mb-0 user-designation"><cn>?????</cn><en>administrator</en></p>
                    </div>
                    <div class="logout-icon" @click="onLogout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                </div>
            </div>
        </aside>
    </menu>
</div>
<script type="module">
    import vue from "../assets/js/vue.build.js";
    import Metismenu from '../assets/plugins/metismenu/js/metisMenu.esm.js';
    import { func,updateSysLanguage,confirm } from "../assets/js/lp.utils.js";
    import { useThemeConf,useHardwareConf,useWebVerConf } from "../assets/js/vue.hooks.js"
    import { ignoreCustomElementPlugin,usbOptionComponent,searchSettingComponent,ledOptionComponent,themeActiveColorComponent } from "../assets/js/vue.helper.js"
    import mutationObserver from '../assets/plugins/polyfill/mutationobserver.esm.js';

    const { createApp,ref,reactive,watchEffect,watch,nextTick,onMounted } = vue;
    const menu = createApp({
        components:{
            "usb-option": usbOptionComponent,
            "led-option": ledOptionComponent,
            "search-setting": searchSettingComponent,
            "theme-color": themeActiveColorComponent
        },
        setup() {
           const { themeConf,updateThemeConf } = useThemeConf();
           const { webVerConf,updateWebVerConf } = useWebVerConf();
           const { hardwareConf } = useHardwareConf();

           const state = {
               simplebarEle: ref(null),
               metismenuEle: ref(null),
               isMenuToggled : ref(true),
               isSidebarHovered: ref(true),
               hadLed: ref(false),
               simplebar: null,
           }

           const onLogout = () => {
               func("/login/onLogout")
                   .then((ret)=>{
                       if(ret.status === "success")
                           location.href = "/";
                   });
           }

           const unwatch = watch(hardwareConf,()=>{
               if(Object.keys(hardwareConf).length > 0) {
                   nextTick(()=>{
                       let as = document.querySelectorAll(".sidebar-wrapper .metismenu li a");
                       for (let i = 0; i < as.length; i++) {
                           if (as[i].href === window.location.protocol+"//"+window.location.host+""+window.location.pathname) {
                               as[i].classList.add("active");
                               let parent = as[i].parentElement;
                               while (parent && parent.tagName === "LI") {
                                   parent.classList.add("mm-active");
                                   parent = parent.parentElement;
                                   if (parent && parent.tagName === "UL")
                                       parent.classList.add("mm-show");
                                   parent = parent.parentElement;
                               }
                               break;
                           }
                       }
                       new Metismenu(state.metismenuEle.value);
                       state.simplebar = new SimpleBar(state.simplebarEle.value);
                       observeMenuChanges(state.metismenuEle.value);
                       unwatch();
                   })
               }
           })

           watch(state.isMenuToggled,() => {
               const body = document.querySelector('body');
               console.log("isMenuToggled changed:", newValue);
               if(state.isMenuToggled.value)
                   body.classList.add('toggled');
               else
                   body.classList.remove('toggled');
           })

            const observeMenuChanges = element => {
                const observer = new mutationObserver((mutations) => {
                    mutations.forEach((mutation) => {
                        if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                            const target = mutation.target;
                            if (target.classList.contains('mm-active'))
                                setTimeout(()=> state.simplebar.recalculate(),230);
                        }
                    });
                });

                observer.observe(element, {
                    attributes: true,
                    subtree: true,
                    attributeFilter: ['class'],
                });
            }

           const onHrefDash = () => {
                location.href="/dashboard.php";
           }

           const onToggleMenu = () => {
               state.isMenuToggled.value = false;
               console.log("Menu toggled:", state.isMenuToggled.value);
           }

           const onMouseEnter = () => {
               if(state.isMenuToggled.value)
                   state.isSidebarHovered.value = true;
           };

           const onMouseLeave = () => {
               if(state.isSidebarHovered.value)
                   state.isSidebarHovered.value = false;
           };

           const onCloseSidebar = () => {
               state.isMenuToggled.value = true;
           }

           const hadLedDevice = () => func("/system/hadLedDevice").then(ret => state.hadLed.value = ret.data);

           const changeWeb = () => {
               confirm({
                   title: '<cn>????</cn><en>Switch Web</en>',
                   content: '<cn>??????????,??????</cn><en>Whether to switch to the classic version and restart?</en>',
                   buttons: {
                       ok: {
                           text: "<cn>??</cn><en>Switch</en>",
                           btnClass: 'btn-primary',
                           keys: ['enter'],
                           action: () => {
                               webVerConf.web = "classic";
                               updateWebVerConf();
                           }
                       },
                       cancel: {
                           text: "<cn>??</cn><en>Cancel</en>"
                       }

                   }
               });
           }

           onMounted(hadLedDevice);

           return {...state,hardwareConf,themeConf,webVerConf,updateThemeConf,onHrefDash,onLogout,
               onToggleMenu,onMouseEnter,onMouseLeave,onCloseSidebar,updateSysLanguage,changeWeb}
       }
    });
    menu.use(ignoreCustomElementPlugin);
    menu.mount('#menu');
</script>