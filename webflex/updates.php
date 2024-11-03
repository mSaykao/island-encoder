<?php
include("head.php");
?>
<div id="alert"></div>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default hidden" id="update-available">
			<div class="title">
				<h3 class="panel-title">Update available</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						An update is available. Updates must be applied one at a time.<br>A reboot will be required for each update.
					</div>
					<div class="col-md-12">
						<button type="button" class="btn btn-warning">Update</button>
					</div>
				</div>
			</div>
		</div>

		<div class="panel panel-default" id="version-list">
			<div class="title">
				<h3 class="panel-title">System Updates</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						<h4 id="current-version"></h4>
					</div>
					<div class="col-md-12">
						Information on firmware updates: <a href="https://www.islandencoders.com/firmware-updates/" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<h4 id="checking-update-msg">
							Checking for available updates...
						</h4>
					</div>
					<table class="table hidden" id="update-list">
						<thead>
							<th>Version</th>
							<th>Info</th>
						</thead>
						<tbody id="update-list">

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="panel panel-default hidden" id="update-logs-panel">
			<div class="title">
				<h3 class="panel-title">Update Logs</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12" id="update-logs"></div>
				</div>
			</div>
		</div>

	</div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="release-notes-modal">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="modal-title">Release notes</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body" id="release-notes">
				<p></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<script>
	function createUpdateInfoElement(verData) {
		var tr = document.createElement("tr");
		var td1 = document.createElement("td");
		td1.innerHTML = "<h4>" + verData["version_id"] + "</h4>";
		tr.append(td1);
		var td2 = document.createElement("td");
		var btn = document.createElement("button");
		btn.setAttribute("type", "button");
		btn.classList.add("btn");
		btn.classList.add("btn-primary");
		btn.innerHTML = "View release notes";
		td2.append(btn);
		tr.append(td2);

		btn.addEventListener("click", (event) => showReleaseNotes(verData["version_id"]));

		return tr;
	}

	function getCurrentVersion() {
		fetch("/update-worker.php?version=1").then(r => r.json()).then(data => {
			document.querySelector("#current-version").innerHTML = "Current version: " + data["version"];
		});
	}

	function showReleaseNotes(version_id) {
		$("#release-notes-modal").modal();
		fetch("/update-worker.php?notes=" + version_id).then(r => r.json()).then(j => {
			document.querySelector("#release-notes").innerHTML = j["notes"];
		});
	}

	function displayUpdateAvailable(version) {
		var parent = document.querySelector("#update-available");
		var button = parent.querySelector("button");
		button.innerText = `Apply update ${version["version_id"]}`;
		parent.classList.remove("hidden");
		button.addEventListener("click", (event) => confirmAndTriggerUpdate());
	}

	function confirmAndTriggerUpdate() {
		var confirmation = confirm("This update may take several minutes, and will reboot the device. Are you sure?");
		if (confirmation) {
			htmlAlert("#alert", "success", "Updating..", "Please do not unplug power from the device during the update!", 30000);
			document.querySelector("#update-available").classList.add("hidden");
			document.querySelector("#version-list").classList.add("hidden");

			fetch("/update-worker.php", {
				method: "POST"
			});
			document.querySelector("#update-logs-panel").classList.remove("hidden");
			setTimeout(fetchUpdateLogs, 1000);
		} else {
			htmlAlert("#alert", "danger", "User declined update", "", 10000);
		}
	}

	function fetchUpdateLogs() {
		fetch("/notifications.php").then(r => r.text()).then(t => {
			// TODO: This is a bit hacky; sort out a better way
			if (t.includes("loginPage")) {
				// Assume reboot has happened:
				window.location = "/login.php"
			} else {
				document.querySelector("#update-logs").innerHTML = t;
			}
		});
		setTimeout(fetchUpdateLogs, 2000);
	}

	function checkForUpdates() {
		fetch("/update-worker.php").then(r => r.json()).then(data => {
			if (data.length >= 1) {
				document.querySelector("#checking-update-msg").innerHTML = "Available updates:";
				document.querySelector("#update-list").classList.remove("hidden");
				listParent = document.querySelector("#update-list tbody")
				data.forEach(u => {
					var entry = createUpdateInfoElement(u);
					listParent.append(entry);
				});
				displayUpdateAvailable(data[0]);
			} else {
				document.querySelector("#checking-update-msg").innerHTML =
					'<h4>You are on the latest version</h4>';
			}

		}).catch(e => {
			console.log(`Error fetching updates: ${e}`);
			htmlAlert("#alert", "danger", "Error", "Could not fetch updates");
		});
	}

	function initialSetup() {
		getCurrentVersion();
		checkForUpdates();
	}

	if (document.readyState !== 'loading') {
		initialSetup();
	} else {
		document.addEventListener('DOMContentLoaded', initialSetup);
	}
</script>

<?php
include("foot.php");
?>
