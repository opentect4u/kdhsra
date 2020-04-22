<!--// to decorate the fees entry table  //-->

<style>

    table, td, th {
        text-align: center;
        border: 1px solid gray;
        }

    table {
        border-collapse: collapse;
        width: 100%;
        }

    th {
        height: 50px;
        }
    td {
        height: 50px;
    }

</style>


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Collection</h1>
    </div>
    
</div> 

<div class="panel panel-default">

    <div class="panel-heading">
       <!-- <p align="right">Fees Entry Form</p> -->
       <p style="text-align: left; width:49%; display: inline-block;">Fees Entry Form</p>
       <p style="text-align: right; width:50%;  display: inline-block;"><strong>Date:</strong> <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('F_collection_c/index') ?>" >
                    
                <div class="col-lg-4">  

                    <div class="form-group">
                        <label>Academic Year</label>
                        <input name="academic_yr" id= "academic_yr" class="form-control" placeholder="Year" value= "<?php echo date('Y');?>" readonly>                                             
                        
                        <?php 
                           /* $already_selected_value = date('y');
                            $earliest_year = 2100;
                            print '<select name="academic_yr" id= "academic_yr" class= "form-control" >';
                            
                            foreach (range(date('Y'), $earliest_year) as $x) 
                            {
                                print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                            }
                            print '</select>'; */
                        ?>                        

                    </div>
                    
                    <br>
                    <div class="form-group">
                        <label>Class<font color="red">*</font></label>

                        <select class="form-control" name="stu_class" id= 'class_name' required >
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

                    <div class="form-group">
                        <label>Roll No<font color="red">*</font></label>

                        <input name="roll_no" class="form-control" id= "roll_no" placeholder="Roll No" required>

                    </div>

                    <br>
                    <div class="form-group">
                        <label>Payment From<font color="red">*</font></label>
                        
                      <!--  <input id="bday-month" class="form-control" type="month" name="fees_month" value="2018-12"> -->
                      
                        <select class="form-control" name="from_month" id= "from_month" required >
                            <option value="0">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
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

                    
                    <div class="form-group">
                        <label>Payment Mode<font color="red">*</font></label>
                        
                        <select class="form-control" name="collc_mode" id="collc_mode" required >
                            <!-- <option value= "NULL">Payment by:</option> -->
                            <option value= "C">Cash</option>
                            <option value= "B">Draft/NEFT</option>
                        </select>
                    </div>

                    <div class="form-group" id="bank_name">
                        <label>Bank Name<font color="red">*</font></label>
                            
                        <input name="bank_name"  class="form-control" placeholder="Bank Name">
                    
                    </div>

                    <div class="form-group" id="draft_no">

                        <label>Draft No<font color="red">*</font></label>
                            
                        <input name="draft_no" class="form-control" placeholder="Draft No" >
                    
                    </div>

                    <div class="form-group" id="neft_no">
                        <label>Draft/NEFT No.<font color="red">*</font></label>
                        <input name="neft_no"  class="form-control" placeholder="Draft/NEFT No." >
                    
                    </div>

                </div>

                    <!-- <input type = "hidden" name="trans_dt" class="form-control" value= "<?php //echo date('y-m-d');?>" readonly> -->
                
                    <!-- for transaction code ---// using the reference "transCd" not "max(--)" function -->
                    <!-- <input type = "hidden" class = "form-control" name= "trans_cd" value= "<?php //echo ($trans_data->transCd)+1;?>"/> -->
                
                    <input name="fees_year" type= "hidden" class="form-control" placeholder="Year" value= "<?php echo date('Y');?>" readonly>                     

                <div class="col-lg-4">
                    
                    <div class="form-group">
                        <label>Date<font color="red">*</font></label>
                        <input name="trans_dt" type= "date" class="form-control" placeholder="Date" value="<?php echo date('Y-m-d');?>" />                                            
                        
                    </div>
                    
                    <br>
                    <div class="form-group">
                    
                        <label>Section<font color="red">*</font></label>
                        
                        <select class="form-control" name="stu_sec" id= "stu_sec" required >
                            <option value= "">Select Section</option>
                            <option value= "A">A</option>
                            <option value= "B">B</option>
                            <option value= "C">C</option>
                            <option value= "D">D</option>
                            <option value= "E">E</option>
                            <option value= "F">F</option>
                            <option value= "G">G</option>
                            <option value= "H">H</option>
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label>Name<font color="red">*</font></label>
                        
                        <input name="stu_name" id="stu_name" class="form-control" placeholder="Student Name" readonly>
                    </div>

                    <br>
                    <div class="form-group">
                        <label>Payment Upto<font color="red">*</font></label>
                        
                      <!--  <input id="bday-month" class="form-control" type="month" name="fees_month" value="2018-12"> -->
                      
                        <select class="form-control" name="to_month" id= "to_month" required >
                            <option value="0">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
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

                    <div class="form-group" id="neft_no">
                        <label>Paying For</label>
                        <input name="tot_months" id= "tot_months" class="form-control" value= "" readonly>
                    
                    </div>
                    
                   
                </div>

                <div class="col-lg-12">
                    <!-- To show error message for month selection -->

                    <span id= "month_msg" ><font color="red">* Please Select Month Range Properly</font></span>
                    <br>

                    <table class="table table-striped">
                        
                        <thead>
                            
                            <tr>
                                <th>Fees</th>
                                <th>Amount</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                        </thead>
                            
                        <tbody id= "intro">
                            <tr>
                                <td>
                                
                                    <select class="form-control feeAmount_cls" name="fees_type_id[]" id="fees_type_id" required >
                                        <option value= "">Select Fees</option>

                                    <?php    
                                        foreach($fees_data as $data)
                                        { 
                                        ?>
                                            <option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->fees_name); ?></option>
                                    <?php   
                                        } 
                                        ?>
                                    </select>
                                
                                </td>
                                
                                <td>
                                    
                                    <input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required readonly>
                                    
                                </td>

                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td>
                                    <strong>Total:</strong>
                                </td>
                                <td colspan="1">
                                    <input name="tot_pm" id="tot_pm" class="form-control" placeholder="Total" readonly>  
                                </td>
                                <td colspan="1">
                                    <input name="tot_amnt" id="tot_amnt" class="form-control" placeholder="Rs." readonly>                                          
                                </td>
                            </tr>
                        </tfoot>

                    </table>

                </div>

                
                <input type= "hidden" name="total" id= "total" class="form-control" value= "" >
                    
                    

                <div class="col-lg-12">

                    <div class="form-group"> 
                        <label>Remarks</label>
                        <textarea name="remarks" id="remarks"  rows="5" class="form-control" placeholder="Remarks"></textarea>
                    </div>
                    
                    <br>
                    <div>
                       
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>

                </div>

            </form>
        </div>
    </div>

</div>



<!-- To handel month range selection  -->
<script>

    $(document).ready(function()
    {
        $('#month_msg').hide();

        $('#to_month').change(function()
        {
            
            var from_month = $('#from_month').val(); 
            var to_month = $(this).val();
            //console.log(from_month);
            //console.log(to_month);

            if(from_month > to_month)
            {
                $('#month_msg').show();
                var tot_months = 0;
            }
            else
            {
                $('#month_msg').hide();
                var difference = parseInt(to_month - from_month); 
                //console.log(difference);

                tot_months = parseInt(difference + 1);
                //console.log(tot_months);
            }

            //console.log(tot_months);            
            $('#tot_months').val(tot_months+' months'); 

            if(from_month != to_month) // For multiple months only tution fee can be paied// for other fees only 1 month must be selected
            {
                document.getElementById("addrow").disabled = true;

                // to get month duration's value first :
                
            }
            else
            {
                document.getElementById("addrow").disabled = false;

                // to get month duration's value first :
                
            }


        });

        
    });

</script>



<script>

    $(document).ready(function(){

        $("#addrow").click(function()
        {

            var newElement= '<tr><td><select class="form-control feeAmount_cls" name="fees_type_id[]" id="fees_type_id"><option value="">Select Fees</option><?php foreach($fees_data as $data){?><option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->fees_name);?><?php } ?></select></td><td><input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';

            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });
    
        
        $('#intro').on( "change", ".amount_cls", function()
        {
            
            $("#total").val('');
            var total = 0;
            $('.amount_cls').each(function(){
                total += +$(this).val();

            });
            $("#total").val(total);

      
        }); 
        
        $('.amount_cls').change(function()
        {

            //var tot = $(this).val();
            //var months_no = $('#tot_months').val('');
            //console.log(1);

        }); 

        // to show and hide the banking fields as per payment mode selected
        
        $("#bank_name").hide()
        $("#draft_no").hide()
        $("#neft_no").hide() 
        
        $('#collc_mode').on('change',function(){

            var selection = $(this).val();
            switch(selection)
            {
                
                case "B":
                    $("#bank_name").show()
                    $("#draft_no").hide()
                    $("#neft_no").show()
                    break;

                /*case "draft":
                    $("#bank_name").show()
                    $("#draft_no").show()
                    $("#neft_no").hide()
                    break;*/

                case "C":
                    $("#bank_name").hide()
                    $("#draft_no").hide()
                    $("#neft_no").hide()
                    break;

               /* default:
                    $("#bank_name").hide()
                    $("#draft_no").hide()
                    $("#neft_no").hide() */
                      
            }

        });

    });


</script> 


<!-- to select student's name as per class, sec and roll  automatically -->

<script>

    $(document).ready(function()
                    {
                        $('#roll_no').change(
                                                function()
                                                {
                                                    
                                                    $.get('<?php echo site_url("F_collection_c/get_student");?>',{  academic_yr: $('#academic_yr').val(),
                                                                                                                    class_name: $('#class_name').val(),
                                                                                                                    stu_sec: $('#stu_sec').val(), 
                                                                                                                    roll_no: $(this).val()} )
                                                    //console.log(class_name); 
                                                    .done( 
                                                        function(data)
                                                        {
                                                            //console.log(data);
                                                            var stu_name = JSON.parse(data);
                                                            
                                                            //    //var stu_name = value.stu_name;
                                                            $('#stu_name').val(stu_name.gender); 
                                                    
                                                            //    $('#stu_name').val(stu_name.stu_name); 
                                                        }

                                                    );

                                                }

                                            );

                    });


</script>


<!-- to get form month as per selected student // getting last tution fee paied month + 1 in form month field -->

<script>

    $(document).ready(function()
    {

        $('#roll_no').change(function()
        {

            $.get('<?php echo site_url("F_collection_c/js_get_lastPaid_month"); ?>' , {   academic_yr: $('#academic_yr').val(),
                                                                                            class_name: $('#class_name').val(),
                                                                                            stu_sec: $('#stu_sec').val(), 
                                                                                            roll_no: $(this).val() })

            .done(function(data)
            {
                var last_month = 0;
                
                last_month = JSON.parse(data);
                //console.log(last_month);
                if(last_month == 12)
                {
                    var form_month = 1;
                }
                else
                {
                    form_month = parseInt(last_month) + 1;
                }
                console.log(form_month);
                $('#from_month').val(form_month); 
        
            });

        });

    });                

</script>


<!-- to get fees amount by selecting the fees type --> 

<script>

    $(document).ready(function()
    {
        $('#intro').on( "change", ".feeAmount_cls", function()
            {
                
                $.get('<?php echo site_url("F_collection_c/get_feeAmount");?>',{class_name: $('#class_name').val(),
                                                                                fees_type_id: $(this).val()} )
                    //console.log(class_name); 

                .done(function(data)
                {
                
                    //console.log(data);

                    var amount = JSON.parse(data);
                    
                    //console.log(amount.fees_amount);

                    $('.amount_cls').eq($('.feeAmount_cls').index(this)).val(amount.fees_amount); 

                    $("#total").val('');
                    var total = 0;
                    $('.amount_cls').each(function(){
                        total += +$(this).val();
                    });
                    $("#total").val(total); // to show in hidden field // to be sumbitted
                    
                    var months = $("#tot_months").val();

                    var number = months.split(" ");
                    var no = number[0];

                    $("#tot_pm").val(total+' X '+no); // to show in table footer 

                    //console.log(parseInt(no)*total);

                    var tot_amnt = no * total;
                    $("#rs").val(tot_amnt);
                    $("#tot_amnt").val('Rs: '+tot_amnt);

                });

            }

        );

    });

</script>
