{literal}
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $('input[name=is_admin]').change(function () {
                if ($(this).is(':checked')) {
                    $('#password_line input').removeAttr('disabled', 'disabled');
                    $('#password_line').show();
                }
                else {
                    if($('input[name=is_proj_mgr]').prop("checked") == false) {
                        $('#password_line input').attr('disabled', 'disabled');
                        $('#password_line').hide();
                    }
                }
            }).change();

            $('input[name=is_proj_mgr]').change(function () {
                if ($(this).is(':checked')) {
                    $('#password_line input').removeAttr('disabled', 'disabled');
                    $('#password_line').show();
                }
                else {
                    if($('input[name=is_admin]').prop("checked") == false) {
                        $('#password_line input').attr('disabled', 'disabled');
                        $('#password_line').hide();
                    }
                }
            }).change();
        });
    </script>
{/literal}
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">{$pageName}</header>
            <div class="panel-body">
                <form method="post" action="">
                    <input type="hidden" name="user_id" value="{$user_id}">

                    <div class="clr10"></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Type First Name"
                                                 name="first_name" value="{$first_name}" required></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Type Last Name"
                                                 name="last_name" value="{$last_name}" required></div>
                    <div class="clr10"></div>
                    <div class="col-sm-6"><input type="text" class="form-control es-input" placeholder="Create Username"
                                                 name="username" value="{$username}" required></div>

                    <div class="col-sm-12 es-checkbox">
                        <label>Please select the roles that apply:</label>
                        <div>
                            <label class="mr-10"><input type="checkbox" value="1" name="is_admin" {if 'admin' == $role} checked{/if}> Admin</label>
                            <label><input type="checkbox" value="1" name="is_proj_mgr" {if 'proj_mgr' == $role} checked{/if}> Project Manager</label>
                        </div>
                    </div>
                    <div id="password_line">
                        <div class="clr30"></div>
                        <div class="col-sm-6"><input type="text" class="form-control es-input"
                                                     placeholder="Create Password" name="password1"
                                                     value="{if 'admin' == $role}{$password1}{/if}" required disabled>
                        </div>
                        <div class="col-sm-6"><input type="text" class="form-control es-input"
                                                     placeholder="Retype Password" name="password2"
                                                     value="{if 'admin' == $role}{$password2}{/if}" required disabled>
                        </div>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary" type="button" onclick="location.href='{$adminUrl}users';">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save User"/>
                    </div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div>