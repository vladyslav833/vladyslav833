{if '' == $page || 'login' == $page || 'forgot-password' == $page || ( '404' == $page && !$user_logged )}
    {include file='lobby.tpl'}
{else}
    {include file='main.tpl'}
{/if}