{literal}
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.cancel-btn').click(function(){
                var dataLink = $(this).data("link");
                if(dataLink)
                    window.location.href = dataLink;
            });
        });
    </script>
{/literal}
<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">{$pageName}</header>
            <div class="panel-body">
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
                <form method="post" action="">
                    <input type="hidden" name="job_id" value="{$job_id}">

                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Project Name (Required)" required name="name" value="{$name}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-10">
                        <input type="text" class="form-control es-input" placeholder="Job #" name="job_num" value="{$job_num}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-6">
                        <label>Status (Required):</label>
                        <select class="form-control es-select" name="status" required>
                            <option value="0" {if $status == "0"} selected{/if}>Select Status</option>
                            <option value="1" {if $status == "1"} selected{/if}>Current Project</option>
                            <option value="2" {if $status == "2"} selected{/if}>Archived</option>
                        </select>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-6">
                        <label>Project Manager (Required):</label>
                        <select class="form-control es-select" name="mgr_id" required>
                            <option value="0" {if !$mgr_id && !$user_id} selected{/if}>Select Manager</option>
                            {foreach from=$managers item=mgr}
                                <option value="{$mgr.id}" {if $mgr.id == $mgr_id || $mgr.id == $user_id} selected{/if}>{$mgr.first_name} {$mgr.last_name}</option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Location" name="location" value="{$location}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Address" name="address1" value="{$address1}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Address" name="address2" value="{$address2}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="City" name="city" value="{$city}">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="State" name="state" value="{$state}">
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control es-input" placeholder="Zip" name="zip" value="{$zip}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Google folder link" name="link" value="{$link}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="On-Site contact person" name="contact" value="{$contact}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Contact person's phone" name="phone" value="{$phone}">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <textarea class="form-control es-input" rows="5" placeholder="Notes" name="notes">{$notes}</textarea>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button class="btn btn-primary cancel-btn" type="button" data-link="{$adminUrl}jobs">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Project"/></div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div>