<div class="container">

    <form class="form-login" method="post" action="{$siteUrl}login">
        <div class="login-header">
            <img src="{$homeUrl}img/header-logo.png" alt="logo" class="login-logo"/>
            <div class="clear"></div>
        </div>

        <div class="login-wrap">
            {if $login_failed}
            <div class="danger">Username and/or Password are incorrect. Please try again.</div>
            <div class="clr20"></div>
            {/if}
            <input type="text" class="form-control" placeholder="Username" name="username" value="{$username}" autofocus>
            <div class="clr20"></div>
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="clr20"></div>
            <button class="btn btn-login btn-block" type="submit">LOGIN</button>
            <div class="clr20"></div>
            <a href="#" rel="tooltip" data-original-title="Forgot Password?"><img src="{$homeUrl}img/forgot-password-icon.png" alt="Info"/></a>
            <a href="{$siteUrl}forgot-password">Forgot Password?</a>
            </div>
        </div>
    </form>

</div>