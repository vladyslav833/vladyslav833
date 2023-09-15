<?php
/* Smarty version 3.1.30, created on 2023-06-28 07:41:41
  from "/home/equipmen/public_html/templates/add-equipment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_649bd625c5eb09_65974078',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd4e3d21044133bb67c9cf42410c9bf202f1103f5' => 
    array (
      0 => '/home/equipmen/public_html/templates/add-equipment.tpl',
      1 => 1639087548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649bd625c5eb09_65974078 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">Add Equipment</header>
            <div class="panel-body">
            <form action="" method="post">
                <div class="clr10"></div>
                <div class="col-sm-6">
                <select class="form-control es-select" name="category" required>
                    <option value="0" <?php if (!$_smarty_tpl->tpl_vars['category']->value) {?> selected<?php }?>>Select Category</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['cat']->value['id'] == $_smarty_tpl->tpl_vars['category']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['cat']->value['name'];?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </select>
                </div>
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Equipment Name" name="equip_type" required value="<?php echo $_smarty_tpl->tpl_vars['equip_type']->value;?>
"></div>
				<div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
equipment';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Equipment" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div>

<?php }
}
