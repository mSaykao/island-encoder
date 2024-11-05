<?php
include("head.php");
?>
<div id="alert"></div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Multi Recorder</h3>
                <div style="position: absolute;right: 35px;top: 6px;font-size: 20px;cursor:pointer;">
                    <i class="fa fa-cog" aria-hidden="true" onclick="onSetting()"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 text-center" style="margin-top: 30px;margin-left: 10px">
                    <strong>Channel select</strong>
                </div>
                <div class="col-sm-9" style="margin-top: 20px">
                    <div class="row" id="channels"></div>
                </div>
            </div>

            <div class="panel-body">
                <hr style="margin-top:5px; margin-bottom: 10px;" />

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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Solo Recorder<h3>
            </div>
            <div class="panel-body">
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
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Input Status<h3>
            </div>
            <div class="panel-body">
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

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Downloads<h3>
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
<div class="modal fade" id="setModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content text-dark" style="border: none">
            <div class="modal-header">
                <h4 class="modal-title">Record Settings</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" id="disk" role="form">
                        <div class="form-group">
                            <label class="col-md-3 col-sm-4 control-label">Enable</label>
                            <div class="col-md-6 col-sm-8">
                                <input type="checkbox" zcfg="enable" class="switch form-control">
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

            <div class="panel panel-default">
                <div class="title">
                    <div class="row">
                        <div class="col-md-10 col-sm-10">
                            <h3 class="panel-title">File Splitting<h3>
                        </div>
                        <div class="col-md-2 col-sm-2">
                            <div class="row">
                                <div class="col-md-2 col-sm-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="panel-body">
                        <form class="form-horizontal text-center" role="form" id="segment">
                            <div class="form-group">
                                <label class="col-sm-4 control-label">
                                    <div class="row">
                                        <div class="col-sm-4 col-sm-offset-4" style="padding: 0">Size</div>
                                        <div class="col-sm-4" style="font-size: 12px;color: #aaaaaa;padding: 0">Gb</div>
                                    </div>
                                </label>
                                <div class="col-sm-4">
                                    <input zcfg="segmentSize" id="segmentSize" type="text" class="form-control">
                                </div>
                                <div class="col-sm-4">
                                    <input id="segmentSizeEnable" zcfg="segmentSizeEnable" type="checkbox" class="switch form-control">
                                </div>
                            </div>
                            <div class="form-group" style="margin-top: 20px">
                                <div id="info" class="col-sm-10 col-sm-offset-1" style="color: red;display: none" )>
                                    <en>*Check if recording is under way, please stop all and continue</en>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="vendor/switch/bootstrap-switch.js"></script>
<script src="js/zcfg.js"></script>
<script type="text/javascript" language="javascript" src="js/confirm/jquery-confirm.min.js"></script>
<script src="vendor/jwplayer/jwplayer.js"></script>
<script src="js/island-record.js"></script>
<script src="js/island-record-disk.js"></script>
<script src="js/streamStatus.js"></script>


<?php
include("foot.php");
?>
