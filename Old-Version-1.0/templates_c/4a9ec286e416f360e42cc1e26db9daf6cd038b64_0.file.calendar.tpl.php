<?php
/* Smarty version 3.1.30, created on 2017-07-13 13:20:33
  from "/home/equipmen/public_html/templates/calendar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_596765917f76b4_25970774',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4a9ec286e416f360e42cc1e26db9daf6cd038b64' => 
    array (
      0 => '/home/equipmen/public_html/templates/calendar.tpl',
      1 => 1395409367,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_596765917f76b4_25970774 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/calendar_pre_scripts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/zebra_datepicker.js"><?php echo '</script'; ?>
>

<form method="post" action="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
calendar-details">
<div class="row calendar-line-0">
    <div class="col-sm-3 es-checkbox">What calendar do you want to view?</div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="calendar" required>
            <option value="" <?php if (!$_smarty_tpl->tpl_vars['calendar']->value) {?> selected<?php }?>>Select Calendar</option>
            <option value="category" <?php if ('equipment' == $_smarty_tpl->tpl_vars['calendar']->value) {?> selected<?php }?>>Equipment</option>
            <option value="job" <?php if ('job' == $_smarty_tpl->tpl_vars['calendar']->value) {?> selected<?php }?>>Job</option>
            <option value="user" <?php if ('user' == $_smarty_tpl->tpl_vars['calendar']->value) {?> selected<?php }?>>User</option>
        </select>
    </div>
</div>
<div class="row calendar-line-1">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="category">
            <option value="">Select Equipment Type</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'smrt_cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_cat']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_cat']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_cat']->value['id'] == $_smarty_tpl->tpl_vars['category']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_cat']->value['name'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>
        <select class="form-control es-select" name="job">
            <option value="">Select Job</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'smrt_job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_job']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_job']->value['id'] == $_smarty_tpl->tpl_vars['job']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['name'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>
        <select class="form-control es-select" name="user">
            <option value="">Select User</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'smrt_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_user']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_user']->value['id'] == $_smarty_tpl->tpl_vars['user']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['lname'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>
    </div>
</div>
<div class="row calendar-line-2">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">
        <select class="form-control es-select" name="view_equip_option">
            <option value="">Select View</option>
            <option value="user" <?php if ('user' == $_smarty_tpl->tpl_vars['view_equip_option']->value) {?> selected<?php }?>>View By User</option>
            <option value="job" <?php if ('job' == $_smarty_tpl->tpl_vars['view_equip_option']->value) {?> selected<?php }?>>View By Job</option>
            <option id="view_all" value="all" <?php if ('all' == $_smarty_tpl->tpl_vars['view_equip_option']->value) {?> selected<?php }?>>View All</option>
            <option id="view_single" value="single" <?php if ('single' == $_smarty_tpl->tpl_vars['view_equip_option']->value) {?> selected<?php }?>>View Individual</option>
        </select>
    </div>

    <div class="col-sm-3">
        <select class="form-control es-select" name="user_id" style="display: none;">
            <option value="">Select User</option>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'smrt_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_user']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_user']->value['id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['fname'];?>
 <?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['lname'];?>
</option>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>

        <select class="form-control es-select" name="job_id"  style="display: none;">
            <option value="">Select Job</option>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'smrt_job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_job']->value) {
?>
            <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_job']->value['id'] == $_smarty_tpl->tpl_vars['job_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['name'];?>
</option>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        </select>

        <select class="form-control es-select" name="equip_id" id="equipment" style="display: none;">
            <option value="0">Select Equipment</option>
            <?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipment']->value, 'equip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['equip']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
" class="equip_item cat<?php echo $_smarty_tpl->tpl_vars['equip']->value['cat_id'];?>
" ><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['name']);?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
        </select>
        <select class="form-control es-select" id="equipment_storage" style="display: none;">
            <option value="0">Select Equipment</option>
            <?php if ($_smarty_tpl->tpl_vars['equipment']->value) {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['equipment']->value, 'equip');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['equip']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['equip']->value['id'];?>
" class="equip_item cat<?php echo $_smarty_tpl->tpl_vars['equip']->value['cat_id'];?>
" ><?php echo stripslashes($_smarty_tpl->tpl_vars['equip']->value['name']);?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            <?php }?>
        </select>
    </div>

</div>
<div class="row calendar-line-3">
<div class="clr20"></div>
    <div class="col-sm-6 es-checkbox2">
        Do you want to narrow your selection by date range?
        
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="allow_date">Yes</label> <input type="radio" name="use_date" value="1" id="allow_date">
        &nbsp;&nbsp;&nbsp;&nbsp;<label for="deny_date">No</label> <input type="radio" name="use_date" value="0" id="deny_date">
    </div>
</div>
<div class="row calendar-line-4" >
<div class="clr20"></div>
    <div class="col-sm-2-5 es-checkbox">Start Date:</div>
    <div class="col-sm-3-5" style="padding-right: 0;">
        <input type="hidden" name="start_date" value="">
        <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date">
    </div>
    <div class="col-sm-2-5 es-checkbox">End Date:</div>
    <div class="col-sm-3-5" style="padding-right: 0;">
        <input type="hidden" name="end_date" value="">
        <input type="text" class="es-input form-control" id="end_date_formated" readonly value="" placeholder="End Date">
    </div>
</div>

<div class="row calendar-line-5">
<div class="clr20"></div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3" style="text-align: right;">
        <button class="btn btn-theme" type="submit">Submit</button>
    </div>
</div>
</form><?php }
}
