<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Eckinger">
        <meta name="keyword" content="Dashboard, Bootstrap, MRN">
        <link rel="shortcut icon" href="{$homeUrl}/img/favicon.png">
        <link rel="apple-touch-icon" href="{$homeUrl}/img/apple-touch-icon.png"/>

        <title>{if $page_name}{$page_name} | {else}{/if}{$default_title}</title>

        <!-- Bootstrap core CSS -->
        <link href="{$homeUrl}css/bootstrap.css" rel="stylesheet">
        <link href="{$homeUrl}css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="{$homeUrl}assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{$homeUrl}assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
        <link href="{$homeUrl}assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
        <link href="{$homeUrl}assets/bootstrap-dialog/css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />

        <link href="{$homeUrl}css/default.css" rel="stylesheet">
        <link href="{$homeUrl}css/gantt/style.css" rel="stylesheet">
        <link href="{$homeUrl}css/qtip/jquery.qtip.css" rel="stylesheet">
        <link href="{$homeUrl}css/style.css" rel="stylesheet">

        <script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js'></script>
        <script type='text/javascript' src='{$homeUrl}js/bootstrap.js'></script>
        <script type="text/javascript" src="{$homeUrl}assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
        <script type="text/javascript" src="{$homeUrl}assets/bootstrap-dialog/js/bootstrap-dialog.js"></script>
        <script type='text/javascript' src='{$homeUrl}js/custom_dialog.js'></script>
        <script type='text/javascript' src='{$homeUrl}js/qtip/jquery.qtip.js'></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="{$homeUrl}js/html5shiv.js"></script>
        <script src="{$homeUrl}js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>
    <section id="container">
        <!--header start-->
        {include file='parts/header.tpl'}
        {include file='parts/sidebar.tpl'}

        <section id="main-content">
            <section class="wrapper">

                <div class="es-breadcrumb">

                {if $breadcrumbs}
                {foreach from=$breadcrumbs key=pagename item=link name=breadcrumbs}
                    {if $smarty.foreach.breadcrumbs.last}
                        {$pagename}
                    {else}
                        <a href="{$link}">{$pagename}</a> <i><img src="{$homeUrl}img/breadcrumb-separator.png" alt="Separator" /></i>
                    {/if}
                {/foreach}
                {else}
                    {$page_name}
                {/if}

                </div>

                <div class="es-wrapper">

                    {if $page eq '404'}{include file="404.tpl"}{/if}

                    {if $page eq 'dashboard'}{include file="dashboard.tpl"}{/if}

                    {if $page eq 'categories'}{include file="categories.tpl"}{/if}
                    {if $page eq 'calendar'}{include file="calendar.tpl"}{/if}
                    {if $page eq 'calendar-details'}{include file="gantt-diagram.tpl"}{/if}
                    {if $page eq 'calendar-2'}{include file="calendar-2.tpl"}{/if}
                    {if $page eq 'prj-calendar'}{include file="prj-calendar.tpl"}{/if}
                    {if $page eq 'wkr-calendar'}{include file="wkr-calendar.tpl"}{/if}

                    {if $page eq 'add-category'}{include file="add-category.tpl"}{/if}

                    {if $page eq 'jobs'}{include file="jobs.tpl"}{/if}
                    {if $page eq 'add-job' || $page eq 'edit-job'}{include file="add-job.tpl"}{/if}
                    {if $page eq 'tasks'}{include file="tasks.tpl"}{/if}
                    {if $page eq 'assign-job'}{include file="assign-job.tpl"}{/if}

                    {if $page eq 'equipment'}{include file="equipment.tpl"}{/if}
                    {if $page eq 'add-equipment'}{include file="add-equipment.tpl"}{/if}
                    {if $page eq 'reserve-equipment'}{include file="reserv-equipment.tpl"}{/if}
                    {if $page eq 'confirm-reservation'}{include file="confirm-reservation.tpl"}{/if}

                    {if $page eq 'edit-account' || $page eq 'edit-my-account'}{include file="edit-account.tpl"}{/if}

                    {if $page eq 'users'}{include file="users.tpl"}{/if}
                    {if $page eq 'add-user' || $page eq 'edit-user' }{include file="add-user.tpl"}{/if}
                    {if $page eq 'add-timeoff' }{include file="add-timeoff.tpl"}{/if}

                    {if $page eq 'timecard'}{include file="timecard.tpl"}{/if}

                </div>

            </section>
        </section>
    </section>
    {include file='parts/footer.tpl'}
    </body>
</html>
