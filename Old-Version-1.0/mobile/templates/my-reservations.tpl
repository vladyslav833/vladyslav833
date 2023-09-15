{literal}
<script>
    jQuery(document).ready(function($){
        $('.confirm').click(function(){
            return confirm('Do you really want to delete this reservation?');
        });
    });
</script>
{/literal}
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20">
                <div class="clr30"></div>
                <div class="view-reservation-header">
                    <h3 class="std white text-center">My Reservations</h3>
                </div>
                {foreach from=$reservations item=res_item name=reserv}
				<div class="reservation-box {if $smarty.foreach.reserv.last} radius-bottom{/if}">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="reservation-left">
                                <div class="bold">{$res_item.equipment_name|stripslashes}</div>
                                <div>Start Date: {$res_item.start_date}</div>
                                <div>End Date: {$res_item.end_date}</div>
                                <div>Job: {$res_item.job_name|stripslashes}</div>
                            </td>
                            <td valign="middle" align="center" class="reservation-right">
                                <a href="{$siteUrl}cancel-reservation?id={$res_item.id}" class="confirm"><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                            </td>
                        </tr>
                    </table>
                    {*<div class="reservation-left pull-left">
                        <div class="bold">{$res_item.equipment_name|stripslashes}</div>
                        <div>Start Date: {$res_item.start_date}</div>
                        <div>End Date: {$res_item.end_date}</div>
                        <div>Job: {$res_item.job_name|stripslashes}</div>
                    </div>
                    <div class="reservation-right pull-right">
                        <a href="{$siteUrl}cancel-reservation&id={$res_item.id}" class="confirm"><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                    </div>*}
                    <div class="clearfix"></div>
                </div>
                {/foreach}
            </div>
         </div>

    </div>
</div>