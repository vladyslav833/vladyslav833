<?php
/* Smarty version 3.1.30, created on 2022-08-25 12:27:21
  from "/home/equipmen/public_html/templates/add-job.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_63075c9900f852_58559570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc81d41d717a422c13d4879586eb3f1783204dac' => 
    array (
      0 => '/home/equipmen/public_html/templates/add-job.tpl',
      1 => 1640109452,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_63075c9900f852_58559570 (Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
 type="text/javascript">
        jQuery(document).ready(function($){
            $('.cancel-btn').click(function(){
                var dataLink = $(this).data("link");
                if(dataLink)
                    window.location.href = dataLink;
            });
        });
    <?php echo '</script'; ?>
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
                <form method="post" action="">
                    <input type="hidden" name="job_id" value="<?php echo $_smarty_tpl->tpl_vars['job_id']->value;?>
">

                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Project Name (Required)" required name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control es-input" placeholder="Job #" name="job_num" value="<?php echo $_smarty_tpl->tpl_vars['job_num']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-6">
                        <label>Status (Required):</label>
                        <select class="form-control es-select" name="status" required>
                            <option value="0" <?php if ($_smarty_tpl->tpl_vars['status']->value == "0") {?> selected<?php }?>>Select Status</option>
                            <option value="1" <?php if ($_smarty_tpl->tpl_vars['status']->value == "1") {?> selected<?php }?>>Current Project</option>
                            <option value="2" <?php if ($_smarty_tpl->tpl_vars['status']->value == "2") {?> selected<?php }?>>Archived</option>
                        </select>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-6">
                        <label>Project Manager (Required):</label>
                        <select class="form-control es-select" name="mgr_id" required>
                            <option value="0" <?php if (!$_smarty_tpl->tpl_vars['mgr_id']->value && !$_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>>Select Manager</option>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['managers']->value, 'mgr');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['mgr']->value) {
?>
                                <option value="<?php echo $_smarty_tpl->tpl_vars['mgr']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['mgr']->value['id'] == $_smarty_tpl->tpl_vars['mgr_id']->value || $_smarty_tpl->tpl_vars['mgr']->value['id'] == $_smarty_tpl->tpl_vars['user_id']->value) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['mgr']->value['first_name'];?>
 <?php echo $_smarty_tpl->tpl_vars['mgr']->value['last_name'];?>
</option>
                            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        </select>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Location" name="location" value="<?php echo $_smarty_tpl->tpl_vars['location']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Address" name="address1" value="<?php echo $_smarty_tpl->tpl_vars['address1']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Address" name="address2" value="<?php echo $_smarty_tpl->tpl_vars['address2']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="City" name="city" value="<?php echo $_smarty_tpl->tpl_vars['city']->value;?>
">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="State" name="state" value="<?php echo $_smarty_tpl->tpl_vars['state']->value;?>
">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="Zip" name="zip" value="<?php echo $_smarty_tpl->tpl_vars['zip']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Google folder link" name="link" value="<?php echo $_smarty_tpl->tpl_vars['link']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="On-Site contact person" name="contact" value="<?php echo $_smarty_tpl->tpl_vars['contact']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Contact person's phone" name="phone" value="<?php echo $_smarty_tpl->tpl_vars['phone']->value;?>
">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <textarea class="form-control es-input" rows="5" placeholder="Notes" name="notes"><?php echo $_smarty_tpl->tpl_vars['notes']->value;?>
</textarea>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary cancel-btn" type="button" data-link="<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
jobs">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Project"/></div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div><?php }
}
