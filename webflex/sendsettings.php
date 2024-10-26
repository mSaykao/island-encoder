<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
<head>
    <?php include ("./public/head.inc") ?>
</head>
<body>
<?php include ("./public/menu.inc") ?>
<div data-simplebar>
    <main class="page-content encode" id="app" v-cloak>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#tab1" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fa fa-sign-in me-1"></i></div>
                                <div class="tab-title"><cn>ç¼–ç å‚æ•°</cn><en>Video Settings</en></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab2" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fas fa-volume-up me-1"></i></div>
                                <div class="tab-title"><cn>éŸ³é¢‘å‚æ•°</cn><en>Audio Settings</en></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab3" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fas fa-gear me-1"></i></div>
                                <div class="tab-title"><en>Send SRT settings</en></div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation" v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.chip !== '3559A' && hardwareConf.chip !== '3516E' && hardwareConf.chip !== 'SS626V100'">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab4" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                      	        <div class="tab-icon"><i class="fa-regular fa-clock me-1"></i></div>
                                <div class="tab-title"><cn>è§†é¢‘å‚æ•°</cn><en>Latency Calculator</en></div>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation" v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.chip !== 'SS626V100'">
                        <a class="nav-link" data-bs-toggle="tab" href="#tab5" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="fas fa-gear me-1"></i></div>
                                <div class="tab-title"><cn>é«˜çº§ç¼–ç å‚æ•°</cn><en>Advanced Encode Settings</en></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3 pe-2 ps-2">
                    <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                        <div class="row">
                            <div class="col-2 text-center">
                                <cn>é¢‘é“åç§°</cn>
                                <en>Channel</en>
                            </div>
                            <div class="col-2 text-center">
                                <cn>åˆ†è¾¨çŽ‡</cn>
                                <en>Video Resolution</en>
                            </div>
                            <div class="col-2 text-center">
                                <cn>ç¼–ç æ–¹å¼</cn>
                                <en>Video Codec</en>
                            </div>
                            <div class="col text-center">
                                <cn>ç çŽ‡æŽ§åˆ¶</cn>
                                <en>Rate Control</en>
                            </div>
                            <div class="col text-center">
                                <cn>ç çŽ‡(kb/s)</cn>
                                <en>Bitrate(kb/s)</en>
                            </div>
                            <div class="col text-center">
                                <cn>å¸§çŽ‡</cn>
                                <en>Framerate</en>
                            </div>
                            <div class="col text-center">
                                <cn>GOP(ç§’)</cn>
                                <en>GOP(sec)</en>
                            </div>
                            <div class="col text-center" style="display: none;">
                                <cn>å¸§åŒæ­¥</cn>
                                <en>sync</en>
                            </div>
                            <div class="col text-center">
                                <cn>å¼€å…³</cn>
                                <en>enable</en>
                            </div>
                        </div>
                        <hr >
                        <div class="row mt-1" v-for="(item,index) in handleEncConf" :key="item.id">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.name">
                                    </div>
                                    <div class="col-2">
                                        <multiple-select v-model:value1="item.encv.width" v-model:value2="item.encv.height" split="x">
                                            <option value="-1x-1">auto</option>
                                            <option v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.capability.encode.maxSize === '4K'" value="3840x2160">4K :)</option>
                                            <option value="1920x1080">1080p</option>
                                            <option value="1280x720">720p</option>
                                            <option value="640x360">360p</option>
                                            <option value="1080x1920">1080x1920</option>
                                            <option value="720x1280">720x1280</option>
                                            <option value="360x640">360x640</option>
                                        </multiple-select>
                                    </div>
                                    <div class="col-2">
                                        <multiple-select v-model:value1="item.encv.codec" v-model:value2="item.encv.profile" split="," @select-change="()=>{onCodecChange(item)}">
                                            <option value="h264,base">H.264 Base</option>
                                            <option value="h264,main">H.264 Main</option>
                                            <option value="h264,high">H.264 High</option>
                                            <option value="h265,main">H.265 Main</option>
                                            <option value="close,base" cn="å…³é—­" en="Close" v-language-option></option>
                                        </multiple-select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.encv.rcmode">
                                            <option value="cbr">CBR</option>
                                            <option value="vbr">VBR</option>
                                            <option value="avbr">AVBR</option>
                                            <option value="fixqp">FIXQP</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.bitrate">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.framerate">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.gop">
                                    </div>
                                    <div class="col" style="display: none;">
                                        <multiple-select v-model:value1="item.encv.syncTS" v-model:value2="item.encv.syncTSMode" split=",">
                                            <option cn="èŠ¯è±¡" en="Sinsam" value="true,sinsam" v-language-option></option>
                                            <option cn="ç®€æ˜“" en="Normal" value="true,linkpi" v-language-option></option>
                                            <option cn="å…³é—­" en="Close" value="false,linkpi" v-language-option></option>
                                        </multiple-select>
                                    </div>
                                    <div class="col lp-align-center">
                                        <bs-switch v-model="item.enable" ></bs-switch>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab4" role="tabpanel">
                        <div class="row">
                            <div class="col-2 text-center">
                                <cn>é¢‘é“åç§°</cn>
                                <en>channel name</en>
                            </div>
                            <div class="col text-center">
                                <cn>å®½</cn>
                                <en>width</en>
                            </div>
                            <div class="col text-center">
                                <cn>é«˜</cn>
                                <en>height</en>
                            </div>
                            <div class="col-2 text-center">
                                <cn>æ™ºèƒ½ç¼–ç æ¨¡å¼</cn>
                                <en>smart encode</en>
                            </div>
                            <div class="col text-center">
                                <cn>minQP</cn>
                                <en>minQP</en>
                            </div>
                            <div class="col text-center">
                                <cn>maxQP</cn>
                                <en>maxQP</en>
                            </div>
                            <div class="col text-center">
                                <cn>fixIQP</cn>
                                <en>fixIQP</en>
                            </div>
                            <div class="col text-center">
                                <cn>fixPQP</cn>
                                <en>fixPQP</en>
                            </div>
                            <div class="col text-center">
                                <cn>ä½Žå»¶æ—¶ç¼–ç </cn>
                                <en>low latency</en>
                            </div>
                        </div>
                        <hr >
                        <div class="row mt-1" v-for="(item,index) in handleEncConf" :key="item.id">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.name">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.width">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.height">
                                    </div>
                                    <div class="col-2">
                                        <select class="form-select" v-model="item.encv.gopmode">
                                            <option value="0">Normal</option>
                                            <option value="1">SmartP</option>
                                            <option value="2">DualP</option>
                                            <option v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.capability.encode.BFrame" value="3">BiPredB</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.minqp">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.maxqp">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.Iqp">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.encv.Pqp">
                                    </div>
                                    <div class="col lp-align-center">
                                        <bs-switch v-model="item.encv.lowLatency" ></bs-switch>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab5" role="tabpanel">
                        <div class="row">
                            <div class="col-2 text-center">
                                <cn>é¢‘é“åç§°</cn>
                                <en>channel name</en>
                            </div>
                            <div class="col-2 text-center">
                                <cn>æ—‹è½¬</cn>
                                <en>rotate</en>
                            </div>
                            <div class="col text-center">
                                <cn>å·¦è£å‰ª</cn>
                                <en>left crop</en>
                            </div>
                            <div class="col text-center">
                                <cn>å³è£å‰ª</cn>
                                <en>right crop</en>
                            </div>
                            <div class="col text-center">
                                <cn>ä¸Šè£å‰ª</cn>
                                <en>top crop</en>
                            </div>
                            <div class="col text-center">
                                <cn>ä¸‹è£å‰ª</cn>
                                <en>bottom crop</en>
                            </div>
                            <div class="col text-center">
                                <cn>å¯¹æ¯”åº¦(0-63)</cn>
                                <en>contrast(0-63)</en>
                            </div>
                            <div class="col text-center">
                                <cn>å…¨å¸§çŽ‡åŽ»éš”è¡Œ</cn>
                                <en>full framerate deinterlace</en>
                            </div>
                            <div class="col text-center">
                                <cn>NTSCå…¼å®¹</cn>
                                <en>NTSC Compatible</en>
                            </div>
                        </div>
                        <hr >
                        <div class="row mt-1" v-for="(item,index) in handleVdoConf" :key="item.id">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.name">
                                    </div>
                                    <div class="col-2">
                                        <select class="form-select" v-model="item.cap.rotate">
                                            <option value="0">0</option>black
                                            <option value="90">90</option>
                                            <option value="180">180</option>
                                            <option value="270">270</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.L">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.R">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.T">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.B">
                                    </div>
                                    <div class="col text-center">
                                        <input type="text" class="form-control" v-if="item.type==='vi'" v-model.trim.lazy="item.cap.contrast">
                                    </div>
                                    <div class="col lp-align-center">
                                        <bs-switch v-model="item.cap.deinterlace" v-if="item.type==='vi'"></bs-switch>
                                    </div>
                                    <div class="col lp-align-center">
                                        <bs-switch v-model="item.cap.ntsc" v-if="item.type==='vi'"></bs-switch>
                                    </div>
                                </div>
                                <hr >
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab2" role="tabpanel">
                        <div class="row">
                            <div class="col-2 text-center">
                                <cn>é¢‘é“åç§°</cn>
                                <en>Input name</en>
                            </div>
                            <div class="col text-center">
                                <cn>ç¼–ç æ ¼å¼</cn>
                                <en>Codec</en>
                            </div>
                            <div class="col text-center">
                                <cn>éŸ³æº</cn>
                                <en>Source</en>
                            </div>
                            <div class="col text-center">
                                <cn>å¢žç›Š</cn>
                                <en>Gain</en>
                            </div>
                            <div class="col text-center">
                                <cn>é‡‡æ ·çŽ‡</cn>
                                <en>Sample rate</en>
                            </div>
                            <div class="col text-center">
                                <cn>å£°é“</cn>
                                <en>Channels</en>
                            </div>
                            <div class="col text-center">
                                <cn>ç çŽ‡(kb/s)</cn>
                                <en>Bitrate (kb/s)</en>
                            </div>
                            <div v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.model==='ENC8'" class="col text-center">
                                <cn>éŸ³è½¨</cn>
                                <en>audio track</en>
                            </div>
                        </div>
                        <hr >
                        <div class="row mt-1" v-for="(item,index) in handleAdoConf" :key="item.id">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-2 text-center">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.name">
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.enca.codec" @change="()=>{onCodecChange(item)}">
                                            <option value="aac">AAC</option>
                                            <option value="pcma">PCMA</option>
                                            <option value="mp2">MPEG2</option>
                                            <option value="mp3">MP3</option>
                                            <option value="opus">OPUS</option>
                                            <option value="close" cn="å…³é—­" en="close" v-language-option></option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.enca.audioSrc">
                                            <option v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.line" value="line">Line</option>
                                            <option v-for="(item,index) in defaultConf" :key="index" :value="item.id">{{item.name}}</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.enca.gain">
                                            <option value="24">+24dB</option>
                                            <option value="18">+18dB</option>
                                            <option value="12">+12dB</option>
                                            <option value="6">+6dB</option>
                                            <option value="0">+0dB</option>
                                            <option value="-6">-6dB</option>
                                            <option value="-12">-12dB</option>
                                            <option value="-18">-18dB</option>
                                            <option value="-24">-24dB</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.enca.samplerate">
                                            <option value="-1">auto</option>
                                            <option value="16000">16K</option>
                                            <option value="32000">32K</option>
                                            <option value="44100">44.1K</option>
                                            <option value="48000">48K</option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <select class="form-select" v-model="item.enca.channels">
                                            <option cn="å•å£°é“" en="mono" value="1" v-language-option></option>
                                            <option cn="ç«‹ä½“å£°" en="stereo" value="2" v-language-option></option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.enca.bitrate">
                                    </div>
                                    <div v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.model==='ENC8'" class="col">
                                        <select v-if="item.enca.audioTrack" class="form-select" v-model.number="item.enca.audioTrack">
                                            <option cn="æº-Line" en="source-line" value="1" v-language-option></option>
                                            <option cn="æº-Hdmi" en="source-hdmi" value="2" v-language-option></option>
                                        </select>
                                    </div>
                                </div>
                                <hr >
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab3" role="tabpanel">
                        <div class="row text-center">
                            <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">Input name</div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">Mode</div>
                            <div class="col-lg-3 col-md-2 col-sm-3 col-xs-2">Address</div>
                            <div class="col-lg-1 col-md-2 col-sm-1 col-xs-1">Stream ID</div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">Port</div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Latency</div>
                            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">Password</div>
                            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">Enabled</div>
                        </div>
                        <hr >
                        <div class="row mt-1" v-for="(item,index) in handleVdoConf" :key="item.id">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.name">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <select class="form-select" v-model="item.cap.rotate">
                                            <option value="caller">Caller</option>black
                                            <option value="listener">Listener</option>
                                            <option value="rendezvous">Rendezvous</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-2 col-sm-3 col-xs-2">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.L">
                                    </div>
                                    <div class="col-lg-1 col-md-2 col-sm-1 col-xs-1">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.R">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.T">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <input type="text" class="form-control" v-model.trim.lazy="item.cap.crop.B">
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1">
                                        <input type="text" class="form-control" v-if="item.type==='vi'" v-model.trim.lazy="item.cap.contrast">
                                    </div>
                                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                        <bs-switch v-model="item.cap.deinterlace" v-if="item.type==='vi'"></bs-switch>
                                    </div>
                                </div>
                                <hr >
                            </div>
                        </div>
                    </div> 
                    <div class="row mt-3">
                        <div class="col-lg-12 text-center">
                            <button type="button" class="btn btn-primary border-3 px-5" @click="saveDefaultConf">
                                <cn>ä¿å­˜</cn>
                                <en>Save</en>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
<?php include ("./public/foot.inc") ?>
<script type="module">
    
    import { extend,deepCopy,confirm,alertMsg } from "./assets/js/lp.utils.js";
    import { useDefaultConf,useHardwareConf } from "./assets/js/vue.hooks.js";
    import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,multipleSelectComponent,languageOptionDirective } from "./assets/js/vue.helper.js"
    import vue from "./assets/js/vue.build.js";
    const {createApp,reactive,watch,toRefs,computed,onMounted} = vue;

    const app = createApp({
        directives:{
            "language-option": languageOptionDirective
        },
        components:{
            "bs-switch" : bootstrapSwitchComponent,
            "multiple-select": multipleSelectComponent
        },
        setup(props,context) {
            
            const { defaultConf,handleDefaultConf,updateDefaultConf } = useDefaultConf();
            const { hardwareConf } = useHardwareConf();
            let globalConf = reactive({});

            const unwatch = watch(defaultConf, (value) => {
                for (let i = 0; i < defaultConf.length; i++) {
                    if (defaultConf[i].type === "net" ) {
                        if(!defaultConf[i].hasOwnProperty("cap")) {
                            defaultConf[i].cap = {
                                contrast: 0,
                                rotate: 0,
                                crop: {
                                    B: 0,
                                    L: 0,
                                    R: 0,
                                    T: 0
                                }
                            }
                        }
                    }
                }
                Object.assign(globalConf, deepCopy(defaultConf[0]));
                globalConf.enca.audioSrc = "source";
                unwatch();
            });

            const handleEncConf = computed(() => {
                return defaultConf.filter(item => {
                    if (hardwareConf.chip === 'SS626V100') {
                        return item.encv !== undefined && item.type !== 'net';
                    }
                    return item.encv && (
                            ['vi', 'usb', 'mix'].includes(item.type) ||
                            (item.type === 'net' && item.net.decodeV) ||
                            (item.type === 'file' && item.decodeV) ||
                            (item.enable && !['net', 'file', 'ndi'].includes(item.type))
                    );
                });
            });
            
            const handleVdoConf = computed(()=>{
                if(defaultConf.length === 0) return [];
                const vodConf = [];
                defaultConf.forEach((item,index) => {
                    if(item.type === 'net' || item.type === 'vi') {
                        if(item.type === 'net') {
                            if (!item.hasOwnProperty("cap")) {
                                item.cap = {
                                    contrast: 0,
                                    rotate: 0,
                                    crop: {
                                        B: 0,
                                        L: 0,
                                        R: 0,
                                        T: 0
                                    }
                                }
                            }
                        }
                        vodConf.push(item);
                    }
                });
                return vodConf;
            })
            
            const handleAdoConf = computed(()=>{
                return defaultConf.filter(item => {
                    return item.encv && (
                            ['vi', 'usb', 'mix'].includes(item.type) ||
                            (item.type === 'net' && item.net.decodeA) ||
                            (item.type === 'file' && item.decodeA) ||
                            (item.enable && !['net', 'file', 'ndi'].includes(item.type))
                    );
                })

            })

            const onCodecChange = (conf) => {
                let hadReset = false;
                if(conf.enca.codec === "opus" && (conf.stream.rtmp || conf.stream2.rtmp)) {
                    alertMsg("<cn>RTMPåè®®æµä¸æ”¯æŒOPUSéŸ³é¢‘ç¼–ç æ ¼å¼,è¯·å…ˆå…³é—­RTMPåè®®æµåŽåœ¨é‡è¯•</cn><en>The RTMP protocol does not support OPUS audio encoding, please disable the RTMP stream and try again.</en>", "warning",8000);
                    hadReset = true;
                }
                if(conf.enca.codec !== "opus" && conf.enca.codec !== "close" && (conf.stream.webrtc || conf.stream2.webrtc)) {
                    alertMsg("<cn>WebRTCåè®®æµä»…æ”¯æŒOPUSéŸ³é¢‘ç¼–ç æ ¼å¼,è¯·å…ˆå…³é—­WebRTCåè®®æµåŽåœ¨é‡è¯•</cn><en>The WebRTC protocol only supports OPUS audio encoding, please disable the WebRTC stream and try again.</en>", "warning",8000);
                    hadReset = true;
                }
                if((conf.encv.codec !== "h264" && conf.encv.codec !== "close"  && conf.stream.webrtc) || (conf.encv2.codec !== "h264" && conf.encv2.codec !== "close" && conf.stream2.webrtc)) {
                    alertMsg("<cn>WebRTCåè®®æµä»…æ”¯æŒH264è§†é¢‘ç¼–ç æ ¼å¼,è¯·å…ˆå…³é—­WebRTCåè®®æµåŽåœ¨é‡è¯•</cn><en>The WebRTC protocol only supports H264 video encoding, please disable the WebRTC stream and try again.</en>", "warning",8000);
                    hadReset = true;
                }
                if(hadReset) {
                    setTimeout(()=>{
                        handleDefaultConf();
                    },500)
                }
            }

            const saveGlobalConfByLocal = () => {
                for ( let i = 0; i < defaultConf.length; i++ ) {
                    if (defaultConf[i].encv === undefined || defaultConf[i].enca === undefined )
                        continue;
                    let global_conf = deepCopy(globalConf);
                    if(defaultConf[i].stream.webrtc) {
                        global_conf.encv.codec = "h264";
                        global_conf.enca.codec = "opus";
                    }
                    if(defaultConf[i].stream2.webrtc) {
                        global_conf.encv2.codec = "h264";
                        global_conf.enca.codec = "opus";
                    }
                    if(global_conf.enca.codec === "opus") {
                        if(defaultConf[i].stream.rtmp)
                            global_conf.enca.codec = defaultConf[i].enca.codec;
                        if(defaultConf[i].stream2.rtmp)
                            global_conf.enca.codec = defaultConf[i].enca.codec;
                    }

                    extend(defaultConf[i].encv, deepCopy(global_conf.encv));
                    extend(defaultConf[i].encv2, deepCopy(global_conf.encv2));
                    extend(defaultConf[i].enca, deepCopy(global_conf.enca));
                    if(defaultConf[i].enca.audioSrc === "source")
                        defaultConf[i].enca.audioSrc = defaultConf[i].id;
                    if(defaultConf[i].type !== "vi" && defaultConf[i].enca.hasOwnProperty("audioTrack"))
                        delete defaultConf[i].enca.audioTrack;
                }
                saveDefaultConf();
            }
            
            const saveDefaultConf = () => {

                // const maxENC = hardwareConf.capability.encode.maxPixel;
                // let sum=0;
                // for ( let i = 0; i < defaultConf.length; i++ ) {
                //     if(defaultConf[i].enable && defaultConf[i].encv !== undefined){
                //         if(defaultConf[i].encv.codec !== "close")
                //             sum+=defaultConf[i].encv.width*defaultConf[i].encv.height*defaultConf[i].encv.framerate;
                //         if(defaultConf[i].enable2 && defaultConf[i].encv2.codec !== "close"){
                //             sum+=defaultConf[i].encv2.width*defaultConf[i].encv2.height*defaultConf[i].encv2.framerate;
                //         }
                //     }
                // }

                // if(maxENC > 0 && sum > maxENC) {
                //     confirm( {
                //         title: '<cn>è­¦å‘Š</cn><en>Warning</en>',
                //         content: '<cn>è¶…å‡ºç¼–ç æ€§èƒ½ä¸Šé™ï¼Œè¯·è°ƒæ•´ç¼–ç å‚æ•°ï¼</cn><en>The limit of encode performance is exceeded. Please adjust the encode parameters!</en>',
                //         buttons: {
                //             ok: {
                //                 text: "<cn>çŸ¥é“äº†</cn><en>I know</en>",
                //                 btnClass: 'btn-primary',
                //                 keys: [ 'enter' ],
                //                 action: () => updateDefaultConf()
                //             }
                //         }
                //     } );
                //     return;
                // }
                updateDefaultConf();
            }            
            return {globalConf,defaultConf,hardwareConf, handleEncConf,handleVdoConf,
                onCodecChange,handleAdoConf, saveGlobalConfByLocal,saveDefaultConf}
        }
    });
    app.use(ignoreCustomElementPlugin);
    app.use(filterKeywordPlugin);
    app.mount('#app');
</script>
</body>
</html>
