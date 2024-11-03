<?php
include("head.php");
?>
<div id="alert"></div>
<div class="row">
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="title">
				<h3 class="panel-title">Custom No Signal graphic</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12">
						You can upload a custom "No Signal" graphic.<br>
						It should be 1920x1080 in PNG or JPEG format.<br>
						<b>WARNING</b>: Uploading an image will cause all streams to briefly drop, and then restart.<br>
						Do not upload an image during the middle of a live broadcast!
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<form role="form" enctype="multipart/form-data" action="/nosignal-upload.php" method="POST">
							<div class='form-group'>
								<label for="file">Image file</label>
								<input type="file" name='file' id="file" class="form-input">
							</div>
							<button type="submit" class="btn btn-default">Upload</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-9 col-sm-12">
		<div class="panel panel-default">
			<div class="title">
				<h3 class="panel-title">Current graphic</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<img id="nosignal-img" width="100%">
				</div>
			</div>
		</div>
	</div>
</div>


<script>
	$(function() {
		var rnd = Math.random();
		$("#nosignal-img").attr("src", `/img/nosignal-thumb.jpg?rnd=${rnd}`);
	});
</script>
<?php
include("foot.php");
?>
