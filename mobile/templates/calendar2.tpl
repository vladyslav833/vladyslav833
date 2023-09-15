<script type='text/javascript' src='{$homeUrl}js/underscore-min.js'></script>
<script type="text/javascript" src="{$homeUrl}assets/bootstrap-calendar/js/calendar.js"></script>
<script type="text/javascript">
    var calendar = $('#calendar').calendar();
</script>

<div class="header-title container">
    <div class="row">
        <!--<div class="col-xs-3"><a href=""><button class="btn btn-login btn-block">Back</button></a></div>-->
        <div class="col-xs-3"><a href=""><button class="btn btn-login btn-block" onclick="window.history.back()">Back</button></a></div>
        <div class="col-xs-9"><h4 class="white text-center">{$item.name}</h4></div>
        <div class="clearfix"></div>
    </div>
</div>


<div class="calendar-content container">
    <div class="row">
        <div class="content-title col-xs-12">

			<div id="calendar"></div>



         </div>
    </div>
</div>