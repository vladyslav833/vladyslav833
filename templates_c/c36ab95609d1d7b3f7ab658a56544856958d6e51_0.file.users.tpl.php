<?php
/* Smarty version 3.1.30, created on 2022-08-14 20:55:27
  from "/home/equipmen/public_html/templates/users.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f9532fa21c98_06100116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c36ab95609d1d7b3f7ab658a56544856958d6e51' => 
    array (
      0 => '/home/equipmen/public_html/templates/users.tpl',
      1 => 1639087551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f9532fa21c98_06100116 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

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

<?php if ($_smarty_tpl->tpl_vars['users']->value) {?>

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
<?php }?>

});
<?php echo '</script'; ?>
>


<div class="row">
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
                <div id="user_role_filter">
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
users">
                        <table>
                            <tr>
                                <td>
                                    <select class="form-control es-select" name="userrole" id="userrole" required >
                                        <option value="unselected">Filter By Role</option>
                                        <option value="admin" <?php if ("admin" == $_smarty_tpl->tpl_vars['filters']->value['userrole']) {?> selected<?php }?>>Admin</option>
                                        <option value="proj_mgr" <?php if ("proj_mgr" == $_smarty_tpl->tpl_vars['filters']->value['userrole']) {?> selected<?php }?>>Proj.Mgr</option>
                                        <option value="user" <?php if ("user" == $_smarty_tpl->tpl_vars['filters']->value['userrole']) {?> selected<?php }?>>Worker</option>
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
                        <?php if ("user" != $_smarty_tpl->tpl_vars['filters']->value['userrole']) {?>
                        <th class="es-th es-th-user text-center">Add Project</th>
                        <?php }?>
                        <th class="es-th es-th-user text-center">Edit</th>
                        <th class="es-th es-th-delete es-end text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['users']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                    <tr>
                        <td class="text-center">
                            <?php if ($_smarty_tpl->tpl_vars['user']->value['role'] == "user") {?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
assign-job/?user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/task-icon.png" alt="Assign Job" />
                                </a>
                            <?php }?>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
</td>
                        <?php if ($_smarty_tpl->tpl_vars['user']->value['role'] == "admin") {?>
                            <td style="text-transform: capitalize;">Admin, Proj.Mgr</td>
                        <?php } elseif ($_smarty_tpl->tpl_vars['user']->value['role'] == "proj_mgr") {?>
                            <td style="text-transform: capitalize;">Proj.Mgr</td>
                        <?php } else { ?>
                            <td style="text-transform: capitalize;"><?php echo $_smarty_tpl->tpl_vars['user']->value['role'];?>
</td>
                        <?php }?>
                        <?php if ("user" != $_smarty_tpl->tpl_vars['filters']->value['userrole']) {?>
                        <td class="text-center">
                            <?php if ($_smarty_tpl->tpl_vars['user']->value['role'] == "admin" || $_smarty_tpl->tpl_vars['user']->value['role'] == "proj_mgr") {?>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-job/?user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/task-icon.png" alt="Add Task" />
                            </a>
                            <?php }?>
                        </td>
                        <?php }?>
                        <td class="text-center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
edit-user/?id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/settings-icon.png" alt="Edit" />
                            </a>
                        </td>
                        <td class="text-center">
                            
                            <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] !== $_smarty_tpl->tpl_vars['currentUser']->value['id'] && $_smarty_tpl->tpl_vars['currentUser']->value['is_admin']) {?>
                                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
delete-user/?id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" class="remove_confirm">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/trash-icon.png" alt="Trash" />
                                </a>
                            <?php }?>
                        </td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <tr><td colspan="5">Not match found.</td></tr>
                <?php }?>
                </tbody>
                </table>

                <div class="clr30"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-user"><button class="btn btn-theme">Add User</button></a>
        </div>
    </div>
</div>

<?php }
}
