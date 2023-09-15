<?php
/* Smarty version 3.1.30, created on 2023-08-28 18:23:56
  from "/home/equipmen/public_html/templates/prj-calendar.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_64ecd82c2207f5_77638316',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78c8107f8482cc408eeea0e5da01efa85fc95c9f' => 
    array (
      0 => '/home/equipmen/public_html/templates/prj-calendar.tpl',
      1 => 1642703743,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_64ecd82c2207f5_77638316 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/prj_calendar_scripts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/zebra_datepicker.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

$(document).ready(function(){
    <?php if ($_smarty_tpl->tpl_vars['tasks']->value) {?>
    <?php }?>
});
let example = $('#calendar-table').dataTable( {
    "bLengtdChange": false,
    "bFilter": false,
    "bInfo": false,
    "sPaginationType": "full_numbers"
} );
<?php echo '</script'; ?>
>


<div class="row">
    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
prj-calendar" onsubmit="return validate()">
        <div class="col-sm-12">
            <div class="subpadding20">
                <div class="clr20"></div>
                <div class="filter-section">
                    <label class="mr-10 label-bold">Select a project to view</label>
                    <div id="user_role_filter">
                        <select class="form-control es-select w-200" name="prjselect" id="prjselect" required>
                            <option value="0" <?php if (!$_smarty_tpl->tpl_vars['filters']->value['prjselect']) {?> selected<?php }?>>Select Job</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['job']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['job']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['job']->value['id'] == $_smarty_tpl->tpl_vars['filters']->value['prjselect']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['job']->value['name'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="subpadding20">
                <div class="clr20"></div>
                <div class="filter-section">
                    <label class="mr-30 label-bold">Select the timeframe</label>
                    <div id="user_role_filter" class="d-flex">
                        <select class="form-control es-select w-200" name="datefilter" id="datefilter" required>
                            <option value="week" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "week") {?> selected<?php }?>>Current Week</option>
                            <option value="month" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "month") {?> selected<?php }?>>Current Month</option>
                            <option value="range" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "range") {?> selected<?php }?>>Date Range</option>
                        </select>
                        <div class="calendar-line-4 filter-section ml-20" style="<?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "range") {?>display: flex<?php } else { ?>display: none<?php }?>">
                            <div class="label-bold">Start Date:</div>
                            <div class="ml-10" style="padding-right: 0;">
                                <input type="hidden" id="start_date" name="start_date" value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['start_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['start_date']);
}?>">
                                <input type="text" class="es-input form-control" id="start_date_formated" readonly value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['start_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['start_date']);
}?>" placeholder="Start Date">
                            </div>
                            <div class="ml-20 label-bold">End Date:</div>
                            <div class="ml-10" style="padding-right: 0;">
                                <input type="hidden" id="end_date" name="end_date" value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['end_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['end_date']);
}?>">
                                <input type="text" class="es-input form-control" id="end_date_formated" readonly value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['end_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['end_date']);
}?>" placeholder="End Date">
                            </div>
                        </div>
                    </div>
                    <div class="subpadding10 mb-10"><button type="submit" class="btn btn-theme" style="display: inline-block">Submit</button></div>
                </div>
            </div>
        </div>
    </form>
    <div class="col-sm-12">
        <div class="subpadding20">
            <h2 class="prj-name" id="prj-name" name="prj-name" style="color: #003f6e;"><?php echo $_smarty_tpl->tpl_vars['selected_job']->value;?>
</h2>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
            <div class="calendar-table-wrap" style="display: <?php echo $_smarty_tpl->tpl_vars['selected_job']->value ? "block" : "none";?>
">
                <div class="table-content">
                    <?php if (count($_smarty_tpl->tpl_vars['workers']->value) > 0 || count($_smarty_tpl->tpl_vars['reservations']->value) > 0) {?>
                    <table class="display table cell-border table-bordered" id="calendar-table">
                        <tbody>
                            <tr class="text-bold">
                                <td class="hide-left-top-border headcol"></td>
                                <td colspan="<?php echo $_smarty_tpl->tpl_vars['filters']->value['difference_days'];?>
" class="hide-left-top-border hide-right-border"></td>
                            </tr>
                            <tr class="text-bold">
                                <td class="hide-left-top-border headcol"></td>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters']->value['month_headers'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                <td colspan="<?php echo $_smarty_tpl->tpl_vars['value']->value;?>
" class="text-center"><?php echo date("F Y ",strtotime($_smarty_tpl->tpl_vars['key']->value));?>
</td>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tr>
                            <tr class="text-bold">
                                <td class="hide-left-top-border headcol"></td>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters']->value['week_headers'], 'value', false, 'key');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <td colspan="<?php echo $_smarty_tpl->tpl_vars['value']->value['days'];?>
" class="text-center"><?php echo $_smarty_tpl->tpl_vars['value']->value['first_day'];?>
 - <?php echo $_smarty_tpl->tpl_vars['value']->value['last_day'];?>
</td>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tr>

                            <tr class="text-center text-bold">
                                <td class="gray-back category-cell headcol fs-18"><?php if (count($_smarty_tpl->tpl_vars['workers']->value) > 0) {?>Workers<?php }?></td>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['filters']->value['wname_headers'], 'value');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['value']->value) {
?>
                                    <td class="text-center text-uppercase"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</td>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </tr>
                            <?php if (count($_smarty_tpl->tpl_vars['workers']->value) > 0) {?>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['workers']->value, 'scheduleValue', false, 'key', 'workerarr', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['scheduleValue']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_workerarr']->value['index']++;
?>
                                <tr class="text-center">
                                    <td class="category-cell text-bold headcol fs-18"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</td>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['scheduleValue']->value, 'sValue');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sValue']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['sValue']->value == 1) {?>
                                            <td class="filled-cell-<?php echo fmod((isset($_smarty_tpl->tpl_vars['__smarty_foreach_workerarr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_workerarr']->value['index'] : null),4);?>
"></td>
                                        <?php } else { ?>
                                            <td></td>
                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                            <?php if (count($_smarty_tpl->tpl_vars['reservations']->value) > 0) {?>
                                <tr>
                                    <td class="text-left gray-back text-bold headcol fs-18">Equipment</td>
                                    <td colspan="<?php echo $_smarty_tpl->tpl_vars['filters']->value['difference_days'];?>
" class="text-left gray-back"></td>
                                </tr>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reservations']->value, 'scheduleValue', false, 'key', 'eqarr', array (
  'index' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['scheduleValue']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_eqarr']->value['index']++;
?>
                                <tr class="text-center">
                                    <td class="category-cell headcol"><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</td>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['scheduleValue']->value, 'sValue');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['sValue']->value) {
?>
                                        <?php if ($_smarty_tpl->tpl_vars['sValue']->value == 1) {?>
                                            <td class="eq-filled-cell-<?php echo fmod((isset($_smarty_tpl->tpl_vars['__smarty_foreach_eqarr']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_eqarr']->value['index'] : null),4);?>
"></td>
                                        <?php } else { ?>
                                            <td></td>
                                        <?php }?>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </tr>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            <?php }?>
                        </tbody>
                    </table>
                    <?php } else { ?>
                        <h3>There are no workers and equipment reserved for the time period.</h3>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php }
}
