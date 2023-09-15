<?php
/* Smarty version 3.1.30, created on 2023-02-13 17:48:06
  from "/home/equipmen/public_html/templates/categories.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63ea77d6aa80a8_01942048',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9ad801b4ac918de19565629acc24407c7d9d82ea' => 
    array (
      0 => '/home/equipmen/public_html/templates/categories.tpl',
      1 => 1639087549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63ea77d6aa80a8_01942048 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

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

<?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>

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
                <thead><tr><th class="es-th es-th-delete es-start" style="text-align: center;">Delete</th><th class="es-th es-th-category es-end">Category</th></tr></thead>
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                    
                    <tr>
                        <td class="text-center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
delete-category&id=<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" class="remove_confirm">
                                <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/trash-icon.png" alt="Trash" />
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
add-category"><button class="btn btn-theme">Add Category</button></a>
		</div>
    </div>
</div>

<?php }
}
