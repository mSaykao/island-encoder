<?php
include("head.php");
?>
<div id="alert"></div>
<div id="alert2"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="title">
				<h3 class="panel-title">Tailscale VPN Config</h3>
			</div>
			<div class="panel-body">
				<div class="row text-center">
					<button id="tailscaleUp" type="button" class="btn btn-primary">
						Start VPN
					</button>
					&nbsp;
					<button id="tailscaleDown" type="button" class="btn btn-primary">
						Stop VPN
					</button>
				</div>

				<div class="row form-group">
					<label class="col-md-2 control-label">
						VPN status:
					</label>
					<div class="col-md-6">
						<div id="vpnStatus">Checking status...</div>
					</div>
				</div>
				<div class="row form-group">
					<label class="control-label col-md-2">
						Tailscale client version:
					</label>
					<div class="col-md-6">
						<div id="clientVersion"></div>
					</div>
				</div>

				<div class="row form-group">
					<label class="col-md-2 control-label" for="authkey">Update VPN Auth key</label>
					<div class="col-md-6"><input type="text" name="authkey" size="70" class="form-control"></div>
				</div>

				<div class="row form-group">
					<label class="col-md-2 control-label" for="subnet_enabled">Subnet routing enabled</label>
					<div class="col-md-6"><input type="checkbox" name="subnet_enabled" class="form-control"></div>
				</div>
				<div class="row form-group">
					<label class="col-md-2 control-label" for="subnet_route">Subnet routing</label>
					<div class="col-md-6"><input type="text" name="subnet_route" size="70" class="form-control" placeholder="For example: 192.168.1.0/24"></div>
				</div>
				<div class="row">
					<div class="col-md-8">
						Subnet routing enables connecting to other devices on the network adjacent to the Encoder, such as an ATEM.
						Enabling subnet routing here will also require approving the subnet route in the <a href="https://login.tailscale.com/admin/machines" target="_blank">Tailscale Admin panel</a>.
						Note that care must be taken not to route subnets that are in the same range as other machines in the Tailnet.<br>
						Do not change these settings during a stream as it may cause a disconnection and be sure to test thoroughly before putting into the field.
					</div>
				</div>

				<hr />
				<div class="row text-center" style="padding-bottom: 5px">
					<button id="restartTailscale" type="button" class="btn btn-warning">
						Restart VPN
					</button>
					&nbsp;
					<button id="logoutTailscale" type="button" class="btn btn-primary">
						Log out VPN
					</button>
				</div>
				<div class="row text-center">
					<button id="saveConfig" type="button" class="btn btn-danger">Save Config</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="title">
				<h3 class="panel-title">ATEM Link</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div id="atem-status" class="col-lg-6"></div>
				</div>
				<div class="row">
					<div class="col-md-6" id="deviceList">
						<i>Click button to start scan</i>
					</div>
				</div>

				<div class="row text-center">
					<button id="scanDeviceBtn" type="button" class="btn btn-primary">Scan for ATEM</button>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function scanDeviceBtnHandler() {
		$("#scanDeviceBtn").text("Scanning...");
		$("#deviceList").html("Starting scan... This will take ten seconds.");
		fetch("/atem-network-scanner.php", {
			method: "POST"
		}).then(r => r.json()).then(j => {
			if (j.success != true) {
				$("#deviceList").html("Scan did not complete successfully");
				$("#scanDeviceBtn").text("Scan for ATEM");
				return;
			}
			let htmlStr = "Possible ATEM devices found:<br><ul>";
			j.addresses.forEach(a => {
				htmlStr += `<li>${a} <button type="button" class="btn btn-sm btn-primary atem-proxy" data="${a}">Proxy</button></li>`;
			});
			htmlStr += "</ul>";
			$("#deviceList").html(htmlStr);
			$("#scanDeviceBtn").text("Scan for ATEM");
			setupAtemProxyButtons();
		});
	}

	function setupAtemProxyButtons() {
		document.querySelectorAll(".atem-proxy").forEach(btn => {
			const ip = btn.attributes["data"]?.value;
			btn.addEventListener("click", () => {
				if (confirm(`Enable ATEM proxying? Only one ATEM can be proxied at a time.`)) {
					func("enableAtemProxy", {
						target_ip: ip
					});
					setTimeout(checkAtemProxyStatus, 1500);
					setTimeout(checkAtemProxyStatus, 4000);
				}
			})
		});
	}

	function checkAtemProxyStatus() {
		func("checkAtemProxy", {}, (result) => {
			var msg = result.result;
			if (msg.length > 1) {
				msg = msg + ". Connect ATEM remote control to Island's IP address.";
			}
			$("#atem-status").text(msg);
		});
	}

	function getStatus() {
		func("getTailscaleStatus", undefined, function(res) {
			$("#vpnStatus").text(res.result.status);
			$("#clientVersion").text(res.result.version);
			setTimeout(getStatus, 5000);
		});
	}

	function startVpn() {
		func("tailscaleUp");
		htmlAlert("#alert", "success", "VPN Starting...", "", 5000);
	}

	function stopVpn() {
		func("tailscaleDown");
		htmlAlert("#alert", "success", "VPN Stopping...", "", 5000);
	}

	function updateAuthKey() {
		newKey = $("input[name=authkey]").val();
		if (newKey == undefined || newKey == "") {
			htmlAlert("#alert", "danger", "Error", "Auth key must not be empty", 10000);
			return;
		}

		callback = function(result) {
			if (result.error != undefined && result.error != "") {
				htmlAlert("#alert", "danger", "Rejected", result.error, 10000);
			} else {
				htmlAlert("#alert", "success", "Success", result.result, 2000);
			}
		}

		func("tailscaleReplaceAuthKey", {
			key: newKey
		}, callback);
	}

	function updateTailscaleClient() {
		htmlAlert("#alert", "success", "Checking - Please wait...", "", 5000);
		callback = function(result) {
			htmlAlert("#alert2", "success", "", result.result);
		};
		func("tailscalePerformUpdate", undefined, callback);
	}

	function restartTailscale() {
		callback = function(result) {
			if (result.error != undefined && result.error != "") {
				htmlAlert("#alert", "danger", "Error", result.error);
			} else {
				htmlAlert("#alert", "success", "Success", "Restarting VPN", 2000);
			}
		}
		func("tailscaleUp", undefined, callback);
	}

	function logoutTailscale() {
		callback = function(result) {
			if (result.error != undefined && result.error != "") {
				htmlAlert("#alert", "danger", "Error", result.error);
			} else {
				htmlAlert("#alert", "success", "Success", "Logged out of VPN", 2000);
			}
		}
		func("logoutTailscale", undefined, callback);
	}

	function setupSubnetRoute(data) {
		$("input[name=subnet_route]").val(data.route);
		$("input[name=subnet_route]").prop("placeholder", data.suggested);
		$("input[name=subnet_enabled]").prop("checked", data.enabled);
	}

	function updateSubnetRoute() {
		let subnetRoute = $("input[name=subnet_route]").val().trim();
		let subnetEnabled = $("input[name=subnet_enabled]").prop("checked");
		if (subnetEnabled) {
			if (subnetRoute == "192.168.0.0/16" || subnetRoute == "192.168.1.0/24" || subnetRoute == "192.168.0.0/16") {
				let c = confirm("The subnet route chosen is very likely to cause conflicts with other devices.\nIf possible, reconfigure the network to use a unique range of private IPs.\nDo you want to continue?");
				if (c != true) {
					htmlAlert("#alert", "success", "Not updated", "", 5000);
					return;
				}
			}
		}
		htmlAlert("#alert", "success", "Updating...", "", 5000);
		callback = function(result) {
			htmlAlert("#alert", "success", "Updated", "VPN must be restarted for this to take effect.<br>This may interrupt your connection!");
			if (subnetRoute == "") {
				// Reload the suggested route
				func("tailscaleGetSubnetRoute", undefined, setupSubnetRoute);
			}
		};
		func("tailscaleSetSubnetRoute", {
			route: subnetRoute,
			enabled: subnetEnabled
		}, callback);
	}

	function saveConfig() {
		newKey = $("input[name=authkey]").val();
		if (newKey != undefined && newKey != "") {
			updateAuthKey();
		}
		updateSubnetRoute();
	}

	$(function() {
		setTimeout(getStatus, 200);
		setTimeout(checkAtemProxyStatus, 1000);

		func("tailscaleGetSubnetRoute", undefined, setupSubnetRoute);

		$("#saveConfig").click(saveConfig);
		$("#tailscaleUp").click(startVpn);
		$("#tailscaleDown").click(stopVpn);
		$("#replaceAuthkey").click(updateAuthKey);
		$("#updateTailscale").click(updateTailscaleClient);
		$('#restartTailscale').click(restartTailscale);
		$('#logoutTailscale').click(logoutTailscale);
		$('#scanDeviceBtn').click(scanDeviceBtnHandler);
		<?
		$keyFile = stat("/link/config/tailscale.key");
		if ($keyFile == false || $keyFile[7] < 10) {
		?>
			htmlAlert("#alert", "danger", "WARNING", "No Tailscale auth key set! Set one before starting VPN.", 5000);
		<?
		}
		?>
	});
</script>
<script src="vendor/switch/bootstrap-switch.js"></script>
<?php
include("foot.php");
?>
