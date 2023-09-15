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
    });
</script>
{/literal}
<form action="" method="post" id="account_form">

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

						<div class="clr10"></div>
                        <div class="col-sm-2 text-right">Company:</div>
                        <div class="col-sm-4 font-blue bold">
                            <select name="RI_related_company" required class="form-control">
                                <option value="" {if !$RI_related_company} selected {/if}>----</option>
                                {if $companies_list}
                                {foreach from=$companies_list item=company}
                                <option value="{$company.id}" {if $company.id == $RI_related_company} selected {/if}>{$company.name}</option>
                                {/foreach}
                                {/if}
                            </select>
                        </div>
                        <div class="clr10"></div>
                        <div class="col-sm-2 text-right">First Name:</div>
                        <div class="col-sm-4 font-blue bold"><input type="text" class="form-control" name="RI_fname" value="{$RI_fname}" required pattern="\w+" /></div>
                        <div class="col-sm-2 text-right">Last Name:</div>
                        <div class="col-sm-4 font-blue bold"><input type="text" class="form-control" name="RI_lname" value="{$RI_lname}" required pattern="\w+" /></div>
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
                        <div class="col-sm-4 font-blue bold"><input type="text" class="form-control" name="RI_user" value="{$RI_user}" required pattern="\w+" /></div>
                        <div class="clr10"></div>
                        <div class="col-sm-2 text-right">Password:</div>
                        <div class="col-sm-4 font-blue bold"><input type="password" class="form-control" name="password1" placeholder="Type Password" required pattern="{literal}[^\s]{3,}{/literal}" onchange="form.password2.pattern = this.value;"></div>
                        <div class="clr5"></div>
                        <div class="col-sm-2 text-right">Confirm:</div>
                        <div class="col-sm-4 font-blue bold"><input type="password" class="form-control" name="password2" placeholder="Retype Password" required pattern="{literal}[^\s]{3,}{/literal}"></div>
                        <div class="clr5"></div>
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