<?php
/* Smarty version 3.1.30, created on 2017-03-29 10:05:44
  from "/home/equipmen/public_html/mobile/templates/dashboard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58db78e862f341_08652466',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df8e9895af46744910d1de35397526b1b78e8127' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/dashboard.tpl',
      1 => 1490725876,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db78e862f341_08652466 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="main-content container">
    <div class="row">
        <div class="content-title col-xs-12 text-center">
            <div class="main-wrap subpadding20">
                <div class="clr30"></div>
                <h3 class="std bold">Hi, <?php echo $_smarty_tpl->tpl_vars['currentUser']->value['fname'];?>
!</h2>
                <h3 class="std">What do you want to do?</h3>
                <div class="clr20"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
my-reservations"><button class="btn btn-login btn-block btn-lg">My Reservations</button></a>
                <div class="clr20"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
view-equipment"><button class="btn btn-login btn-block btn-lg">View Equipment</button></a>
                <div class="clr20"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
reserve-equipment"><button class="btn btn-login btn-block btn-lg">Reserve Equipment</button></a>
                <div class="clr20"></div>
                <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
logout"><button class="btn btn-login btn-block btn-lg">Logout</button></a>
            </div>
         </div>
     </div>
</div><?php }
}
