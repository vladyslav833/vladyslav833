{literal}
<script>
    jQuery(document).ready(function($){
        $("#afp-check").change(function() {
            if ($(this).prop('checked')==true){
                $('.mask-time').removeClass("hide-mask-time").addClass("show-mask-time");
            } else {
                $('.mask-time').removeClass("show-mask-time").addClass("hide-mask-time");
            }
        });
    });

    function checkValid(){
        var hours = document.getElementById("hours").value;
        var mins = document.getElementById("mins").value;
        var mhours = document.getElementById("mhours").value;
        var mmins = document.getElementById("mmins").value;
        var afpCheck = document.getElementById("afp-check");
        if(afpCheck.checked == true) {
            if(mhours == "") {
                alert("Please add mask hours");
                return false;
            }
            if(mmins == "") {
                alert("Please add mask minutes");
                return false;
            }
            if(mhours == "0" && mmins == "0") {
                alert("Please add spent hours and mins");
                return false;
            }
        } else {
            if(hours == "") {
                alert("Please add worked hours");
                return false;
            }
            if(mins == "") {
                alert("Please add worked minutes");
                return false;
            }
            if(hours == "0" && mins == "0") {
                alert("Please add spent hours and mins");
                return false;
            }
        }

        var jobId = document.getElementById("job").value;
        if(!jobId || jobId == "") {
            alert("Please select job");
            return false;
        }

        return true;
    }
</script>
{/literal}
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="clr30"></div>
            <h2 class="white text-center bold">{if $last_week == "last"}Last Week's Timecard{else}This Week's Timecard{/if}</h2>
            <form method="post" action="{$siteUrl}add-entry" onsubmit="return checkValid()">
                <input type="hidden" id="entry_id" name="entry_id" value="{$entry_id}">
                <input type="hidden" id="last_week" name="last_week" value="{$last_week}">
                <div class="timecard-detail-box">
                    <span class="select-job-label">Select Job</span>
                    <select class="form-control" name="job" id="job" required>
                        {foreach from=$task_list item=task}
                        <option value="{$task.job_id}" {if $job_id == $task.job_id}selected{/if}>{$task.name}</option>
                        {/foreach}
                    </select>
                    <textarea placeholder="Enter Job/Task Description Here" id="job-desc" name="job-desc" class="form-control job-desc" rows="3">{$description}</textarea>
                    <span class="afp-check">
                        <input type="checkbox" class="afp-checkbox" id="afp-check" name="afp-check" {if $mask_req == 1}checked{/if}>
                        Was an AFP 10 Mask Required?</span>
                    <div class="enter-date">
                        <span class="date-label">Enter Date</span>
                        <select class="form-control" id="timestamp" name="timestamp">
                            {foreach from=$week_days item=weekday}
                                <option value="{$weekday.value}" {if $timestamp == $weekday.value}selected{/if}>{$weekday.time_string}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="enter-time">
                        <span class="time-label">Enter Job Time</span>
                        <select class="form-control" id="hours" name="hours">
                            <option value="h">Hrs</option>
                            {for $index=0 to 12}
                                <option value="{$index}" {if floor($time_worked) == $index}selected{/if}>{$index}</option>
                            {/for}
                        </select>
                        <select class="form-control" id="mins" name="mins">
                            <option value="m">Min</option>
                            <option value="0" {if $time_worked - floor($time_worked) == 0}selected{/if}>00</option>
                            <option value="15" {if $time_worked - floor($time_worked) == 0.25}selected{/if}>15</option>
                            <option value="30" {if $time_worked - floor($time_worked)  == 0.5}selected{/if}>30</option>
                            <option value="45" {if $time_worked - floor($time_worked) == 0.75}selected{/if}>45</option>
                        </select>
                    </div>
                    <div class="enter-time mask-time {if $mask_req == 1}show-mask-time{else}hide-mask-time{/if}">
                        <span class="time-label">Enter Mask Time</span>
                        <select class="form-control" id="mhours" name="mhours">
                            <option value="hh">Hrs</option>
                            {for $index=0 to 12}
                                <option value="{$index}" {if floor($mask_time_worked) == $index}selected{/if}>{$index}</option>
                            {/for}
                        </select>
                        <select class="form-control" id="mmins" name="mmins">
                            <option value="mm">Min</option>
                            <option value="0" {if $mask_time_worked - floor($mask_time_worked) == 0}selected{/if}>00</option>
                            <option value="15" {if $mask_time_worked - floor($mask_time_worked) == 0.25}selected{/if}>15</option>
                            <option value="30" {if $mask_time_worked - floor($mask_time_worked)  == 0.5}selected{/if}>30</option>
                            <option value="45" {if $mask_time_worked - floor($mask_time_worked) == 0.75}selected{/if}>45</option>
                        </select>
                    </div>
                    <div class="entry-action">
                        <a class="btn btn-danger btn-lg btn-span" href="{$homeUrl}timecard{if $last_week == "last"}?add=last{/if}">Cancel</a>
                        <button class="btn btn-success btn-lg btn-span" type="submit">Submit</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div>