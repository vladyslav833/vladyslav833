<div class="main-content container">
    <div class="row">
        <div class="content-title col-xs-12 text-center">
            <div class="subpadding20">
                <div class="clr30"></div>
                <h3 class="color std">Equipment Scheduler</h3>
                <h2 class="color std">Login</h2>
                <div class="clr20"></div>
            </div>

            <form class="form-login" method="post" action="{$siteUrl}login">
            {if $login_failed}
            <div class="danger">Username is incorrect. Please try again.</div>
            <div class="clr20"></div>
            {/if}

            <div class="login-wrap subpadding20">
                <input type="text" class="es-input form-control" placeholder="Username" name="username" value="{$username}" autofocus>
                <div class="clr20"></div>
                <button class="btn btn-login btn-block" type="submit">Login</button>
                <div class="clr20"></div>
            </div>
            </form>

        </div>
    </div>
</div>