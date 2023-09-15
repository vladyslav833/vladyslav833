<?php
/* Smarty version 3.1.30, created on 2017-07-07 18:24:24
  from "/home/equipmen/public_html/templates/add-job.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_595fc3c87ca848_91111242',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cc81d41d717a422c13d4879586eb3f1783204dac' => 
    array (
      0 => '/home/equipmen/public_html/templates/add-job.tpl',
      1 => 1396004644,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_595fc3c87ca848_91111242 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading"><?php echo $_smarty_tpl->tpl_vars['pageName']->value;?>
</header>
            <div class="panel-body">
            <form method="post" action="">
                <input type="hidden" name="job_id" value="<?php echo $_smarty_tpl->tpl_vars['job_id']->value;?>
">
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Name of Job" required name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
"></div>
			    <div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['adminUrl']->value;?>
jobs';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Job" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div><?php }
}
