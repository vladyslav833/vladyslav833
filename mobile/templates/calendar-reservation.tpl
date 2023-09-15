<script type='text/javascript'>

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

<form action="" method="post">

<input type="hidden" id="start_date" name="start_date" value="0">
<input type="hidden" id="end_date" name="end_date" value="0">
<input type="hidden" name="equipment" value="{$equipment_id}">
<input type="hidden" id="active_table" value="1">

<div class="calendar-content container">
    <div class="row">
        <div class="content-title col-xs-12">Please select your dates.</div>
    </div>
    <div class="row">
        <div class="col-xs-4" style="padding-right: 1px;">
            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date" style="padding: 6px;">
        </div>
        <div class="col-xs-4" style="padding-left: 1px;">
            <input type="text" class="es-input form-control" id="end_date_formated" readonly  value="" placeholder="End Date" style="padding: 6px;">
        </div>
        <div class="col-xs-4"><button class="btn btn-login btn-block" type="submit" id="save_reservation" style="display: none;">Reserve</button></div>
    </div>
    <div class="clr20"></div>
    <div class="row">
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
</div>
</form>