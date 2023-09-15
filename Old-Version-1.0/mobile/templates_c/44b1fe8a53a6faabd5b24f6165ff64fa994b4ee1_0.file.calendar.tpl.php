<?php
/* Smarty version 3.1.30, created on 2017-03-29 15:07:46
  from "/home/equipmen/public_html/mobile/templates/calendar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58dbbfb2625c60_49604039',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '44b1fe8a53a6faabd5b24f6165ff64fa994b4ee1' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/calendar.tpl',
      1 => 1490725873,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58dbbfb2625c60_49604039 (Smarty_Internal_Template $_smarty_tpl) {
?>
<input type="hidden" id="active_table" value="0">

<?php echo '<script'; ?>
 type='text/javascript'>

    var table_read_only = true;

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

<div class="calendar-content container">
    <div class="row">
        <div class="content-title col-xs-12">
            <input type="hidden" id="datepicker">
            <div class="datepicker_calendar_container"></div>
         </div>
    </div>
    <div class="row">
        <div class="clr20"></div>
        <center><a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
view-equipment"><button class="btn btn-login">Back</button></a></center>
    </div>
</div>


<?php }
}
