<script type="text/javascript" src="{$homeUrl}js/view-equipment.js"></script>
<div class="view-equipment3 container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20">
            <form action="{$siteUrl}calendar{if $page eq 'reserve-equipment'}-reservation{/if}" method="post">
                <div class="clr30"></div>
                <h3 class="std text-center">Select The Equipment You Want To View</h3>
                <div class="clr20"></div>
                <select class="form-control es-select" name="category" id="category">
                    <option value="0">Select Category</option>
                    {if $categories}
                    {foreach from=$categories item=cat}
                        <option value="{$cat.id}">{$cat.name|stripslashes}</option>
                    {/foreach}
                    {/if}
                </select>
                <div id="step2" style="display: none;">
                    <div class="clr20"></div>
                    <select class="form-control es-select" name="equipment" id="equipment">
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
                <div id="step3" style="display: none;">
                    <div class="clr20"></div>
                    <center><button class="btn btn-login">View</button></center>
                </div>
            </form>
            </div>
         </div>

    </div>
</div>
