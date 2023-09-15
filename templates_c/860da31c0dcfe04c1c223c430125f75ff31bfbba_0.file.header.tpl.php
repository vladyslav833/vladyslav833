<?php
/* Smarty version 3.1.30, created on 2022-08-14 17:41:18
  from "/home/equipmen/public_html/templates/parts/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f925ae037078_77785348',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '860da31c0dcfe04c1c223c430125f75ff31bfbba' => 
    array (
      0 => '/home/equipmen/public_html/templates/parts/header.tpl',
      1 => 1639087551,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f925ae037078_77785348 (Smarty_Internal_Template $_smarty_tpl) {
?>
<header class="header">
    <span class="pull-left"><a href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/header-logo.png" alt="logo" class="subpadding20 logo"/></a></span>
    <h2>Project Management</h2>
    <span class="pull-right header-info">
    Hi, <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
edit-my-account"><?php echo $_smarty_tpl->tpl_vars['currentUser']->value['fname'];?>
</a> <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
edit-my-account"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/settings-icon.png" alt="Setting" class="header-icon" /></a> <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
logout"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/logoff-icon.png" alt="Log Off" class="header-icon" /></a></span>
</header><?php }
}
