// Created for Island Record page; based off OEM record.php
var fileList = [];
var totalPage = 0;
var curPage = 0;
var eachPage = 20;
var config, ini;
var intervalId = -1;
var playPath, playName;
var playStart, playCount;
var fragmentData;
var hasAdminRole = false; // Updated by fetchUsername() at page load

$("#playerModal,#setModal").on('show.bs.modal', function () {
    var $this = $(this);
    var $modal_dialog = $this.find('.modal-dialog');
    $this.css('display', 'block');
    $modal_dialog.css({
        'margin-top': Math.max(0, ($(window).height() - $modal_dialog.height()) / 2)
    });
});
$("#setModal").on('hide.bs.modal', function () {
    $("#info").hide();
});

$('#playerModal').on('hidden.bs.modal', function (e) {
    $('#player').trigger('pause');
})

function play(path, name, start, count) {
    $('#playerModal').modal('show');
    var host = window.location.host;
    var url = "";
    if (name.indexOf("mp4") > 0) {
        url = "http://" + host + path + name;
    } else {
        playPath = path;
        playName = name;
        playStart = parseInt(start);
        playCount = parseInt(count);
        url = "http://" + host + path + name + "_" + start + ".mp4";
    }
    $("#player").attr("src", url);
    $('#player').trigger('play');
    if (count > 1) {
        $("#playTitleEn").html("Video player(　Fragment 1　)");
        $("#btnBox").show();
    } else {
        $("#playTitleEn").html("Video player");
        $("#btnBox").hide();
    }
}

function onPlayFragment(type) {
    var curUrl = $("#player").attr("src");
    var list = curUrl.split("_");
    var curNum = list[2].substring(0, list[2].indexOf("."));

    if (type == "next") {
        var nextNum = parseInt(curNum) + 1;
        if (nextNum < playStart + playCount) {
            var url = "http://" + location.hostname + playPath + playName + "_" + nextNum + ".mp4";
            $("#playTitleEn").html("Video player(　Fragment " + (nextNum - playStart + 1) + "　)");
            $("#player").attr("src", url);
            $('#player').trigger('play');
        }
    } else {
        var preNum = parseInt(curNum) - 1;
        if (preNum >= playStart) {
            var url = "http://" + location.hostname + playPath + playName + "_" + preNum + ".mp4";
            $("#playTitleEn").html("Video player(　Fragment " + (preNum - playStart + 1) + "　)");
            $("#player").attr("src", url);
            $('#player').trigger('play');
        }
    }

}

$("#player")[0].addEventListener('ended', function (e) {
    var curUrl = $("#player").attr("src");
    var list = curUrl.split("_");
    var curNum = list[2].substring(0, 1);
    var nextNum = parseInt(curNum) + 1;
    if (nextNum < playStart + playCount) {
        var url = "http://" + location.hostname + playPath + playName + "_" + nextNum + ".mp4";
        $("#playTitleCn").html("视频播放(　分段" + (nextNum - playStart + 1) + "　)");
        $("#playTitleEn").html("Video player(　Fragment " + (nextNum - playStart + 1) + "　)");
        $("#player").attr("src", url);
        $('#player').trigger('play');
    }
})

function onSetting() {
    $('#setModal').modal('show');
    openDiskModal(hasAdminRole);
    getMountedPath();

    var segmentDura = 0,
        segmentSize = 1;
    var segmentDuraEnable = false,
        segmentSizeEnable = false;
    var fragment = config["any"]["fragment"];
    if (config["any"].hasOwnProperty("fragment")) {
        if (fragment != null) {
            if (fragment.hasOwnProperty("segmentDura"))
                segmentDura = fragment["segmentDura"];
            if (fragment.hasOwnProperty("segmentSize"))
                segmentSize = fragment["segmentSize"];
            if (fragment.hasOwnProperty("segmentDuraEnable"))
                segmentDuraEnable = fragment["segmentDuraEnable"];
            if (fragment.hasOwnProperty("segmentSizeEnable"))
                segmentSizeEnable = fragment["segmentSizeEnable"];
        }
    }
    fragmentData = {
        segmentDura: segmentDura,
        segmentSize: segmentSize,
        segmentDuraEnable: segmentDuraEnable,
        segmentSizeEnable: segmentSizeEnable
    }
    zcfg("#segment", fragmentData);
}

function onUmount() {
    $.confirm({
        title: '<h4 style="font-weight: 600"><en>Unmount Disk</en></h4>',
        content: "Please ensure disk is not recording when unmounting the disk",
        buttons: {
            ok: {
                text: "Unmount",
                btnClass: 'btn-warning',
                keys: ['enter'],
                action: function () {
                    func("umountDisk", [], function (res) {
                        if (res.error != "") {
                            htmlAlert("#alert", "danger", res.error, "", 5000);
                            return;
                        }
                        setTimeout(function () {
                            location.reload();
                        }, 500);
                    })
                }
            },
            cancel: {
                text: "Cancel"
            }
        }
    });
}

function delFile(name) {
    $.confirm({
        title: '<cn>删除文件</cn><en>Delete</en>',
        content: '<cn>是否删除该文件？</cn><en>Confirm to delete this file?</en>',
        buttons: {
            ok: {
                text: "<cn>确认</cn><en>Confirm</en>",
                btnClass: 'btn-danger',
                keys: ['enter'],
                action: function () {
                    func("delFile", {
                        "name": name
                    }, function (data) {
                        refreshDownloads();
                    });
                }
            },
            cancel: {
                text: "<cn>取消</cn><en>Cancel</en>",
                action: function () { }
            }

        }
    });

}

function gotoPage(num) {
    curPage = num;
    $("#fileList").html("");
    var html = "";
    $("#pagenav li").each(function (i, o) {
        if (i == num)
            $(o).addClass("active");
        else
            $(o).removeClass("active");
    });
    $.ajaxSettings.async = false;
    for (var i = num * eachPage; i < fileList.length && i < num * eachPage + eachPage; i++) {
        if (fileList[i].type != "directory")
            continue;
        var name = fileList[i].name;
        var path = '/files/' + name + '/';
        var tmp = "";
        $.getJSON(path, function (list1) {
            var dirMark = false;
            for (var i = 0; i < list1.length; i++) {
                for (var j = 0; j < ini.length; j++) {
                    if (list1[i].name == ini[j].id + "" && list1[i].type == "directory")
                        dirMark = true;
                }
            }
            if (!dirMark)
                return;
            tmp = '<div class="col-md-12"><div class="panel panel-default"><div class="panel-heading text-center">' +
                '<span>' + name + '</span>' +
                '<button onClick="delFile(\'' + name + '\');" type="button" class="btn btn-sm btn-danger pull-right">' +
                '<i class="fa fa-trash-o"></i> Delete</button></div><div class="panel-body"><div class="row">';
            for (var i = 0; i < list1.length; i++) {
                if (list1[i].type != "directory")
                    continue;
                var chnId = parseInt(list1[i].name);
                tmp += '<div class="col-sm-6 col-md-3"><ul class="list-group"><li class="list-group-item text-center">' +
                    '<strong>' + ini[chnId].name + '</strong></li>';
                var path2 = path + list1[i].name + '/';
                $.getJSON(path2, function (list2) {
                    var tmp2 = "";
                    var jpg = "";
                    var mp4 = "";
                    var countMap = {};
                    for (var i = 0; i < list2.length; i++) {
                        var name2 = list2[i].name;

                        if (name2.indexOf(".jpg") > 0)
                            jpg = '<li class="list-group-item img"><img src="' + path2 + name2 + '" alt="..."></li>';
                        else {
                            var start = 99999;
                            var mark = "";
                            var format = name2.substring(name2.indexOf("."));
                            var fileName = "";
                            if (name2.indexOf("_") > 0) {
                                var nList = name2.split("_");
                                mark = nList[0].substring(0, 7);
                                fileName = mark + format;
                                if (countMap.hasOwnProperty(fileName))
                                    start = countMap[fileName].start;
                                var num = parseInt(nList[1].substring(0, nList[1].indexOf(format)));
                                if (num < start)
                                    start = num;
                            } else {
                                mark = name2;
                                start = 0;
                                fileName = mark;
                            }

                            var param = {};
                            if (countMap.hasOwnProperty(fileName)) {
                                param = countMap[fileName];
                                var count = param["count"];
                                count++;
                                param["count"] = count;
                                param["start"] = start;
                            } else {
                                param = {
                                    path: path2,
                                    start: start,
                                    mark: mark,
                                    count: 1,
                                    format: format
                                }
                            }
                            countMap[fileName] = param;
                        }
                    }
                    for (var key in countMap) {
                        var fileName = key;
                        var param = countMap[key];
                        var path = param["path"];
                        var mark = param["mark"];
                        var start = param["start"];
                        var count = param["count"];
                        var format = param["format"];
                        if (key.indexOf("mp4") > 0)
                            mp4 += '<li class="list-group-item"><a href="javascript:void(0)" onclick="onDownload(\'' + path + '\',\'' + mark + '\',\'' + start + '\',\'' + count + '\',\'' + format + '\')"><i class="fa fa-download"></i>' + fileName + '</a><button type="button" class="btn btn-default btn-xs pull-right" onClick="play(\'' + path + '\',\'' + mark + '\',\'' + start + '\',\'' + count + '\');"><i class="fa fa-play"></i></button></li>';
                        else
                            tmp2 += '<li class="list-group-item"><a href="javascript:void(0)" onclick="onDownload(\'' + path + '\',\'' + mark + '\',\'' + start + '\',\'' + count + '\',\'' + format + '\')"><i class="fa fa-download"></i>' + fileName + '</a></li>';

                    }
                    tmp += jpg + mp4 + tmp2 + '</ul></div>';
                });
            }
        });

        tmp += '</div></div></div></div>';
        html += tmp;
    }
    $.ajaxSettings.async = true;
    $("#fileList").html(html);
}

function onDownload(path, name, startNum, count, format) {
    (new Array(parseInt(count)).fill(0)).forEach(function (item, index) {
        setTimeout(() => {
            var url = "",
                downName = "";
            if (name.indexOf(format) < 0) {
                url = path + name + "_" + (parseInt(startNum) + index) + format;
                //downName =　name+"_"+(index+1)+format;
                downName = "";
            } else {
                url = path + name;
                downName = "";
            }
            var a = document.createElement('a');
            var e = document.createEvent('MouseEvents');
            e.initEvent('click', false, false);
            a.href = url;
            a.download = downName;
            a.dispatchEvent(e);
        }, 200 * index)
    });
}

function onTimer() {
    var channels = config["channels"];
    rpc("rec.getDurTime", [], (data) => {
        var obj = $.parseJSON(data);
        Object.keys(obj).forEach((id) => {
            let durTime = obj[id];
            let numericalId = id.substring(3, 5);
            let node = document.querySelector(`#durTime${numericalId}`);
            if (node) {
                node.value = durTime;
            }
        });
    });
}

function refreshDownloads() {
    let search = $("#searchVal").val();
    $.getJSON("files/", function (list) {
        fileList = [];
        for (var i = list.length - 1; i >= 0; i--) {
            if (search != "") {
                var dirName = list[i].name;
                if (dirName.indexOf(search) != -1)
                    fileList.push(list[i]);
            } else
                fileList.push(list[i]);
        }
        totalPage = Math.ceil(fileList.length / eachPage);

        var nav = "";
        for (var i = 0; i < totalPage; i++) {
            nav += '<li class="active"><a href="#" onClick="gotoPage(' + i + ')">' + (i + 1) + '</a></li>';
        }
        $("#pagenav").html(nav);
        gotoPage(curPage);
    });
}

function getState() {
    func("getDiskSpace", [], function (data) {
        if (data.total == 0) {
            $('#space').text("--/--");
            $('#space').css("margin-right", "10px");
        } else {
            $('#space').text(data.used + " / " + data.total);
        }
    });
}

function buildChannelList(enabledChn) {
    let parent = document.querySelector("#channelList");
    parent.innerHTML = "";
    enabledChn.forEach(c => {
        let id = c["id"];
        let row = document.createElement('div');
        row.innerHTML = `<div class="row" style="margin-top: 5px;">` +
            `<div class="col-md-4 col-xs-4">` +
            `<input value="${c.chnName}" type="text" class="form-control" disabled="disabled">` +
            `</div>` +
            `<div class="col-md-4 col-xs-4">` +
            `<button id="startRecord${id}" type="button" class="btn btn-danger recordBtn" name="startRecord">REC</button>` +
            `<button id="stopRecord${id}" type="button" class="btn btn-primary stopBtn" name="stopRecord">STOP</button>` +
            `</div>` +
            `<div class="col-md-4 col-xs-4">` +
            `<input id="durTime${id}" type="text" class="form-control" disabled="disabled" style="color: #399bff; border: none;background: none;outline: none;text-align:center" value="--:--:--">` +
            `</div></div>`;

        let recordBtn = row.querySelector('.recordBtn');
        recordBtn.addEventListener("click", () => onRecordBtnClick(id));
        row.querySelector(".stopBtn").addEventListener("click", () => onStopBtnClick(id));
        parent.append(row);
    });
}

function initView(andThen) {
    var formats = ["mp4", "ts", "flv", "mkv", "mov"];
    $.getJSON("config/config.json", function (result) {
        ini = result; // Why there and not config, that's also global?!
        $.getJSON("config/record.json", function (cfg) {
            config = cfg;
            var chns = cfg["channels"];
            var enabledChn = new Array();
            var html = "";
            var isRecordMark = false;
            for (var i = 0; i < result.length; i++) {
                var id = result[i].id;
                for (var j = 0; j < chns.length; j++) {
                    if (id === chns[j].id) {
                        chns[j].chnName = result[i].name;
                        chns[j].enable = result[i].enable;
                        chns[j].durTime = "--:--:--";
                        if (result[i].enable) {
                            for (var k = 0; k < formats.length; k++) {
                                if (chns[j][formats[k]])
                                    isRecordMark = true;
                            }
                            enabledChn.push(chns[j]);
                            html += '<div class="col-sm-3" style="margin-left: 5px;"><div class="checkbox"><label><input type="checkbox" style="margin-top: 2px" name="' + i + '" value="' + result[i].id + '">' + result[i].name + '</label></div></div>';
                        }
                    }
                }
            }
            $("#channels").html(html);
            var channels = cfg.any.chns;
            for (var i = 0; i < channels.length; i++) {
                var cid = channels[i];
                $("#channels input[name='" + cid + "']").attr("checked", true);
            }

            buildChannelList(enabledChn);
            zcfg("#all", cfg["any"]);

            if (isRecordMark)
                intervalId = setInterval(onTimer, 1000)
            else {
                clearInterval(intervalId);
                intervalId = -1;
            }

            getState();

            andThen();
        });
    });
}

function setupSegmentSizeControls() {
    function saveSegmentInfo() {
        rpc("rec.isRecordState", [], function (data) {
            if (data) {
                alert("Please ensure recording has stopped before changing this setting.");
                return;
            }
            rpc("rec.update", [JSON.stringify(config, null, 2)], function (data) {
                console.log(`updated segment mode.`);
            })
        });
    }

    $("#segmentSizeEnable").on("switchChange.bootstrapSwitch", function (event, newState) {
        config["any"]["fragment"]["segmentSizeEnable"] = newState;
        config["any"]["fragment"]["segmentDuraEnable"] = false;
        saveSegmentInfo();
    });

    $("#segmentSize").on("change", function () {
        let size = parseInt($("#segmentSize").val());
        if (size == undefined || size < 1 || size > 1000) {
            size = 1;
            $("#segmentSize").val(size);
        }
        config["any"]["fragment"]["segmentSize"] = size;
        saveSegmentInfo();
    });
}

function onRecordBtnClick(id) {
    rpc("rec.isMountDisk", [], (data) => {
        if (!data) {
            htmlAlert("#alert", "danger", "No external storage device was found!", "", 5000);
            return;
        }

        // alert(`record id ${id}`);
        config.channels[id]["mp4"] = true;
        config.channels[id]["mov"] = false;
        config.channels[id]["flv"] = false;
        config.channels[id]["mkv"] = false;
        config.channels[id]["ts"] = false;
        // config.channels[id]["enable"] = true;
        config.channels[id]["isPause"] = false;
        rpc("rec.execute", [JSON.stringify(config, null, 2)], function (data) {
            setTimeout(refreshDownloads, 2000);
            if (intervalId < 0)
                intervalId = setInterval(onTimer, 1000);
        });
    });
    return false;
}

function onStopBtnClick(id) {
    // alert(`stop id ${id}`);
    config.channels[id]["mp4"] = false;
    config.channels[id]["mov"] = false;
    config.channels[id]["flv"] = false;
    config.channels[id]["mkv"] = false;
    config.channels[id]["ts"] = false;
    // config.channels[id]["enable"] = false;
    // config.channels[id]["isPause"] = true;
    rpc("rec.execute", [JSON.stringify(config, null, 2)], function (data) {
        if (intervalId < 0)
            intervalId = setInterval(onTimer, 1000);
    });

    return false;
}

$(function () {
    $.fn.bootstrapSwitch.defaults.size = 'small';
    $.fn.bootstrapSwitch.defaults.onColor = 'warning';
    navIndex(4);
    initView(() => {
        updateChannelStatus();
        refreshDownloads();
        diskModalSetup();
        getMountedPath();
        setupSegmentSizeControls();
    });

    document.querySelector("#search").addEventListener("click", (e) => refreshDownloads());
    document.querySelector("#refreshDownloads").addEventListener("click", (e) => refreshDownloads());

    checkAdminRole();
});

$("#startRecord").click(function (e) {
    rpc("rec.isMountDisk", [], function (data) {
        if (!data) {
            htmlAlert("#alert", "danger", "No external storage device was found!", "", 5000);
            return;
        }
        var checkChns = new Array();
        $("#channels :checked").each(function (i, o) {
            var id = $(o).attr("value");
            checkChns.push(id);
            // Force MP4 (Island mod)
            config.channels[id]["flv"] = false;
            config.channels[id]["mkv"] = false;
            config.channels[id]["ts"] = false;
            config.channels[id]["mov"] = false;
            config.channels[id]["mp4"] = true;
        });

        config["any"].chns = checkChns;
        rpc("rec.execute", [JSON.stringify(config, null, 2)], function (data) {
            setTimeout(refreshDownloads, 2000);
            if (intervalId < 0)
                intervalId = setInterval(onTimer, 1000);
            // htmlAlert("#alert", "success", "Multi-recording started", "", 3000);
        })
    })
});

$("#stopRecord").click(function (e) {
    rpc("rec.stop", [], function (data) {
        if (data) {
            $.getJSON("config/record.json", function (cfg) {
                clearInterval(intervalId);
                intervalId = -1;
            });
            setTimeout(onTimer, 1500);
        }
    });
});

$("#setAllName").blur(function () {
    $("#setAllName").css("border", "solid 1px black")
});

function checkAdminRole() {
    fetch("/func.php?func=checkAdminRole").then(r => r.json()).then(r => {
        if (r.error == "") {
            hasAdminRole = r.result;
        }
        else {
            console.log(`Failed to fetch user role: ${r.error}`);
        }
    });
}