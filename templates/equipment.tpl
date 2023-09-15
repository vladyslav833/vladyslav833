{literal}
<script>

$(document).ready(function(){

    $('.remove_confirm').click(function(){
        var link = $(this).attr('href');
        var line_name = $(this).parent().next().html();

        BootstrapDialog.confirm( 'Delete Equipment', 'Are your sure you want to delete<br><b>'+ line_name +'<b>?' , function( result ){
            if( result ) {
                window.location = link;
            }
        });
        return false;
    });

{/literal}{if $equipment}{literal}

    $('#example').dataTable( {
        "aaSorting": [[ 0, "asc" ]],
        "bFilter": false,
        "iDisplayLength": 25,
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            { "bSortable": false },
            null,
            null,
            { "bSortable": false }
        ],
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sLengthMenu": "Display _MENU_ items per page."
        }
    } );

{/literal}{/if}{literal}

});

</script>
{/literal}

<div class="row">
    <div class="col-sm-12">
		<div class="subpadding20">
            <div class="clr20"></div>
                <div id="category_filter">



                <form method="post" action="{$adminUrl}equipment">
                    <!--<input type="hidden" name="page" value="admin/equipment">-->
                    <table cellpadding="0" cellspacing="0"><tr>
                    <td><a href="{$adminUrl}add-equipment"><button class="btn btn-theme" type="button">Add Equipment</button></a></td>
                    <td width="25"></td>
                    <td><select class="form-control es-select" name="category" id="category" required >
                        <option value="0">Select Category</option>
                        {foreach from=$categories item=cat}
                            <option value="{$cat.id}" {if $cat.id eq $filters.category} selected{/if}>{$cat.name}</option>
                        {/foreach}
                    </select></td>
                    <td><button type="submit" class="btn btn-theme" style="display: inline-block">Filter</button></td>
                    </tr></table>
                </form>
                </div>
                <table class="display table table-hover" id="example">
                <thead>
                    <tr>
                        <th class="es-th es-th-delete es-start" style="text-align: center;">Delete</th>
                        <th class="es-th es-th-equipment">Equipment</th>
                        <th class="es-th es-th-eqcategory">Category</th>
                        <th class="es-th es-th-availability  es-end calendar-end">Reserve &amp; Check Availability</th>
                    </tr>
                </thead>
                <tbody>
                {if $equipment}
                {foreach from=$equipment item=equip}
                    <tr>
                        <td class="text-center"><a href="{$adminUrl}delete-equipment/?id={$equip.id}" class="remove_confirm"><img src="{$homeUrl}img/trash-icon.png" alt="Trash" /></a></td>
                        <td>{$equip.name|stripslashes}</td>
                        <td>{$equip.cat_name|stripslashes}</td>
                        <td class="text-center"><a href="{$adminUrl}reserve-equipment/?id={$equip.id}"><img src="{$homeUrl}img/availability-icon.png" alt="Availability" /></a></td>
                    </tr>
                {/foreach}
                {else}
                    <tr><td colspan="4">Not match found.</td></tr>
                {/if}
                </tbody>
                </table>

                <div class="clr30"></div>

		</div>
    </div>
</div>

