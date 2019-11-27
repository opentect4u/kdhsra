<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        Class Entry Form
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= " <?php echo site_url('classControllers/update_entry') ?>" >

                <input type="hidden" name="sl_no" value=" <?php echo($data[0]); ?> ">
                <input type= "hidden" name="date_m" value= "<?php echo date('y-m-d H:i:s');?>" required >
                    
                    <div class="form-group">
                        <label>Class Name</label>
                        <input class="form-control" name="class_name" value= "<?php echo($data[1]); ?>">
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>