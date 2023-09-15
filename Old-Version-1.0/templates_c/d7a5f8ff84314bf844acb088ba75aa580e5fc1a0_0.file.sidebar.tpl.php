<?php
/* Smarty version 3.1.30, created on 2017-07-07 18:24:09
  from "/home/equipmen/public_html/templates/parts/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fc3b93614f9_56532490',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7a5f8ff84314bf844acb088ba75aa580e5fc1a0' => 
    array (
      0 => '/home/equipmen/public_html/templates/parts/sidebar.tpl',
      1 => 1395302501,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595fc3b93614f9_56532490 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!--sidebar start-->

<aside>
    <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <li class="dashboard-menu">
            
            <span>Dashboard</span>
        </li>
        <li class="reservation-menu">
            <a  href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
reserve-equipment" <?php if ('reserve-equipment' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Make Reservation</a>
        </li>
        <li class="calendar-menu">
            <a  href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
calendar" <?php if ('calendar' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Calendar</a>
        </li>
        <li class="categories-menu">
            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
categories" <?php if ('categories' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Categories</a>
        </li>
        <li class="equipment-menu">
            <a  href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
equipment" <?php if ('equipment' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Equipment</a>
        </li>
        <li class="jobs-menu">
            <a  href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
jobs" <?php if ('jobs' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Jobs</a>
        </li>
        <li class="users-menu">
            <a  href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
users" <?php if ('users' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Users</a>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end--><?php }
}
