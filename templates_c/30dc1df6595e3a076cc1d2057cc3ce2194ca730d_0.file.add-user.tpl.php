<?php
/* Smarty version 3.1.30, created on 2022-08-25 20:30:17
  from "/home/equipmen/public_html/templates/add-user.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6307cdc99dfd50_08452155',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '30dc1df6595e3a076cc1d2057cc3ce2194ca730d' => 
    array (
      0 => '/home/equipmen/public_html/templates/add-user.tpl',
      1 => 1639977895,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6307cdc99dfd50_08452155 (Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
 type="text/javascript">
        jQuery(document).ready(function ($) {
            $('input[name=is_admin]').change(function () {
                if ($(this).is(':checked')) {
                    $('#password_line input').removeAttr('disabled', 'disabled');
                    $('#password_line').show();
                }
                else {
                    if($('input[name=is_proj_mgr]').prop("checked") == false) {
                        $('#password_line input').attr('disabled', 'disabled');
                        $('#password_line').hide();
                    }
                }
            }).change();

            $('input[name=is_proj_mgr]').change(function () {
                if ($(this).is(':checked')) {
                    $('#password_line input').removeAttr('disabled', 'disabled');
                    $('#password_line').show();
                }
                else {
                    if($('input[name=is_admin]').prop("checked") == false) {
                        $('#password_line input').attr('disabled', 'disabled');
                        $('#password_line').hide();
                    }
                }
            }).change();
        });
    <?php echo '</script'; ?>
>

<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading"><?php echo $_smarty_tpl->tpl_vars['pageName']->value;?>
</header>
            <div class="panel-body">
                <form method="post" action="">
                    <input type="hidden" name="user_id" value="<?php echo $_smarty_tpl->tpl_vars['user_id']->value;?>
">

                    <div class="clr10"></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Type First Name"
                                                 name="first_name" value="<?php echo $_smarty_tpl->tpl_vars['first_name']->value;?>
" required></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Type Last Name"
                                                 name="last_name" value="<?php echo $_smarty_tpl->tpl_vars['last_name']->value;?>
" required></div>
                    <div class="clr10"></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Create Username"
                                                 name="username" value="<?php echo $_smarty_tpl->tpl_vars['username']->value;?>
" required></div>

                    <div class="col-sm-12 es-checkbox">
                        <label>Please select the roles that apply:</label>
                        <div>
                            <label class="mr-10"><input type="checkbox" value="1" name="is_admin" <?php if ('admin' == $_smarty_tpl->tpl_vars['role']->value) {?> checked<?php }?>> Admin</label>
                            <label><input type="checkbox" value="1" name="is_proj_mgr" <?php if ('proj_mgr' == $_smarty_tpl->tpl_vars['role']->value) {?> checked<?php }?>> Project Manager</label>
                        </div>
                    </div>
                    <div id="password_line">
                        <div class="clr30"></div>
                        <div class="col-sm-6"><input type="text" class="form-control es-input"
                                                     placeholder="Create Password" name="password1"
                                                     value="<?php if ('admin' == $_smarty_tpl->tpl_vars['role']->value) {
echo $_smarty_tpl->tpl_vars['password1']->value;
}?>" required disabled>
                        </div>
                        <div class="col-sm-6"><input type="text" class="form-control es-input"
                                                     placeholder="Retype Password" name="password2"
                                                     value="<?php if ('admin' == $_smarty_tpl->tpl_vars['role']->value) {
echo $_smarty_tpl->tpl_vars['password2']->value;
}?>" required disabled>
                        </div>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary" type="button" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
users';">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save User"/>
                    </div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div><?php }
}
