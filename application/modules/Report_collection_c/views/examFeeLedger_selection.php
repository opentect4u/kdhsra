<!-- for year picker --> 

<link href="<?php echo base_url('assets/vendor/Year-Picker/style.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.js'); ?>" async ></script>


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Student Tution Fee Ledger</h1>
    </div>
    
</div> 


<div class="panel panel-default">

    <div class="panel-heading">
       
       <p style="text-align: left; width:49%; display: inline-block;">Tution Fee ledger</p>
       
    </div>

    <div class="panel-body">
        
        <div class="row">

            <form role="form" method="POST" action= "<?php echo site_url('Report_collection_c/view_examLedger') ?>" >

                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>CLass<font color="red">*</font></label>

                        <select class="form-control" name="class" required >
                            <option value= "">Select Class</option>

                        <?php
                            foreach($classData as $data1)
                            {
                            ?>
                            
                            <option value= "<?php echo($data1->class_name); ?>"><?php echo($data1->class_name); ?></option>
                            
                            <?php
                                } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Form Date <font color="red">*</font></label>
                        
                        <input type="date" name= "from_dt" class="form-control" value="" />
                        
                    </div>

                </div>

                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>Section<font color="red">*</font></label>
                        
                        <select class="form-control" name="stu_sec" id= "stu_sec" required >
                            <option value= "">Select Section</option>
                            <option value= "A">A</option>
                            <option value= "B">B</option>
                            <option value= "C">C</option>
                            <option value= "D">D</option>
                        </select>
                    </div> 
                    
                    <div class="form-group">
                        <label>To Date <font color="red">*</font></label>
                        
                        <input type="date" name= "to_dt" class="form-control" value="" />
                        
                    </div>
                    
                </div>

                <div class="col-lg-6">

                    <div class="form-group">
                        <label>Examination Type<font color="red">*</font></label>
                        
                        <select class="form-control" name="exam_type" id= "exam_type" required >
                            <option value= "">Select Examination</option>
                            <option value= "8">Half Yearly</option>
                            <option value= "10">Final</option>
                        </select>
                    </div> 

                </div>

                <div class="col-lg-12">

                    <div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>

            </form>

        </div>

    </div>

</div>

