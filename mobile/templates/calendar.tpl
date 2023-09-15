<input type="hidden" id="active_table" value="0">

<script type='text/javascript'>

    var table_read_only = true;

    var reservations = [
    {foreach from=$reservations item=reserv name=reservations}
        {literal} { {/literal}
            'start' :   '{$reserv.start_date}',
            'end'   :   '{$reserv.end_date}',
            'name'  :   '{$reserv.first_name|stripslashes|htmlspecialchars_decode} {$reserv.last_name|stripslashes|htmlspecialchars_decode}',
            'job'   :   '{$reserv.job_name|stripslashes|htmlspecialchars_decode}'
        {literal} } {/literal}{if not $smarty.foreach.reservations.last},{/if}
    {/foreach}
    ];

</script>
<script type="text/javascript" src="{$homeUrl}js/zebra_datepicker.js"></script>
<script type="text/javascript" src="{$homeUrl}js/calendar_scripts.js"></script>

<div class="header-title container">
    <div class="row">
        <div class="col-xs-3"><button class="btn btn-login btn-block" onclick="window.history.back()">Back</button></div>
        <div class="col-xs-9"><h4 class="white text-center">{$item.name|stripslashes}</h4></div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="calendar-content container">
    <div class="row">
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
    <div class="row">
        <div class="clr20"></div>
        <center><a href="{$siteUrl}view-equipment"><button class="btn btn-login">Back</button></a></center>
    </div>
</div>


