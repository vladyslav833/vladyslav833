<?php
/* Smarty version 3.1.30, created on 2017-07-07 18:24:22
  from "/home/equipmen/public_html/templates/jobs.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fc3c69f5367_95967597',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f2f00d06cef11876ca87bff121f59ffbe7d97a6' => 
    array (
      0 => '/home/equipmen/public_html/templates/jobs.tpl',
      1 => 1487141356,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595fc3c69f5367_95967597 (Smarty_Internal_Template $_smarty_tpl) {
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
<?php }?>

});
<?php echo '</script'; ?>
>


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
                <?php if ($_smarty_tpl->tpl_vars['jobs']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                    <tr>
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
                        <td><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
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
