<div class="hidden" id="srt-help-text" style="text-align: left">
    <div class="row" style="margin-bottom: 10px">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 clearfix">CALLER MODE</div>
        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
            This encoder: Type the IP of target device in address box and the port number.<br>
            Target device: Set to LISTENER mode with address 0.0.0.0 and same port number.<br>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 clearfix">LISTENER MODE</div>
        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
            This encoder: Type in port number.<br>
            Target device: Set to CALLER mode, use the same port number and paste in the below IP address:<br>
            <span class="self-ip-address"></span>
        </div>
    </div>
    <div class="row" style="margin-bottom: 10px">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 clearfix">RENDEZVOUS MODE</div>
        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
            This encoder: Type target device IP / URL and port number.<br>
            Target device: use same port number and this IP address:<br>
            <span class="self-ip-address"></span>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 clearfix">LATENCY</div>
        <div class="col-lg-7 col-md-8 col-sm-9 col-xs-12">
            Latency is usually around 150-200ms
        </div>
    </div>
</div>
<script>
    function postZfgSetupSrtHelpText() {
        $("a.show-srt-help-text").click(function() {
            $("#srt-help-text").removeClass("hidden");
            return false;
        });
    }
</script>
