// adjusts precision based on scale
function niceNumber(n) {
    if (n > 10.0) {
        return Math.round(n);
    }
    return n.toFixed(1);
}

function displayLatencyResults(results) {
    results.sort();
    let minValue = niceNumber(results[0]);
    let maxValue = niceNumber(results[results.length - 1]);
    let meanValue = niceNumber(results[Math.round(results.length * 0.5)]);
    let p90Value = niceNumber((results[results.length - 2] + results[results.length - 3]) / 2.0);
    let srt = Math.round(p90Value * 4.0);

    document.querySelector("#ping-results").innerHTML = "Ping time in milliseconds:" +
        "<table class='table'><tbody>" +
        `<tr><td>Min</td><td>${minValue} ms</td></tr>` +
        `<tr><td>Mean</td><td>${meanValue} ms</td></tr>` +
        `<tr><td>P90</td><td>${p90Value} ms</td></tr>` +
        `<tr><td>Max</td><td>${maxValue} ms</td></tr>` +
        `<tr><td><h3>SRT Latency</h3></td><td><h3>${srt}</h3></td></tr>` +
        "</tbody></table>";
}

function checkLatency() {
    $("#results-modal").modal();
    document.querySelector("#ping-results").innerHTML = "Working...";

    let target = document.querySelector("#targetIp").value;
    fetch("/latency-check-worker.php?target=" + target).then(r => r.json()).then(data => {
        if (data["results"] && data["results"].length > 8) {
            displayLatencyResults(data["results"]);
        } else {
            htmlAlert("#alert", "danger", "Error", "Failed to check latency", 10000);
            $("#results-modal").modal("hide");
        }
    }).catch(reason => {
        $("#results-modal").modal("hide");
        htmlAlert("#alert", "danger", "Error", reason, 10000);
    });
}

function checkSpeed() {
    alert("not yet implemented");
}

function initialSetup() {
    let latencyButton = document.querySelector("#checkLatency");
    latencyButton.addEventListener("click", (event) => checkLatency());
}

if (document.readyState !== 'loading') {
    initialSetup();
} else {
    document.addEventListener('DOMContentLoaded', initialSetup);
}

