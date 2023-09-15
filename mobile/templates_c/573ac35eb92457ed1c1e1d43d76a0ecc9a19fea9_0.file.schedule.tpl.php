<?php
/* Smarty version 3.1.30, created on 2021-12-22 20:30:50
  from "/home/equipmen/public_html/mobile/templates/schedule.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_61c38afaecbfd8_98119137',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '573ac35eb92457ed1c1e1d43d76a0ecc9a19fea9' => 
    array (
      0 => '/home/equipmen/public_html/mobile/templates/schedule.tpl',
      1 => 1640152446,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61c38afaecbfd8_98119137 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/schedule.js"><?php echo '</script'; ?>
>
<div class="view-reservation container">
    <div class="row">
        <div class="col-xs-12">
            <form id="schedule_form" method="POST" action="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
schedule">
                <input name="delta" id="delta" value="<?php echo $_smarty_tpl->tpl_vars['delta']->value;?>
" hidden>
                <div class="subpadding20 text-center">
                    <div class="clr30"></div>
                    <h2 class="white text-center bold">My Schedule</h2>
                    <h4 class="white text-center"><a class="prev-btn"><<</a> <?php echo $_smarty_tpl->tpl_vars['today']->value;?>
 <a class="next-btn">>></a></h4>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['sdata']->value, 'data');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['data']->value) {
?>
                    <div class="card-box">
                        <span class="card-date"><?php echo $_smarty_tpl->tpl_vars['data']->value['name'];?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['alert'] == 1) {?><span class="card-afp-name">ALERT! MUST WEAR AFP10 MASK!!!</span><?php }?>
                        <span class="card-task-name detail-align">Tasks: <?php echo $_smarty_tpl->tpl_vars['data']->value['description'];?>
</span>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['address1']) {?><span class="card-prj-name detail-align detail-font">Address:  <span style="font-weight: 500"><?php echo $_smarty_tpl->tpl_vars['data']->value['address1'];?>
</span></span><?php }?>
                        <span class="card-prj-name detail-align detail-font" style="padding-left: 95px"><?php if ($_smarty_tpl->tpl_vars['data']->value['city']) {
echo $_smarty_tpl->tpl_vars['data']->value['city'];
echo ",";
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['state']) {
echo $_smarty_tpl->tpl_vars['data']->value['state'];
}?> <?php if ($_smarty_tpl->tpl_vars['data']->value['zip']) {
echo $_smarty_tpl->tpl_vars['data']->value['zip'];
}?></span>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['notes']) {?><span class="card-prj-name detail-align detail-font">Project Notes:  <span style="font-weight: 500"><?php echo $_smarty_tpl->tpl_vars['data']->value['notes'];?>
</span></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['manager_name']) {?><span class="card-prj-name detail-align detail-font">Proj. Mgr:  <span style="font-weight: 500"><?php echo $_smarty_tpl->tpl_vars['data']->value['manager_name'];?>
</span></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['contact']) {?><span class="card-prj-name detail-align detail-font">On-site Contact Person:  <span style="font-weight: 500"><?php echo $_smarty_tpl->tpl_vars['data']->value['contact'];?>
</span></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['phone']) {?><span class="card-prj-name detail-align detail-font">Contact Person's #:  <span style="font-weight: 500"><?php echo $_smarty_tpl->tpl_vars['data']->value['phone'];?>
</span></span><?php }?>
                        <?php if ($_smarty_tpl->tpl_vars['data']->value['link']) {?>
                            <div class="file-action">
                                <button type="button" class="show-file" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
showFile" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
">VIEW PROJECT FILE</button>
                            </div>
                            <div class="project-file" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
projectFile">
                                <div class="preview-header">
                                    <span>Project Files</span>
                                    <img class="close-preview" src="<?php echo $_smarty_tpl->tpl_vars['siteUrl']->value;?>
img/close-preview.png" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
">
                                </div>
                                <div class="preview-section">
                                    <iframe src="<?php echo $_smarty_tpl->tpl_vars['data']->value['link'];?>
" class="preview-content">
                                        <p>Your browser does not support iframe</p>
                                    </iframe>
                                </div>
                                <div class="preview-footer"></div>
                            </div>
                        <?php }?>
                        <span class="card-notes border-round" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
notes" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
">ADD NOTES</span>
                        <div class="notes-section" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
noteSection">
                            <div class="note-header">NOTES</div>
                            <div class="notes-content">
                                <textarea rows="5" class="notes" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
noteContent"></textarea>
                            </div>
                            <div class="note-action">
                                <button class="btn btn-danger btn-lg btn-span cancel-btn" type="button" id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
Cancel" data-id="<?php echo $_smarty_tpl->tpl_vars['data']->value['tid'];?>
">CANCEL</button>
                                <button class="btn btn-success btn-lg btn-span" type="button">SAVE</button>
                            </div>
                        </div>
                    </div>
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
