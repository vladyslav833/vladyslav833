
{if $results}

<script type="text/javascript" src="{$homeUrl}js/gantt/jquery.fn.gantt.js"></script>
<script type="text/javascript">{*</script>*}

    var colors = ['ganttRed','ganttGreen','ganttOrange',''];

    var result_source = [
    {foreach from=$results item=timeline name=gantt key=index}

    {assign var=temp_index value=$index-1}

    {if $results[$temp_index]}
        {if $results[$temp_index].eid !== $timeline.eid }
            {assign var="indexColor" value=$indexColor+1}
            {literal}
            ]
        },
        {
        {/literal}
            name: '{if 'category' !== $type}{$timeline.equip_name}{else}{if 'user' == $veo}{$timeline.equip_name}{else}{$timeline.equip_name}{/if}{/if}',
            //name: '{if 'category' !== $type}{$timeline.equip_name}{else}{if 'user' == $veo}{$timeline.user_name}{else}{$timeline.job_name}{/if}{/if}',
            values: [
        {/if}

            {literal} { {/literal}
                from: "{$timeline.start_date}",
                to: "{$timeline.end_date}",
                //label: "{if 'category' == $type}{if 'user' == $veo}{$timeline.job_name}{else}{$timeline.user_name}{/if}{else}{$timeline.equip_name}{/if}",
                label: "{$timeline.user_name}",
                customClass: colors[{$indexColor % 4}]+" data{$index} bartitle"
            {literal} }, {/literal}

            {if $smarty.foreach.gantt.last}
            ]
        {literal}
        }
        {/literal}
            {/if}

    {else}

        {literal}
        {
        {/literal}
            name: '{if 'category' !== $type}{$timeline.equip_name}{else}{if 'user' == $veo}{$timeline.equip_name}{else}{$timeline.equip_name}{/if}{/if}',
            //name: '{if 'category' !== $type}{$timeline.equip_name}{else}{if 'user' == $veo}{$timeline.user_name}{else}{$timeline.job_name}{/if}{/if}',
            values: [
            {literal} { {/literal}
                from: "{$timeline.start_date}",
                to: "{$timeline.end_date}",
                //label: "{if 'category' == $type}{if 'user' == $veo}{$timeline.job_name}{else}{$timeline.user_name}{/if}{else}{$timeline.equip_name}{/if}",
                label: "{$timeline.user_name}",
                customClass: colors[{$indexColor % 4}]+" data{$index} bartitle"
            {literal} }, {/literal}
            {if $smarty.foreach.gantt.last}
            ]
        {literal}
        }
        {/literal}
            {/if}
    {/if}
    {/foreach}
    ];
{literal}

    $(document).ready(function(){
        $(".gantt").gantt({
            source: result_source,
            navigate: "scroll",
            maxScale: "days",
            itemsPerPage: 10,
            onRender: function(){

            {/literal}
            {foreach from=$results item=timeline name=gantt key=index}
                $('.bartitle.data{$index}').attr('data-titlebar', true );
                // main title
                //$('.bartitle.data{$index}').attr('data-title','{if 'category' == $type}{$timeline.equip_name}{else}{$timeline.user_name}{/if}');
                $('.bartitle.data{$index}').attr('data-title','{$timeline.user_name}');
                // tip text
                //$('.bartitle.data{$index}').attr('title','{if 'category' == $type}{if 'user' == $veo}{$timeline.job_name}{else}{$timeline.user_name}{/if}{else}{$timeline.job_name}{/if}');
                $('.bartitle.data{$index}').attr('title','{$timeline.job_name}');
            {/foreach}
            {literal}

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
{/literal}
{*<script>*}</script>

<div class="gantt"></div>

{literal}<!--
<script type="text/javascript">

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


</script>
-->{/literal}

{else}

    No match found

{/if}