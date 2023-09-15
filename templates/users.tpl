{literal}
<script>

$(document).ready(function(){

    $('.remove_confirm').click(function(){
        var link = $(this).attr('href');
        var line_name = $(this).parent().next().html();

        BootstrapDialog.confirm( 'Delete user', 'Are your sure you want to delete<br><b>'+ line_name +'<b>?' , function( result ){
            if( result ) {
                window.location = link;
            }
        });
        return false;
    });

{/literal}{if $users}{literal}

    $('#example').dataTable( {
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "iDisplayLength": 25,
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,
            null,
            null,
            null,
            { "bSortable": false }
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
                <div id="user_role_filter">
                    <form method="post" action="{$adminUrl}users">
                        <table>
                            <tr>
                                <td>
                                    <select class="form-control es-select" name="userrole" id="userrole" required >
                                        <option value="unselected">Filter By Role</option>
                                        <option value="admin" {if "admin" eq $filters.userrole} selected{/if}>Admin</option>
                                        <option value="proj_mgr" {if "proj_mgr" eq $filters.userrole} selected{/if}>Proj.Mgr</option>
                                        <option value="user" {if "user" eq $filters.userrole} selected{/if}>Worker</option>
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
                        <th class="es-th es-th-user es-start text-center">Assign Job</th>
                        <th class="es-th es-th-user">First Name</th>
                        <th class="es-th es-th-user">Last Name</th>
                        <th class="es-th es-th-user">User Name</th>
                        <th class="es-th es-th-user">Role</th>
                        {if "user" neq $filters.userrole}
                        <th class="es-th es-th-user text-center">Add Project</th>
                        {/if}
                        <th class="es-th es-th-user text-center">Edit</th>
                        <th class="es-th es-th-delete es-end text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                {if $users}
                {foreach from=$users item=user}
                    <tr>
                        <td class="text-center">
                            {if $user.role == "user" }
                                <a href="{$adminUrl}assign-job/?user_id={$user.id}">
                                    <img src="{$homeUrl}img/task-icon.png" alt="Assign Job" />
                                </a>
                            {/if}
                        </td>
                        <td>{$user.first_name}</td>
                        <td>{$user.last_name}</td>
                        <td>{$user.username}</td>
                        {if $user.role == "admin"}
                            <td style="text-transform: capitalize;">Admin, Proj.Mgr</td>
                        {elseif $user.role == "proj_mgr"}
                            <td style="text-transform: capitalize;">Proj.Mgr</td>
                        {else}
                            <td style="text-transform: capitalize;">{$user.role}</td>
                        {/if}
                        {if "user" neq $filters.userrole}
                        <td class="text-center">
                            {if $user.role == "admin" || $user.role == "proj_mgr" }
                            <a href="{$adminUrl}add-job/?user_id={$user.id}">
                                <img src="{$homeUrl}img/task-icon.png" alt="Add Task" />
                            </a>
                            {/if}
                        </td>
                        {/if}
                        <td class="text-center">
                            <a href="{$adminUrl}edit-user/?id={$user.id}">
                                <img src="{$homeUrl}img/settings-icon.png" alt="Edit" />
                            </a>
                        </td>
                        <td class="text-center">
                            {*if $user.role !== 'admin' && $user.id !== $currentUser->id *}
                            {if $user.id !== $currentUser.id && $currentUser.is_admin }
                                <a href="{$adminUrl}delete-user/?id={$user.id}" class="remove_confirm">
                                    <img src="{$homeUrl}img/trash-icon.png" alt="Trash" />
                                </a>
                            {/if}
                        </td>
                    </tr>
                {/foreach}
                {else}
                    <tr><td colspan="5">Not match found.</td></tr>
                {/if}
                </tbody>
                </table>

                <div class="clr30"></div>
                <a href="{$adminUrl}add-user"><button class="btn btn-theme">Add User</button></a>
        </div>
    </div>
</div>

