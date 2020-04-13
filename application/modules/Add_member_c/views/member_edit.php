
<div class="row">

<div class="col-lg-12">
    <h1 class="page-header">Admin</h1>
</div>

</div>


<div class="panel panel-default">

<div class="panel-heading">
    <p style="text-align: left; width:49%; display: inline-block;">Edit Member Details</p>
    <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/Y');?> </p>
</div>

<div class="panel-body">
    <div class="row">
        <form role="form" id="new_memb" method="POST" action= "<?php echo site_url('Add_member_c/edit') ?>" >
            
            <div class="col-lg-6"> 

                <div class="form-group">
                    <label>Member ID<font color="red">*</font></label>
                        
                    <input type= "text" name="mem_id" class="form-control" value="<?php echo $data->mem_id; ?>" readonly>
                
                </div>

                <div class="form-group">
                    <label>Date of Membership<font color="red">*</font></label>
                        
                    <input type= "text" name="mem_dt" class="form-control" value="<?php echo date('d/m/Y',strtotime($data->membership_dt)); ?>" readonly>
                
                </div>

                <div class="form-group">
                    <label>Member Name<font color="red">*</font></label>
                        
                    <input type= "text" name="mem_name" class="form-control" value="<?php echo $data->mem_name; ?>" required>
                
                </div>

                <div class="form-group">
                    
                    <label>Contact No</label>
                        
                    <input type= "text" name="phone_no" class="form-control" pattern="[1-9]{1}[0-9]{9}" value="<?php echo $data->phone_no; ?>" >
                
                </div>

                <div class="form-group">
                    
                    <label>Email Id</label>
                        
                    <input type="email" name="email_id" class="form-control" value="<?php echo $data->email; ?>" >
                
                </div>

                <div class="form-group">
                    <label>Member Type<font color="red">*</font></label>
                    <select class="form-control" name="mem_type" id= "mem_type">
                        <option value= "0">Select</option>
                        <option value= "L"<?php echo($data->mem_type=='L')?'selected':'';?>>Life Time Member</option>
                        <option value= "R"<?php echo($data->mem_type=='R')?'selected':'';?>>Regular Member</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Sex<font color="red">*</font></label>
                    <select class="form-control" name="memb_sex" id= "memb_sex" >
                        <option value= "0">Select</option>
                        <option value= "M"<?php echo($data->gender=='M')?'selected':'';?>>Male</option>
                        <option value= "F"<?php echo($data->gender=='F')?'selected':'';?>>Female</option>
                        <option value= "O"<?php echo($data->gender=='O')?'selected':'';?>>Others</option>
                    </select>
                </div>

                <div class="form-group">
                    <label id="mamt">Monthly Subscription<font color="red">*</font></label>
                    <input type="number" id="amount" name="amount" class="form-control"  value="<?php echo $data->m_sub_amount; ?>" required>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea class="form-control" name="adr" ><?php echo $data->memb_addr; ?></textarea>
                </div>

                <div>
                    <button type="submit" id="submit" class="btn btn-default">Submit</button>
                </div>

            </div>
        </form>
    </div>

</div>

</div>


<script>
$(document).ready(function(){

    $("#mem_type").on('change',function(){

        if($(this).val()=='L'){

            $("#amount").val(0);

            $("#amount").hide();

            $("#mamt").hide();
        }else{

            $("#amount").show();

            $("#mamt").show();
        }

    });

    $("#new_memb").on('submit',function(){

        if($("#mem_type").val()=='0'){

            alert("Please supply member type");

            $("#mem_type").css("border","1px solid red");
            
            return false;
        }else{

            return true;

        }
    });

});

</script>