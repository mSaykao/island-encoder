
function initRecordInfo() {
    function continueRecordSetup() {
        // Copied from record.php and modified.. feels like that inner loop could be optimised
        fetch("config/config.json").then(r => r.json()).then(config => {
            fetch("config/record.json").then(r => r.json()).then(recordCfg => {
                var channels = recordCfg["channels"];
                var enabledChn = new Array();
                for (var i = 0; i < config.length; i++) {
                    var id = config[i].id;
                    for (var j = 0; j < channels.length; j++) {
                        if (id === channels[j].id) {
                            channels[j].name = config[i].name;
                            if (config[i].enable) {
                                enabledChn.push(channels[j]);
                            }
                        }
                    }
                }

                buildRecordChannelList(enabledChn);
            });
        });
    }

    fetch("/config/hardware.json").then(r => r.json()).then(hardware => {
        if (hardware["chip"] == "SS524V100" || hardware["chip"] == "SS528V100") {
            document.querySelector("#recordingPanel").classList.remove("hidden");
            continueRecordSetup();
        }
    });
}

function buildRecordChannelList(enabledChn) {
    let html = "";
    enabledChn.forEach(c => {
        let id = c["id"];
        html += `<tr><td>${c.chnName}</td><td id="durTime${id}">--:--:--</td></tr>`;
    });
    document.querySelector("#recordStatus").innerHTML = html;
}

function getRecordStatus() {
    rpc("rec.getDurTime", [], (data) => {
        var obj = $.parseJSON(data);
        Object.keys(obj).forEach(id => {
            let durTime = obj[id];
            let numericalId = id.substring(3, 5);
            let node = document.querySelector(`#durTime${numericalId}`);
            if (node) {
                node.innerHTML = durTime;
            }
        });
    });
}
