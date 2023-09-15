<?php
/* Smarty version 3.1.30, created on 2017-03-29 11:21:32
  from "/home/equipmen/public_html/mobile/templates/view-equipment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58db8aacbc1952_91843436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6932af5e8c43c6be4b2665366749c5d7cf3ef08e' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/view-equipment.tpl',
      1 => 1490725877,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db8aacbc1952_91843436 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/view-equipment.js"><?php echo '</script'; ?>
>
<div class="view-equipment3 container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20">
            <form action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
calendar<?php if ($_smarty_tpl->tpl_vars['page']->value == 'reserve-equipment') {?>-reservation<?php }?>" method="post">
                <div class="clr30"></div>
                <h3 class="std text-center">Select The Equipment You Want To View</h3>
                <div class="clr20"></div>
                <select class="form-control es-select" name="category" id="category">
                    <option value="0">Select Category</option>
                    <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
"><?php echo stripslashes($_smarty_tpl->tpl_vars['cat']->value['name']);?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php }?>
                </select>
                <div id="step2" style="display: none;">
                    <div class="clr20"></div>
                    <select class="form-control es-select" name="equipment" id="equipment">
                        <option value="0">Select Equipment</option>
                        <?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipment']->value, 'equip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['equip']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
" class="equip_item cat<?php echo $_smarty_tpl->tpl_vars['equip']->value['cat_id'];?>
" ><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['name']);?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        <?php }?>
                    </select>
                    <select class="form-control es-select" id="equipment_storage" style="display: none;">
                        <option value="0">Select Equipment</option>
                        <?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipment']->value, 'equip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['equip']->value) {
?>
                            <option value="<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
" class="equip_item cat<?php echo $_smarty_tpl->tpl_vars['equip']->value['cat_id'];?>
" ><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['name']);?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        <?php }?>
                    </select>
                </div>
                <div id="step3" style="display: none;">
                    <div class="clr20"></div>
                    <center><button class="btn btn-login">View</button></center>
                </div>
            </form>
            </div>
         </div>

    </div>
</div>
<?php }
}
