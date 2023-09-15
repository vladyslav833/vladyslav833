<div class="container">
<form class="form-login" method="post" action="">
    <div class="login-header hidden-xs">
        <img src="{$siteUrl}img/header-logo.png" alt="logo" class="login-logo"/>
        <div class="clear"></div>
    </div>
    <div class="login-wrap">
        {if $error}
        <div class="error" style="color: #ff0000; font-weight: bold; padding: 15px;">
            {$error}
        </div>
        {/if}
        <p class="text-center" style="color: #fff;">We will send your password to you via email.</p>
        <input type="email" name="email" class="form-control" placeholder="Username" autofocus>
        <div class="clr20"></div>
        <button class="btn btn-login btn-block" type="submit">SEND PASSWORD</button>
    </div>
</form>
</div>