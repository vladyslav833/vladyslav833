<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">{$pageName}</header>
            <div class="panel-body">
            <form method="post" action="">
                <input type="hidden" name="job_id" value="{$job_id}">
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Name of Job" required name="name" value="{$name}"></div>
			    <div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='{$adminUrl}jobs';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Job" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div>