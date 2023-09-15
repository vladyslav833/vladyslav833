<?php
/* Smarty version 3.1.30, created on 2017-07-07 18:24:09
  from "/home/equipmen/public_html/templates/main.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fc3b9323b81_56218685',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '590ad3fbc810f15521df4cd194eef857c6156985' => 
    array (
      0 => '/home/equipmen/public_html/templates/main.tpl',
      1 => 1487027724,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:parts/header.tpl' => 1,
    'file:parts/sidebar.tpl' => 1,
    'file:404.tpl' => 1,
    'file:dashboard.tpl' => 1,
    'file:categories.tpl' => 1,
    'file:calendar.tpl' => 1,
    'file:gantt-diagram.tpl' => 1,
    'file:calendar-2.tpl' => 1,
    'file:add-category.tpl' => 1,
    'file:jobs.tpl' => 1,
    'file:add-job.tpl' => 1,
    'file:equipment.tpl' => 1,
    'file:add-equipment.tpl' => 1,
    'file:reserv-equipment.tpl' => 1,
    'file:confirm-reservation.tpl' => 1,
    'file:edit-account.tpl' => 1,
    'file:users.tpl' => 1,
    'file:add-user.tpl' => 1,
    'file:parts/footer.tpl' => 1,
  ),
),false)) {
function content_595fc3b9323b81_56218685 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Eckinger">
        <meta name="keyword" content="Dashboard, Bootstrap, MRN">
        <link rel="shortcut icon" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
/img/favicon.png">
        <link rel="apple-touch-icon" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
/img/apple-touch-icon.png"/>

        <title><?php if ($_smarty_tpl->tpl_vars['page_name']->value) {
echo $_smarty_tpl->tpl_vars['page_name']->value;?>
 | <?php } else {
}
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
assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
assets/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/default.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/gantt/style.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/qtip/jquery.qtip.css" rel="stylesheet">
        <link href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
css/style.css" rel="stylesheet">

        <?php echo '<script'; ?>
 type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/bootstrap.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
assets/advanced-datatable/media/js/jquery.dataTables.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
assets/bootstrap-dialog/js/bootstrap-dialog.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/custom_dialog.js'><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type='text/javascript' src='<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/qtip/jquery.qtip.js'><?php echo '</script'; ?>
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
    </head>

    <body>
    <section id="container">
        <!--header start-->
        <?php $_smarty_tpl->_subTemplateRender("file:parts/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php $_smarty_tpl->_subTemplateRender("file:parts/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>


        <section id="main-content">
            <section class="wrapper">

                <div class="es-breadcrumb">

                <?php if ($_smarty_tpl->tpl_vars['breadcrumbs']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumbs']->value, 'link', false, 'pagename', 'breadcrumbs', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['pagename']->value => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['total'];
?>
                    <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumbs']->value['last'] : null)) {?>
                        <?php echo $_smarty_tpl->tpl_vars['pagename']->value;?>

                    <?php } else { ?>
                        <a href="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['pagename']->value;?>
</a> <i><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/breadcrumb-separator.png" alt="Separator" /></i>
                    <?php }?>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->tpl_vars['page_name']->value;?>

                <?php }?>

                </div>

                <div class="es-wrapper">

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == '404') {
$_smarty_tpl->_subTemplateRender("file:404.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'dashboard') {
$_smarty_tpl->_subTemplateRender("file:dashboard.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'categories') {
$_smarty_tpl->_subTemplateRender("file:categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'calendar') {
$_smarty_tpl->_subTemplateRender("file:calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'calendar-details') {
$_smarty_tpl->_subTemplateRender("file:gantt-diagram.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'calendar-2') {
$_smarty_tpl->_subTemplateRender("file:calendar-2.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'add-category') {
$_smarty_tpl->_subTemplateRender("file:add-category.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'jobs') {
$_smarty_tpl->_subTemplateRender("file:jobs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'add-job' || $_smarty_tpl->tpl_vars['page']->value == 'edit-job') {
$_smarty_tpl->_subTemplateRender("file:add-job.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'equipment') {
$_smarty_tpl->_subTemplateRender("file:equipment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'add-equipment') {
$_smarty_tpl->_subTemplateRender("file:add-equipment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'reserve-equipment') {
$_smarty_tpl->_subTemplateRender("file:reserv-equipment.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'confirm-reservation') {
$_smarty_tpl->_subTemplateRender("file:confirm-reservation.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'edit-account' || $_smarty_tpl->tpl_vars['page']->value == 'edit-my-account') {
$_smarty_tpl->_subTemplateRender("file:edit-account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'users') {
$_smarty_tpl->_subTemplateRender("file:users.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>
                    <?php if ($_smarty_tpl->tpl_vars['page']->value == 'add-user' || $_smarty_tpl->tpl_vars['page']->value == 'edit-user') {
$_smarty_tpl->_subTemplateRender("file:add-user.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}?>

                </div>

            </section>
        </section>
    </section>
    <?php $_smarty_tpl->_subTemplateRender("file:parts/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    </body>
</html><?php }
}
