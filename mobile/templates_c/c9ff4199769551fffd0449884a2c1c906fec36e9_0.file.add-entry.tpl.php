<?php
/* Smarty version 3.1.30, created on 2022-01-14 21:46:40
  from "/home/equipmen/public_html/mobile/templates/add-entry.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61e1ef406edf72_75213686',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9ff4199769551fffd0449884a2c1c906fec36e9' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/add-entry.tpl',
      1 => 1642184429,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61e1ef406edf72_75213686 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function($){
        $("#afp-check").change(function() {
            if ($(this).prop('checked')==true){
                $('.mask-time').removeClass("hide-mask-time").addClass("show-mask-time");
            } else {
                $('.mask-time').removeClass("show-mask-time").addClass("hide-mask-time");
            }
        });
    });

    function checkValid(){
        var hours = document.getElementById("hours").value;
        var mins = document.getElementById("mins").value;
        var mhours = document.getElementById("mhours").value;
        var mmins = document.getElementById("mmins").value;
        var afpCheck = document.getElementById("afp-check");
        if(afpCheck.checked == true) {
            if(mhours == "") {
                alert("Please add mask hours");
                return false;
            }
            if(mmins == "") {
                alert("Please add mask minutes");
                return false;
            }
            if(mhours == "0" && mmins == "0") {
                alert("Please add spent hours and mins");
                return false;
            }
        } else {
            if(hours == "") {
                alert("Please add worked hours");
                return false;
            }
            if(mins == "") {
                alert("Please add worked minutes");
                return false;
            }
            if(hours == "0" && mins == "0") {
                alert("Please add spent hours and mins");
                return false;
            }
        }

        var jobId = document.getElementById("job").value;
        if(!jobId || jobId == "") {
            alert("Please select job");
            return false;
        }

        return true;
    }
<?php echo '</script'; ?>
>

<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="clr30"></div>
            <h2 class="white text-center bold"><?php if ($_smarty_tpl->tpl_vars['last_week']->value == "last") {?>Last Week's Timecard<?php } else { ?>This Week's Timecard<?php }?></h2>
            <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
add-entry" onsubmit="return checkValid()">
                <input type="hidden" id="entry_id" name="entry_id" value="<?php echo $_smarty_tpl->tpl_vars['entry_id']->value;?>
">
                <input type="hidden" id="last_week" name="last_week" value="<?php echo $_smarty_tpl->tpl_vars['last_week']->value;?>
">
                <div class="timecard-detail-box">
                    <span class="select-job-label">Select Job</span>
                    <select class="form-control" name="job" id="job" required>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['task_list']->value, 'task');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['task']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['task']->value['job_id'];?>
" <?php if ($_smarty_tpl->tpl_vars['job_id']->value == $_smarty_tpl->tpl_vars['task']->value['job_id']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['task']->value['name'];?>
</option>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    </select>
                    <textarea placeholder="Enter Job/Task Description Here" id="job-desc" name="job-desc" class="form-control job-desc" rows="3"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
                    <span class="afp-check">
                        <input type="checkbox" class="afp-checkbox" id="afp-check" name="afp-check" <?php if ($_smarty_tpl->tpl_vars['mask_req']->value == 1) {?>checked<?php }?>>
                        Was an AFP 10 Mask Required?</span>
                    <div class="enter-date">
                        <span class="date-label">Enter Date</span>
                        <select class="form-control" id="timestamp" name="timestamp">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['week_days']->value, 'weekday');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['weekday']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['weekday']->value['value'];?>
" <?php if ($_smarty_tpl->tpl_vars['timestamp']->value == $_smarty_tpl->tpl_vars['weekday']->value['value']) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['weekday']->value['time_string'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </select>
                    </div>
                    <div class="enter-time">
                        <span class="time-label">Enter Job Time</span>
                        <select class="form-control" id="hours" name="hours">
                            <option value="h">Hrs</option>
                            <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 12+1 - (0) : 0-(12)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 0, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" <?php if (floor($_smarty_tpl->tpl_vars['time_worked']->value) == $_smarty_tpl->tpl_vars['index']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</option>
                            <?php }
}
?>

                        </select>
                        <select class="form-control" id="mins" name="mins">
                            <option value="m">Min</option>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['time_worked']->value-floor($_smarty_tpl->tpl_vars['time_worked']->value) == 0) {?>selected<?php }?>>00</option>
                            <option value="15" <?php if ($_smarty_tpl->tpl_vars['time_worked']->value-floor($_smarty_tpl->tpl_vars['time_worked']->value) == 0.25) {?>selected<?php }?>>15</option>
                            <option value="30" <?php if ($_smarty_tpl->tpl_vars['time_worked']->value-floor($_smarty_tpl->tpl_vars['time_worked']->value) == 0.5) {?>selected<?php }?>>30</option>
                            <option value="45" <?php if ($_smarty_tpl->tpl_vars['time_worked']->value-floor($_smarty_tpl->tpl_vars['time_worked']->value) == 0.75) {?>selected<?php }?>>45</option>
                        </select>
                    </div>
                    <div class="enter-time mask-time <?php if ($_smarty_tpl->tpl_vars['mask_req']->value == 1) {?>show-mask-time<?php } else { ?>hide-mask-time<?php }?>">
                        <span class="time-label">Enter Mask Time</span>
                        <select class="form-control" id="mhours" name="mhours">
                            <option value="hh">Hrs</option>
                            <?php
$_smarty_tpl->tpl_vars['index'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['index']->step = 1;$_smarty_tpl->tpl_vars['index']->total = (int) ceil(($_smarty_tpl->tpl_vars['index']->step > 0 ? 12+1 - (0) : 0-(12)+1)/abs($_smarty_tpl->tpl_vars['index']->step));
if ($_smarty_tpl->tpl_vars['index']->total > 0) {
for ($_smarty_tpl->tpl_vars['index']->value = 0, $_smarty_tpl->tpl_vars['index']->iteration = 1;$_smarty_tpl->tpl_vars['index']->iteration <= $_smarty_tpl->tpl_vars['index']->total;$_smarty_tpl->tpl_vars['index']->value += $_smarty_tpl->tpl_vars['index']->step, $_smarty_tpl->tpl_vars['index']->iteration++) {
$_smarty_tpl->tpl_vars['index']->first = $_smarty_tpl->tpl_vars['index']->iteration == 1;$_smarty_tpl->tpl_vars['index']->last = $_smarty_tpl->tpl_vars['index']->iteration == $_smarty_tpl->tpl_vars['index']->total;?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
" <?php if (floor($_smarty_tpl->tpl_vars['mask_time_worked']->value) == $_smarty_tpl->tpl_vars['index']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['index']->value;?>
</option>
                            <?php }
}
?>

                        </select>
                        <select class="form-control" id="mmins" name="mmins">
                            <option value="mm">Min</option>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['mask_time_worked']->value-floor($_smarty_tpl->tpl_vars['mask_time_worked']->value) == 0) {?>selected<?php }?>>00</option>
                            <option value="15" <?php if ($_smarty_tpl->tpl_vars['mask_time_worked']->value-floor($_smarty_tpl->tpl_vars['mask_time_worked']->value) == 0.25) {?>selected<?php }?>>15</option>
                            <option value="30" <?php if ($_smarty_tpl->tpl_vars['mask_time_worked']->value-floor($_smarty_tpl->tpl_vars['mask_time_worked']->value) == 0.5) {?>selected<?php }?>>30</option>
                            <option value="45" <?php if ($_smarty_tpl->tpl_vars['mask_time_worked']->value-floor($_smarty_tpl->tpl_vars['mask_time_worked']->value) == 0.75) {?>selected<?php }?>>45</option>
                        </select>
                    </div>
                    <div class="entry-action">
                        <a class="btn btn-danger btn-lg btn-span" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
timecard<?php if ($_smarty_tpl->tpl_vars['last_week']->value == "last") {?>?add=last<?php }?>">Cancel</a>
                        <button class="btn btn-success btn-lg btn-span" type="submit">Submit</button>
                    </div>
                </div>
            </form>
         </div>
    </div>
</div><?php }
}
