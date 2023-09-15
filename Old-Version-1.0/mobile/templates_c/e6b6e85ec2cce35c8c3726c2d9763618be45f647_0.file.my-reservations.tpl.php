<?php
/* Smarty version 3.1.30, created on 2017-03-29 11:21:54
  from "/home/equipmen/public_html/mobile/templates/my-reservations.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_58db8ac2471bb0_36422871',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6b6e85ec2cce35c8c3726c2d9763618be45f647' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/my-reservations.tpl',
      1 => 1490725876,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_58db8ac2471bb0_36422871 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function($){
        $('.confirm').click(function(){
            return confirm('Do you really want to delete this reservation?');
        });
    });
<?php echo '</script'; ?>
>

<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20">
                <div class="clr30"></div>
                <div class="view-reservation-header">
                    <h3 class="std white text-center">My Reservations</h3>
                </div>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['reservations']->value, 'res_item', false, NULL, 'reserv', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['res_item']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['total'];
?>
				<div class="reservation-box <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_reserv']->value['last'] : null)) {?> radius-bottom<?php }?>">
                    <table width="100%" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="reservation-left">
                                <div class="bold"><?php echo stripslashes($_smarty_tpl->tpl_vars['res_item']->value['equipment_name']);?>
</div>
                                <div>Start Date: <?php echo $_smarty_tpl->tpl_vars['res_item']->value['start_date'];?>
</div>
                                <div>End Date: <?php echo $_smarty_tpl->tpl_vars['res_item']->value['end_date'];?>
</div>
                                <div>Job: <?php echo stripslashes($_smarty_tpl->tpl_vars['res_item']->value['job_name']);?>
</div>
                            </td>
                            <td valign="middle" align="center" class="reservation-right">
                                <a href="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
cancel-reservation?id=<?php echo $_smarty_tpl->tpl_vars['res_item']->value['id'];?>
" class="confirm"><img src="img/mark-btn.png" alt="Mark" width="40" /></a>
                            </td>
                        </tr>
                    </table>
                    
                    <div class="clearfix"></div>
                </div>
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            </div>
         </div>

    </div>
</div><?php }
}
