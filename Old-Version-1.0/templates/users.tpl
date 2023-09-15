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
        "aaSorting": [[ 1, "asc" ]],
        "aoColumns": [
            { "bSortable": false },
            null,
            null,
            null,
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
                        <th class="es-th es-th-delete es-start" style="text-align: center;">Delete</th>
                        <th class="es-th es-th-user">User Name</th>
                        <th class="es-th es-th-user">First Name</th>
                        <th class="es-th es-th-user">Last Name</th>
                        <th class="es-th es-th-user">Role</th>
                        <th class="es-th es-th-user es-end text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                {if $users}
                {foreach from=$users item=user}
                    <tr>
                        <td class="text-center">
                            {*if $user.role !== 'admin' && $user.id !== $currentUser->id *}
                            {if $user.id !== $currentUser.id && $currentUser.is_admin }
                            <a href="{$adminUrl}delete-user/?id={$user.id}" class="remove_confirm">
                                <img src="{$homeUrl}img/trash-icon.png" alt="Trash" />
                            </a>
                            {/if}
                        </td>
                        <td>{$user.username}</td>
                        <td>{$user.first_name}</td>
                        <td>{$user.last_name}</td>
                        <td style="text-transform: capitalize;">{$user.role}</td>
                        <td class="text-center">
                            <a href="{$adminUrl}edit-user/?id={$user.id}">
                                <img src="{$homeUrl}img/settings-icon.png" alt="Edit" />
                            </a>
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

