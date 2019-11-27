<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        Student Entry Form
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" name="stuform" method="POST" action= " <?php echo site_url('Student_controller/update_entry') ?>" onsubmit="return validate()" >

                <?php if($student_data)
                { 
                    foreach($student_data as $row)
                    { 
                         //echo($row->addr); die; ?>

                        <input type= "hidden" name="sl_no" value= "<?php echo($row->sl_no);?>" required>
                    <!--    <input type= "hidden" name="date" value= "<?php //echo($row->created_dt);?>" required> -->
                        <input type= "hidden" name="date_m" value= "<?php echo date('y-m-d H:i:s');?>" required >
                        
                        <div class="form-group">
                            <label>Student Name</label>
                            <input class="form-control" name="stu_name" id= "stu_name" value= "<?php echo($row->stu_name); ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Roll No</label>
                            <input class="form-control" name="roll_no" value= "<?php echo($row->roll_no); ?>" required>
                        </div>

                        <div class="form-group">

                            <label>Class</label>
                            <select class="form-control" name="class_name" id="class_name" readonly>
                                
                                <option value= "<?php echo($row->class); ?>"><?php echo($row->class); ?></option>

                            </select>

                        </div>
                        
                        <div class="form-group">

                            <label>Section</label>
                            <select class="form-control" name="sec_name" id="sec_name" readonly>
                            
                                <option value= "<?php echo($row->sec); ?>"><?php echo($row->sec);  ?></option>

                            </select>

                        </div>
                        
                        <div class="form-group">
                            <label>Guardian's Name</label>
                            <input class="form-control" name="guardian" value= "<?php echo($row->guardian); ?>" placeholder="Guardian's Name" required>
                        </div>

                        <div class="form-group">
                            <label>Mobile No</label>
                            <input class="form-control" name="mob_no" id= "mob_no" value= "<?php echo($row->mob_no); ?>" required><span id="mob_err" style= "color: red"></span>
                        </div>
                         
                        <div class="form-group">
                            <label>Email Id</label>
                            <input class="form-control" name="mail_id" id= "mail_id" value= "<?php echo($row->mail_id); ?>" type="email" ><span id="mail_err" style= "color: red"></span>
                        </div>

                                            
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" type= "text" name="addr"  rows="10" cols="50" placeholder="Address"><?php echo($row->addr); ?></textarea>
                        </div> 
                        
                        <button type="submit" class="btn btn-default">Submit</button>
                    
                    <?php } ?>

                <?php } ?>

                </form>
            </div>
        </div>
    </div>

</div>


<script>

    //var stu_name = document.stuform.stu_name.value;
    var stu_name    =   document.forms["stuform"]["stu_name"];
    var roll_no     =   document.forms["stuform"]["roll_no"];
    var class_name  =   document.forms["stuform"]["class_name"];
    var sec_name    =   document.forms["stuform"]["sec_name"];
    var guardian    =   document.forms["stuform"]["guardian"];
    var mob_no      =   document.forms["stuform"]["mob_no"];   
    var mail_id     =   document.forms["stuform"]["mail_id"];

   

    function validate()
    {

        if(stu_name.value == "" || stu_name.value == null)
        {
            stu_name.style.border = "1px solid red";
            stu_name.focus();
            return false;
        }

        if(roll_no.value == "" || roll_no.value == null)
        {
            roll_no.style.border = "1px solid red";
            roll_no.focus();
            return false;
        }

        if(class_name.value == "" || class_name.value == null)
        {
            class_name.style.border = "1px solid red";
            class_name.focus();
            return false;
        }

        if(sec_name.value == "" || sec_name.value == null)
        {
            sec_name.style.border = "1px solid red";
            sec_name.focus();
            return false;
        }

        if(guardian.value == "" || guardian.value == null)
        {
            guardian.style.border = "1px solid red";
            guardian.focus();
            return false;
        }

        /*if(mob_no.value == "")
        {
            mob_no.style.border = "1px solid red";
            mob_no.focus();
            return false;
        } */

        return phone_validate();        
        
        
    } 

    mail_id.addEventListener("click", mail_validate, true); // adding function to verify mail
    
    
    function phone_validate()
    {
        console.log(1);

        var phone = document.stuform.mob_no.value;

        if(phone == "" || phone == null)
        {

            mob_no.style.border = "1px solid red";
            mob_no.focus();
            return false;

        }
        else
        {
            //pattern="[1-9]{1}[0-9]{9}"
            //console.log(2);

            var phoneNum = phone.replace(/[^\d]/g, '');

            //if(phoneNum.length > 6 && phoneNum.length < 11)
            if(phoneNum.length == 10)
            {

                return true;

            }
            else
            {

                document.getElementById("mob_err").innerHTML="Please enter a valid phone no. address."; 
                mob_no.style.border = "1px solid red";
                mob_no.focus();
                return false;

            }
            

        }

        //return mail_validate();

    }
    
    
    function mail_validate()
    {
        console.log(2);
        
        var mail = document.stuform.mail_id.value;
        var atposition = mail.indexOf("@");  
        var dotposition = mail.lastIndexOf("."); 

        if(mail == "" || mail == null)
        {
            //console.log(1);

           /* mail_id.style.border = "1px solid red";
            mail_id.focus(); 
            return false; */

            return true;
        }
        else
        {

            if (atposition<1 || dotposition<atposition+2 || dotposition+2>=x.length)
            {  
                //console.log(2);
                //alert("Please enter a valid e-mail address.");  // to show pop up / alert message-
                
                document.getElementById("mail_err").innerHTML="Please enter a valid e-mail address."; 
                mail_id.style.border = "1px solid red";
                mail_id.focus();
                
                return false;  
            }

        }


    }

</script>