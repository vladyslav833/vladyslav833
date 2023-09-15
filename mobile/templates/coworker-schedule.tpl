<script type="text/javascript" src="{$homeUrl}js/schedule.js"></script>
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <form id="schedule_form" method="POST" action="{$siteUrl}coworker-schedule">
                <input name="delta" id="delta" value="{$delta}" hidden>
                <div class="subpadding20 text-center">
                    <div class="clr30"></div>
                    <h3 class="white text-center bold">Co-Worker Schedule</h3>
                    <h4 class="white text-center"><a class="prev-btn"><<</a> {$today} <a class="next-btn">>></a></h4>
                    {foreach from=$sdata item=data}
                        {$cardname = "grey-card"}
                        {foreach from=$data item=udata}
                            {if $cardname == "grey-card"}
                                {$cardname = "white-card"}
                            {else}
                                {$cardname = "grey-card"}
                            {/if}
                            <div class="card-box text-center">
                                <span class="card-date">{$udata.user_name}</span>
                                <span class="card-task-name {$cardname} detail-font">{$udata.name}</span>
                                {if $udata.address1}<span class="card-task-name {$cardname}">{$udata.address1}</span>{/if}
                                {if $udata.city && $udata.state}<span class="card-task-name {$cardname}">{$udata.city}, {$udata.state} {$udata.zip}</span>{/if}
                                <span class="card-prj-name {$cardname} border-round"></span>
                            </div>
                        {/foreach}
                    {/foreach}
                </div>
            </form>
        </div>
    </div>
</div>