<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
<head>
    <?php include ("./public/head.inc") ?>
</head>
<body>
<?php include ("./public/menu.inc") ?>
    <div data-simplebar>
        <main class="page-content intercom" id="app" v-cloak>
    
            <div class="row" v-if="Object.keys(intercomConf).length > 0">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <en>vMix Tally Link</en>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mt-3">
                                <div class="col-lg-5 lp-align-center">
                                    <label>
                                        <en>Enable</en>
                                    </label>
                                </div>
                                <div class="col-lg-7">
                                    <bs-switch v-model="intercomConf.tally.enable" :size="'normal'"></bs-switch>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-5 lp-align-center">
                                    <label>
                                        <en>vMix IP</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" v-model="intercomConf.vmix.ip">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-5 lp-align-center">
                                    <label>
                                        <en>Device Name</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" v-model="intercomConf.intercom.name">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-5 lp-align-center">
                                    <label>
                                        <en>vMix Input</en>
                                    </label>
                                </div>
                                <div class="col-lg-6">
                                    <select class="form-select" v-model="intercomConf.intercom.did">
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
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3" v-for="(rowItems, rowIndex) in handleDevicesArray" :key="rowIndex">
                    <div class="row row-cols-4">
                        <div class="col-lg-3" v-for="(item, index) in rowItems" :key="index">
                            <div class="card">
                                <div class="card-header bg-transparent">
                                    <div class="py-1 px-2 text-center">
                                        {{ item.title }}
                                    </div>
                                </div>
                                <div class="card-body text-center">
                                    <div :class="['intercomBtn','state'+item.state]">
                                        <i :class="['fa fa-microphone intercomMic',{'lp-display-hide':!item.talking}]"></i>
                                        <span>{{ item.content }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-4">
                                <button type="button" @click="updateIntercomConf" class="col-2 offset-5 btn border-3 btn-primary text-center"><en>Save</en></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <tally-modal :modal-title="'Tally灯测试&Tally test'" :modal-show="showTallyModal"
                           :confirm-btn-name="'测试&Test'" :cancel-btn-name="'取消&Cancel'" @confirm-btn-click="onTallyTest">
                <div class="row">
                    <div class="col-lg-2 lp-align-center">
                        <cn>PVM</cn>
                        <en>PVM</en>
                    </div>
                    <div class="col-lg-2 lp-align-center">
                        <select class="form-select" v-model="tallyPVMVal">
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
                    <div class="col-lg-2 lp-align-center">
                        <cn>PGM</cn>
                        <en>PGM</en>
                    </div>
                    <div class="col-lg-3 lp-align-center">
                        <select class="form-select" v-model="tallyPGMVal">
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
            </tally-modal>
        </main>
    </div>
    <?php include ("./public/foot.inc") ?>

<script type="module">
    import {rpc, alertMsg, clearReactiveObject, func} from "./assets/js/lp.utils.js";
    import { useIntercomConf } from "./assets/js/vue.hooks.js";
    import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,languageOptionDirective,customModalComponent } from "./assets/js/vue.helper.js"
    import vue from "./assets/js/vue.build.js";
    const {createApp,ref,reactive,watch,watchEffect,computed,onMounted} = vue;

    const app = createApp({
        directives: {
            "language-option": languageOptionDirective
        },
        components:{
            "bs-switch" : bootstrapSwitchComponent,
            "tally-modal": customModalComponent
        },
        setup(props,context) {
    
            const { intercomConf,defIntercomConf,updateIntercomConf } = useIntercomConf();

            const state = {
                showTallyModal:ref(false),
                tallyPVMVal: ref(1),
                tallyPGMVal: ref(1),
                intercomState: reactive({}),
                hadLed: ref(false)
            }
            
            const handleDevicesArray = computed(()=>{

                const deviceList = [
                    { id: 1, content: '1',talking:false, state:-1 },
                    { id: 2, content: '2',talking:false, state:-1 },
                    { id: 3, content: '3',talking:false, state:-1 },
                    { id: 4, content: '4',talking:false, state:-1 },
                    { id: 5, content: '5',talking:false, state:-1 },
                    { id: 6, content: '6',talking:false, state:-1 },
                    { id: 7, content: '7',talking:false, state:-1 },
                    { id: 8, content: '8',talking:false, state:-1 },
                ];

                if(Object.keys(state.intercomState).length > 0 && Object.keys(intercomConf).length > 0) {
                    deviceList.forEach(dev => {
                        if(dev.id === parseInt(defIntercomConf.intercom.did) && defIntercomConf.intercom.enable && defIntercomConf.server.enable) {
                            dev.title = defIntercomConf.intercom.name;
                            dev.talking = state.intercomState.talking;
                            dev.state = 0;
                        }
                    })
                    state.intercomState.intercom.forEach((item,index) => {
                        deviceList.forEach((dev,idx) => {
                            if(dev.id === item.id || dev.id === parseInt(intercomConf.intercom.did)) {
                                if(dev.id === item.id) {
                                    dev.title = item.name;
                                } else {
                                    dev.title = intercomConf.intercom.name;
                                    dev.talking = state.intercomState.talking;
                                }
                                let count = 0;
                                if(state.intercomState.tally)
                                    count = state.intercomState.tally.length;
                                if(idx < count)
                                    dev.state = state.intercomState.tally[idx];
                                else
                                    dev.state = 0;
                            }
                        })
                    })
                }

                const result = [];
                const columns = 4;
                for (let i = 0; i < deviceList.length; i += columns)
                    result.push(deviceList.slice(i, i + columns));
                return result;
            });

            const onTallyTest = () => {
                const list=new Array(8).fill(0);
                list[state.tallyPVMVal.value-1] = 2;
                list[state.tallyPGMVal.value-1] = 1;
                rpc( "intercom.setTally", [list]);
            }

            const handleIntercomState = () => {
                rpc( "intercom.getState").then(data => {
                    clearReactiveObject(state.intercomState);
                    Object.assign(state.intercomState,data);
                })
                setTimeout(handleIntercomState,500);
            }

            const hadLedDevice = () => func("/system/hadLedDevice").then(ret => state.hadLed.value = ret.data);

            onMounted(()=>{
                handleIntercomState();
                hadLedDevice();
            })
            
            return {...state,intercomConf,updateIntercomConf,handleDevicesArray,onTallyTest}
        }
    });
    app.use(ignoreCustomElementPlugin);
    app.use(filterKeywordPlugin);
    app.mount('#app');
</script>
</body>
</html>