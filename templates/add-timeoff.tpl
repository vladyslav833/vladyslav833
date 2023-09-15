{literal}
    <script type="text/javascript">
        jQuery(document).ready(function($){
            $('body').on('change', '.worker', function() {
                var worker_id = $(this).val();
                var ajaxUrl = $("#siteUrl").val() + "admin/ajax";
                if(worker_id > 0) {
                    $.ajax({
                        url: ajaxUrl,
                        type: "POST",
                        data: {action: "checkWorkerTimeOff", workerId: worker_id},
                        dataType: "json",
                        success: function(res) {
                            if(res.status) {
                                $("#uid").val(worker_id);
                                $("#start_date").val(res.userdata.start_date);
                                $("#end_date").val(res.userdata.end_date);
                            } else {
                                $("#uid").val("");
                            }
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                            console.log(errorMessage);
                        }
                    });
                }
            });
        });
        function validateForm() {
            if($("#worker_id").val() == "" || $("#worker_id").val() == "0"){
                alert("Please select worker");
                return false;
            }

            if ($("#start_date").val() == "") {
                alert("Start date must be filled out");
                return false;
            }

            if ($("#end_date").val() == "") {
                alert("End date must be filled out");
                return false;
            }

            if($("#end_date").val() < $("#start_date").val()) {
                alert("Start date can't be grater than end date");
                return false;
            }
        }
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
                <form method="post" action="" onsubmit="return validateForm()">
                    <input type="hidden" name="uid" id="uid">
                    <input id="siteUrl" value="{$siteUrl}" type="hidden">
                    <div class="task-section">
                        <div class="clr10"></div>
                        <div class="col-sm-12">
                            <p class="text-primary fs-24 bold">Worker Availability</p>
                        </div>
                    </div>

                    <div class="user-section">
                        <div class="clr10"></div>
                        <div class="col-sm-12">
                            <p class="text-primary fs-18 bold">Select Worker</p>
                            <div class="workers">
                                <div class="d-flex worker-selection">
                                    <select class="form-control es-select worker" id="worker_id" name="worker_id" required>
                                        <option value="0">Worker</option>
                                        {foreach from=$users item=user}
                                            <option value="{$user.id}" {if $user.id == $user_id} selected{/if}>{$user.first_name} {$user.last_name}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="clr30"></div>
                    <div class="col-sm-12">
                        <p class="text-primary fs-18 bold">Select a start and end date</p>
                    </div>
                    <div class="col-sm-6">
                        <label class="text-primary fs-18 bold">Start Date</label>
                        <input type="date" class="form-control start-date" id="start_date" name="start_date" value="{$start_date}">
                    </div>
                    <div class="col-sm-6">
                        <label class="text-primary fs-18 bold">End Date</label>
                        <input type="date" class="form-control end-date" id="end_date" name="end_date" value="{$end_date}">
                    </div>

                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-danger" onclick="location.href='{$adminUrl}users';">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Schedule Time"/></div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div>