<?php
include("hardware.php");
include("session.php");
include("headhead.php");
?>

<nav class="navbar navbar-default">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="dashboard.php"> <img src="img/logo.png" style="width: 97px; height: 40px;" class="visible-xs-block visible-sm-block" /> <img src="img/logo.png" class="visible-md-block visible-lg-block" /> </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="defaultNavbar1">
      <ul class="nav navbar-nav navc">
        <li><a href="dashboard.php"><i class="fa fa-tachometer menuIcon"></i>
            Dashboard
          </a></li>
        <li><a href="sendsettings.php"><i class="fa fa-upload menuIcon"></i>
            SEND
          </a></li>
        <li><a href="decode.php"><i class="fa fa-download menuIcon"></i>
            RECEIVE
          </a></li>
        <li><a href="output.php"><i class="fa fa-external-link menuIcon"></i>
            OUTPUT
          </a></li>
        <? if ($chip == "SS524V100" || $chip == "SS528V100") { ?>
          <li><a href="island-record.php"><i class="fa fa-floppy-o menuIcon"></i>
              RECORD
            </a></li>
        <? } ?>
        <li><a href="tally.php"><i class="fa fa-lightbulb-o menuIcon"></i>
            TALLY
          </a></li>

        <li role="presentation" class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-gears menuIcon"></i>
            Settings<span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li><a href="tailscale.php"><i class="fa fa-plug"></i>VPN & ATEM Link</en></a></li>
            <li><a href="nosignal.php"><i class="fa fa-image"></i>Change No Signal graphic</en></a></li>
            <li><a href="updates.php"><i class="fa fa-wrench"></i>Updates</a></li>
            <li><a href="syncer-live.php"><i class="fa fa-clock-o"></i>Syncer</a></li>
            <?
            if ($_SESSION['login'] == "admin") {
            ?>
              <li><a href="sys.php"><i class="fa fa-gear"></i>System</a></li>
            <?
            } else {
            ?>
              <li><a href="sys-user.php"><i class="fa fa-gear"></i>Network settings</a></li>
            <?
            }
            ?>
            <? if ($chip == "SS524V100" || $chip == "SS528V100") { ?>
              <li><a href="format-disk.php"><i class="fa fa-floppy-o"></i>Format Disk</a></li>
            <? } ?>
          </ul>
        </li>

        <?
        if ($_SESSION['login'] == "admin") {
        ?>
          <li role="presentation" class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true"> <i class="fa fa-coffee menuIcon"></i>
              <en>Advanced</en><span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="encode.php"><i class="fa fa-image"></i>Encode</a></li>
              <li><a href="stream.php"><i class="fa fa-upload"></i>Stream</a></li>
              <li><a href="output-v1.php"><i class="fa fa-upload"></i>Output (Advanced)</a></li>

              <?php
              if ($hardware["function"]["ndi"] && $hardware["function"]["videoOut"]) {
              ?>
                <li><a href="ndi.php"><i class="fa fa-television"></i>NDI decode</a></li>
              <?php
              }
              ?>
              <li><a href="intercom.php"><i class="fa fa-headphones"></i>
                  Intercom
                </a></li>

              <li><a href="group.php"><i class="fa fa-server"></i>Group</a></li>
              <li><a href="service.php"><i class="fa fa-cloud"></i>Service</a></li>
              <li><a href="gb28181.php"><i class="fa fa-cloud"></i>GB28181</a></li>
              <li><a href="roi.php"><i class="fa fa-user-circle-o"></i>ROI</a></li>
              <li><a href="sync.php"><i class="fa fa-tasks"></i>
                  Synchronization
                </a></li>
              <?php
              if ($hardware["function"]["carousel"]) {
              ?>
                <li><a href="carousel.php"><i class="fa fa-youtube-play"></i>
                    Video carousel
                  </a></li>
              <?php
              }
              if ($hardware["function"]["record"]) {
              ?>
                <li><a href="record.php"><i class="fa fa-folder-open"></i>Record</a></li>
              <?php
              }
              ?>
              <li><a href="push.php"><i class="fa fa-arrow-circle-up"></i>Multiple Push</a></li>
              <li><a href="player.php"><i class="fa fa-play-circle-o"></i>H5 Player</a></li>
              <?php
              if ($hardware["function"]["serialport"]) {
              ?>
                <li><a href="uart.php"><i class="fa fa-link"></i>Serial Port</a></li>
              <?php
              }
              ?>
              <?php
              if ($hardware["function"]["remote"]) {
              ?>
                <li><a href="remote.php"><i class="fa fa-fire"></i>Remote</a></li>
              <?php
              }
              ?>
              <li>
                <a href="disk.php"><i class="fa fa-database"></i>Mount Disk</a>
              </li>
              <li><a href="explorer.php"><i class="fa fa-folder-open-o"></i>USB Disk</a></li>
              <?php
              if ($hardware["function"]["overlay"]) {
              ?>
                <li><a href="overlay.php"><i class="fa fa-magic"></i>Overlay</a></li>
              <?php
              }
              ?>
              <li><a href="insta360.php"><i class="fa fa-camera"></i>Insta360 Link</a></li>
              <li><a href="colorKey.php"><i class="fa fa-cut"></i>ColorKey</a></li>
              <li>
                <svg style="position: absolute;margin: 5px 0px 0px 18px;" width="16" height="16" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M43 6H23H5" stroke="#fff" stroke-width="4" stroke-linecap="square" stroke-linejoin="miter" />
                  <path d="M23 23V6" stroke="#fff" stroke-width="4" stroke-linecap="square" stroke-linejoin="miter" />
                  <path d="M8.42498 19.5798L40.3005 28.1209L38.5581 30.7598L34.5557 37.9696L32.8133 40.6085L4.80151 33.1028L8.42498 19.5798Z" fill="#fff" stroke="#fff" stroke-width="4" stroke-linecap="square" stroke-linejoin="miter" />
                  <path d="M38.5583 30.7598L42.422 31.7951L40.3515 39.5225L34.5559 37.9696" stroke="#fff" stroke-width="4" stroke-linecap="square" stroke-linejoin="miter" />
                </svg>
                <a style="padding-left: 38px;" href="onvif.php">Onvif PTZ</a>
              </li>
              <li><a href="rproxy.php"><i class="fa fa-wechat"></i>
                  Reverse Proxy
                </a></li>
            </ul>
          </li>
        <?
        }
        ?>

      </ul>
      <ul class="nav navbar-nav navr">
        <li> <a id="logout" class="btn btn-default" href="login.php?logout=true"> <i class="fa fa-sign-out"></i>Log out</a></li>
      </ul>
    </div>

    <!-- /.navbar-collapse -->
  </div>
  <!-- /.container-fluid -->
</nav>
<div class="container main">
