{literal}
<script>

$(document).ready(function(){

    $('.remove_confirm').click(function(){
        var link = $(this).attr('href');
        var cat_name = $(this).parent().next().html();

        BootstrapDialog.confirm( 'Delete job', 'Are your sure you want to delete<br><b>'+ cat_name +'<b>?' , function( result ){
            if( result ) {
                window.location = link;
            }
        });
        return false;
    });

{/literal}{if $jobs}{literal}

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
                <thead>
                    <tr>
                        <th class="es-th es-th-delete es-start" style="text-align: center;">Delete/Edit</th>
                        <th class="es-th es-th-job es-end">Job Name</th>
                    </tr>
                </thead>
                <tbody>
                {if $jobs}
                {foreach from=$jobs item=cat}
                    <tr>
                        <td class="text-center">
                            <a href="{$adminUrl}delete-job/?id={$cat.id}" class="remove_confirm">
                                <img src="{$homeUrl}img/trash-icon.png" alt="Trash" />
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{$adminUrl}edit-job/?id={$cat.id}">
                                <img src="{$homeUrl}img/settings-icon.png" alt="Edit" />
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
                <a href="{$adminUrl}add-job"><button class="btn btn-theme">Add Job</button></a>
        </div>
    </div>
</div>

