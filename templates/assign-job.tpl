<script type="text/javascript" src="{$homeUrl}js/assign-job.js"></script>

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
                    <input type="hidden" name="id" value="{$id}">
                    <input id="siteUrl" value="{$siteUrl}" hidden>
                    <div class="task-section">
                        <div class="clr10"></div>
                        <div class="col-sm-6">
                            <p class="text-primary fs-18 bold">Assign Job/Task to User</p>
                            <select class="form-control es-select" id="task_id" name="task_id" required>
                                <option value="0" {if !$task_id} selected{/if}>Select Job</option>
                                {foreach from=$jobs item=job}
                                    <option value="{$job.id}" {if $job.id == $job_id} selected{/if}>{$job.name}</option>
                                {/foreach}
                                <option value="new" {if $task_id == "new"}selected{/if}>Small Job/Task --> Enter Name</option>
                            </select>
                        </div>
                        <div class="col-sm-6 {if $task_id != "new"}hide-dropdown{/if}" id="newJobName">
                            <p class="text-primary fs-18 bold">Enter Name</p>
                            <input class="form-control" id="newName" name="newName" value="{$newName}">
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
                    <div class="clr10"></div>
                    <div class="user-section">
                        <div class="clr10"></div>
                        <div class="col-sm-12">
                            <p class="text-primary fs-18 bold">Assign Worker(s) to Job</p>
                            <div class="workers">
                                {foreach from=$workers item=$worker }
                                    {if $worker != "0"}
                                        <div class="clr10"></div>
                                        <div class="d-flex worker-selection">
                                            <select class="form-control es-select worker" name="worker_id[]" required>
                                                <option value="0" {if !$worker} selected{/if}>Select Worker</option>
                                                {foreach from=$users item=user}
                                                    <option value="{$user.id}" {if $user.id == $worker} selected{/if}>{$user.first_name} {$user.last_name}</option>
                                                {/foreach}
                                            </select>
                                            <h4 class="delete-btn">DELETE</h4>
                                            <div class="errmsg-box">
                                            </div>
                                        </div>
                                    {/if}
                                {/foreach}
                                {if !$workers || count($workers) == 0 }
                                    <div class="d-flex worker-selection">
                                        <select class="form-control es-select worker" name="worker_id[]" required>
                                            <option value="0">Select Worker</option>
                                            {foreach from=$users item=user}
                                                <option value="{$user.id}" {if $user.id == $user_id} selected{/if}>{$user.first_name} {$user.last_name}</option>
                                            {/foreach}
                                        </select>
                                        <h4 class="delete-btn">DELETE</h4>
                                        <div class="errmsg-box">
                                        </div>
                                    </div>
                                {/if}
                            </div>
                            <div class="clr10"></div>
                            <span class="btn btn-primary add-worker-btn"><img src="{$homeUrl}img/reservation-icon.png">Add another worker to this job</span>
                            <div class="d-flex temp-section worker-selection">
                                <select class="form-control es-select worker hide-dropdown" name="worker_id[]">
                                    <option value="0" {if !$worker_id} selected{/if}>Select Worker</option>
                                    {foreach from=$users item=user}
                                        <option value="{$user.id}" {if $user.id == $worker_id} selected{/if}>{$user.first_name} {$user.last_name}</option>
                                    {/foreach}
                                </select>
                                <h4 class="delete-btn hide-dropdown">DELETE</h4>
                                <div class="errmsg-box">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12 es-checkbox">
                        <label class="mr-10 fs-18 bold text-primary"><input type="checkbox" name="hide_task" id="hide_task" {if '1' == $hide_task} checked{/if}> Do Not Display on calendar or as Job Conflict</label>
                    </div>

                    <div class="col-sm-12 es-checkbox">
                        <label class="mr-10 fs-18 bold text-primary"><input type="checkbox" name="alert" id="alert_check" {if '1' == $alert} checked{/if}> Include an Alert on this job/task?</label>
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <input type="text" class="form-control es-input" placeholder="Enter Alert Text" name="alert_text" value="{$alert_text}" id="alert_text">
                    </div>
                    <div class="clr10"></div>
                    <div class="col-sm-12">
                        <p class="text-primary fs-18 bold">Enter task description or other useful information.</p>
                        <textarea class="form-control es-input" rows="5" placeholder="Enter Description Text" name="description">{$description}</textarea>
                    </div>
                    <div class="clr30"></div>
                    <div class="col-sm-6">
                        <button type="button" class="btn btn-danger" onclick="location.href='{$adminUrl}tasks';">Cancel</button>
                    </div>
                    <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Assign Job"/></div>
                    <div class="clr30"></div>
                </form>
            </div>
        </section>
    </div>
</div>
