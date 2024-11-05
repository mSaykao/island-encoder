<?php
include("head.php");

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location:nosignal.php");
    exit();
}

// Original filename: $_FILES['file']['name']
// Where it is stored: $_FILES['file']['tmp_name']

$origName = $_FILES['file']['name'];

# Find the extension:
preg_match('/\.([a-zA-Z]{3,4})$/', $origName, $matches);
$extension = strtolower($matches[1]);
$tmpFile = "/tmp/new-no-signal.$extension";

move_uploaded_file($_FILES['file']['tmp_name'], $tmpFile);

$output = exec("cd /tmp && /opt/yuv-converter/runner.sh $tmpFile");

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
                        Upload completed: <? echo $output; ?>
                        <br><br>
                        New graphic:<br>
                        <img id="nosignal-img" width="100%">
                    </div>
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
