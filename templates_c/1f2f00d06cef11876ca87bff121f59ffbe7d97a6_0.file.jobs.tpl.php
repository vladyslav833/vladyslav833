<?php
/* Smarty version 3.1.30, created on 2022-08-14 20:55:53
  from "/home/equipmen/public_html/templates/jobs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f953493df8c0_06522929',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f2f00d06cef11876ca87bff121f59ffbe7d97a6' => 
    array (
      0 => '/home/equipmen/public_html/templates/jobs.tpl',
      1 => 1642184555,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f953493df8c0_06522929 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

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

<?php if ($_smarty_tpl->tpl_vars['jobs']->value) {?>

    $('#example').dataTable( {
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        "aaSorting": [[ 2, "asc" ]],
        "aoColumns": [
            { "bSortable": false },
            { "bSortable": true },
            { "bSortable": true },
            { "bSortable": true },
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
jobs">
                        <table>
                            <tr>
                                <td>
                                    <select class="form-control es-select" name="status" required>
                                        <option value="unselected">Filter By Status</option>
                                        <option value="all" <?php if ($_smarty_tpl->tpl_vars['filters']->value['status'] == "all") {?> selected<?php }?>>All</option>
                                        <option value="1" <?php if ($_smarty_tpl->tpl_vars['filters']->value['status'] == "1") {?> selected<?php }?>>Current</option>
                                        <option value="2" <?php if ($_smarty_tpl->tpl_vars['filters']->value['status'] == "2") {?> selected<?php }?>>Archived</option>
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
                <?php if ($_smarty_tpl->tpl_vars['jobs']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                    <tr>
                        <td class="text-center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
assign-job/?job_id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/task-icon.png" alt="Assign Job" />
                            </a>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['job_num'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</td>
                        <td class="text-center"><?php if ($_smarty_tpl->tpl_vars['cat']->value['status'] == 1) {?>Current<?php } elseif ($_smarty_tpl->tpl_vars['cat']->value['status'] == 2) {?>Archived<?php } else {
}?></td>
                        <td class="text-center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
delete-job/?id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" class="remove_confirm">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/trash-icon.png" alt="Trash" />
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
edit-job/?id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/settings-icon.png" alt="Edit" />
                            </a>
                        </td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <tr><td colspan="2">Not match found.</td></tr>
                <?php }?>
                </tbody>
                </table>

                <div class="clr30"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-job"><button class="btn btn-theme">Add Job</button></a>
        </div>
    </div>
</div>

<?php }
}
