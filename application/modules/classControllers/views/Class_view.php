<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Class Entry Form</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= " <?php echo site_url('classControllers/index') ?>" >
                    <input type= "hidden" name="date_c" value= "<?php echo date('y-m-d H:i:s');?>" required >

                    <div class="form-group">
                        <label>Class Name</label>
                        <input class="form-control" name="class_name" placeholder="Class Name">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>