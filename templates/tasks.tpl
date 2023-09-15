<script type="text/javascript" src="{$homeUrl}js/task_calendar_scripts.js"></script>
<script type="text/javascript" src="{$homeUrl}js/zebra_datepicker.js"></script>
{literal}
<script>

$(document).ready(function(){

    {/literal}{if $tasks}{literal}

        $('#example').dataTable( {
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "aoColumns": [
                null,
                null,
                null,
                null,
                { "bSortable": false }
            ],
            "sPaginationType": "full_numbers"
        } );
    {/literal}{/if}{literal}

});
</script>
{/literal}

<div class="row">
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
            <div class="filter-section">
                <label class="mr-10">Filter Results</label>
                <div id="user_role_filter">
                    <form method="post" action="{$adminUrl}tasks" onsubmit="return validate()">
                        <table>
                            <tr>
                                <td class="d-flex">
                                    <select class="form-control es-select w-200" name="datefilter" id="datefilter" required>
                                        <option value="this" {if $filters.daterange == "this"} selected{/if}>This Week</option>
                                        <option value="next" {if $filters.daterange == "next"} selected{/if}>Next Week</option>
                                        <option value="last" {if $filters.daterange == "last"} selected{/if}>Last Week</option>
                                        <option value="range" {if $filters.daterange == "range"} selected{/if}>Date Range</option>
                                    </select>
                                    <div class="calendar-line-4 filter-section ml-20" style="{if $filters.daterange == "range"}display: flex{else}display: none{/if}">
                                        <div>Start Date:</div>
                                        <div class="ml-10" style="padding-right: 0;">
                                            <input type="hidden" id="start_date" name="start_date" value="{if $filters.start_date != ""}{date("Y-m-d", $filters.start_date)}{/if}">
                                            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="{if $filters.start_date != ""}{date("Y-m-d", $filters.start_date)}{/if}" placeholder="Start Date">
                                        </div>
                                        <div class="ml-20">End Date:</div>
                                        <div class="ml-10" style="padding-right: 0;">
                                            <input type="hidden" id="end_date" name="end_date" value="{if $filters.end_date != ""}{date("Y-m-d", $filters.end_date)}{/if}">
                                            <input type="text" class="es-input form-control" id="end_date_formated" readonly value="{if $filters.end_date != ""}{date("Y-m-d", $filters.end_date)}{/if}" placeholder="End Date">
                                        </div>
                                    </div>
                                </td>
                                <td class="subpadding10"><button type="submit" class="btn btn-theme" style="display: inline-block">Submit</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <table class="display table table-hover" id="example">
                <thead>
                    <tr>
                        <th class="es-th es-start">Jobs/Tasks</th>
                        <th class="es-th">Worker</th>
                        <th class="es-th">Start Date</th>
                        <th class="es-th">End Date</th>
                        <th class="es-th es-end text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                {if $tasks}
                    {foreach from=$tasks item=task}
                        <tr>
                            <td>{$task.name}</td>
                            <td>{$task.user_id}</td>
                            <td>{date('m-d-Y', strtotime($task.start_date))}</td>
                            <td>{date('m-d-Y', strtotime($task.end_date))}</td>
                            <td class="text-center">
                                <a href="{$adminUrl}assign-job/?id={$task.tid}">
                                    <img src="{$homeUrl}img/settings-icon.png" alt="Edit Task" />
                                </a>
                            </td>
                        </tr>
                    {/foreach}
                {else}
                    <tr><td colspan="2">Not match found.</td></tr>
                {/if}
                </tbody>
            </table>
        </div>
    </div>
</div>

