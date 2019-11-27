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
        <h1 class="page-header">Transaction</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Expense Entry Form</p>
        <p style="text-align: right; width:50%;  display: inline-block;"><strong>Date:</strong> <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('Expense_cal/index') ?>" >
                
                <div class="col-lg-12">  

                    <!-- <input type= "hidden" name="trans_dt" value= "<?php echo date('y-m-d');?>" required > -->
                    <!-- <input type= "hidden" name="trans_cd" value= "<?php //echo ($trans_data->transCd)+1;?>" required > -->

                    <table class="table table-striped">
                        <div class="form-group">
                            <tr>
                                <th>Expense Name</th>
                                <th>Amount</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                            <tbody id= "intro">
                                <tr>
                                    <td>
                                    
                                        <select class="form-control" name="exp_type_id[]" id="fees_type_id" required >
                                            <option value= "">Select Expense</option>

                                        <?php    
                                            foreach($data_expense as $data)
                                            { 
                                            ?>
                                                <option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->expenses); ?></option>
                                        <?php   
                                            } 
                                            ?>
                                        </select>
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        <input name="exp_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required>
                                        
                                    </td>

                                    <td></td>
                                    
                                   <!-- <td>
                                        
                                        <button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        
                                    </td> -->

                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>
                                        <strong>Total:</strong>
                                    </td>
                                    <td colspan="2">
                                        <input name="total" id="total" class="form-control" placeholder="Total" readonly>  
                                    </td>
                                </tr>
                            </tfoot>

                        </div>

                    </table>

                </div>

                <div class="col-lg-6">
                    <br>

                    <div class="form-group" id="date">
                        <label>Date<font color="red">*</font></label>
                            
                        <input name="trans_dt" type= "date" value="<?php echo date('Y-m-d');?>" class="form-control" placeholder="Date" required>
                    
                    </div>

                    <div class="form-group">
                        <label>Payment Mode<font color="red">*</font></label>
                        
                        <select class="form-control" name="exp_mode" id="collc_mode" required >
                            <!-- <option value= "NULL">Payment by:</option> -->
                            <option value= "cash">Cash</option>
                            <option value= "draft">Draft</option>
                            <option value= "neft">NEFT</option>
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
                        <label>NEFT No<font color="red">*</font></label>
                        <input name="neft_no"  class="form-control" placeholder="NEFT No" >
                    
                    </div>

                    <div class="form-group"> 
                        <label>Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea>
                    </div>

                    <div>
                       
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>
                
                </div>


            </div>
        </div>
    </div>


</div>



<script>

    $(document).ready(function(){

        $("#addrow").click(function(){

            var newElement= '<tr><td><select class="form-control" name="exp_type_id[]" id="fees_type_id"><option value="">Select Fees</option><?php foreach($data_expense as $data){?><option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->expenses);?><?php } ?></select></td><td><input name="exp_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                
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


        $("#bank_name").hide()
        $("#draft_no").hide()
        $("#neft_no").hide() 
        
        
        $('#collc_mode').on('change',function(){

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
                    
            }

        });




    });

</script>





