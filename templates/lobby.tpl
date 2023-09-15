<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Eckinger">
        <meta name="keyword" content="Dashboard, Bootstrap, ES">

        <title>{$default_title}{if $pageName} - {$pageName}{else}{/if}</title>

        <link rel="shortcut icon" href="{$homeUrl}img/favicon.png">

        <!-- Bootstrap core CSS -->
        <link href="{$homeUrl}css/bootstrap.css" rel="stylesheet">
        <link href="{$homeUrl}css/bootstrap-reset.css" rel="stylesheet">
        <!--external css-->
        <link href="{$homeUrl}assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="{$homeUrl}css/style.css" rel="stylesheet">

        <script type='text/javascript' src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script type='text/javascript' src='{$homeUrl}js/bootstrap.js'></script>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="{$homeUrl}js/html5shiv.js"></script>
        <script src="{$homeUrl}js/respond.min.js"></script>
        <![endif]-->
        {literal}
        <script type='text/javascript'>
            jQuery(document).ready(function($){
        {/literal}
                $('[rel=tooltip]').tooltip();
                $('a[rel=tooltip]').attr('tabindex','32000');
                {if $popup_message}alert('{$popup_message}');{/if}
        {literal}
            });
        </script>
        {/literal}
    </head>
    <body class="login-body">

        {if '404' == $page}{include file="404.tpl"}{/if}
        {if $page eq '' || $page eq 'login'}{include file="login.tpl"}{/if}
        {if $page eq 'forgot-password'}{include file="forgot-password.tpl"}{/if}

    </body>
</html>