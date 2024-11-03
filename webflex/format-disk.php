<?php
include("head.php");
if ($chip == "HI3520DV400") {
	exit;
}
?>
<div id="alert"></div>

<div class="row">
	<div class="col-md-12">

		<div class="panel panel-default" id="format-disk">
			<div class="title">
				<h3 class="panel-title">Format External Disk- EXT4</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-lg-3">
						<div class="form-group">
							<label>Filesystem type</label>
							<select name="format_mode" id="format_mode" class="form-control">
								<option value="ext4">EXT4</option>
								<option value="fat32">FAT32</option>
							</select>
						</div>
					</div>
					<div class="col-md-12 col-lg-9">
						Formatting a disk as FAT32 will limit the capacity to 32GB, and individual files have a maximum size of 4GB. The format is easily
						readable on MacOS and Windows devices.<br>
						Formatting a disk as EXT4 enables full use of its capacity on this device, and individual files have no size restriction.
						However this format is not supported by default on MacOS or Windows devices, requiring extra drivers to be installed.
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped">
							<thead>
								<th>Device</th>
								<th></th>
							</thead>
							<tbody id="disk-list">
							</tbody>
						</table>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<button class="btn btn-info" type="button" id="refreshDisks"><i class="fa fa-refresh"></i> Refresh drive list</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<script>
	function getAvailableDisks() {
		fetch("/format-disk-worker.php").then(r => r.json()).then(data => {
			$("disk-list").empty();
			if (data.devices.size == 0) {
				htmlAlert("#alert", "warning", "No external disks found", "", 10000);
			} else {
				listDisks(data.devices);
			}
		})
	}

	function listDisks(devices) {
		tbody = document.querySelector("#disk-list");
		var innerHtml = "";
		devices.forEach(device => {
			var devInfo = device.info;
			innerHtml += `<tr><td>${devInfo}</td>` +
				`<td><button class="btn btn-danger" type="button" id="${device.id}">Format!</button></td></tr>`;
		})
		tbody.innerHTML = innerHtml;
		devices.forEach(device => {
			let btn = document.querySelector("#" + device.id);
			let msg = "Any existing data on this disk will be deleted. Are you sure?";
			btn.addEventListener("click", () => confirmFormat(device.id, msg));
		});
	}

	function confirmFormat(deviceId, message) {
		let result = confirm(message);
		if (result) {
			formatDisk(deviceId);
		}
	}

	function formatDisk(deviceId) {
		let mode = document.querySelector("#format_mode").value;
		let btn = document.querySelector("#" + deviceId);
		btn.disabled = true;
		setTimeout(() => btn.disabled = false, 2000);
		htmlAlert("#alert", "info", "Please wait...", "", 30000);
		fetch(`/format-disk-worker.php?device=${deviceId}&mode=${mode}`, {
			method: "POST"
		}).then(r => r.json()).then(data => {
			document.querySelector("#alert").innerHTML = "";
			htmlAlert("#alert", "success", "Result: ", data.message);
		});
	}

	function initialSetup() {
		let btn = document.querySelector("#refreshDisks");
		btn.addEventListener("click", getAvailableDisks);
		getAvailableDisks();
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
