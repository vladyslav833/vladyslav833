<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Eckinger">
    <meta name="keyword" content="Dashboard, Bootstrap, ES">
    <link rel="shortcut icon" href="{$homeUrl}/img/favicon.png">
    <link rel="apple-touch-icon" href="{$homeUrl}/img/apple-touch-icon.png"/>

    <title>{if $pageName}{$pageName} | {/if}{$default_title}</title>

    <!-- Bootstrap core CSS -->
    <link href="{$homeUrl}css/bootstrap.css" rel="stylesheet">
    <link href="{$homeUrl}css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="{$homeUrl}assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="{$homeUrl}css/style.css" rel="stylesheet">
    <link href="{$homeUrl}css/shCoreDefault.css" rel="stylesheet" type="text/css" >
    <link href="{$homeUrl}css/default.css" rel="stylesheet" type="text/css" >
    <link href="{$homeUrl}css/qtip/jquery.qtip.css" rel="stylesheet" type="text/css" >
    <link href="{$homeUrl}css/jquery-theme-redmond/jquery-ui-1.10.4.custom.min.css" rel='stylesheet' type='text/css' >

    <script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script type='text/javascript' src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type='text/javascript' src='{$homeUrl}js/qtip/jquery.qtip.js'></script>
    <script type='text/javascript' src='{$homeUrl}js/bootstrap.js'></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="{$homeUrl}js/html5shiv.js"></script>
    <script src="{$homeUrl}js/respond.min.js"></script>
    <![endif]-->

    <script type="">
        var siteUrl = '{$siteUrl}';
    </script>
</head>

<body>

    <div class="header">
        <div class="logo">
            <a href="{$homeUrl}"><img src="{$homeUrl}img/header-logo.png" alt="Logo" class="logo-img" /></a>
           </div>
    </div>

    {if $page eq 'login'}{include file="login.tpl"}{/if}
    {if $page eq 'dashboard'}{include file="dashboard.tpl"}{/if}
    {if $page eq 'view-equipment'}{include file="view-equipment.tpl"}{/if}
    {if $page eq 'reserve-equipment'}{include file="view-equipment.tpl"}{/if}
    {if $page eq 'my-reservations'}{include file="my-reservations.tpl"}{/if}
    {if $page eq 'view-reservations'}{include file="view-reservations.tpl"}{/if}
    {if $page eq 'calendar'}{include file="calendar.tpl"}{/if}
    {if $page eq 'timecard'}{include file="timecard.tpl"}{/if}
    {if $page eq 'add-entry'}{include file="add-entry.tpl"}{/if}
    {if $page eq 'schedule'}{include file="schedule.tpl"}{/if}
    {if $page eq 'coworker-schedule'}{include file="coworker-schedule.tpl"}{/if}
    {if $page eq 'calendar-reservation'}{include file="calendar-reservation.tpl"}{/if}
    {if $page eq 'save-reservation'}{include file="save-reservation.tpl"}{/if}
    {*
    {if $page eq 'calendar2'}{include file="calendar2.tpl"}{/if}
    *}



    <div class="footer container">
        &copy; Copyright {"Y"|date} Norman Eckinger, Inc.. - All Rights Reserved
    </div>
</body>
</html>
