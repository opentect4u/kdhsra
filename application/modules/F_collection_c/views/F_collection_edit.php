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

<?php
    //var_dump($edit_fees_data); die;
?>


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Transaction</h1>
    </div>
    
</div> 

<div class="panel panel-default">

    <div class="panel-heading">
       <!-- <p align="right">Fees Entry Form</p> -->
       <p style="text-align: left; width:49%; display: inline-block;">Edit Fees Entry</p>
       <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>
    
    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('F_collection_c/update_fees') ?>" >
            
                <?php 
                    foreach($edit_data as $row)
                    { ?>
                            
                        <div class="col-lg-3">  

                        <!-- <div class="form-group">
                                <label>Date:</label>
                                <input class="form-control" value= "<?php //echo date('d/m/y');?>" readonly>
                            </div> -->

                            <div class="form-group">
                                <label>Payment For(Month)<font color="red">*</font></label>
                                
                                <select class="form-control"  name="fees_month" required >
                                    <option value= "<?php echo($row->fees_month); ?>"><?php echo($row->fees_month); ?></option>
                                   
                                    
                                </select>
                                
                            </div>

                         <!--   <br>
                            <div class="form-group">
                                <label>Payment For</label>
                                
                                <input name="fees_year" class="form-control" value= "<?php// echo($row->fees_year);?>" placeholder="Year" readonly>

                            </div> -->
                            
                            
                            <br>
                            <div class="form-group">
                                <label>Student class<font color="red">*</font></label>

                                <select class="form-control" name="stu_class" required >
                                    <option value= "<?php echo($row->stu_class); ?>"><?php echo($row->stu_class); ?></option>

                                </select>

                            </div>

                            <div class="form-group">
                               <!-- <label>Student Section<font color="red">*</font></label>
                                
                                <select class="form-control" name="stu_sec" required >
                                    <option value= "<?php //echo($row->stu_sec); ?>"><?php //echo($row->stu_sec); ?></option> -->

                                    <label>Student Roll No<font color="red">*</font></label>

                                    <input name="roll_no" class="form-control" value= "<?php echo($row->roll_no);?>" placeholder="Roll No" required>

                                </select>
                            </div>

                            <br>
                            <div class="form-group">
                                <label>Payment Mode<font color="red">*</font></label>
                                
                                <select class="form-control" name="collc_mode" id="collc_mode" required >
                                    <option value= "<?php echo($row->collc_mode); ?>"><?php echo($row->collc_mode); ?></option>
                                    
                                </select>
                            </div>

                            

                            <div class="form-group" id="bank_name">
                                <label>Bank Name<font color="red">*</font></label>
                                    
                                <input name="bank_name" value= "<?php echo($row->bank_name); ?>" class="form-control" placeholder="Bank Name">
                            
                            </div>

                            <div class="form-group" id="draft_no">

                                <label>Draft No<font color="red">*</font></label>
                                    
                                <input name="draft_no" value= "<?php echo($row->draft_no); ?>" class="form-control" placeholder="Draft No" >
                            
                            </div>

                            <div class="form-group" id="neft_no">
                                <label>NEFT No<font color="red">*</font></label>
                                <input name="neft_no" value= "<?php echo($row->neft_no); ?>" class="form-control" placeholder="NEFT No" >
                            
                            </div>

                            


                        </div>

                            <input type = "hidden" name="trans_dt" class="form-control" value= "<?php echo($row->trans_dt);?>" readonly>
                        
                            
                            <input type = "hidden" class = "form-control" name= "trans_cd" value= "<?php echo($row->trans_cd);?>"/>
                        

                        <div class="col-lg-3">
                            
                            <div class="form-group">
                                <label>Payment For(Year)</label>
                                
                                <input name="fees_year" class="form-control" value= "<?php echo($row->fees_year);?>" placeholder="Year" readonly>

                            </div>

                            <br>
                            <div class="form-group">
                                <label>Student Section<font color="red">*</font></label>
                                
                                <select class="form-control" name="stu_sec" required >
                                    <option value= "<?php echo($row->stu_sec); ?>"><?php echo($row->stu_sec); ?></option>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label>Student Name<font color="red">*</font></label>
                                
                                <input name="stu_name" id="stu_name" class="form-control" value= "<?php echo($row->stu_name);?>" placeholder="Student Name" readonly>
                            </div>
                        
                            
                        
                        
                        </div>

                        <div class="col-lg-10">

                            <table >
                                
                                <div class="form-group">
                                    <tr>
                                        <th>Fees</th>
                                        <th>Amount</th>
                                        <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                        
                                    </tr>

                                    <tbody id= "intro">
                                       
                                            <!-- starting forr loop to maintain the row no. -->

                                        <?php   
                                        foreach($edit_fees_data as $data1)
                                        {
                                        
                                        ?>

                                        <tr>

                                            <td>
                                                <select class="form-control" name="fees_type_id[]" id="fees_type_id" required >

                                                    <option value="<?php echo ($data1->sl_no); ?>"><?php echo ($data1->fees_name); ?></option>
                                                
                                                </select>
                                                
                                            </td>
                                            
                                            <td>
                                                
                                                <input name="fees_amount[]" id="fees_amount" value= "<?php echo ($data1->fees_amount); ?>" class="form-control amount_cls" placeholder="Amount" required>
                                                
                                            </td>

                                        </tr>    

                                        <?php 
                                        }  
                                        ?>
                                        
                                        <!--<td>
                                            <button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        </td> -->

                                        
                                        
                                        
                                            <!-- closing the count in for loop -->

                                    </tbody>

                                    <tfoot>
                                        <tr>
                                            <td>
                                                <strong>Total:</strong>
                                            </td>
                                        
                                            <td colspan="2">
                                                <input name="total" id="total" class="form-control" value= "<?php echo($row->total);?>" placeholder="Total" readonly>  
                                            </td>
                                        </tr>
                                    </tfoot> 

                                </div>

                            </table>

                        </div>

                        <div class="col-lg-6">

                            <br><br>
                            <div class="form-group"> 
                                <label>Remarks</label>
                                <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"><?php echo($row->remarks);?></textarea>
                            </div>
                            
                            <br>
                            <div>
                            
                                <button type="submit" class="btn btn-default">Submit</button>

                            </div>

                        </div>

                    <?php
                    }
                    ?>
            
            </form>
        </div>
    </div>

</div>




<script>

    $(document).ready(function(){
        
        $("#addrow").click(function(){

         var newElement= '<tr><td><select class="form-control" name="fees_type_id[]" id="fees_type_id"><option value="">Select Fees</option><?php foreach($fees_type as $data_fees){?><option value="<?php echo ($data_fees->sl_no); ?>"><?php echo ($data_fees->fees_name);?><?php } ?></select></td><td><input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                        
            $("#intro").append($(newElement));
                                                                
        });

        // to change the value of total field as per fees field selected by adding rows
        
        $("#intro").on("click","#removeRow", function(){
            $(this).parent().parent().remove();
            $('.amount_cls').change();
        });
    
        
        $('#intro').on( "change", ".amount_cls", function(){
            $("#total").val('');
            var total = 0;
            $('.amount_cls').each(function(){
                total += +$(this).val();
            });
            $("#total").val(total);
      
        });
        
        // to show and hide the banking fields as per payment mode selected

        
       /* $("#bank_name").hide()
        $("#draft_no").hide()
        $("#neft_no").hide() */
        
        
       /* $('#collc_mode').on('change',function(){

            var selection = $(this).val();
            switch(selection)
            {
                
                case "neft":
                    $("#bank_name").show()
                    $("#draft_no").hide()
                    $("#neft_no").show()
                    break;

                case "draft":
                    $("#bank_name").show()
                    $("#draft_no").show()
                    $("#neft_no").hide()
                    break;

                case "cash":
                    $("#bank_name").hide()
                    $("#draft_no").hide()
                    $("#neft_no").hide()
                    break;  
                           
                    
            }  */

            if($("#collc_mode").val()== 'draft')
                {$("#neft_no").hide();}

            if($("#collc_mode").val()== 'neft')
                {$("#draft_no").hide();}

            if($("#collc_mode").val()== 'cash') 
            {
                $("#bank_name").hide();
                $("#neft_no").hide();
                $("#draft_no").hide();
            }                  


        //});
    

    });


</script> 
