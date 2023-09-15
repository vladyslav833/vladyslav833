<?php
/* Smarty version 3.1.30, created on 2022-08-14 19:17:01
  from "/home/equipmen/public_html/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f93c1d088748_32682751',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70481c41715fd31e0153af90b22d1c795f7e1805' => 
    array (
      0 => '/home/equipmen/public_html/templates/login.tpl',
      1 => 1639087550,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f93c1d088748_32682751 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="container">

    <form class="form-login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
login">
        <div class="login-header">
            <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/header-logo.png" alt="logo" class="login-logo"/>
            <div class="clear"></div>
        </div>

        <div class="login-wrap">
            <?php if ($_smarty_tpl->tpl_vars['login_failed']->value) {?>
            <div class="danger">Username and/or Password are incorrect. Please try again.</div>
            <div class="clr20"></div>
            <?php }?>
            <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" autofocus>
            <div class="clr20"></div>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="clr20"></div>
            <button class="btn btn-login btn-block" type="submit">LOGIN</button>
            <div class="clr20"></div>
            <a href="#" rel="tooltip" data-original-title="Forgot Password?"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/forgot-password-icon.png" alt="Info"/></a>
            <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
forgot-password">Forgot Password?</a>
            </div>
        </div>
    </form>

</div><?php }
}
