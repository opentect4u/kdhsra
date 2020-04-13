<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Add Collection Type</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/Y');?> </p>
    
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= " <?php echo site_url('Society_collection_c/index') ?>" >
            
                    <div class="form-group">
                        <label>Collection Type</label>
                        <input class="form-control" name="collections" placeholder="Collection Type" required>
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>