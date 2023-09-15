<?php
/* Smarty version 3.1.30, created on 2017-03-29 00:32:15
  from "/home/equipmen/public_html/mobile/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58daf27f2b3166_79950057',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '887e8e80547245482fb692f49b1985e3ef2eeb1a' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/index.tpl',
      1 => 1490725872,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:login.tpl' => 1,
    'file:dashboard.tpl' => 1,
    'file:view-equipment.tpl' => 2,
    'file:my-reservations.tpl' => 1,
    'file:view-reservations.tpl' => 1,
    'file:calendar.tpl' => 1,
    'file:calendar-reservation.tpl' => 1,
    'file:save-reservation.tpl' => 1,
  ),
),false)) {
function content_58daf27f2b3166_79950057 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Eckinger">
    <meta name="keyword" content="Dashboard, Bootstrap, ES">
    <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
/img/favicon.png">
    <link rel="apple-touch-icon" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
/img/apple-touch-icon.png"/>

    <title><?php if ($_smarty_tpl->tpl_vars['pageName']->value) {
echo $_smarty_tpl->tpl_vars['pageName']->value;?>
 | <?php }
echo $_smarty_tpl->tpl_vars['default_title']->value;?>
</title>

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
    <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/shCoreDefault.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/default.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" >
    <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/jquery-theme-redmond/jquery-ui-1.10.4.custom.min.css" rel='stylesheet' type='text/css' >

    <?php echo '<script'; ?>
 type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type='text/javascript' src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/qtip/jquery.qtip.js'><?php echo '</script'; ?>
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
 type="">
        var siteUrl = '<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
';
    <?php echo '</script'; ?>
>
</head>

<body>

    <div class="header">
        <div class="logo">
            <a href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/header-logo.png" alt="Logo" class="logo-img" /></a>
           </div>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'login') {
$_smarty_tpl->_subTemplateRender("file:login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'dashboard') {
$_smarty_tpl->_subTemplateRender("file:dashboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'view-equipment') {
$_smarty_tpl->_subTemplateRender("file:view-equipment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'reserve-equipment') {
$_smarty_tpl->_subTemplateRender("file:view-equipment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'my-reservations') {
$_smarty_tpl->_subTemplateRender("file:my-reservations.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'view-reservations') {
$_smarty_tpl->_subTemplateRender("file:view-reservations.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'calendar') {
$_smarty_tpl->_subTemplateRender("file:calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'calendar-reservation') {
$_smarty_tpl->_subTemplateRender("file:calendar-reservation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'save-reservation') {
$_smarty_tpl->_subTemplateRender("file:save-reservation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
    



    <div class="footer container">
        &copy; Copyright <?php echo date("Y");?>
 Norman Eckinger, Inc.. - All Rights Reserved
    </div>
</body>
</html>
<?php }
}
