<?php
/* Smarty version 3.1.30, created on 2023-06-28 07:34:52
  from "/home/equipmen/public_html/templates/reserv-equipment.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_649bd48c5e2484_27652888',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1afc9c215b16a1cbcffdc092fd80c280926a476b' => 
    array (
      0 => '/home/equipmen/public_html/templates/reserv-equipment.tpl',
      1 => 1639087550,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_649bd48c5e2484_27652888 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type='text/javascript'>

    var reservations = [
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reservations']->value, 'reserv', false, NULL, 'reservations', array (
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['reserv']->value) {
?>
         { 
            'start' :   '<?php echo $_smarty_tpl->tpl_vars['reserv']->value['start_date'];?>
',
            'end'   :   '<?php echo $_smarty_tpl->tpl_vars['reserv']->value['end_date'];?>
',
            'name'  :   '<?php echo htmlspecialchars_decode(stripslashes($_smarty_tpl->tpl_vars['reserv']->value['first_name']));?>
 <?php echo htmlspecialchars_decode(stripslashes($_smarty_tpl->tpl_vars['reserv']->value['last_name']));?>
',
            'job'   :   '<?php echo htmlspecialchars_decode(stripslashes($_smarty_tpl->tpl_vars['reserv']->value['job_name']));?>
'
         }, 
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    ];

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/view-equipment.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/zebra_datepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/calendar_scripts.js"><?php echo '</script'; ?>
>

<form action="" method="post">

<input type="hidden" id="start_date" name="start_date" value="0">
<input type="hidden" id="end_date" name="end_date" value="0">
<input type="hidden" id="active_table" value="1">

<div class="row" style="width: 550px; margin-left: 0px; float: left;">
<?php if (!$_smarty_tpl->tpl_vars['make_reservation']->value) {?>
    <div class="row">
        <input type="hidden" name="equip_id" value="<?php echo $_smarty_tpl->tpl_vars['equipment']->value['id'];?>
">
        <div class="content-title col-xs-12">You are viewing: <b>Equipment / <?php echo stripslashes($_smarty_tpl->tpl_vars['category']->value);?>
 / <?php echo stripslashes($_smarty_tpl->tpl_vars['equipment']->value['name']);?>
</b></div>
        <div class="clr5"></div>
    </div>
    <div class="row">
        <div class="content-title col-xs-12">Please select the dated you wish to reserve this equipment for.</div>
        <div class="clr20"></div>
    </div>
    <div class="row">
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Start Date:</div>
        <div class="col-xs-3"> <!--style="padding-right: 1px;">-->
            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date" style="padding: 6px;">
        </div>
        <div class="col-xs-2 es-checkbox" style="padding-left: 1px;">End Date:</div>
        <div class="col-xs-3"> <!--style="padding-left: 1px;">-->
            <input type="text" class="es-input form-control" id="end_date_formated" readonly  value="" placeholder="End Date" style="padding: 6px;">
        </div>
    </div>


    <div class="row" id="save_reservation">
        <div class="clr20"></div>
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Select User:</div>
        <div class="col-xs-5">
            <select class="form-control es-select" name="user_id" id="user" required>
                <option value="">Select User</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'smrt_user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_user']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_user']->value['id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['smrt_user']->value['last_name'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </div>
    </div>

    <div class="row" id="job_reservation" style="display: none;">
        <div class="clr20"></div>
        <div class="col-xs-2 es-checkbox" style="padding-right: 1px;">Select Job:</div>
        <div class="col-xs-5">
            <select class="form-control es-select" name="job_id" id="job" required>
                <option value="">Select Job</option>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'smrt_job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_job']->value) {
?>
                <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['smrt_job']->value['id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['name'];?>
</option>
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </select>
        </div>

        <div class="col-xs-3" id="submit_line" style="display: none;">
            <button class="btn btn-login" type="submit">Reserve</button>
        </div>

    </div>

    <div class="clr20"></div>

    <div class="row">
        <div class="clr20"></div>
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
    <div class="clr20"></div>


<?php } else { ?>

    <input type="hidden" name="make_reservation" value="1">

    <div class="row">
        <div class="content-title col-xs-12">Select the equipment you want to reserve</div>
        <div class="clr10"></div>
    </div>

    <div class="row">
        <div class="content-title col-xs-9">
            <select class="form-control es-select" name="category" id="category">
                <option value="0">Select Category</option>
                <?php if ($_smarty_tpl->tpl_vars['categories']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categories']->value, 'cat');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->value) {
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['cat']->value['id'];?>
"><?php echo stripslashes($_smarty_tpl->tpl_vars['cat']->value['name']);?>
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
    <div class="clr20"></div>
    <div class="row" id="step2" style="display: none;">
        <div class="content-title col-xs-9">
            <select class="form-control es-select" name="equip_id" id="equipment">
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
        <div class="clr10"></div>
    </div>

    <div class="row" id="step3" style="display: none;">
        <div class="col-xs-3">
            <button class="btn btn-theme" type="submit">View Calendar</button>
        </div>
    </div>
<?php }?>
</div>
</form><?php }
}
