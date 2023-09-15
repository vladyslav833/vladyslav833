<?php
/* Smarty version 3.1.30, created on 2017-07-07 16:34:21
  from "/home/equipmen/public_html/templates/lobby.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fa9fd154ff4_27954162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2447b0fe7acd378505fd891cdbfa413ca0c3d02b' => 
    array (
      0 => '/home/equipmen/public_html/templates/lobby.tpl',
      1 => 1393007327,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:404.tpl' => 1,
    'file:login.tpl' => 1,
    'file:forgot-password.tpl' => 1,
  ),
),false)) {
function content_595fa9fd154ff4_27954162 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Eckinger">
        <meta name="keyword" content="Dashboard, Bootstrap, ES">

        <title><?php echo $_smarty_tpl->tpl_vars['default_title']->value;
if ($_smarty_tpl->tpl_vars['pageName']->value) {?> - <?php echo $_smarty_tpl->tpl_vars['pageName']->value;
} else {
}?></title>

        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/favicon.png">

        <!-- Bootstrap core CSS -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/style.css" rel="stylesheet">

        <?php echo '<script'; ?>
 type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/bootstrap.js'><?php echo '</script'; ?>
>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/html5shiv.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/respond.min.js"><?php echo '</script'; ?>
>
        <![endif]-->
        
        <?php echo '<script'; ?>
 type='text/javascript'>
            jQuery(document).ready(function($){
        
                $('[rel=tooltip]').tooltip();
                $('a[rel=tooltip]').attr('tabindex','32000');
                <?php if ($_smarty_tpl->tpl_vars['popup_message']->value) {?>alert('<?php echo $_smarty_tpl->tpl_vars['popup_message']->value;?>
');<?php }?>
        
            });
        <?php echo '</script'; ?>
>
        
    </head>
    <body class="login-body">

        <?php if ('404' == $_smarty_tpl->tpl_vars['page']->value) {
$_smarty_tpl->_subTemplateRender("file:404.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value == '' || $_smarty_tpl->tpl_vars['page']->value == 'login') {
$_smarty_tpl->_subTemplateRender("file:login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
        <?php if ($_smarty_tpl->tpl_vars['page']->value == 'forgot-password') {
$_smarty_tpl->_subTemplateRender("file:forgot-password.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

    </body>
</html><?php }
}
