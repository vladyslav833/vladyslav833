{literal}
<script>
    jQuery(document).ready(function($){
        $('.card-edit').click(function(){
            var id = $(this).attr('data-id');
            var last_week = $(this).attr('data-last');
            if(last_week != "")
                window.location = 'add-entry?add=last&id=' + id;
            else
                window.location = 'add-entry?id=' + id;
        });
    });
</script>
{/literal}
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20 text-center">
                <div class="clr30"></div>
                <h2 class="white text-center bold">This Week's Timecard</h2>
                <h4 class="white text-center">{$sunday} - {$saturday}</h4>
                <h4 class="white text-center bold mb-20">Hours To Date: {$total_hours}</h4>
                {if $canedit && $lastedit}
                    <a class="can-edit" href="{$homeUrl}timecard?add=last">You can still edit last week's timecard</a>
                {/if}
                {if $last_week != ""}
                    <a class="add-entry-btn" href="{$homeUrl}add-entry?add=last">Add Entry</a>
                {else}
                    <a class="add-entry-btn" href="{$homeUrl}add-entry">Add Entry</a>
                {/if}
                {foreach from=$tdata item=data}
                    {if $data.mask_req == 1 }
                        <div class="card-box">
                            <span class="card-date">{$data.date_time}</span>
                            {if $data.job_id != 0}
                                <span class="card-afp-name">{$data.job_title} - AFP MASK REQUIRED</span>
                            {else}
                                <span class="card-afp-name">{$data.job_name} - AFP MASK REQUIRED</span>
                            {/if}
                            <span class="card-task-name">Tasks: {$data.description}</span>
                            <span class="card-total-hours">Total Time: {floor($data.time_worked)} Hours {($data.time_worked - floor($data.time_worked)) * 60} Minutes{if $data.finalize == 0}<span class="card-edit" data-id="{$data.id}" data-last="{$last_week}">EDIT</span>{/if}</span>
                        </div>
                    {else}
                        <div class="card-box">
                            <span class="card-date">{$data.date_time}</span>
                            <span class="card-prj-name">{if $data.job_id == 0}{$data.job_name}{else}{$data.job_title}{/if}</span>
                            <span class="card-task-name">Tasks: {$data.description}</span>
                            <span class="card-total-hours">Total Time: {floor($data.time_worked)} Hours {($data.time_worked - floor($data.time_worked)) * 60} Minutes{if $data.finalize == 0}<span class="card-edit" data-id="{$data.id}" data-last="{$last_week}">EDIT</span>{/if}</span>
                        </div>
                    {/if}
                {/foreach}
            </div>
         </div>
    </div>
</div>