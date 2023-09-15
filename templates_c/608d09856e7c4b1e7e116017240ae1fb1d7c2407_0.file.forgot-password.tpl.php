<?php
/* Smarty version 3.1.30, created on 2022-09-14 08:46:00
  from "/home/equipmen/public_html/templates/forgot-password.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_632186b8d97542_15158966',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '608d09856e7c4b1e7e116017240ae1fb1d7c2407' => 
    array (
      0 => '/home/equipmen/public_html/templates/forgot-password.tpl',
      1 => 1639087549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_632186b8d97542_15158966 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">
<form class="form-login" method="post" action="">
    <div class="login-header hidden-xs">
        <img src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
img/header-logo.png" alt="logo" class="login-logo"/>
        <div class="clear"></div>
    </div>
    <div class="login-wrap">
        <?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
        <div class="error" style="color: #ff0000; font-weight: bold; padding: 15px;">
            <?php echo $_smarty_tpl->tpl_vars['error']->value;?>

        </div>
        <?php }?>
        <p class="text-center" style="color: #fff;">We will send your password to you via email.</p>
        <input type="email" name="email" class="form-control" placeholder="Username" autofocus>
        <div class="clr20"></div>
        <button class="btn btn-login btn-block" type="submit">SEND PASSWORD</button>
    </div>
</form>
</div><?php }
}
