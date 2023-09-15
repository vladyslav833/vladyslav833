<?php
/* Smarty version 3.1.30, created on 2021-09-14 19:07:07
  from "/home/equipmen/public_html/templates/add-category.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6140e4cb7f4053_20404772',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e936d1581a28c527586d16bb2754bf25d3d33fd2' => 
    array (
      0 => '/home/equipmen/public_html/templates/add-category.tpl',
      1 => 1392305898,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6140e4cb7f4053_20404772 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">Add Category</header>
            <div class="panel-body">
            <form method="post" action="">
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Category Name" required name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></div>
			    <div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
categories';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Category" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div><?php }
}
