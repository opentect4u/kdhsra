<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>


<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Edit Member Entry</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('Add_member_c/edit') ?>" >

                <?php 
                foreach($data as $row)
                { ?>

                <div class="col-lg-6"> 
                    <input type= "hidden" name="mem_id" value= "<?php echo ($row->mem_id);?>" >

                    <div class="form-group">
                        <label>Member Name<font color="red">*</font></label>
                            
                        <input name="mem_name" class="form-control" value= "<?php echo ($row->mem_name);?>" placeholder="Member Name" required>
                    
                    </div>

                    <div class="form-group">
                        <label>Contact No</label>
                            
                        <input name="phone_no" class="form-control" pattern="[1-9]{1}[0-9]{9}" value= "<?php echo ($row->phone_no);?>" placeholder="Contact No">
                    
                    </div>

                    <div class="form-group">
                        <label>Member Type<font color="red">*</font></label>
                        <select class="form-control" name="mem_type" id= "mem_type" required >
                        <option value="<?php echo ($row->mem_type); ?>"><?php echo ($row->mem_type); ?></option>

                            <!--<option value= "">Select Type</option>
                            <option value= "LM">Life Time Member</option>
                            <option value= "MS">Monthly Subscriber</option> -->
                            
                        </select>
                    </div>
                    
                    <div class="form-group" id= "amount">
                        <label>Monthly Charge <font color="red">*</font></label>
                            
                        <input name="m_sub_amount" class="form-control" value="<?php echo ($row->m_sub_amount); ?>" placeholder="Amount" >
                    
                    </div>

                    <br>
                    <div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>

                </div>

                <?php
                }?>

            </form>
        </div>

    </div>

</div>


<script>

    if($("#mem_type").val()== 'LM')
        {$("#amount").hide();}

    if($("#mem_type").val()== 'MS')
        {$("#amount").show();}
               

</script>