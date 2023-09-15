<?php
/* Smarty version 3.1.30, created on 2021-12-22 20:30:30
  from "/home/equipmen/public_html/mobile/templates/timecard.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61c38ae6e2f666_17881707',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd321b727aa7372ae2885d6c98e72e2cf007a51fd' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/timecard.tpl',
      1 => 1640203474,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61c38ae6e2f666_17881707 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php echo '<script'; ?>
>
    jQuery(document).ready(function($){
        $('.card-edit').click(function(){
            var id = $(this).attr('data-id');
            var last_week = $(this).attr('data-last');
            if(last_week != "")
                window.location = 'add-entry?add=last&id=' + id;
            else
                window.location = 'add-entry?id=' + id;
        });
    });
<?php echo '</script'; ?>
>

<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <div class="subpadding20 text-center">
                <div class="clr30"></div>
                <h2 class="white text-center bold">This Week's Timecard</h2>
                <h4 class="white text-center"><?php echo $_smarty_tpl->tpl_vars['sunday']->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['saturday']->value;?>
</h4>
                <h4 class="white text-center bold mb-20">Hours To Date: <?php echo $_smarty_tpl->tpl_vars['total_hours']->value;?>
</h4>
                <?php if ($_smarty_tpl->tpl_vars['canedit']->value && $_smarty_tpl->tpl_vars['lastedit']->value) {?>
                    <a class="can-edit" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
timecard?add=last">You can still edit last week's timecard</a>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['last_week']->value != '') {?>
                    <a class="add-entry-btn" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
add-entry?add=last">Add Entry</a>
                <?php } else { ?>
                    <a class="add-entry-btn" href="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
add-entry">Add Entry</a>
                <?php }?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['tdata']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                    <?php if ($_smarty_tpl->tpl_vars['data']->value['mask_req'] == 1) {?>
                        <div class="card-box">
                            <span class="card-date"><?php echo $_smarty_tpl->tpl_vars['data']->value['date_time'];?>
</span>
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['job_id'] != 0) {?>
                                <span class="card-afp-name"><?php echo $_smarty_tpl->tpl_vars['data']->value['job_title'];?>
 - AFP MASK REQUIRED</span>
                            <?php } else { ?>
                                <span class="card-afp-name"><?php echo $_smarty_tpl->tpl_vars['data']->value['job_name'];?>
 - AFP MASK REQUIRED</span>
                            <?php }?>
                            <span class="card-task-name">Tasks: <?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</span>
                            <span class="card-total-hours">Total Time: <?php echo floor($_smarty_tpl->tpl_vars['data']->value['time_worked']);?>
 Hours <?php echo ($_smarty_tpl->tpl_vars['data']->value['time_worked']-floor($_smarty_tpl->tpl_vars['data']->value['time_worked']))*60;?>
 Minutes<?php if ($_smarty_tpl->tpl_vars['data']->value['finalize'] == 0) {?><span class="card-edit" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-last="<?php echo $_smarty_tpl->tpl_vars['last_week']->value;?>
">EDIT</span><?php }?></span>
                        </div>
                    <?php } else { ?>
                        <div class="card-box">
                            <span class="card-date"><?php echo $_smarty_tpl->tpl_vars['data']->value['date_time'];?>
</span>
                            <span class="card-prj-name"><?php if ($_smarty_tpl->tpl_vars['data']->value['job_id'] == 0) {
echo $_smarty_tpl->tpl_vars['data']->value['job_name'];
} else {
echo $_smarty_tpl->tpl_vars['data']->value['job_title'];
}?></span>
                            <span class="card-task-name">Tasks: <?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</span>
                            <span class="card-total-hours">Total Time: <?php echo floor($_smarty_tpl->tpl_vars['data']->value['time_worked']);?>
 Hours <?php echo ($_smarty_tpl->tpl_vars['data']->value['time_worked']-floor($_smarty_tpl->tpl_vars['data']->value['time_worked']))*60;?>
 Minutes<?php if ($_smarty_tpl->tpl_vars['data']->value['finalize'] == 0) {?><span class="card-edit" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['id'];?>
" data-last="<?php echo $_smarty_tpl->tpl_vars['last_week']->value;?>
">EDIT</span><?php }?></span>
                        </div>
                    <?php }?>
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
