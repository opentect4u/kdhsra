<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
    <p style="text-align: left; width:49%; display: inline-block;">Edit Collection Entry</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= " <?php echo site_url('Society_collection_c/edit') ?>" >

                <?php 
                foreach($data as $row)
                {  ?>
                    
                    <input type="hidden" name="sl_no" value=" <?php echo($row->sl_no); ?> ">
                    
                    <div class="form-group">
                        <label>Collections</label>
                        <input class="form-control" name="collections" value= "<?php echo($row->collections); ?>" required>
                    </div>

                    <button type="submit" class="btn btn-default">Submit</button>

                <?php
                }?>

                </form>

            </div>
        </div>
    </div>

</div>