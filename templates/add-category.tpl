<div class="row">
    <div class="col-sm-6">
        <section class="panel">
            <header class="panel-heading">Add Category</header>
            <div class="panel-body">
            <form method="post" action="">
                <div class="clr10"></div>
                <div class="col-sm-12"><input type="text" class="form-control es-input" placeholder="Type Category Name" required name="name" value="{$name}"></div>
			    <div class="clr30"></div>
                <div class="col-sm-6"><button class="btn btn-primary" onclick="location.href='{$adminUrl}categories';">Cancel</button></div>
                <div class="col-sm-6 text-right"><input type="submit" class="btn btn-theme" value="Save Category" /></div>
                <div class="clr30"></div>
            </form>
            </div>
        </section>
    </div>
</div>