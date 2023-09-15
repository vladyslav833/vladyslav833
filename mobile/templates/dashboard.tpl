<script type="text/javascript" src="{$homeUrl}js/dashboard.js"></script>
<div class="main-content container">
    <div class="row">
        <div class="content-title col-xs-12 text-center">
            <div class="main-wrap subpadding20">
                <div class="clr30"></div>
                <h2 class="std bold">Hi, {$currentUser.fname}!</h2>
                <h3 class="std">What do you want to do?</h3>
                <div class="clr30"></div>
                <div class="main-screen">
                    <div class="col-xs-4 p-0">
                        <span class="schedule-icon"><img class="dashboard-menu" src="{$homeUrl}img/calendar-icon.png" alt="Schedule" /></span>
                        <p class="fs-18">Schedule</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <span class="equipment-icon"><img class="dashboard-menu" src="{$homeUrl}img/equipment-icon.png" alt="Equipment" /></span>
                        <p class="fs-18">Equipment</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="{$siteUrl}timecard"><img class="dashboard-menu" src="{$homeUrl}img/timer-icon.png" alt="Timer" /></a>
                        <p class="fs-18">Timecard</p>
                    </div>
                    <div class="clr20"></div>
                    <div class="col-xs-12">
                        <a href="{$siteUrl}logout"><img class="dashboard-menu" src="{$homeUrl}img/logout-icon.png" alt="Logout" /></a>
                        <p class="fs-18">Logout</p>
                    </div>
                </div>
                <div class="equipment-section">
                    <div class="col-xs-4 p-0">
                        <a href="{$siteUrl}my-reservations"><img class="dashboard-menu" src="{$homeUrl}img/my-reservation.png" alt="Calendar" /></a>
                        <p class="fs-16">My Reservations</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="{$siteUrl}view-equipment"><img class="dashboard-menu" src="{$homeUrl}img/view-equipment.png" alt="Equipment" /></a>
                        <p class="fs-16">View Equipment</p>
                    </div>
                    <div class="col-xs-4 p-0">
                        <a href="{$siteUrl}reserve-equipment"><img class="dashboard-menu" src="{$homeUrl}img/reserve-equipment.png" alt="Timer" /></a>
                        <p class="fs-16">Reserve Equipment</p>
                    </div>
                </div>
                <div class="schedule-section">
                    <div class="col-xs-6 p-0">
                        <a href="{$siteUrl}schedule"><img class="dashboard-menu" src="{$homeUrl}img/calendar-icon.png" alt="My Schedule" /></a>
                        <p class="fs-16">My<br>Schedule</p>
                    </div>
                    <div class="col-xs-6 p-0">
                        <a href="{$siteUrl}coworker-schedule"><img class="dashboard-menu" src="{$homeUrl}img/co-worker-icon.png" alt="Equipment" /></a>
                        <p class="fs-16">Co-Worker<br>Schedules</p>
                    </div>
                </div>
            </div>
         </div>
     </div>
</div>