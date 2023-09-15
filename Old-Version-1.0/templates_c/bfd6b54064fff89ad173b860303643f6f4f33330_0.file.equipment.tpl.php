<?php
/* Smarty version 3.1.30, created on 2017-07-07 18:24:09
  from "/home/equipmen/public_html/templates/equipment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fc3b93a4179_63672077',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bfd6b54064fff89ad173b860303643f6f4f33330' => 
    array (
      0 => '/home/equipmen/public_html/templates/equipment.tpl',
      1 => 1487268069,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595fc3b93a4179_63672077 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>

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

<?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>

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

<?php }?>

});

<?php echo '</script'; ?>
>


<div class="row">
    <div class="col-sm-12">
		<div class="subpadding20">
            <div class="clr20"></div>
                <div id="category_filter">



                <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
equipment">
                    <!--<input type="hidden" name="page" value="admin/equipment">-->
                    <table cellpadding="0" cellspacing="0"><tr>
                    <td><a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-equipment"><button class="btn btn-theme" type="button">Add Equipment</button></a></td>
                    <td width="25"></td>
                    <td><select class="form-control es-select" name="category" id="category" required >
                        <option value="0">Select Category</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['cat']->value['id'] == $_smarty_tpl->tpl_vars['filters']->value['category']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
                <?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipment']->value, 'equip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['equip']->value) {
?>
                    <tr>
                        <td class="text-center"><a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
delete-equipment/?id=<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
" class="remove_confirm"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/trash-icon.png" alt="Trash" /></a></td>
                        <td><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['name']);?>
</td>
                        <td><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['cat_name']);?>
</td>
                        <td class="text-center"><a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
reserve-equipment/?id=<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/availability-icon.png" alt="Availability" /></a></td>
                    </tr>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <tr><td colspan="4">Not match found.</td></tr>
                <?php }?>
                </tbody>
                </table>

                <div class="clr30"></div>

		</div>
    </div>
</div>

<?php }
}
