<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
<head>
    <?php include ("./public/head.inc") ?>
    <link href="assets/plugins/nouislider/css/nouislider.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="css/theme/theme.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendor/switch/bootstrap-switch.css" rel="stylesheet">
    <link href="assets/js/confirm/jquery-confirm.min.css" rel="stylesheet" />
    <link href="vendor/slider/css/bootstrap-slider.min.css" rel="stylesheet" />
    <link href="vendor/colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
    <link href="assets/my.css" rel="stylesheet">
    <link rel="stylesheet" id="langcss">
    <style>
        .navbar:after, .navbar:before {
            display: none;
        }
        .navbar-nav {
            position: relative;
            left: auto;
            margin: 0;
        }
        .top-header .navbar .top-right-menu .nav-item .nav-link {
            padding-top: var(--bs-nav-link-padding-y);
            padding-bottom: var(--bs-nav-link-padding-y);
        }
        select.form-control {
            appearance: auto;
        }
        .panel-default {
            border-color: rgba(255, 255, 255, 0.15);
            background-color: rgb(33, 37, 41)!important;
        }
        .panel .title {
            padding-bottom: 15px;
            border-color: rgba(255, 255, 255, 0.15);
            color: rgb(173, 181, 189);
        }
    </style>

    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/jquery.jsonrpcclient.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/global.js" id="globaljs" defLang="cn"></script>
</head>
<body>
<?php include ("./public/menu.inc") ?>
<div data-simplebar class="p-0">
    <main class="page-content mix" id="app" v-cloak>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default" style="
    background-color: rgb(33, 37, 41);
">
                    <div class="title">
                        <h3 class="panel-title" style="

    color: #ADB5BD;
">Output Config</h3>
                    </div>
                    <div class="panel-body">
                        <div id="alertOut"></div>
                        <form class="form-horizontal" id="output" role="form">
                            <div class="row" style="
    background: #212529;
">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">
                                            HDMI enable
                                        </label>
                                        <div class="col-sm-6">
                                            <!-- <input type="checkbox" zcfg="output.enable" class="switch form-control"> -->
                                            <bs-switch v-model="defaultConf[mixIndex].output.enable" :size="'normal'"></bs-switch>
                                            <!-- <div class="bootstrap-switch-small bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-on bootstrap-switch-animate" style="width: 88px;"><div class="bootstrap-switch-container" style="width: 129px; margin-left: 0px;"><span class="bootstrap-switch-handle-on bootstrap-switch-warning" style="width: 43px;">ON</span><span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 43px;">OFF</span><input type="checkbox" zcfg="output.enable" class="switch form-control"></div></div> -->
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label class="col-sm-4 control-label">
                                            <en>Interface</en>
                                        </label>
                                        <div class="col-sm-6">
                                            <select zcfg="output.type" class="form-control">
                                                <option value="hdmi">HDMI</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">
                                            Resolution
                                        </label>
                                        <div class="col-sm-6" >
                                            <select zcfg="output.output" class="form-control" style="
    /* color: red; */
    background-color: #212529;
">
                                                <option value="3840x2160_30">4K30</option>
                                                <option value="3840x2160_25">4K25</option>
                                                <option value="1080P60">1080P60</option>
                                                <option value="1080I60">1080I60</option>
                                                <option value="1080P50">1080P50</option>
                                                <option value="1080I50">1080I50</option>
                                                <option value="1080P30">1080P30</option>
                                                <option value="1080P25">1080P25</option>
                                                <option value="1080P24">1080P24</option>
                                                <option value="720P60">720P60</option>
                                                <option value="720P50">720P50</option>
                                                <option value="576P50">576P50</option>
                                                <option value="480P60">480P60</option>
                                                <option value="2560x1600_60">2560x1600_60</option>
                                                <option value="2560x1440_60">2560x1440_60</option>
                                                <option value="2560x1440_30">2560x1440_30</option>
                                                <option value="1920x1200_60">1920x1200_60</option>
                                                <option value="1920x2160_30">1920x2160_30</option>
                                                <option value="1600x1200_60">1600x1200_60</option>
                                                <option value="1680x1050_60">1680x1050_60</option>
                                                <option value="1440x900_60">1440x900_60</option>
                                                <option value="1366x768_60">1366x768_60</option>
                                                <option value="1280x1024_60">1280x1024_60</option>
                                                <option value="1280x800_60">1280x800_60</option>
                                                <option value="1024x768_60">1024x768_60</option>
                                                <option value="800x600_60">800x600_60</option>
                                                <option value="640x480_60">640x480_60</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">
                                            Rotation
                                        </label>
                                        <div class="col-sm-6">
                                            <select zcfg="output.rotate" class="form-control" style="
    /* color: red; */
    background-color: #212529;
">
                                                <option value="0">0</option>
                                                <option value="90">90</option>
                                                <option value="180">180</option>
                                                <option value="270">270</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-4 control-label">
                                            Video source
                                        </label>
                                        <div class="col-sm-6">
                                            <select zcfg="output.src" id="hdmisrc" class="form-control" style="
    /* color: red; */
    background-color: #212529;
">
                                                <option value="0">HDMI</option><option value="1">USBCam</option><option value="2">Net1</option><option value="3">Net2</option><option value="4">Net3</option><option value="5">Net4</option><option value="6">NDI Recv</option><option value="7">Carousel</option><option value="8">ColorKey</option><option value="9">Mix</option></select>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">
                                            Multiview enable
                                        </label>
                                        <div class="col-sm-5">
                                            <bs-switch v-model="defaultConf[mixIndex].enable" :size="'normal'"></bs-switch>
                                            <!-- <div class="bootstrap-switch-off bootstrap-switch-small bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 88px;"><div class="bootstrap-switch-container" style="width: 129px; margin-left: -43px;"><span class="bootstrap-switch-handle-on bootstrap-switch-warning" style="width: 43px;">ON</span><span class="bootstrap-switch-label" style="width: 43px;">&nbsp;</span><span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 43px;">OFF</span><input type="checkbox" zcfg="enable" class="switch form-control"></div></div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-offset-5">
                                    <button type="button" id="save" class="save btn btn-primary" style="width: 7em">
                                        Save
                                    </button>

                                    <a href="player.php"><button type="button" class="btn btn-secondary" style="
    margin-left: 4px;
">
                                            RTMP Player
                                        </button></a>
                                </div>
                            </div>


                        </form>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 mx-auto lp-equal-height-container">
                <div class="card lp-equal-height-item">
                    <div class="card-body">
                        <div class="row">
                            <div class="d-flex align-items-center gap-3 px-2 py-1">
                                <div class="flex-grow-0">
                                    <label class="fw-bold">
                                        <cn>频道</cn>
                                        <en>Channel</en>:
                                    </label>
                                </div>
                                <div class="flex-grow-0">
                                    <select class="form-select">
                                        <option v-if="defaultConf.length > 0 && mixIndex > -1" :value="defaultConf[mixIndex].id">{{defaultConf[mixIndex].name}}</option>
                                    </select>
                                </div>
                                <div class="flex-grow-0">
                                    <label class="fw-bold">
                                        <cn>布局</cn>
                                        <en>Layout</en>:
                                    </label>
                                </div>
                                <div class="flex-grow-0">
                                    <select class="form-select" v-model="curLayId" @change="onChangeLayout">
                                        <option v-for="(item,index) in defLaysConf" :value="item.layId">{{item.layNameEn}}</option>
                                    </select>
                                </div>
                                <div class="flex-grow-1 d-flex justify-content-end pe-3">
                                    <i class="fa-solid fa-gear fa-lg lp-cursor-pointer" @click="hrefDefLayout"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-2 mb-2">
                                <div class="card-img-content">
                                    <div class="card-img-background"></div>
                                    <img :src="chnImgUrl" class="card-img" :style="handleAutoStyle()">
                                    <img :src="chnImgUrl" class="card-img" :style="['visibility: hidden;position: relative;height:0',{'paddingTop':imgRatio+'%'}]">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mx-auto lp-equal-height-container">
                <div class="card lp-equal-height-item d-flex flex-column">
                    <div class="card-header bg-transparent flex-grow-0">
                        <div class="p-2 mb-0 d-flex align-items-end">
                            <cn>布局设定</cn>
                            <en>Layout config</en>
                        </div>
                    </div>
                    <div class="card-body pb-4 flex-grow-1">
                        <div class="row flex-grow-1 h-100">
                            <div class="col-lg-12 mt-2 mb-2">
                                <div class="layout-bg card-img-content pb-0 h-100">
                                    <div class="bg-black" :style="handleAutoStyle()">
                                        <div class="lay-border" v-for="(item,index) in handleActiveDefLayConf.layouts" :style="{position:'absolute',width:item.pos.w * 100+'%',height:item.pos.h*100+'%',left:item.pos.x*100+'%',top:item.pos.y*100+'%',zIndex:item.pos.index}">
                                            <div :style="{width:'100%',height:'100%',backgroundColor: handleLayBackColor(index)}">
                                                <div class="d-flex align-items-center gap-1 border-0 px-2 py-1">
                                                    <div class="flex-grow-1">
                                                        <select class="form-select" v-model="defaultConf[mixIndex].srcV[index]" @change="updateDefaultConf('noTip')">
                                                            <option value="-1" cn="空" en="none" v-language-option></option>
                                                            <option v-for="(it,index) in handleLayoutChnSelect(defaultConf[mixIndex].srcV[index])" :value="it.id">{{it.name}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex-grow-0">
                                                        <button :class="['btn',{'btn-default':handleActiveVolume(index)},{'px-2 btn-primary':!handleActiveVolume(index)}]" @click="onUpdateActiveVolume(defaultConf[mixIndex].srcV[index])">
                                                            <i :class="['fa-solid',{'fa-volume-off':handleActiveVolume(index)},{'fa-volume-high':!handleActiveVolume(index)}]"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>
<?php include ("./public/foot.inc") ?>
<script type="module">

    import { rpc,confirm } from "./assets/js/lp.utils.js";
    import { useDefaultConf,useDefLaysConf,useHardwareConf } from "./assets/js/vue.hooks.js";
    import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,nouiSliderComponent,languageOptionDirective } from "./assets/js/vue.helper.js"
    import mutationObserver from './assets/plugins/polyfill/mutationobserver.esm.js';
    import vue from "./assets/js/vue.build.js";

    const {createApp,ref,reactive,watchEffect,computed,onMounted} = vue;
    const app = createApp({
        directives:{
            "language-option": languageOptionDirective
        },
        components:{
            "bs-switch" : bootstrapSwitchComponent,
            "noui-slider": nouiSliderComponent
        },
        setup(props,context) {

            const { defaultConf,updateDefaultConf } = useDefaultConf();
            const { defLaysConf } = useDefLaysConf();
            const { hardwareConf } = useHardwareConf();

            const state = {
                chnImgUrl: ref(""),
                curLayId: ref(-1),
                mixIndex: ref(-1),
                curTheme: ref("default"),
                imgRatio: ref("56.25")
            }

            const updateChnImage = () => {
                if(defaultConf[state.mixIndex.value].enable)
                    state.chnImgUrl.value = "snap/snap" + defaultConf[state.mixIndex.value].id + ".jpg?rnd=" + Math.random();
                else
                    state.chnImgUrl.value = "assets/img/nosignal.jpg";
                setTimeout(() => { rpc( "enc.snap" ) },200)
                setTimeout(updateChnImage,500);
            }

            const handleEnableConf = computed(()=>{
                return defaultConf.filter((item,index)=>{
                    return !!item.enable;
                })
            })

            const handleActiveDefLayConf = computed(()=>{
                return defLaysConf.find((item) => item.layId === state.curLayId.value) || {};
            });

            const handleLayoutChnSelect = computed(() => {
                return (chnId) => {
                    let srcV = defaultConf[state.mixIndex.value].srcV;
                    return defaultConf.filter((item,index)=>{
                        return !(srcV.indexOf(item.id) > -1 && item.id !== chnId);
                    });
                };
            });

            const handleActiveVolume = index => {
                if(index < defaultConf[state.mixIndex.value].srcV.length) {
                    const idx = defaultConf[state.mixIndex.value].srcV[index].toString();
                    return !defaultConf[state.mixIndex.value].srcA.includes(idx) && !defaultConf[state.mixIndex.value].srcA.includes(Number(idx));
                }
            };

            const onUpdateActiveVolume = chnId => {
                if(chnId === "-1")
                    return;
                chnId = chnId.toString();
                defaultConf[state.mixIndex.value].srcA = defaultConf[state.mixIndex.value].srcA.map(item => item = item.toString());
                defaultConf[state.mixIndex.value].srcV = defaultConf[state.mixIndex.value].srcV.map(item => item = item.toString());
                let idx = defaultConf[state.mixIndex.value].srcA.indexOf(chnId);
                if(idx === -1)
                    defaultConf[state.mixIndex.value].srcA.push(chnId);
                else
                    defaultConf[state.mixIndex.value].srcA.splice(idx, 1);
                updateDefaultConf("noTip");
            };

            const unwatch = watchEffect(()=>{
                if(defaultConf.length > 0 && Object.keys(defLaysConf).length > 0) {
                    for(let i=0;i<defaultConf.length;i++) {
                        if(defaultConf[i].type !== "mix")
                            continue;

                        var layList = [];
                        let mixChn = defaultConf[i];
                        for (let j = 0; j < mixChn.layout.length; j++) {
                            let layout = mixChn.layout[j];
                            let layObj = {
                                "a": layout.a,
                                "x": layout.x,
                                "y": layout.y,
                                "w": layout.w,
                                "h": layout.h,
                                "index": layout.index
                            }
                            layList.push(layObj);
                        }
                        let curLayStr = JSON.stringify(layList);

                        for (let j = 0; j < defLaysConf.length; j++) {
                            let las = defLaysConf[j].layouts;
                            let layout = [];
                            for (let k = 0; k < las.length; k++) {
                                layout.push(las[k].pos);
                            }
                            if(curLayStr === JSON.stringify(layout)) {
                                state.curLayId.value = defLaysConf[j].layId;
                                break;
                            }
                        }

                        let { width, height} = mixChn.encv;
                        width = Number(width) > 0 ? Number(width) : 1920;
                        height = Number(height) > 0 ? Number(height) : 1080;

                        if(width < height)
                            state.imgRatio.value = "85";
                        state.mixIndex.value = i;
                    }
                    updateChnImage();
                    unwatch();
                }
            })

            const handleAutoStyle = () => {
                if(state.mixIndex.value < 0)
                    return "";
                const encv = defaultConf[state.mixIndex.value].encv;
                let { width, height} = encv;
                width = Number(width) > 0 ? Number(width) : 1920;
                height = Number(height) > 0 ? Number(height) : 1080;
                let ww = "100%";
                let hh = height / (width * state.imgRatio.value/100) * 100 + "%";
                if (width < height) {
                    hh = "100%";
                    ww = (state.imgRatio.value/100 * width) / height * 100 + "%";
                }
                return `position: absolute;margin:0 auto;width: ${ww};height: ${hh};`;
            };

            const hrefDefLayout = () => {
                confirm({
                    title: '<cn>布局</cn><en>Layout</en>',
                    content: '<cn>是否打开布局管理器？</cn><en>Jump to Layout Manager?</en>',
                    buttons: {
                        ok: {
                            text: "<cn>打开</cn><en>Confirm</en>",
                            btnClass: 'btn-primary',
                            keys: ['enter'],
                            action: () => window.location.href = "defLayout.php"
                        },
                        cancel: {
                            text: "<cn>取消</cn><en>Cancel</en>",
                            action: () => {}
                        }
                    }
                });
            }

            const onChangeLayout = () => {
                let layout = [];
                let srcV = [];
                let srcA = [];
                let markV = false;
                let markA = false;
                for(let i=0;i<defLaysConf.length;i++) {
                    if(state.curLayId.value === defLaysConf[i].layId) {
                        let las = defLaysConf[i].layouts;
                        for (let j = 0; j < las.length; j++) {
                            layout.push(las[j].pos);
                            if(las[j].id < 0) {
                                srcV.push("-1");
                            } else {
                                srcV.push(las[j].id + "");
                                markV = true;
                                if(las[j].ado) {
                                    srcA.push(las[j].id + "")
                                    markA = true;
                                }
                            }
                        }
                    }
                }

                if(!markV) {
                    if (srcV.length >= defaultConf[state.mixIndex.value].srcV.length)
                        srcV.splice(0, defaultConf[state.mixIndex.value].srcV.length, ...defaultConf[state.mixIndex.value].srcV);
                    else
                        srcV = defaultConf[state.mixIndex.value].srcV.slice(0, srcV.length);
                }

                defaultConf[state.mixIndex.value].srcV.splice(0, defaultConf[state.mixIndex.value].srcV.length, ...srcV);
                defaultConf[state.mixIndex.value].layout.splice(0, defaultConf[state.mixIndex.value].layout.length, ...layout);
                if(markA)
                    defaultConf[state.mixIndex.value].srcA.splice(0, defaultConf[state.mixIndex.value].srcA.length, ...srcA);
                updateDefaultConf("noTip");
                const options = document.querySelectorAll(`option[cn]`);
                options.forEach(option => {
                    option.textContent = option.getAttribute('cn');
                });
            }

            const handleLayBackColor = (idx) => {
                let color = 0;
                if(state.curTheme.value !== "dark") {
                    if(idx % 2 === 0)
                        color = 128 + 25 * (idx / 2);
                    else
                        color = 128 - 25 * (idx / 2 + 1);
                } else
                    color = 85 - 15 * (idx / 2 + 1);
                return "rgb(" + color + "," + color + "," + color + ")";
            }

            onMounted(()=>{
                const html = document.querySelector('html');
                const observer = new mutationObserver(mutations => {
                    mutations.forEach(mutation => {
                        if (mutation.type === 'attributes' && mutation.attributeName === "data-bs-theme")
                            state.curTheme.value = mutation.target.getAttribute("data-bs-theme");
                    });
                });
                const config = {
                    attributes: true,
                    attributeFilter: ["data-bs-theme"],
                    subtree: false
                };
                observer.observe(html, config);
            });

            return {...state,defaultConf,defLaysConf,hardwareConf,handleEnableConf,handleActiveDefLayConf,
                hrefDefLayout,onChangeLayout,handleLayBackColor,handleActiveVolume,onUpdateActiveVolume,
                handleAutoStyle,handleLayoutChnSelect,updateDefaultConf}
        }
    });
    app.use(ignoreCustomElementPlugin);
    app.use(filterKeywordPlugin);
    app.mount('#app');
</script>
</body>
</html>
