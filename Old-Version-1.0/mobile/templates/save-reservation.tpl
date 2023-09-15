{*
<script type="text/javascript">
    var available_jobs =  [
    {if $jobs}
        {foreach from=$jobs item=smrt_job}
        {literal}{{/literal}
            label: "{$smrt_job.name|stripslashes}",
            value: "{$smrt_job.id}"
        {literal}},{/literal}
        {/foreach}
    {/if}
    ];
</script>
<script type="text/javascript" src="{$homeUrl}js/save-reservation.js"></script>
*}

<div class="save-reservation container">
    <div class="row">
        <div class="col-xs-12">
        <form method="post" action="{$siteUrl}save-reservation">
            <div class="subpadding20">
                <div class="clr30"></div>
                <h3 class="std text-center">Confirm This Reservation</h3>
                <div class="clr20"></div>
                <div class="bold text-center">{$item_name}</div>
                <div class="text-center">Start Date: {$start_date}</div>
                <div class="text-center">End Date: {$end_date}</div>
                <div class="clr20"></div>
                <input type="hidden" name="reservation_id" value="{$reservation_id}">
                {*
                <input type="hidden" name="job_id" value="" id="job_id">
                <input type="text" class="es-input form-control" id="job_name" placeholder="Enter Job Name" name="job_name" value="{$job_name}" autofocus required>
                *}
                <select class="form-control es-select" name="job_id" required>
                    <option value="0">Select Job</option>
                    {if $jobs}
                    {foreach from=$jobs item=smrt_job}
                        <option value="{$smrt_job.id}">{$smrt_job.name|stripslashes}</option>
                    {/foreach}
                    {/if}
                </select>
            </div>
            <div class="clr20"></div>
			<div class="col-xs-6"><button class="btn btn-danger btn-lg btn-span" onclick="window.location.replace({$siteUrl}calendar&cat_id={$cat_id}&item_id={$item_id})">Cancel</button></div>
            <div class="col-xs-6 text-right"><button class="btn btn-success btn-lg btn-span" type="submit">Reserve</button></div>
        </form>
         </div>
    </div>
</div>