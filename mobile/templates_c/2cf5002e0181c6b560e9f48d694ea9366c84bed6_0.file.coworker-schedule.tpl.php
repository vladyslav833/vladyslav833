<?php
/* Smarty version 3.1.30, created on 2021-12-17 01:23:16
  from "/home/equipmen/public_html/mobile/templates/coworker-schedule.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61bbe68432ae58_28048563',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2cf5002e0181c6b560e9f48d694ea9366c84bed6' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/coworker-schedule.tpl',
      1 => 1639087494,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61bbe68432ae58_28048563 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/schedule.js"><?php echo '</script'; ?>
>
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <form id="schedule_form" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
coworker-schedule">
                <input name="delta" id="delta" value="<?php echo $_smarty_tpl->tpl_vars['delta']->value;?>
" hidden>
                <div class="subpadding20 text-center">
                    <div class="clr30"></div>
                    <h3 class="white text-center bold">Co-Worker Schedule</h3>
                    <h4 class="white text-center"><a class="prev-btn"><<</a> <?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 <a class="next-btn">>></a></h4>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sdata']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                        <?php $_smarty_tpl->_assignInScope('cardname', "grey-card");
?>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value, 'udata');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['udata']->value) {
?>
                            <?php if ($_smarty_tpl->tpl_vars['cardname']->value == "grey-card") {?>
                                <?php $_smarty_tpl->_assignInScope('cardname', "white-card");
?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->_assignInScope('cardname', "grey-card");
?>
                            <?php }?>
                            <div class="card-box text-center">
                                <span class="card-date"><?php echo $_smarty_tpl->tpl_vars['udata']->value['user_name'];?>
</span>
                                <span class="card-task-name <?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
 detail-font"><?php echo $_smarty_tpl->tpl_vars['udata']->value['name'];?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['udata']->value['address1']) {?><span class="card-task-name <?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['udata']->value['address1'];?>
</span><?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['udata']->value['city'] && $_smarty_tpl->tpl_vars['udata']->value['state']) {?><span class="card-task-name <?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['udata']->value['city'];?>
, <?php echo $_smarty_tpl->tpl_vars['udata']->value['state'];?>
 <?php echo $_smarty_tpl->tpl_vars['udata']->value['zip'];?>
</span><?php }?>
                                <span class="card-prj-name <?php echo $_smarty_tpl->tpl_vars['cardname']->value;?>
 border-round"></span>
                            </div>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                </div>
            </form>
        </div>
    </div>
</div><?php }
}
