<?php
/* Smarty version 3.1.30, created on 2022-08-14 20:55:38
  from "/home/equipmen/public_html/templates/tasks.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62f9533ad35fb9_42672043',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '67003734f67b3a4f5b5a64bdf8748113a79b2d7e' => 
    array (
      0 => '/home/equipmen/public_html/templates/tasks.tpl',
      1 => 1642184630,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62f9533ad35fb9_42672043 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/task_calendar_scripts.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/zebra_datepicker.js"><?php echo '</script'; ?>
>

<?php echo '<script'; ?>
>

$(document).ready(function(){

    <?php if ($_smarty_tpl->tpl_vars['tasks']->value) {?>

        $('#example').dataTable( {
            "bLengthChange": false,
            "bFilter": false,
            "bInfo": false,
            "aoColumns": [
                null,
                null,
                null,
                null,
                { "bSortable": false }
            ],
            "sPaginationType": "full_numbers"
        } );
    <?php }?>

});
<?php echo '</script'; ?>
>


<div class="row">
    <div class="col-sm-12">
        <div class="subpadding20">
            <div class="clr20"></div>
            <div class="filter-section">
                <label class="mr-10">Filter Results</label>
                <div id="user_role_filter">
                    <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
tasks" onsubmit="return validate()">
                        <table>
                            <tr>
                                <td class="d-flex">
                                    <select class="form-control es-select w-200" name="datefilter" id="datefilter" required>
                                        <option value="this" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "this") {?> selected<?php }?>>This Week</option>
                                        <option value="next" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "next") {?> selected<?php }?>>Next Week</option>
                                        <option value="last" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "last") {?> selected<?php }?>>Last Week</option>
                                        <option value="range" <?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "range") {?> selected<?php }?>>Date Range</option>
                                    </select>
                                    <div class="calendar-line-4 filter-section ml-20" style="<?php if ($_smarty_tpl->tpl_vars['filters']->value['daterange'] == "range") {?>display: flex<?php } else { ?>display: none<?php }?>">
                                        <div>Start Date:</div>
                                        <div class="ml-10" style="padding-right: 0;">
                                            <input type="hidden" id="start_date" name="start_date" value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['start_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['start_date']);
}?>">
                                            <input type="text" class="es-input form-control" id="start_date_formated" readonly value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['start_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['start_date']);
}?>" placeholder="Start Date">
                                        </div>
                                        <div class="ml-20">End Date:</div>
                                        <div class="ml-10" style="padding-right: 0;">
                                            <input type="hidden" id="end_date" name="end_date" value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['end_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['end_date']);
}?>">
                                            <input type="text" class="es-input form-control" id="end_date_formated" readonly value="<?php if ($_smarty_tpl->tpl_vars['filters']->value['end_date'] != '') {
echo date("Y-m-d",$_smarty_tpl->tpl_vars['filters']->value['end_date']);
}?>" placeholder="End Date">
                                        </div>
                                    </div>
                                </td>
                                <td class="subpadding10"><button type="submit" class="btn btn-theme" style="display: inline-block">Submit</button></td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <table class="display table table-hover" id="example">
                <thead>
                    <tr>
                        <th class="es-th es-start">Jobs/Tasks</th>
                        <th class="es-th">Worker</th>
                        <th class="es-th">Start Date</th>
                        <th class="es-th">End Date</th>
                        <th class="es-th es-end text-center">Edit</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($_smarty_tpl->tpl_vars['tasks']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tasks']->value, 'task');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['task']->value) {
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['task']->value['name'];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['task']->value['user_id'];?>
</td>
                            <td><?php echo date('m-d-Y',strtotime($_smarty_tpl->tpl_vars['task']->value['start_date']));?>
</td>
                            <td><?php echo date('m-d-Y',strtotime($_smarty_tpl->tpl_vars['task']->value['end_date']));?>
</td>
                            <td class="text-center">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
assign-job/?id=<?php echo $_smarty_tpl->tpl_vars['task']->value['tid'];?>
">
                                    <img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/settings-icon.png" alt="Edit Task" />
                                </a>
                            </td>
                        </tr>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <?php } else { ?>
                    <tr><td colspan="2">Not match found.</td></tr>
                <?php }?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php }
}
