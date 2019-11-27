
<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>


<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Member Entry Form</p>
        <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('Add_member_c/index') ?>" >
                
                <div class="col-lg-6"> 
                    <input type= "hidden" name="mem_id" value= "<?php echo ($data->mem_id)+1;?>" >

                    <div class="form-group">
                        <label>Member Name<font color="red">*</font></label>
                            
                        <input name="mem_name" class="form-control" placeholder="Member Name" required>
                    
                    </div>

                    <div class="form-group">
                        <label>Contact No</label>
                            
                        <input name="phone_no" class="form-control" pattern="[1-9]{1}[0-9]{9}" placeholder="Contact No">
                    
                    </div>

                    <div class="form-group">
                        <label>Member Type<font color="red">*</font></label>
                        <select class="form-control" name="mem_type" id= "mem_type" required >
                            <option value= "">Select Type</option>
                            <option value= "LM">Life Time Member</option>
                            <option value= "MS">Monthly Subscriber</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id= "amount">
                        <label>Monthly Charge <font color="red">*</font></label>
                            
                        <input name="m_sub_amount" class="form-control"  placeholder="Amount" >
                    
                    </div>

                    <br>
                    <div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </div>

                </div>
            </form>
        </div>

    </div>

</div>


<script>

    $(document).ready(function(){

        $("#amount").hide()

        $('#mem_type').on('change',function(){

            var selection = $(this).val();
            switch(selection)
            {
                
                case "LM":
                    $("#amount").hide()
                    break;

                case "MS":
                    $("#amount").show()
                    break;

            }

        });

    });

</script>
