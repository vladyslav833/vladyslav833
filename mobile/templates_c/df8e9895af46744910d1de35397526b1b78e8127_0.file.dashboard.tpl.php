<?php
/* Smarty version 3.1.30, created on 2021-12-13 17:38:55
  from "/home/equipmen/public_html/mobile/templates/dashboard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61b7852fe0d718_95558976',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df8e9895af46744910d1de35397526b1b78e8127' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/dashboard.tpl',
      1 => 1639087494,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61b7852fe0d718_95558976 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/dashboard.js"><?php echo '</script'; ?>
>
<div class="main-content container">
    <div class="row">
        <div class="content-title col-xs-12 text-center">
            <div class="main-wrap subpadding20">
                <div class="clr30"></div>
                <h2 class="std bold">Hi, <?php echo $_smarty_tpl->tpl_vars['currentUser']->value['fname'];?>
!</h2>
                <h3 class="std">What do you want to do?</h3>
                <div class="clr30"></div>
                <div class="main-screen">
                    <div class="col-xs-4 p-0">
                        <span class="schedule-icon"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/calendar-icon.png" alt="Schedule" /></span>
                        <p class="fs-18">Schedule</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <span class="equipment-icon"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/equipment-icon.png" alt="Equipment" /></span>
                        <p class="fs-18">Equipment</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
timecard"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/timer-icon.png" alt="Timer" /></a>
                        <p class="fs-18">Timecard</p>
                    </div>
                    <div class="clr20"></div>
                    <div class="col-xs-12">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
logout"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/logout-icon.png" alt="Logout" /></a>
                        <p class="fs-18">Logout</p>
                    </div>
                </div>
                <div class="equipment-section">
                    <div class="col-xs-4 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
my-reservations"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/my-reservation.png" alt="Calendar" /></a>
                        <p class="fs-16">My Reservations</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
view-equipment"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/view-equipment.png" alt="Equipment" /></a>
                        <p class="fs-16">View Equipment</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
reserve-equipment"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/reserve-equipment.png" alt="Timer" /></a>
                        <p class="fs-16">Reserve Equipment</p>
                    </div>
                </div>
                <div class="schedule-section">
                    <div class="col-xs-6 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
schedule"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/calendar-icon.png" alt="My Schedule" /></a>
                        <p class="fs-16">My<br>Schedule</p>
                    </div>
                    <div class="col-xs-6 p-0">
                        <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
coworker-schedule"><img class="dashboard-menu" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/co-worker-icon.png" alt="Equipment" /></a>
                        <p class="fs-16">Co-Worker<br>Schedules</p>
                    </div>
                </div>
            </div>
         </div>
     </div>
</div><?php }
}
