
function getNetworkInterfaces(repeatsRemaining = 33) {
    let repeatInterval = 9000;
    if (repeatsRemaining == 0) {
        return;
    }

    unauthedFunc("getAllNetworkInterfaces", undefined, function (res) {
        $("#networkInterfaces").empty();
        res.result.forEach(i => {
            if (i.name == "lo") {
                i.name = "Loopback"
                return;
            }

            else if (i.name == "eth0") {
                i.name = "LAN"
            }
            else if (i.name == "wlan0") {
                i.name = "WIFI"
            }
            else if (i.name == "tailscale0") {
                i.name = "VPN"
            }

            item = `<div class="row"><div class="col-md-3 col-sm-2 col-xs-2">${i.name}</div><div class="col-md-6 col-sm-3 col-xs-3">${i.address}` +
                ` <a href="#" onclick="copyToClipboard('${i.address}');"><i class="fa fa-clipboard"></i></a></div></div>`;

            $("#networkInterfaces").append(item);
        });

        setTimeout(_ => { getNetworkInterfaces(repeatsRemaining - 1) }, repeatInterval);
    });
}

function copyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.opacity = 0;
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    try {
        document.execCommand('copy');
    } catch (err) {
        console.log(`Error copying to clipboard: ${err}`);
    }
    document.body.removeChild(textArea);
}

// Javascript helper to just get the best IP address to call ourselves with.
// ie. Preference to tailscale0, then eth0
function getSelfIPAddress() {
    unauthedFunc("getAllNetworkInterfaces", undefined, function (res) {
        var interfaces = {};
        res.result.forEach(i => {
            interfaces[i.name] = i.address;
        });
        var best = interfaces["tailscale0"];
        if (best == undefined || best == "") {
            best = interfaces["eth0"];
        }
        $(".self-ip-address").text(best);
    });
}

// A jquery onclick handler -- doesn't work because content has to be served on https
/*
function copyIpAddress() {
    var addr = $(this).parent().find(".self-ip-address").first().text();
    navigator.clipboard.writeText(addr);
}
*/