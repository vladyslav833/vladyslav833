<div class="row" style="color: #003F6E;">
    <div class="content-title col-xs-12" style="font-size: 20px;"><b>Reservation Confirmation</b></div>
    <div class="clr20"></div>

    <div class="content-title col-xs-12"><b>You have made the following reservation.</b></div>
    <div class="clr20"></div>

    <div class="content-title col-xs-12"><b>Equipment:</b> {$equipment_name|stripslashes}</div>
    <div class="clr10"></div>

    <div class="content-title col-xs-12"><b>User:</b> {$user_name|stripslashes}</div>
    <div class="clr10"></div>

    <div class="content-title col-xs-12"><b>Job:</b> {$job_name|stripslashes}</div>
    <div class="clr10"></div>

    {if $start_date == $end_date}
    <div class="content-title col-xs-12"><b>Date:</b> {$start_date_formated}</div>
    {else}
    <div class="content-title col-xs-12"><b>Dates:</b> {$start_date_formated} - {$end_date_formated}</div>
    {/if}
</div>