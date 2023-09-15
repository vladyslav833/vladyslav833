<?php
/* Smarty version 3.1.30, created on 2023-03-14 17:39:50
  from "/home/equipmen/public_html/templates/gantt-diagram.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_6410b166dcb217_31587593',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3b7b82f69d8c5e7d2f58851ffdbd12625a2a3c30' => 
    array (
      0 => '/home/equipmen/public_html/templates/gantt-diagram.tpl',
      1 => 1639087549,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6410b166dcb217_31587593 (Smarty_Internal_Template $_smarty_tpl) {
?>

<?php if ($_smarty_tpl->tpl_vars['results']->value) {?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['homeUrl']->value;?>
js/gantt/jquery.fn.gantt.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">

    var colors = ['ganttRed','ganttGreen','ganttOrange',''];

    var result_source = [
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'timeline', false, 'index', 'gantt', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['timeline']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['total'];
?>

    <?php $_smarty_tpl->_assignInScope('temp_index', $_smarty_tpl->tpl_vars['index']->value-1);
?>

    <?php if ($_smarty_tpl->tpl_vars['results']->value[$_smarty_tpl->tpl_vars['temp_index']->value]) {?>
        <?php if ($_smarty_tpl->tpl_vars['results']->value[$_smarty_tpl->tpl_vars['temp_index']->value]['eid'] !== $_smarty_tpl->tpl_vars['timeline']->value['eid']) {?>
            <?php $_smarty_tpl->_assignInScope('indexColor', $_smarty_tpl->tpl_vars['indexColor']->value+1);
?>
            
            ]
        },
        {
        
            name: '<?php if ('category' !== $_smarty_tpl->tpl_vars['type']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
}
}?>',
            //name: '<?php if ('category' !== $_smarty_tpl->tpl_vars['type']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
}
}?>',
            values: [
        <?php }?>

             { 
                from: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['start_date'];?>
",
                to: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['end_date'];?>
",
                //label: "<?php if ('category' == $_smarty_tpl->tpl_vars['type']->value) {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
}
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
}?>",
                label: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];?>
",
                customClass: colors[<?php echo $_smarty_tpl->tpl_vars['indexColor']->value%4;?>
]+" data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
 bartitle"
             }, 

            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last'] : null)) {?>
            ]
        
        }
        
            <?php }?>

    <?php } else { ?>

        
        {
        
            name: '<?php if ('category' !== $_smarty_tpl->tpl_vars['type']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
}
}?>',
            //name: '<?php if ('category' !== $_smarty_tpl->tpl_vars['type']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
}
}?>',
            values: [
             { 
                from: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['start_date'];?>
",
                to: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['end_date'];?>
",
                //label: "<?php if ('category' == $_smarty_tpl->tpl_vars['type']->value) {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
}
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
}?>",
                label: "<?php echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];?>
",
                customClass: colors[<?php echo $_smarty_tpl->tpl_vars['indexColor']->value%4;?>
]+" data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
 bartitle"
             }, 
            <?php if ((isset($_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last'] : null)) {?>
            ]
        
        }
        
            <?php }?>
    <?php }?>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    ];


    $(document).ready(function(){
        $(".gantt").gantt({
            source: result_source,
            navigate: "scroll",
            maxScale: "days",
            itemsPerPage: 10,
            onRender: function(){

            
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['results']->value, 'timeline', false, 'index', 'gantt', array (
  'last' => true,
  'iteration' => true,
  'total' => true,
));
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['index']->value => $_smarty_tpl->tpl_vars['timeline']->value) {
$_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['iteration']++;
$_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['last'] = $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['iteration'] == $_smarty_tpl->tpl_vars['__smarty_foreach_gantt']->value['total'];
?>
                $('.bartitle.data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').attr('data-titlebar', true );
                // main title
                //$('.bartitle.data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').attr('data-title','<?php if ('category' == $_smarty_tpl->tpl_vars['type']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['equip_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
}?>');
                $('.bartitle.data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').attr('data-title','<?php echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];?>
');
                // tip text
                //$('.bartitle.data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').attr('title','<?php if ('category' == $_smarty_tpl->tpl_vars['type']->value) {
if ('user' == $_smarty_tpl->tpl_vars['veo']->value) {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['user_name'];
}
} else {
echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];
}?>');
                $('.bartitle.data<?php echo $_smarty_tpl->tpl_vars['index']->value;?>
').attr('title','<?php echo $_smarty_tpl->tpl_vars['timeline']->value['job_name'];?>
');
            <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

            

                bindQtip();
            }
        });

        function bindQtip(){
            $(".bartitle").qtip({
                content: {
                    text: function(event, api) {
                        return $(this).attr('title');
                    },
                    title: function(event, api) {
                        return $(this).attr('data-title');
                    }
                },
                position: {
                    my: 'bottom center',
                    at: 'top center',
                    target: 'event'
                },
                style: {
                    classes: 'qtip-bootstrap',
                }
                /*,
                show:{
                    event: 'hover',
                    solo: true
                },
                hide:{
                    event: 'click unfocus'
                }
                */
            });
        }
    });

<?php echo '</script'; ?>
>

<div class="gantt"></div>

<!--
<?php echo '<script'; ?>
 type="text/javascript">

var result_source2 = [


        {

            name: '1998 Ford Dump',
            values: [
             {
                from: "2014-03-05",
                to: "2014-03-06",
                label: "1998 Ford Dump",
                customClass: colors[0]+" data0 bartitle"
             },




        {

            name: '1998 Ford Dump',
            values: [
             {
                from: "2014-03-18",
                to: "2014-03-20",
                label: "1998 Ford Dump",
                customClass: colors[0]+" data1 bartitle"
             },
                        ]

        }

                        ];


<?php echo '</script'; ?>
>
-->

<?php } else { ?>

    No match found

<?php }
}
}
