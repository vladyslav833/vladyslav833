<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20">
                <div class="clr30"></div>
                <div class="view-reservation-header">
                    <h3 class="std white text-center">View Reservations</h3>
                </div>
                {foreach from=$reservation item=res_item name=reserv}
				<div class="reservation-box {if $smarty.foreach.reserv.last} radius-bottom{/if}">
                    <div class="reservation-left pull-left">
                        <div class="bold">{$res_item.name}</div>
                        <div>Start Date: {$res_item.start_date}</div>
                        <div>End Date: {$res_item.end_date}</div>
                        <div>Job: {$res_item.job_name}</div>
                    </div>
                    <div class="reservation-right pull-right">
                        <a href="{$siteUrl}cancel-reservation?id={$res_item.id}" class="confirm"><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                {/foreach}

				{*
                <div class="reservation-box">
                    <div class="reservation-left pull-left">
                        <div class="bold">Scissors Lift</div>
                        <div>Start Date: March 25, 2014</div>
                        <div>End Date: June 15, 2014</div>
                        <div>Job: Mercy Medical Center</div>
                    </div>
                    <div class="reservation-right pull-right">
                        <a href=""><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                    </div>
                    <div class="clearfix"></div>
                </div>

				<div class="reservation-box">
                    <div class="reservation-left pull-left">
                        <div class="bold">2014 Chevy Dump Truck</div>
                        <div>Start Date: March 21, 2014</div>
                        <div>End Date: March 24, 2014</div>
                        <div>Job: Ziegler Tire</div>
                    </div>
                    <div class="reservation-right pull-right">
                        <a href=""><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                    </div>
                    <div class="clearfix"></div>
                </div>

				<div class="reservation-box radius-bottom">
                    <div class="reservation-left pull-left">
                        <div class="bold">2014 Chevy Dump Truck</div>
                        <div>Start Date: March 21, 2014</div>
                        <div>End Date: March 24, 2014</div>
                        <div>Job: Ziegler Tire</div>
                    </div>
                    <div class="reservation-right pull-right radius-bottom-right">
                        <a href=""><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                *}

            </div>
         </div>

    </div>
</div>