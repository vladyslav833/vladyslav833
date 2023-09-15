<?php
/* Smarty version 3.1.30, created on 2022-08-19 19:34:43
  from "/home/equipmen/public_html/templates/assign-job.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_62ffd7c3dc9c28_05423227',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '944959541fbe1f866062dc2d82dee44243c7f9a6' => 
    array (
      0 => '/home/equipmen/public_html/templates/assign-job.tpl',
      1 => 1642184526,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_62ffd7c3dc9c28_05423227 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/assign-job.js"><?php echo '</script'; ?>
>

<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading"><?php echo $_smarty_tpl->tpl_vars['pageName']->value;?>
</header>
            <div class="panel-body">
                <?php if ($_smarty_tpl->tpl_vars['errors']->value) {?>
                    <div class="alert alert-danger">
                        <?php if (is_array($_smarty_tpl->tpl_vars['errors']->value)) {?>
                            <ul>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
?>
                                    <li><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</li>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                            </ul>
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->tpl_vars['errors']->value;?>

                        <?php }?>
                    </div>
                <?php }?>
                <form method="post" action="" onsubmit="return validateForm()">
                    <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
">
                    <input id="siteUrl" value="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
" hidden>
                    <div class="task-section">
                        <div class="clr10"></div>
                        <div class="col-sm-6">
                            <p class="text-primary fs-18 bold">Assign Job/Task to User</p>
                            <select class="form-control es-select" id="task_id" name="task_id" required>
                                <option value="0" <?php if (!$_smarty_tpl->tpl_vars['task_id']->value) {?> selected<?php }?>>Select Job</option>
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['job']->value) {
?>
                                    <option value="<?php echo $_smarty_tpl->tpl_vars['job']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['job']->value['id'] == $_smarty_tpl->tpl_vars['job_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['job']->value['name'];?>
</option>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                <option value="new" <?php if ($_smarty_tpl->tpl_vars['task_id']->value == "new") {?>selected<?php }?>>Small Job/Task --> Enter Name</option>
                            </select>
                        </div>
                        <div class="col-sm-6 <?php if ($_smarty_tpl->tpl_vars['task_id']->value != "new") {?>hide-dropdown<?php }?>" id="newJobName">
                            <p class="text-primary fs-18 bold">Enter Name</p>
                            <input class="form-control" id="newName" name="newName" value="<?php echo $_smarty_tpl->tpl_vars['newName']->value;?>
">
                        </div>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-12">
                        <p class="text-primary fs-18 bold">Select a start and end date</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-primary fs-18 bold">Start Date</label>
                        <input type="date" class="form-control start-date" id="start_date" name="start_date" value="<?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
">
                    </div>
                    <div class="col-sm-6">
                        <label class="text-primary fs-18 bold">End Date</label>
                        <input type="date" class="form-control end-date" id="end_date" name="end_date" value="<?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="user-section">
                        <div class="clr10"></div>
                        <div class="col-sm-12">
                            <p class="text-primary fs-18 bold">Assign Worker(s) to Job</p>
                            <div class="workers">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['workers']->value, 'worker');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['worker']->value) {
?>
                                    <?php if ($_smarty_tpl->tpl_vars['worker']->value != "0") {?>
                                        <div class="clr10"></div>
                                        <div class="d-flex worker-selection">
                                            <select class="form-control es-select worker" name="worker_id[]" required>
                                                <option value="0" <?php if (!$_smarty_tpl->tpl_vars['worker']->value) {?> selected<?php }?>>Select Worker</option>
                                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                                                    <option value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['worker']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</option>
                                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                            </select>
                                            <h4 class="delete-btn">DELETE</h4>
                                            <div class="errmsg-box">
                                            </div>
                                        </div>
                                    <?php }?>
                                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                <?php if (!$_smarty_tpl->tpl_vars['workers']->value || count($_smarty_tpl->tpl_vars['workers']->value) == 0) {?>
                                    <div class="d-flex worker-selection">
                                        <select class="form-control es-select worker" name="worker_id[]" required>
                                            <option value="0">Select Worker</option>
                                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                                                <option value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</option>
                                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                        </select>
                                        <h4 class="delete-btn">DELETE</h4>
                                        <div class="errmsg-box">
                                        </div>
                                    </div>
                                <?php }?>
                            </div>
                            <div class="clr10"></div>
                            <span class="btn btn-primary add-worker-btn"><img src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
img/reservation-icon.png">Add another worker to this job</span>
                            <div class="d-flex temp-section worker-selection">
                                <select class="form-control es-select worker hide-dropdown" name="worker_id[]">
                                    <option value="0" <?php if (!$_smarty_tpl->tpl_vars['worker_id']->value) {?> selected<?php }?>>Select Worker</option>
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['users']->value, 'user');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
?>
                                        <option value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['user']->value['id'] == $_smarty_tpl->tpl_vars['worker_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['user']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['user']->value['last_name'];?>
</option>
                                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                                </select>
                                <h4 class="delete-btn hide-dropdown">DELETE</h4>
                                <div class="errmsg-box">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12 es-checkbox">
                        <label class="mr-10 fs-18 bold text-primary"><input type="checkbox" name="hide_task" id="hide_task" <?php if ('1' == $_smarty_tpl->tpl_vars['hide_task']->value) {?> checked<?php }?>> Do Not Display on calendar or as Job Conflict</label>
                    </div>

                    <div class="col-sm-12 es-checkbox">
                        <label class="mr-10 fs-18 bold text-primary"><input type="checkbox" name="alert" id="alert_check" <?php if ('1' == $_smarty_tpl->tpl_vars['alert']->value) {?> checked<?php }?>> Include an Alert on this job/task?</label>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Enter Alert Text" name="alert_text" value="<?php echo $_smarty_tpl->tpl_vars['alert_text']->value;?>
" id="alert_text">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <p class="text-primary fs-18 bold">Enter task description or other useful information.</p>
                        <textarea class="form-control es-input" rows="5" placeholder="Enter Description Text" name="description"><?php echo $_smarty_tpl->tpl_vars['description']->value;?>
</textarea>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-danger" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
tasks';">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Assign Job"/></div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div><?php }
}
