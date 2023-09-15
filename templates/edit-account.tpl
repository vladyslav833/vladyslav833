{literal}
<script type="text/javascript">
    jQuery(document).ready(function($){
        $('#change_password').change(function(){
            if( $(this).is(':checked') ){
                $('#passwords_block').show();
            }
            else{
                $('#passwords_block').hide();
            }
        });

        $('#account_form').submit(function(){
            if( $('#change_password').is(':checked') ){
                if( $( input[name=password1] ).val().replace(/[\s]/,'') == '' ){
                    $( input[name=password1] ).focus();
                    alert( 'Please enter password');
                    return false;
                }

                if( $( input[name=password2] ).val().replace(/[\s]/,'') == '' ){
                    $( input[name=password2] ).focus();
                    alert( 'Please enter password confirmation');
                    return false;
                }
            }
        });
    });
</script>
{/literal}
<form action="" method="post" id="account_form">
    <input type="hidden" name="RI_id" value="{if $ID}{$ID|md5}{/if}">
<div class="mrn-wrapper">
  <!-- page start-->
	<div class="row">
        <div class="col-sm-12">
         	<div class="panel">
                <div class="panel-body">
                    <div class="subpading">

                        {if $errors}
                            <div class="alert alert-danger">
                            {if is_array($errors)}
                                <ul>
                                {foreach from=$errors item=error}
                                    <li>{$error}</li>
                                {/foreach}
                                </ul>
                            {else}
                                {$errors}
                            {/if}
                            </div>
                        {/if}

                        {if $success_submit && $is_submit}
                        <div class="btn btn-success">
                            Account was successfully updated!
                        </div>
                        {/if}

						<div class="clr10"></div>
                        <div class="col-sm-2 text-right">Name:</div>
                        <div class="col-sm-4 font-blue bold">{$RI_fname} {$RI_lname}</div>
                        <div class="clr10"></div>
                        <div class="col-sm-2 text-right">Email:</div>
                        <div class="col-sm-4 font-blue bold"><input type="email" class="form-control" name="RI_Email" value="{$RI_Email}" required></div>
                        <div class="clr5"></div>
                        <div class="col-sm-2 text-right">Phone:</div>
                        <div class="col-sm-4 font-blue bold"><input type="text" class="form-control" name="RI_Phone" value="{$RI_Phone}"></div>
                        <div class="clr5"></div>
                        <div class="col-sm-2 text-right">Fax:</div>
                        <div class="col-sm-4 font-blue bold"><input type="text" class="form-control" name="RI_Fax" value="{$RI_Fax}"></div>
                        <div class="clr5"></div>
                        <div class="col-sm-2 text-right">Username:</div>
                        <div class="col-sm-4 font-blue bold">{$RI_user}</div>
                        <div class="clr10"></div>
                        <div class="col-sm-2 text-right">&nbsp;</div>
                        <div class="col-sm-4 font-blue bold"><input type="checkbox" id="change_password" name="change_password" value="1" {if $change_password}checked{/if}/> Change password? </div>
                        <div class="clr10"></div>
                    <div id="passwords_block" {if !$change_password}style="display: none;"{/if}>
                        <div class="col-sm-2 text-right">Password:</div>
                        <div class="col-sm-4 font-blue bold"><input type="password" class="form-control" name="password1" placeholder="Type Password" pattern="{literal}[^\s]{3,}{/literal}" onchange="form.password2.pattern = this.value;"></div>
                        <div class="clr5"></div>
                        <div class="col-sm-2 text-right">Confirm:</div>
                        <div class="col-sm-4 font-blue bold"><input type="password" class="form-control" name="password2" placeholder="Retype Password" pattern="{literal}[^\s]{3,}{/literal}"></div>
                        <div class="clr5"></div>
                    </div>
                        <hr>
                        <div class="col-sm-12 text-right">
                            <input type="reset" class="btn btn-primary" value="Cancel Changes">
                            <input type="submit" class="btn btn-info" value="Save Changes">
                        </div>

                        <div class="clr30"></div>
                    </div>
           		</div>
            </div>
        </div>
    </div>
</div>
</form>