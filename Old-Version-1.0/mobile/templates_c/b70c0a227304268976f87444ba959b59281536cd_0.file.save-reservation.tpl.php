<?php
/* Smarty version 3.1.30, created on 2017-03-29 11:21:46
  from "/home/equipmen/public_html/mobile/templates/save-reservation.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58db8aba968535_61310493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b70c0a227304268976f87444ba959b59281536cd' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/save-reservation.tpl',
      1 => 1490725876,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db8aba968535_61310493 (Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="save-reservation container">
    <div class="row">
        <div class="col-xs-12">
        <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
save-reservation">
            <div class="subpadding20">
                <div class="clr30"></div>
                <h3 class="std text-center">Confirm This Reservation</h3>
                <div class="clr20"></div>
                <div class="bold text-center"><?php echo $_smarty_tpl->tpl_vars['item_name']->value;?>
</div>
                <div class="text-center">Start Date: <?php echo $_smarty_tpl->tpl_vars['start_date']->value;?>
</div>
                <div class="text-center">End Date: <?php echo $_smarty_tpl->tpl_vars['end_date']->value;?>
</div>
                <div class="clr20"></div>
                <input type="hidden" name="reservation_id" value="<?php echo $_smarty_tpl->tpl_vars['reservation_id']->value;?>
">
                
                <select class="form-control es-select" name="job_id" required>
                    <option value="0">Select Job</option>
                    <?php if ($_smarty_tpl->tpl_vars['jobs']->value) {?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['jobs']->value, 'smrt_job');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['smrt_job']->value) {
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['smrt_job']->value['id'];?>
"><?php echo stripslashes($_smarty_tpl->tpl_vars['smrt_job']->value['name']);?>
</option>
                    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                    <?php }?>
                </select>
            </div>
            <div class="clr20"></div>
			<div class="col-xs-6"><button class="btn btn-danger btn-lg btn-span" onclick="window.location.replace(<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
calendar&cat_id=<?php echo $_smarty_tpl->tpl_vars['cat_id']->value;?>
&item_id=<?php echo $_smarty_tpl->tpl_vars['item_id']->value;?>
)">Cancel</button></div>
            <div class="col-xs-6 text-right"><button class="btn btn-success btn-lg btn-span" type="submit">Reserve</button></div>
        </form>
         </div>
    </div>
</div><?php }
}
