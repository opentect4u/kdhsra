<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Report</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        
        <p style="text-align: left; width:49%; display: inline-block;">Student Collection Report</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
        
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= "<?php echo site_url('Report_collection_c/bill_form') ?>" >

                    <div class="form-group">
                        <label>Bill Of<font color="red">*</font></label>
                      
                        <select class="form-control" name="month" required >
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">Appril</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                        
                    </div>
                    <br>

                    <div class="form-group">
                        <label>Year<font color="red">*</font></label>

                        <input name="year" class="form-control" id= "year" placeholder="Year" value= "20<?php echo date('y')  ?>" required>

                    </div>
                    <br>

                    <div class="form-group">
                        <label>Class<font color="red">*</font></label>

                        <select class="form-control" name="class" id= 'class' required >
                            <option value= "">Select Class</option>

                        <?php    
                            foreach($class_data as $data)
                            { 
                             ?>
                                <option value="<?php echo ($data->class_name); ?>"><?php echo ($data->class_name); ?></option>
                        <?php   
                            } 
                            ?>
                        </select>

                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">GO<i class="fa fa-angle-double-right fa-fw "></i></button>

                </form>

            </div>
        </div>
    </div>

</div>