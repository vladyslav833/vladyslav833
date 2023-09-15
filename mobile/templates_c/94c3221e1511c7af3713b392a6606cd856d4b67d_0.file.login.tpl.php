<?php
/* Smarty version 3.1.30, created on 2021-12-13 17:38:50
  from "/home/equipmen/public_html/mobile/templates/login.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61b7852a13cea3_21636851',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '94c3221e1511c7af3713b392a6606cd856d4b67d' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/login.tpl',
      1 => 1639087494,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61b7852a13cea3_21636851 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="main-content container">
    <div class="row">
        <div class="content-title col-xs-12 text-center">
            <div class="subpadding20">
                <div class="clr30"></div>
                <h3 class="color std">Equipment Scheduler</h3>
                <h2 class="color std">Login</h2>
                <div class="clr20"></div>
            </div>

            <form class="form-login" method="post" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
login">
            <?php if ($_smarty_tpl->tpl_vars['login_failed']->value) {?>
            <div class="danger">Username is incorrect. Please try again.</div>
            <div class="clr20"></div>
            <?php }?>

            <div class="login-wrap subpadding20">
                <input type="text" class="es-input form-control" placeholder="Username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" autofocus>
                <div class="clr20"></div>
                <button class="btn btn-login btn-block" type="submit">Login</button>
                <div class="clr20"></div>
            </div>
            </form>

        </div>
    </div>
</div><?php }
}
