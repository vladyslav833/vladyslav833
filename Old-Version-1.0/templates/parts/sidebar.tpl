<!--sidebar start-->

<aside>
    <div id="sidebar"  class="nav-collapse ">
    <!-- sidebar menu start-->
    <ul class="sidebar-menu" id="nav-accordion">
        <li class="dashboard-menu">
            {*<a href="{$adminUrl}" {if 'dashboard' == $page} class="selected"{/if}>Dashboard</a>*}
            <span>Dashboard</span>
        </li>
        <li class="reservation-menu">
            <a  href="{$adminUrl}reserve-equipment" {if 'reserve-equipment' == $page} class="selected"{/if}>Make Reservation</a>
        </li>
        <li class="calendar-menu">
            <a  href="{$adminUrl}calendar" {if 'calendar' == $page} class="selected"{/if}>Calendar</a>
        </li>
        <li class="categories-menu">
            <a href="{$adminUrl}categories" {if 'categories' == $page} class="selected"{/if}>Categories</a>
        </li>
        <li class="equipment-menu">
            <a  href="{$adminUrl}equipment" {if 'equipment' == $page} class="selected"{/if}>Equipment</a>
        </li>
        <li class="jobs-menu">
            <a  href="{$adminUrl}jobs" {if 'jobs' == $page} class="selected"{/if}>Jobs</a>
        </li>
        <li class="users-menu">
            <a  href="{$adminUrl}users" {if 'users' == $page} class="selected"{/if}>Users</a>
        </li>

    </ul>
    <!-- sidebar menu end-->
</div>
</aside>
<!--sidebar end-->