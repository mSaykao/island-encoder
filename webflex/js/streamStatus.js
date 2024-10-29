
function updateStreamStatus() {
    $.getJSON("config/config.json", function (data) {
        // console.log(data);
        $('#streamStatus').empty();
        data.forEach(item => {
            htmlStr = "";
            if (item.enable) {
                htmlStr += `<tr><td>${item.name}</td><td>`;
                fr = "@" + item.encv.framerate;
                if (item.encv.framerate == -1) // -1 means auto
                    fr = "";
                res = `${item.encv.width}x${item.encv.height}${fr}`;
                bitrate = Math.round(item.encv.bitrate / 1000);
                codec = `${item.encv.codec} ${bitrate} Mbps`;
                htmlStr += `${res} ${codec}`;
                htmlStr += "</td><td>";
                if (item.stream.srt.enable) {
                    srt = item.stream.srt;
                    info = `SRT: ${srt.ip}:${srt.port} (${srt.mode})`;
                    htmlStr += info;
                }
                htmlStr += '</td></tr>';
                $('#streamStatus').append(htmlStr);
            }
        });
    });
    setTimeout(updateStreamStatus, 9000);
}

// A variation on the above, that includes hardware input status and network sources
function updateChannelStatus() {
    rpc("enc.getInputState", null, inputs => {
        let inputStatus = {};
        inputs.forEach(item => {
            let status = "";
            if (item.protocol == "HDMI" || item.protocol == "SDI") {
                if (item.avalible) {
                    let fr = item.framerate;
                    if (fr == -1)
                        fr = ""
                    status = item.height + (item.interlace ? "I" : "P") + fr;
                } else {
                    status = "NO SIGNAL";
                }
            }
            if (status != "") {
                inputStatus[item.name] = status;
            }
        });


        fetch("config/config.json").then(r => r.json()).then(data => {
            // console.log(data);
            let updatedHtml = "<div class='row'><div class='col-md-3'><b>Channel</b></div>" +
                "<div class='col-md-4'><b>Input status</b></div>" +
                "<div class='col-md-5'><b>Encode setting</b></div></div><hr>";
            data.forEach(item => {
                let htmlStr = "";
                if (item.enable) {
                    htmlStr += `<div class="row" id="chanInfo${item.id}"><div class="col-md-3">${item.name}</div>`;
                    htmlStr += `<div class="col-md-4 chanInputStatus">`;
                    if (item["type"] == "net") {
                        let netpath = item["net"]["path"];
                        htmlStr += netpath;
                    }
                    else if (inputStatus[item.name]) {
                        htmlStr += inputStatus[item.name];
                    }
                    htmlStr += `</div><div class="col-md-5">`;

                    let fr = "@" + item.encv.framerate;
                    if (item.encv.framerate == -1) // -1 means auto
                        fr = "";
                    let res = `${item.encv.width}x${item.encv.height}${fr}`;
                    let bitrate = Math.round(item.encv.bitrate / 1000);
                    let codec = `${item.encv.codec} ${bitrate} Mbps`;
                    htmlStr += `${res} ${codec}`;
                    htmlStr += "</div></div><hr>";
                    updatedHtml += htmlStr;
                }
            });
            document.querySelector("#channelStatus").innerHTML = updatedHtml;
        }).catch(reason => {
            console.log(`Error updating channel status: ${reason}`);
        });
    });
    setTimeout(updateChannelStatus, 4500);
}


function updateInputStatus() {
    rpc("enc.getInputState", null, function (data) {
        data.forEach(item => {
            let status = "";
            if (item.protocol == "HDMI" || item.protocol == "SDI") {
                if (item.avalible) {
                    let fr = item.framerate;
                    if (fr == -1)
                        fr = ""
                    status = item.height + (item.interlace ? "I" : "P") + fr;
                } else {
                    status = "NO SIGNAL";
                }
            }
            if (status != "") {
                let target = document.querySelectorAll(`.chanInputStatus[channelName="${item.name}"]`);
                target.forEach(n => n.innerHTML = status);
            }
        });
    });
}