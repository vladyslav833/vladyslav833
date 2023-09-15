<?php
/* Smarty version 3.1.30, created on 2022-08-14 17:41:17
  from "/home/equipmen/public_html/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f925ade8db30_22616462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f522eb859589accef912b75c9ccbcdef9bb58e7a' => 
    array (
      0 => '/home/equipmen/public_html/templates/index.tpl',
      1 => 1639087550,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:lobby.tpl' => 1,
    'file:main.tpl' => 1,
  ),
),false)) {
function content_62f925ade8db30_22616462 (Smarty_Internal_Template $_smarty_tpl) {
if ('' == $_smarty_tpl->tpl_vars['page']->value || 'login' == $_smarty_tpl->tpl_vars['page']->value || 'forgot-password' == $_smarty_tpl->tpl_vars['page']->value || ('404' == $_smarty_tpl->tpl_vars['page']->value && !$_smarty_tpl->tpl_vars['user_logged']->value)) {?>
    <?php $_smarty_tpl->_subTemplateRender("file:lobby.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php } else { ?>
    <?php $_smarty_tpl->_subTemplateRender("file:main.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
}
