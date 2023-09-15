<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">Add Equipment</header>
            <div class="panel-body">
            <form action="" method="post">
                <div class="clr10"></div>
                <div class="col-sm-6">
                <select class="form-control es-select" name="category" required>
                    <option value="0" {if !$category} selected{/if}>Select Category</option>
                    {foreach from=$categories item=cat}
                        <option value="{$cat.id}" {if $cat.id == $category} selected{/if}>{$cat.name}</option>
                    {/foreach}
                </select>
                </div>
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Equipment Name" name="equip_type" required value="{$equip_type}"></div>
				<div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='{$adminUrl}equipment';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Equipment" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div>

