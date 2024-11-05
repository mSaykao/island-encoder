<?php include ("./link/session.php") ?>
<!doctype html>
<html lang="uft-8">
<head>
    <?php include ("./public/head.inc") ?>
</head>
<body>
<?php include ("./public/menu.inc") ?>
<div data-simplebar>
    <main class="page-content record" id="app" v-cloak>
        <div class="row">
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-header bg-transparent d-flex">
                        <div class="flex-grow-1">
                            <div class="p-2 mb-0 d-flex align-items-end">
                                <cn>录制参数</cn>
                                <en>Multiple Recorder</en>
                            </div>
                        </div>
                        <div class="flex-grow-0 pe-2 pt-2" @click="setRecordOption">
                            <i class="fa-solid fa-gear fa-lg lp-cursor-pointer"></i>
                        </div>
                    </div>
                    <div class="card-body" >
                        <div class="row my-3">
                            <div class="col-lg-3 text-center">
                                <cn>通道选择</cn>
                                <en>Channel select</en>
                            </div>
                            <div class="col-lg-8">
                                <div class="row row-cols-5" v-if="Object.keys(recordConf).length > 0">
                                    <div class="form-check form-check-primary mb-2" v-for="(item,index) in handleEnableConf" :key="item.id">
                                        <input class="form-check-input" type="checkbox" v-model="recordConf.any.chns" :value="item.id">
                                        <label class="form-check-label">
                                            {{item.name}}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div id="alert"></div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <button type="button" id="startRecord" class="btn btn-danger">
                                        <i class="fa fa-video-camera"></i> MULTI REC
                                    </button>
                                    <button type="button" id="stopRecord" class="btn btn-primary">
                                        <i class="fa fa-stop"></i> STOP ALL
                                    </button>
                                </div>
                                <div class="col-lg-6 col-sm-12" style="line-height: 34px;padding: 0 10px">
                                    <span id="mountStatus"></span> - 
                                    Used Space:
                                    <span id="space">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <en class="panel-title">Solo Recorder<en>
                        </div>
                        <div class="card-body">
                            <div class="row" style="margin-top: 5px;">
                                <div class="col-md-4 col-xs-4">Channel</div>
                                <div class="col-md-4 col-xs-4">Controls</div>
                                <div class="col-md-4 col-xs-4">Record time</div>
                            </div>
                            <div id="channelList">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="card">
                        <div class="card-header bg-transparent">
                            <en class="panel-title">Input Status<en>
                        </div>
                        <div class="card-body">
                            <div id="channelStatus"></div>
                            <div class="row" style="margin-top: 5px;">
                                <div class="col-md-12">
                                    <a href="/sendsettings.php"><button class="btn btn-primary">Quality settings</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <en class="panel-title">Downloads<en>
                            </div>
                            <div class="panel-body">
                                <div class="row" style="margin-bottom: 20px;">
                                    <div class="col-md-10 col-sm-12">
                                        <div class="col-md-4 col-md-offset-8 col-sm-12 col-sm-offset-0">
                                            <input type="text" class="form-control" id="searchVal">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 text-center">
                                        <button id="search" type="button" class="btn btn-primary">Search</button>
                                        <button id="refreshDownloads" type="button" class="btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div class="row" id="fileList"></div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <nav aria-label="...">
                                            <ul class="pagination" id="pagenav">
                                            </ul>
                                        </nav>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="playerModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content text-dark">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Video player</h4>
                        </div>
                        <div class="modal-body">
                            <video id="player" controls style="width:100%;height:100%;object-fit: fill"></video>
                        </div>
                        <div class="modal-footer" id="btnBox">
                            <button type="button" class="btn btn-warning" onclick="onPlayFragment('previous')">
                                <cn>????</cn>
                                <en>Previous Fragment</en>
                            </button>
                            <button type="button" class="btn btn-warning" onclick="onPlayFragment('next')">
                                <cn>????</cn>
                                <en>Next Fragment</en>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <player-modal :modal-title="playerModalTitle" :modal-show="showPlayerModal" :modal-size="'modal-xl'" :had-footer="playerModalFooter"
                      :confirm-btn-name="'上一分段&Previous Fragment'" :cancel-btn-name="'下一分段&Next Fragment'"
                      :cancel-close-modal="false" @cancel-btn-click="playFragment('next')"
                      @confirm-btn-click="playFragment('last')" @modal-visible="playModalVisible">
            <video-player :url="playerUrl"></video-player>
        </player-modal>
        <setting-modal :modal-title="'分段设置&Record Settings'" :modal-show="showSettingModal"
                      :confirm-btn-name="'保存&Save'" :cancel-btn-name="'取消&Cancel'" @confirm-btn-click="saveFragmentSetting">
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" id="disk" role="form">
                            <div class="form-group">
                                <label class="col-md-3 col-sm-4 control-label">Enable</label>
                                <div class="col-md-6 col-sm-8">
                                    <bs-switch v-model="isEnabled" zcfg="enable"></bs-switch>
                                </div>
                            </div>
                            <input type="text" class="hidden" id="mountDisk" zcfg="used" value="local" />
                            <div class="form-group">
                                <label class="col-md-3 col-sm-4 control-label">Device</label>
                                <div class="col-md-6 col-sm-8">
                                    <select class="form-control" zcfg="local.device" id="diskDevices"></select>
                                </div>
                            </div>
                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                            <div class="form-group">
                                <label class="col-md-3 col-sm-4 control-label">
                                    <en>Mount status:</en>
                                </label>
                                <div class="col-md-9 col-sm-8" style="padding: 0">
                                    <label class="control-label" id="mountStatus" style="white-space:pre-wrap;color: gray">
                                        <en>Not mounted</en>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 col-sm-4 control-label">Disk space:</label>
                                <div class="col-md-9 col-sm-8" style="padding: 0">
                                    <label class="control-label" id="diskSpace" style="color: gray">
                                        <span>-- / --</span>
                                    </label>
                                </div>
                            </div>
                            <hr style="margin-top:10px; margin-bottom: 10px;" />
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="button" id="saveDisk" class="btn btn-warning" style="padding: 6px 20px">Mount</button>
                                    <button type="button" id="unmount" class="btn btn-warning" style="padding: 6px 20px">Unmount</button>
                                </div>
                            </div>
                            <div class="form-group" style="padding-top: 30px;padding-left: 30px;color: gray">
                                <label class="col-md-11 col-sm-12">
                                    Tip: Make sure that you are not recording when you unmount the storage device or change the mounted device
                                </label>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 offset-lg-1 lp-align-center">
                    <cn>分段大小 (GB)</cn>
                    <en>Fragment size(GB)</en>
                </div>
                <div class="col-lg-4">
                    <input type="text" class="form-control disabled"  disabled readonly v-model.number.trim.lazy="handleFragmentConf.segmentSize">
                </div>
                <div class="col-lg-3 lp-align-center">
                    <bs-switch v-model="handleFragmentConf.segmentSizeEnable"></bs-switch>
                </div>
            </div>
        </setting-modal>
    </main>
</div>
<?php include ("./public/foot.inc") ?>
<script src="vendor/switch/bootstrap-switch.js"></script>
<script src="js/zcfg.js"></script>
<script type="text/javascript" language="javascript" src="js/confirm/jquery-confirm.min.js"></script>
<script src="vendor/jwplayer/jwplayer.js"></script>
<script src="js/island-record.js"></script>
<script src="js/island-record-disk.js"></script>
<script src="js/streamStatus.js"></script>
<script type="module">
    import {rpc, func, alertMsg, confirm} from "./assets/js/lp.utils.js";
    import { useDefaultConf,useRecordConf,useRecordFiles } from "./assets/js/vue.hooks.js";
    import { ignoreCustomElementPlugin,filterKeywordPlugin,bootstrapSwitchComponent,customModalComponent,videoPlayerComponent } from "./assets/js/vue.helper.js"
    import vue from "./assets/js/vue.build.js";

    const {createApp,ref,reactive,watchEffect,computed,onMounted} = vue;
    const app = createApp({
        components:{
            "bs-switch" : bootstrapSwitchComponent,
            "player-modal": customModalComponent,
            "setting-modal": customModalComponent,
            "video-player": videoPlayerComponent,
        },
        setup: function (props, context) {

            const { defaultConf } = useDefaultConf();
            const { recordConf, handleRecordConf ,updateRecordConf } = useRecordConf();
            const { recordFiles,handleRecordFiles } = useRecordFiles();

            const state = {
                recDuration:reactive({}),
                diskSpace: ref("--/--"),
                showPlayerModal: ref(false),
                playerUrl: ref(""),
                playerModalTitle: ref("正在播放"),
                playerModalFooter: ref(false),
                showSettingModal: ref(false)
            }

            const handleEnableConf = computed(() => {
                return defaultConf.filter(item => {
                    return item.enable && item.type !== "file";
                })
            });

            const handleMergeRecordConf = computed(() => {
                if(!recordConf.hasOwnProperty("channels")) return [];
                if(defaultConf.length > 0 && Object.keys(state.recDuration).length > 0) {
                    return recordConf.channels.filter((chn, index) => {
                        const conf = defaultConf.find(item => item.id === chn.id);
                        if (!conf.enable)
                            recordConf.any.chns = recordConf.any.chns.filter(item => item !== conf.id);
                        chn.enable = conf.enable;
                        chn.durTime = state.recDuration["chn" + index];
                        return conf.enable;
                    });
                }
                return recordConf.channels;
            })

            const handleFragmentConf = computed(() => {
                if(!recordConf.hasOwnProperty("channels")) return {};
                if(!recordConf["any"].hasOwnProperty("fragment")){
                    recordConf["any"]["fragment"] = {
                        segmentDura: 0,
                        segmentSize: 1,
                        segmentDuraEnable: false,
                        segmentSizeEnable: false
                    }
                }
                return recordConf["any"]["fragment"];
            })

            const onStartRecord = async () => {
                const isMountDisk = await rpc("rec.isMountDisk");
                if (!isMountDisk) {
                    alertMsg('<cn>启动录制失败，没有找到外部存储设备！</cn><en>Failed to start recording,no external storage device was found!</en>', 'error');
                    return;
                }

                const any = recordConf.any;
                const channels = recordConf.channels;

                any.chns.forEach(chn => {
                    channels.forEach(channel => {
                        if (chn === channel.id) {
                            for (let key in channel) {
                                if (any.hasOwnProperty(key)) {
                                    channel[key] = any[key];
                                }
                            }
                        }
                    });
                });

                const result = await rpc("rec.execute", [JSON.stringify(recordConf, null, 2)]);
                if (result) {
                    alertMsg('<cn>启动录制成功</cn><en>Recording started successfully!</en>', 'success');
                    setTimeout(handleRecordFiles,500);
                    return;
                }
                alertMsg('<cn>启动录制失败，没有找到外部存储设备！</cn><en>Failed to start recording,no external storage device was found!</en>', 'error');
            }

            const onStopRecord = () => {
                rpc("rec.stop").then( data => {
                    if(data){
                        handleRecordConf();
                        alertMsg('<cn>停止录制成功</cn><en>Recording stoped successfully!</en>', 'success');
                        return;
                    }
                    alertMsg('<cn>停止录制失败！</cn><en>Failed to stop recording</en>', 'error');
                } );
            }

            const onStartRecordByFormat = async type => {
                const result = await rpc("rec.execute", [JSON.stringify(recordConf, null, 2)]);
                if (result) {
                    if(type) {
                        setTimeout(handleRecordFiles,500);
                        alertMsg('<cn>启动录制成功</cn><en>Recording started successfully!</en>', 'success');
                    } else {
                        alertMsg('<cn>停止录制成功</cn><en>Recording started successfully!</en>', 'success');
                    }
                    return;
                }
                alertMsg('<cn>操作失败，没有找到外部存储设备！</cn><en>Operation failed, external storage device not found! </en>', 'error');
            }

            const handleDiskSpace = () => {
                func("/system/getMountDiskSpace").then(data => {
                    if (data.status === "error") {
                        state.diskSpace.value = "--/--";
                        return;
                    }
                    state.diskSpace.value = data.data.used + " / " + data.data.total
                });
            }

            const handleRecordDurTime = () => {
                rpc("rec.getDurTime").then( data => Object.assign(state.recDuration,JSON.parse(data)) );
                setTimeout(handleRecordDurTime,1000);
            }

            const handleChnNameById = chnId => {
                if(defaultConf.length > 0) {
                    const chnConf = defaultConf.find(item => item.id === parseInt(chnId));
                    return chnConf.name;
                }
                return "";
            }

            const makeImgUrl = (dir,chnId) => {
                const [dateName,fileName] = dir.split("_");
                return  "files/" + dir + "/" + chnId + "/" + fileName + "0.jpg";
            }

            const delRecordFileByName = dirName => {
                confirm({
                    title: '<cn>删除</cn><en>Delete</en>',
                    content: '<cn>是否删除文件'+dirName+' ？</cn><en>Do you want to delete the file '+dirName+' ?</en>',
                    buttons: {
                        ok: {
                            text: "<cn>删除</cn><en>Delete</en>",
                            btnClass: 'btn-primary',
                            keys: ['enter'],
                            action: () => {
                                func("/root/delRecordFile",{"name":dirName}).then(res => {
                                    alertMsg(res.msg,res.status);
                                    if(res.status === "success")
                                        handleRecordFiles();
                                })
                            }
                        },
                        cancel: {
                            text: "<cn>取消</cn><en>Cancel</en>",
                            action: () => {}
                        }
                    }
                });
            }

            const handleMp4Array = (dir,chnId) => {
                return recordFiles[dir][chnId].filter(file => file.toLowerCase().endsWith('.mp4')).reverse();
            }

            const showVideoPlayer = (dir,chnId) => {
                const mp4Array = handleMp4Array(dir,chnId);
                state.playerModalFooter.value = mp4Array.length  > 1;
                state.playerUrl.value = "files/" + dir + "/" + chnId + "/" + mp4Array[0];
                if(mp4Array.length > 1)
                    state.playerModalTitle.value = "正在播放 "+dir+" (1/"+mp4Array.length+")&Playing "+dir+" (1/"+mp4Array.length+")";
                else
                    state.playerModalTitle.value = "正在播放 "+dir+"&Playing "+dir;
                state.showPlayerModal.value = !state.showPlayerModal.value;
            }

            const playFragment = type =>{
                if(state.playerUrl.value) {
                    const [,dir,chnId,fileName] = state.playerUrl.value.split("/");
                    const mp4Array = handleMp4Array(dir,chnId);
                    let index = mp4Array.indexOf(fileName);
                    if(type === "next") {
                        if(index+1 < mp4Array.length)
                            index += 1;
                    }

                    if(type === "last") {
                        if(index-1 >= 0)
                            index -= 1;
                    }
                    state.playerUrl.value = "files/" + dir + "/" + chnId + "/" + mp4Array[index];
                    state.playerModalTitle.value = "正在播放 "+dir+" ("+(index+1)+"/"+mp4Array.length+")&Playing "+dir+" ("+(index+1)+"/"+mp4Array.length+")";
                }
            }

            const playModalVisible = visible => {
                if(!visible)
                    state.playerUrl.value = "";
            }

            const handleRecordFileFormat= (dir,chnId) => {
                const formats = [];
                recordFiles[dir][chnId].forEach(file => {
                    const [,fileFormat] = file.split(".");
                    if(fileFormat !== "jpg" && !formats.includes(fileFormat.toUpperCase()))
                        formats.push(fileFormat.toUpperCase());
                })
                return formats;
            }

            const onDownloadRecordFile = (dir,chnId,format) => {
                format = format.toLowerCase();
                const count = recordFiles[dir][chnId].filter(file => file.toLowerCase().endsWith('.'+format)).length;
                recordFiles[dir][chnId].forEach((file,index) => {
                    const [,fileFormat] = file.split(".");
                    if(fileFormat === format) {
                        setTimeout(()=> {
                            const url = "/files/"+dir+"/"+chnId+"/"+file;
                            let downName = dir+"."+format;
                            if(count > 1)
                                downName = dir+"_"+(index+1)+"."+format;
                            const eleA = document.createElement('a');
                            eleA.href = url;
                            eleA.download = downName;
                            eleA.dispatchEvent(new MouseEvent('click'));
                        },200 * index)
                    }
                })
            }

            const setRecordOption = () => {
                state.showSettingModal.value = !state.showSettingModal.value;
            }

            const saveFragmentSetting = () => {
                updateRecordConf();
            }

            onMounted(() => {
                handleDiskSpace();
                handleRecordDurTime();
            })

            return {...state, recordConf ,updateRecordConf,handleEnableConf,recordFiles,handleMergeRecordConf,
                handleFragmentConf, onStartRecord,onStopRecord,onStartRecordByFormat,handleChnNameById,makeImgUrl,
                delRecordFileByName, showVideoPlayer,handleMp4Array,handleRecordFileFormat,onDownloadRecordFile,
                setRecordOption,saveFragmentSetting,playFragment,playModalVisible}
        }
    });
    app.use(ignoreCustomElementPlugin);
    app.use(filterKeywordPlugin);
    app.mount('#app');
</script>
</body>
</html>