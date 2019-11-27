<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        Expense Entry Form
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

            <?php foreach($data as $row)
            { ?>

                <form role="form" method="POST" action= " <?php echo site_url('Expense_controller/update_entry') ?>" >

                <input type="hidden" name="sl_no" value=" <?php echo($row->sl_no); ?> ">
                <input type= "hidden" name="date_m" value= "<?php echo date('y-m-d H:i:s');?>" required >
                    
                    <div class="form-group">
                        <label>Expense Name</label>
                        <input class="form-control" name="expense_name" value= "<?php echo($row->expenses); ?>">
                    </div>

            <?php
            } ?>

                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>