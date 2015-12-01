<div class="well col-lg-6 col-lg-offset-3">
    <form class="form-horizontal" action="addMovie.php" method="post">
        <fieldset>
            <legend>Add movie to database</legend>
            <div class="form-group">
                <label for="title" class="col-lg-2 control-label">Title</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>
            </div>
            <div class="form-group">
                <label for="tagline" class="col-lg-2 control-label">Tagline</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="tagline" id="tagline" placeholder="Tagline">
                </div>
            </div>
            <div class="form-group">
                <label for="relased" class="col-lg-2 control-label">Relased</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" name="released" id="relased" placeholder="Relased (must be number)">
                </div>
            </div>
            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-default">Cancel</button>
                </div>
            </div>
        </fieldset>
    </form>
</div>