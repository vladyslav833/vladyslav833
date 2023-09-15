<script type="text/javascript" src="{$homeUrl}js/calendar_pre_scripts.js"></script>
<script type="text/javascript" src="{$homeUrl}js/zebra_datepicker.js"></script>

<form method="post" action="{$adminUrl}calendar-details">
<div class="row calendar-line-0">
    <div class="col-sm-3 es-checkbox">What calendar do you want to view?</div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="calendar" required>
            <option value="" {if !$calendar} selected{/if}>Select Calendar</option>
            <option value="category" {if 'equipment' == $calendar} selected{/if}>Equipment</option>
            <option value="job" {if 'job' == $calendar} selected{/if}>Job</option>
            <option value="user" {if 'user' == $calendar} selected{/if}>User</option>
        </select>
    </div>
</div>
<div class="row calendar-line-1">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="category">
            <option value="">Select Equipment Type</option>
            {foreach from=$categories item=smrt_cat}
                <option value="{$smrt_cat.id}" {if $smrt_cat.id == $category} selected{/if}>{$smrt_cat.name}</option>
            {/foreach}
        </select>
        <select class="form-control es-select" name="job">
            <option value="">Select Job</option>
            {foreach from=$jobs item=smrt_job}
                <option value="{$smrt_job.id}" {if $smrt_job.id == $job} selected{/if}>{$smrt_job.name}</option>
            {/foreach}
        </select>
        <select class="form-control es-select" name="user">
            <option value="">Select User</option>
            {foreach from=$users item=smrt_user}
                <option value="{$smrt_user.id}" {if $smrt_user.id == $user} selected{/if}>{$smrt_user.fname} {$smrt_user.lname}</option>
            {/foreach}
        </select>
    </div>
</div>
<div class="row calendar-line-2">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="view_equip_option">
            <option value="">Select View</option>
            <option value="user" {if 'user' == $view_equip_option} selected{/if}>View By User</option>
            <option value="job" {if 'job' == $view_equip_option} selected{/if}>View By Job</option>
            <option id="view_all" value="all" {if 'all' == $view_equip_option} selected{/if}>View All</option>
            <option id="view_single" value="single" {if 'single' == $view_equip_option} selected{/if}>View Individual</option>
        </select>
    </div>

    <div class="col-sm-3">
        <select class="form-control es-select" name="user_id" style="display: none;">
            <option value="">Select User</option>
        {foreach from=$users item=smrt_user}
            <option value="{$smrt_user.id}" {if $smrt_user.id == $user_id} selected{/if}>{$smrt_user.fname} {$smrt_user.lname}</option>
        {/foreach}
        </select>

        <select class="form-control es-select" name="job_id"  style="display: none;">
            <option value="">Select Job</option>
        {foreach from=$jobs item=smrt_job}
            <option value="{$smrt_job.id}" {if $smrt_job.id == $job_id} selected{/if}>{$smrt_job.name}</option>
        {/foreach}
        </select>

        <select class="form-control es-select" name="equip_id" id="equipment" style="display: none;">
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

</div>
<div class="row calendar-line-3">
<div class="clr20"></div>
    <div class="col-sm-6 es-checkbox2">
        Do you want to narrow your selection by date range?
        {*
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="allow_date">Yes</label> <input type="radio" name="use_date" value="1" id="allow_date" {if $use_date} checked {/if}>
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="deny_date">No</label> <input type="radio" name="use_date" value="0" id="deny_date" {if !$use_date} checked {/if}>
        *}
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="allow_date">Yes</label> <input type="radio" name="use_date" value="1" id="allow_date">
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="deny_date">No</label> <input type="radio" name="use_date" value="0" id="deny_date">
    </div>
</div>
<div class="row calendar-line-4" >
<div class="clr20"></div>
    <div class="col-sm-2-5 es-checkbox">Start Date:</div>
    <div class="col-sm-3-5" style="padding-right: 0;">
        <input type="hidden" name="start_date" value="">
        <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date">
    </div>
    <div class="col-sm-2-5 es-checkbox">End Date:</div>
    <div class="col-sm-3-5" style="padding-right: 0;">
        <input type="hidden" name="end_date" value="">
        <input type="text" class="es-input form-control" id="end_date_formated" readonly value="" placeholder="End Date">
    </div>
</div>

<div class="row calendar-line-5">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="text-align: right;">
        <button class="btn btn-theme" type="submit">Submit</button>
    </div>
</div>
</form>