{literal}
<script>

$(document).ready(function(){

    $('.remove_confirm').click(function(){
        var link = $(this).attr('href');
        var line_name = $(this).parent().next().html();

        BootstrapDialog.confirm( 'Delete Category', 'Are your sure you want to delete<br><b>'+ line_name +'<b>?' , function( result ){
            if( result ) {
                window.location = link;
            }
        });
        return false;
    });

{/literal}{if $categories}{literal}

    $('#example').dataTable( {
        "aaSorting": [[ 0, "asc" ]],
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            { "bSortable": false },
            null
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
                <table class="display table table-hover" id="example">
                <thead><tr><th class="es-th es-th-delete es-start" style="text-align: center;">Delete</th><th class="es-th es-th-category es-end">Category</th></tr></thead>
                <tbody>
                {if $categories}
                {foreach from=$categories item=cat}
                    {*<tr><td class="text-center"><a href="{$adminUrl}delete-category?id={$cat.id}" class="remove_confirm"><img src="{$homeUrl}img/trash-icon.png" alt="Trash" /></a></td><td>{$cat.name}</td></tr>*}
                    <tr>
                        <td class="text-center">
                            <a href="{$adminUrl}delete-category&id={$cat.id}" class="remove_confirm">
                                <img src="{$homeUrl}img/trash-icon.png" alt="Trash" />
                            </a>
                        </td>
                        <td>{$cat.name}</td>
                    </tr>
                {/foreach}
                {else}
                    <tr><td colspan="2">Not match found.</td></tr>
                {/if}
                </tbody>
                </table>

                <div class="clr30"></div>
                <a href="{$adminUrl}add-category"><button class="btn btn-theme">Add Category</button></a>
		</div>
    </div>
</div>

