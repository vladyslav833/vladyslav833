<!--sidebar start-->
<script type="text/javascript" src="{$homeUrl}js/sidebar.js"></script>
<aside>
    <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <li class="dashboard-menu">
            {*<a href="{$adminUrl}" {if 'dashboard' == $page} class="selected"{/if}>Dashboard</a>*}
            <span>Dashboard</span>
        </li>
    	{*<li>
            <span class="calendar-menu {if 'calendar' == $page || 'prj-calendar' == $page || 'wkr-calendar' == $page}selected{/if}">Calendar
                <i class="{if 'calendar' == $page || 'prj-calendar' == $page || 'wkr-calendar' == $page}icon-caret-up{else}icon-caret-down{/if} download-btn"></i>
            </span>
            <div class="calendar-dropdown {if 'calendar' == $page || 'prj-calendar' == $page || 'wkr-calendar' == $page}show-dropdown{else}hide-dropdown{/if}">
                <a href="{$adminUrl}calendar" class="view-calendar {if 'calendar' == $page}selected{/if}">Calendar</a>
                <a href="{$adminUrl}prj-calendar" class="prj-calendar {if 'prj-calendar' == $page}selected{/if}"">Project Calendar</a>
                <a href="{$adminUrl}wkr-calendar" class="wkr-calendar {if 'wkr-calendar' == $page}selected{/if}"">Worker Calendar</a>
            </div>
        </li>*}
        <li>
            <span class="equipment-menu {if 'equipment' == $page || 'categories' == $page || 'reserve-equipment' == $page}selected{/if}">Equipment
                <i class="{if 'equipment' == $page || 'categories' == $page || 'reserve-equipment' == $page}icon-caret-up{else}icon-caret-down{/if} download-btn"></i>
            </span>
            <div class="equipment-dropdown {if 'equipment' == $page || 'categories' == $page || 'reserve-equipment' == $page}show-dropdown{else}hide-dropdown{/if}">
                <a class="all-equipment-menu {if 'equipment' == $page}selected{/if}" href="{$adminUrl}equipment">All Equipment</a>
                <a class="categories-menu {if 'categories' == $page}selected{/if}" href="{$adminUrl}categories">Categories</a>
                <a class="reservation-menu {if 'reserve-equipment' == $page}selected{/if}" href="{$adminUrl}reserve-equipment">Make Reservation</a>
            </div>
        </li>
        <li>
            <span class="jobs-menu {if 'jobs' == $page || 'add-job' == $page}selected{/if}">Projects
                <i class="{if 'jobs' == $page || 'add-job' == $page}icon-caret-up{else}icon-caret-down{/if} download-btn"></i>
            </span>
            <div class="jobs-dropdown {if 'jobs' == $page || 'add-job' == $page}show-dropdown{else}hide-dropdown{/if}">
                <a href="{$adminUrl}jobs" class="all-jobs {if 'jobs' == $page}selected{/if}">View All</a>
                <a href="{$adminUrl}add-job" class="add-job {if 'add-job' == $page}selected{/if}"">Add New Project</a>
            </div>
        </li>
        <li>
            <span class="assign-job-menu {if 'tasks' == $page || 'assign-job' == $page}selected{/if}">Jobs/Tasks
                <i class="{if 'tasks' == $page || 'assign-job' == $page}icon-caret-up{else}icon-caret-down{/if} download-btn"></i>
            </span>
            <div class="tasks-dropdown {if 'tasks' == $page || 'assign-job' == $page}show-dropdown{else}hide-dropdown{/if}">
                <a href="{$adminUrl}tasks" class="all-tasks {if 'tasks' == $page}selected{/if}">View All Jobs/Tasks</a>
                <a href="{$adminUrl}assign-job" class="assign-job {if 'assign-job' == $page}selected{/if}"">Assign Job/Task</a>
            </div>
        </li>
        <li>
            <span class="users-menu {if 'users' == $page || 'add-user' == $page || 'add-timeoff' == $page}selected{/if}">Users
                <i class="{if 'users' == $page || 'add-user' == $page || 'add-timeoff' == $page}icon-caret-up{else}icon-caret-down{/if} download-btn"></i>
            </span>
            <div class="users-dropdown {if 'users' == $page || 'add-user' == $page || 'add-timeoff' == $page}show-dropdown{else}hide-dropdown{/if}">
                <a href="{$adminUrl}users" class="all-users {if 'users' == $page}selected{/if}">View All</a>
                <a href="{$adminUrl}add-user" class="add-user {if 'add-user' == $page}selected{/if}"">Add New User</a>
                <a href="{$adminUrl}add-timeoff" class="add-timeoff {if 'add-timeoff' == $page}selected{/if}"">Schedule Time Off</a>
            </div>
        </li>
        <li class="timecard-menu">
            <a href="{$adminUrl}timecard" {if 'timecard' == $page} class="selected"{/if}>Timecard</a>
        </li>
    </ul>

    <!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end-->
