<?php
/* Smarty version 3.1.30, created on 2022-08-14 17:41:18
  from "/home/equipmen/public_html/templates/parts/sidebar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f925ae0d5689_52913041',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd7a5f8ff84314bf844acb088ba75aa580e5fc1a0' => 
    array (
      0 => '/home/equipmen/public_html/templates/parts/sidebar.tpl',
      1 => 1642184601,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f925ae0d5689_52913041 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!--sidebar start-->
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/sidebar.js"><?php echo '</script'; ?>
>
<aside>
    <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <li class="dashboard-menu">
            
            <span>Dashboard</span>
        </li>
        <li>
            <span class="calendar-menu <?php if ('calendar' == $_smarty_tpl->tpl_vars['page']->value || 'prj-calendar' == $_smarty_tpl->tpl_vars['page']->value || 'wkr-calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Calendar
                <i class="<?php if ('calendar' == $_smarty_tpl->tpl_vars['page']->value || 'prj-calendar' == $_smarty_tpl->tpl_vars['page']->value || 'wkr-calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>icon-caret-up<?php } else { ?>icon-caret-down<?php }?> download-btn"></i>
            </span>
            <div class="calendar-dropdown <?php if ('calendar' == $_smarty_tpl->tpl_vars['page']->value || 'prj-calendar' == $_smarty_tpl->tpl_vars['page']->value || 'wkr-calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>show-dropdown<?php } else { ?>hide-dropdown<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
calendar" class="view-calendar <?php if ('calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Calendar</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
prj-calendar" class="prj-calendar <?php if ('prj-calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Project Calendar</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
wkr-calendar" class="wkr-calendar <?php if ('wkr-calendar' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Worker Calendar</a>
            </div>
        </li>
        <li>
            <span class="equipment-menu <?php if ('equipment' == $_smarty_tpl->tpl_vars['page']->value || 'categories' == $_smarty_tpl->tpl_vars['page']->value || 'reserve-equipment' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Equipment
                <i class="<?php if ('equipment' == $_smarty_tpl->tpl_vars['page']->value || 'categories' == $_smarty_tpl->tpl_vars['page']->value || 'reserve-equipment' == $_smarty_tpl->tpl_vars['page']->value) {?>icon-caret-up<?php } else { ?>icon-caret-down<?php }?> download-btn"></i>
            </span>
            <div class="equipment-dropdown <?php if ('equipment' == $_smarty_tpl->tpl_vars['page']->value || 'categories' == $_smarty_tpl->tpl_vars['page']->value || 'reserve-equipment' == $_smarty_tpl->tpl_vars['page']->value) {?>show-dropdown<?php } else { ?>hide-dropdown<?php }?>">
                <a class="all-equipment-menu <?php if ('equipment' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
equipment">All Equipment</a>
                <a class="categories-menu <?php if ('categories' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
categories">Categories</a>
                <a class="reservation-menu <?php if ('reserve-equipment' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>" href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
reserve-equipment">Make Reservation</a>
            </div>
        </li>
        <li>
            <span class="jobs-menu <?php if ('jobs' == $_smarty_tpl->tpl_vars['page']->value || 'add-job' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Projects
                <i class="<?php if ('jobs' == $_smarty_tpl->tpl_vars['page']->value || 'add-job' == $_smarty_tpl->tpl_vars['page']->value) {?>icon-caret-up<?php } else { ?>icon-caret-down<?php }?> download-btn"></i>
            </span>
            <div class="jobs-dropdown <?php if ('jobs' == $_smarty_tpl->tpl_vars['page']->value || 'add-job' == $_smarty_tpl->tpl_vars['page']->value) {?>show-dropdown<?php } else { ?>hide-dropdown<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
jobs" class="all-jobs <?php if ('jobs' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">View All</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-job" class="add-job <?php if ('add-job' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Add New Project</a>
            </div>
        </li>
        <li>
            <span class="assign-job-menu <?php if ('tasks' == $_smarty_tpl->tpl_vars['page']->value || 'assign-job' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Jobs/Tasks
                <i class="<?php if ('tasks' == $_smarty_tpl->tpl_vars['page']->value || 'assign-job' == $_smarty_tpl->tpl_vars['page']->value) {?>icon-caret-up<?php } else { ?>icon-caret-down<?php }?> download-btn"></i>
            </span>
            <div class="tasks-dropdown <?php if ('tasks' == $_smarty_tpl->tpl_vars['page']->value || 'assign-job' == $_smarty_tpl->tpl_vars['page']->value) {?>show-dropdown<?php } else { ?>hide-dropdown<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
tasks" class="all-tasks <?php if ('tasks' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">View All Jobs/Tasks</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
assign-job" class="assign-job <?php if ('assign-job' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Assign Job/Task</a>
            </div>
        </li>
        <li>
            <span class="users-menu <?php if ('users' == $_smarty_tpl->tpl_vars['page']->value || 'add-user' == $_smarty_tpl->tpl_vars['page']->value || 'add-timeoff' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">Users
                <i class="<?php if ('users' == $_smarty_tpl->tpl_vars['page']->value || 'add-user' == $_smarty_tpl->tpl_vars['page']->value || 'add-timeoff' == $_smarty_tpl->tpl_vars['page']->value) {?>icon-caret-up<?php } else { ?>icon-caret-down<?php }?> download-btn"></i>
            </span>
            <div class="users-dropdown <?php if ('users' == $_smarty_tpl->tpl_vars['page']->value || 'add-user' == $_smarty_tpl->tpl_vars['page']->value || 'add-timeoff' == $_smarty_tpl->tpl_vars['page']->value) {?>show-dropdown<?php } else { ?>hide-dropdown<?php }?>">
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
users" class="all-users <?php if ('users' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>">View All</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-user" class="add-user <?php if ('add-user' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Add New User</a>
                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
add-timeoff" class="add-timeoff <?php if ('add-timeoff' == $_smarty_tpl->tpl_vars['page']->value) {?>selected<?php }?>"">Schedule Time Off</a>
            </div>
        </li>
        <li class="timecard-menu">
            <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
timecard" <?php if ('timecard' == $_smarty_tpl->tpl_vars['page']->value) {?> class="selected"<?php }?>>Timecard</a>
        </li>
    </ul>

    <!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end--><?php }
}
