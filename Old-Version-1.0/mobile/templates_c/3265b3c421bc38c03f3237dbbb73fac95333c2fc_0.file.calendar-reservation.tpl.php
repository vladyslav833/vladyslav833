<?php
/* Smarty version 3.1.30, created on 2017-03-29 11:21:43
  from "/home/equipmen/public_html/mobile/templates/calendar-reservation.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58db8ab7475d45_10519149',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3265b3c421bc38c03f3237dbbb73fac95333c2fc' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/calendar-reservation.tpl',
      1 => 1490725870,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db8ab7475d45_10519149 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type='text/javascript'>

    var reservations = [
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reservations']->value, 'reserv', false, NULL, 'reservations', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['reserv']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['total'];
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
         } <?php if (!(isset($_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_reservations']->value['last'] : null)) {?>,<?php }?>
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
js/zebra_datepicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/calendar_scripts.js"><?php echo '</script'; ?>
>

<div class="header-title container">
    <div class="row">
        <div class="col-xs-3"><button class="btn btn-login btn-block" onclick="window.history.back()">Back</button></div>
        <div class="col-xs-9"><h4 class="white text-center"><?php echo stripslashes($_smarty_tpl->tpl_vars['item']->value['name']);?>
</h4></div>
        <div class="clearfix"></div>
    </div>
</div>

<form action="" method="post">

<input type="hidden" id="start_date" name="start_date" value="0">
<input type="hidden" id="end_date" name="end_date" value="0">
<input type="hidden" name="equipment" value="<?php echo $_smarty_tpl->tpl_vars['equipment_id']->value;?>
">
<input type="hidden" id="active_table" value="1">

<div class="calendar-content container">
    <div class="row">
        <div class="content-title col-xs-12">Please select your dates.</div>
    </div>
    <div class="row">
        <div class="col-xs-4" style="padding-right: 1px;">
            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="" placeholder="Start Date" style="padding: 6px;">
        </div>
        <div class="col-xs-4" style="padding-left: 1px;">
            <input type="text" class="es-input form-control" id="end_date_formated" readonly  value="" placeholder="End Date" style="padding: 6px;">
        </div>
        <div class="col-xs-4"><button class="btn btn-login btn-block" type="submit" id="save_reservation" style="display: none;">Reserve</button></div>
    </div>
    <div class="clr20"></div>
    <div class="row">
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
</div>
</form><?php }
}
