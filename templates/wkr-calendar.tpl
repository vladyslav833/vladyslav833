<script type="text/javascript" src="{$homeUrl}js/wkr_calendar_scripts.js"></script>
<script type="text/javascript" src="{$homeUrl}js/zebra_datepicker.js"></script>
{literal}
<script>

    $(document).ready(function(){
        {/literal}{if $tasks}{literal}
        {/literal}{/if}{literal}
    });
    let example = $('#calendar-table').dataTable( {
        "bLengtdChange": false,
        "bFilter": false,
        "bInfo": false,
        "sPaginationType": "full_numbers"
    } );
</script>
{/literal}

<div class="row">
    <form method="post" action="{$adminUrl}wkr-calendar" onsubmit="return validate()">
        <div class="col-sm-12">
            <div class="subpadding20">
                <div class="clr20"></div>
                <div class="filter-section">
                    <label class="mr-10 label-bold">Select a worker to view</label>
                    <div id="user_role_filter">
                        <select class="form-control es-select w-200" name="usrselect" id="usrselect" required>
                            <option value="0" {if !$filters.usrselect} selected{/if}>Select Worker</option>
                            {foreach from=$users item=user}
                                <option value="{$user.id}" {if $user.id == $filters.usrselect} selected{/if}>{$user.first_name} {$user.last_name}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="subpadding20">
                <div class="clr20"></div>
                <div class="filter-section">
                    <label class="mr-30 label-bold">Select the timeframe</label>
                    <div id="user_role_filter" class="d-flex">
                        <select class="form-control es-select w-200" name="datefilter" id="datefilter" required>
                            <option value="week" {if $filters.daterange == "week"} selected{/if}>Current Week</option>
                            <option value="month" {if $filters.daterange == "month"} selected{/if}>Current Month</option>
                            <option value="range" {if $filters.daterange == "range"} selected{/if}>Date Range</option>
                        </select>
                        <div class="calendar-line-4 filter-section ml-20" style="{if $filters.daterange == "range"}display: flex{else}display: none{/if}">
                            <div class="label-bold">Start Date:</div>
                            <div class="ml-10" style="padding-right: 0;">
                                <input type="hidden" id="start_date" name="start_date" value="{if $filters.start_date != ""}{date("Y-m-d", $filters.start_date)}{/if}">
                                <input type="text" class="es-input form-control" id="start_date_formated" readonly value="{if $filters.start_date != ""}{date("Y-m-d", $filters.start_date)}{/if}" placeholder="Start Date">
                            </div>
                            <div class="ml-20 label-bold">End Date:</div>
                            <div class="ml-10" style="padding-right: 0;">
                                <input type="hidden" id="end_date" name="end_date" value="{if $filters.end_date != ""}{date("Y-m-d", $filters.end_date)}{/if}">
                                <input type="text" class="es-input form-control" id="end_date_formated" readonly value="{if $filters.end_date != ""}{date("Y-m-d", $filters.end_date)}{/if}" placeholder="End Date">
                            </div>
                        </div>
                    </div>
                    <div class="subpadding10 mb-10"><button type="submit" class="btn btn-theme" style="display: inline-block">Submit</button></div>
                </div>
            </div>
        </div>
    </form>
    <div class="col-sm-12">
        <div class="subpadding20">
            <h2 class="prj-name" id="uname" name="uname" style="color: #003f6e;">{$selected_user}</h2>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
            <div class="calendar-table-wrap" style="display: {($selected_user)?"block":"none"}">
                <div class="table-content">
                    {if count($jobs) > 0 || count($timeoff_headers) > 0 || count($reservations) > 0}
                    <table class="display table cell-border table-bordered" id="calendar-table">
                        <tbody>
                        <tr class="text-bold">
                            <td class="hide-left-top-border headcol"></td>
                            <td colspan="{$filters.difference_days}" class="hide-left-top-border hide-right-border"></td>
                        </tr>
                        <tr class="text-bold">
                            <td class="hide-left-top-border headcol"></td>
                            {foreach from=$filters.month_headers item=value key=key}
                                <td colspan="{$value}" class="text-center">{date("F Y ",strtotime($key))}</td>
                            {/foreach}
                        </tr>
                        <tr class="text-bold">
                            <td class="hide-left-top-border headcol"></td>
                            {foreach from=$filters.week_headers item=value key=key}
                                <td colspan="{$value['days']}" class="text-center">{$value['first_day']} - {$value['last_day']}</td>
                            {/foreach}
                        </tr>
                        <tr class="text-center text-bold">
                            <td class="gray-back category-cell headcol fs-18">{if count($jobs) > 0}Jobs{/if}</td>
                            {foreach from=$filters.wname_headers item=value}
                                <td class="text-center text-uppercase">{$value}</td>
                            {/foreach}
                        </tr>
                        {if count($jobs) > 0}
                            {foreach from=$jobs item=scheduleValue key=key name=jobarr}
                                <tr class="text-center">
                                    <td class="category-cell text-bold headcol fs-18">{$key}</td>
                                    {foreach from=$scheduleValue item=sValue}
                                        {if $sValue == 1}
                                            <td class="filled-cell-{fmod($smarty.foreach.jobarr.index, 4)}"></td>
                                        {else}
                                            <td></td>
                                        {/if}
                                    {/foreach}
                                </tr>
                            {/foreach}
                        {/if}
                        {if count($timeoff_headers) > 0}
                            <tr class="text-center text-bold">
                                <td class="category-cell headcol fs-18">Time Off</td>
                                {foreach from=$timeoff_headers item=tValue}
                                    {if $tValue == 1}
                                        <td class="timeoff-cell"></td>
                                    {else}
                                        <td></td>
                                    {/if}
                                {/foreach}
                            </tr>
                        {/if}
                        {if count($reservations) > 0}
                            <tr>
                                <td class="text-left gray-back text-bold headcol fs-18">Equipment</td>
                                <td colspan="{$filters.difference_days}" class="text-left gray-back"></td>
                            </tr>
                            {foreach from=$reservations item=scheduleValue key=key name=eqarr}
                                <tr class="text-center">
                                    <td class="category-cell headcol">{$key}</td>
                                    {foreach from=$scheduleValue item=sValue}
                                        {if $sValue == 1}
                                            <td class="eq-filled-cell-{fmod($smarty.foreach.eqarr.index, 4)}"></td>
                                        {else}
                                            <td></td>
                                        {/if}
                                    {/foreach}
                                </tr>
                            {/foreach}
                        {/if}
                        </tbody>
                    </table>
                    {else}
                        <h3>There are no jobs and equipment reserved for the time period.</h3>
                    {/if}
                </div>
            </div>
        </div>
    </div>
</div>