<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
<head>
    <?php include ("./public/head.inc") ?>
</head>
<body>
<?php include ("./public/menu.inc") ?>
    <div data-simplebar>
        <main class="page-content uart" id="app" v-cloak>
            <div class="row">
                <div class="col-lg-6" v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.serialport">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>Basic config</en>
                            </div>
                        </div>
                        <div class="card-body pb-4" v-if="Object.keys(uartConf).length > 0">
                            <div class="row mt-3">
                                <div class="col-lg-3 offset-lg-1 lp-align-center">
                                    <label>
                                        <en>Serial port</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-select" v-model="uartConf.device">
                                        <option value="/dev/ttyAMA1">ttyAMA1</option>
                                        <option value="/dev/ttyUSB0">ttyUSB0</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3 offset-lg-1 lp-align-center">
                                    <label>
                                        <en>BaudRate</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-select" v-model="uartConf.baudRate">
                                        <option value="115200">115200</option>
                                        <option value="9600">9600</option>
                                        <option value="4800">4800</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3 offset-lg-1 lp-align-center">
                                    <label>
                                        <en>Socket port</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control" v-model="uartConf.port">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-3 offset-lg-1 lp-align-center">
                                    <label>
                                        <en>IP Address</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <input class="form-control" v-model="uartConf.ip">
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn border-3 btn-primary px-4 me-3" @click="saveUartConf">
                                        <en>Save</en>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" v-if="Object.keys(hardwareConf).length > 0 && hardwareConf.function.button">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>Button define</en>
                            </div>
                        </div>
                        <div class="card-body pb-4 gpio-btn">
                            <div class="row mt-5">
                                <div class="col-lg-2 offset-lg-1 lp-align-center"></div>
                                <div class="col-lg-4">
                                    <en>Short Press</en>
                                </div>
                                <div class="col-lg-3">
                                    <en>Long Press</en>
                                </div>
                            </div>
                            <div class="row mt-4" v-for="(item,index) in buttonConf">
                                <div class="col-lg-2 offset-lg-1 lp-align-center">
                                    <label>{{item.name}}</label>
                                </div>
                                <div class="col-lg-4">
                                    <select class="form-select" v-model="item.click">
                                        <option value="push.start" en="Start push" v-language-option></option>
                                        <option value="push.stop" en="Stop push" v-language-option></option>
                                        <option value="rec.start" en="Start record" v-language-option></option>
                                        <option value="rec.stop" en="Stop record" v-language-option></option>
                                        <option value="" en="None" v-language-option></option>
                                    </select>
                                </div>
                                <div class="col-lg-3">
                                    <select class="form-select" v-model="item.press">
                                        <option value="enc.setNetDhcp">DHCP</option>
                                        <option value="" en="None" v-language-option></option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-lg-12 text-center">
                                    <button type="button" class="btn border-3 btn-primary px-4" @click="saveButtonConf">
                                        <en>Save</en>
                                    </button>
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
    import { rpc,rpc6,alertMsg } from "./assets/js/lp.utils.js";
    import { useHardwareConf,useButtonConf,useUartConf } from "./assets/js/vue.hooks.js";
    import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,languageOptionDirective } from "./assets/js/vue.helper.js"
    import vue from "./assets/js/vue.build.js";

    const {createApp,ref,reactive,watch,watchEffect,computed} = vue;
    const app = createApp({
        directives: {
          "language-option": languageOptionDirective
        },
        components:{
            "bs-switch" : bootstrapSwitchComponent
        },
        setup(props,context) {
    
            const { hardwareConf } = useHardwareConf();
            const { buttonConf } = useButtonConf();
            const { uartConf } = useUartConf();
            
            const saveUartConf = () => {
                rpc( "uart.update", [ JSON.stringify( uartConf, null, 2 ) ]).then(data => {
                    if ( typeof ( data.error ) != "undefined" )
                        alertMsg('<en>Save config failed!</en>', 'error');
                    else
                        alertMsg('<en>Save config success!</en>', 'success');
                })
            }
            
            const saveButtonConf = () => {
                rpc6( "gpio.update", [ JSON.stringify( buttonConf, null, 2 ) ]).then(data => {
                    if ( typeof ( data.error ) != "undefined" )
                        alertMsg('<en>Save config failed!</en>', 'error');
                    else
                        alertMsg('<en>Save config success!</en>', 'success');
                })
            }
            
            return {hardwareConf,buttonConf,uartConf,saveUartConf,saveButtonConf}
        }
    });
    app.use(ignoreCustomElementPlugin);
    app.use(filterKeywordPlugin);
    app.mount('#app');
</script>
</body>
</html>