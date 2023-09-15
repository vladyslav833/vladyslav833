<script type='text/javascript'>

    var reservations = [
    {foreach from=$reservations item=reserv name=reservations}
        {literal} { {/literal}
            'start' :   '{$reserv.start_date}',
            'end'   :   '{$reserv.end_date}',
            'name'  :   '{$reserv.first_name|stripslashes|htmlspecialchars_decode} {$reserv.last_name|stripslashes|htmlspecialchars_decode}',
            'job'   :   '{$reserv.job_name|stripslashes|htmlspecialchars_decode}'
        {literal} }, {/literal}
    {/foreach}
    ];

</script>
<script type="text/javascript" src="{$homeUrl}js/view-equipment.js"></script>
<script type="text/javascript" src="{$homeUrl}js/zebra_datepicker.js"></script>
<script type="text/javascript" src="{$homeUrl}js/calendar_scripts.js"></script>

<form action="" method="post">

<input type="hidden" id="start_date" name="start_date" value="0">
<input type="hidden" id="end_date" name="end_date" value="0">
<input type="hidden" id="active_table" value="1">

<div class="row" style="width: 550px; margin-left: 0px; float: left;">
{if !$make_reservation}
    <div class="row">
        <input type="hidden" name="equip_id" value="{$equipment.id}">
        <div class="content-title col-xs-12">You are viewing: <b>Equipment / {$category|stripslashes} / {$equipment.name|stripslashes}</b></div>
        <div class="clr5"></div>
    </div>
    <div class="row">
        <div class="content-title col-xs-12">Please select the dated you wish to reserve this equipment for.</div>
        <div class="clr20"></div>
    </div>
    <div class="row">
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Start Date:</div>
        <div class="col-xs-3"> <!--style="padding-right: 1px;">-->
            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date" style="padding: 6px;">
        </div>
        <div class="col-xs-2 es-checkbox" style="padding-left: 1px;">End Date:</div>
        <div class="col-xs-3"> <!--style="padding-left: 1px;">-->
            <input type="text" class="es-input form-control" id="end_date_formated" readonly  value="" placeholder="End Date" style="padding: 6px;">
        </div>
    </div>


    <div class="row" id="save_reservation">
        <div class="clr20"></div>
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Select User:</div>
        <div class="col-xs-5">
            <select class="form-control es-select" name="user_id" id="user" required>
                <option value="">Select User</option>
            {foreach from=$users item=smrt_user}
                <option value="{$smrt_user.id}" {if $smrt_user.id == $user_id} selected{/if}>{$smrt_user.first_name} {$smrt_user.last_name}</option>
            {/foreach}
            </select>
        </div>
    </div>

    <div class="row" id="job_reservation" style="display: none;">
        <div class="clr20"></div>
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Select Job:</div>
        <div class="col-xs-5">
            <select class="form-control es-select" name="job_id" id="job" required>
                <option value="">Select Job</option>
            {foreach from=$jobs item=smrt_job}
                <option value="{$smrt_job.id}" {if $smrt_job.id == $user_id} selected{/if}>{$smrt_job.name}</option>
            {/foreach}
            </select>
        </div>

        <div class="col-xs-3" id="submit_line" style="display: none;">
            <button class="btn btn-login" type="submit">Reserve</button>
        </div>

    </div>

    <div class="clr20"></div>

    <div class="row">
        <div class="clr20"></div>
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
    <div class="clr20"></div>


{else}

    <input type="hidden" name="make_reservation" value="1">

    <div class="row">
        <div class="content-title col-xs-12">Select the equipment you want to reserve</div>
        <div class="clr10"></div>
    </div>

    <div class="row">
        <div class="content-title col-xs-9">
            <select class="form-control es-select" name="category" id="category">
                <option value="0">Select Category</option>
                {if $categories}
                {foreach from=$categories item=cat}
                    <option value="{$cat.id}">{$cat.name|stripslashes}</option>
                {/foreach}
                {/if}
            </select>
        </div>
    </div>
    <div class="clr20"></div>
    <div class="row" id="step2" style="display: none;">
        <div class="content-title col-xs-9">
            <select class="form-control es-select" name="equip_id" id="equipment">
                <option value="0">Select Equipment</option>
                {if $equipment}
                {foreach from=$equipment item=equip}
                    <option value="{$equip.id}" class="equip_item cat{$equip.cat_id}" >{$equip.name|stripslashes}</option>
                {/foreach}
                {/if}
            </select>
            <select class="form-control es-select" id="equipment_storage" style="display: none;">
                <option value="0">Select Equipment</option>
                {if $equipment}
                {foreach from=$equipment item=equip}
                    <option value="{$equip.id}" class="equip_item cat{$equip.cat_id}" >{$equip.name|stripslashes}</option>
                {/foreach}
                {/if}
            </select>
        </div>
        <div class="clr10"></div>
    </div>

    <div class="row" id="step3" style="display: none;">
        <div class="col-xs-3">
            <button class="btn btn-theme" type="submit">View Calendar</button>
        </div>
    </div>
{/if}
</div>
</form>