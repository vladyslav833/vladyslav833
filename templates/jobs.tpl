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

    $('#example').dataTable({
        "bLengthChange": true, // Enable "Display X projects per page" option
        "iDisplayLength": 10, // Set the default value to 10 projects per page
        "aLengthMenu": [[10, 25, 50], [10, 25, 50]], // Array of options for the dropdown menu
        "bFilter": false,
        "bInfo": false,
        "aaSorting": [[2, "asc"]],
        "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": false }
        ],
        "sPaginationType": "full_numbers",
        "oLanguage": {
            "sLengthMenu": "Display _MENU_ projects per page."
        }
    });
{/literal}{/if}{literal}

});
</script>
{/literal}

<div class="row">
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
                <div id="user_role_filter">
                    <form method="post" action="{$adminUrl}jobs">
                        <table>
                            <tr>
                                <td>
                                    <select class="form-control es-select" name="status" required>
                                        <option value="unselected">Filter By Status</option>
                                        <option value="all" {if $filters.status == "all"} selected{/if}>All</option>
                                        <option value="1" {if $filters.status == "1"} selected{/if}>Current</option>
                                        <option value="2" {if $filters.status == "2"} selected{/if}>Archived</option>
                                    </select>
                                </td>
                                <td class="subpadding10"><button type="submit" class="btn btn-theme" style="display: inline-block">Filter</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
                <table class="display table table-hover" id="example">
                <thead>
                    <tr>
                        <th class="es-th es-th-delete es-start text-center">Assign Job</th>
                        <th class="es-th es-th-delete">Job #</th>
                        <th class="es-th es-th-job">Job Name</th>
                        <th class="es-th es-th-delete text-center">Status</th>
                        <th class="es-th es-th-delete es-end text-center">Delete/Edit</th>
                    </tr>
                </thead>
                <tbody>
                {if $jobs}
                {foreach from=$jobs item=cat}
                    <tr>
                        <td class="text-center">
                            <a href="{$adminUrl}assign-job/?job_id={$cat.id}">
                                <img src="{$homeUrl}img/task-icon.png" alt="Assign Job" />
                            </a>
                        </td>
                        <td>{$cat.job_num}</td>
                        <td>{$cat.name}</td>
                        <td class="text-center">{if $cat.status == 1}Current{elseif $cat.status == 2}Archived{else}{/if}</td>
                        <td class="text-center">
                            <a href="{$adminUrl}delete-job/?id={$cat.id}" class="remove_confirm">
                                <img src="{$homeUrl}img/trash-icon.png" alt="Trash" />
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="{$adminUrl}edit-job/?id={$cat.id}">
                                <img src="{$homeUrl}img/settings-icon.png" alt="Edit" />
                            </a>
                        </td>
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

