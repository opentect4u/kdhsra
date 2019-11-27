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
       <!-- <p align="right">Fees Entry Form</p> -->
       <p style="text-align: left; width:49%; display: inline-block;">Edit Fees Entry</p>
       <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('Expense_cal/update_exp') ?>" >
                <div class="col-lg-8"> 
                    <table >
                        <div class="form-group">
                            <tr>
                                <th>Expese Name</th>
                                <th>Amount</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                            <tbody id= "intro">
                                <?php   
                                foreach($edit_exp_data as $data1)
                                { ?>
                                <tr>

                                    <td>
                                        <select class="form-control" name="exp_type_id[]" id="fees_type_id" required >

                                            <option value="<?php echo ($data1->sl_no); ?>"><?php echo ($data1->expenses); ?></option>
                                        
                                        </select>
                                        
                                    </td>
                                    
                                    <td>
                                        
                                        <input name="exp_amount[]" id="fees_amount" value= "<?php echo ($data1->exp_amount); ?>" class="form-control amount_cls" placeholder="Amount" required>
                                        
                                    </td>

                                
                                <?php 
                                }?>

                                </tr>

                            </tbody>

                <?php   
                foreach($edit_data as $data2)
                { ?>
                            
                            <tfoot>
                                <tr>
                                    <td>
                                        <strong>Total:</strong>
                                    </td>
                                
                                    <td colspan="2">
                                        <input name="total" id="total" class="form-control" value= "<?php echo($data2->total);?>" placeholder="Total" readonly>  
                                    </td>
                                </tr>
                            </tfoot> 

                        </div>
                    </table>

                </div>

                <div class="col-lg-6">
                    <br>
                    <div class="form-group">
                        <label>Payment Mode<font color="red">*</font></label>
                        
                        <select class="form-control" name="exp_mode" id="collc_mode" required >
                            <option value= "<?php echo($data2->exp_mode); ?>"><?php echo($data2->exp_mode); ?></option>
                            <!--<option value= "cash">Cash</option>
                            <option value= "draft">Draft</option>
                            <option value= "neft">NEFT</option> -->
                        </select>
                    </div>

                    <div class="form-group" id="bank_name">
                        <label>Bank Name<font color="red">*</font></label>
                            
                        <input name="bank_name" value= "<?php echo($data2->bank_name); ?>"  class="form-control" placeholder="Bank Name">
                    
                    </div>

                    <div class="form-group" id="draft_no">

                        <label>Draft No<font color="red">*</font></label>
                            
                        <input name="draft_no" value= "<?php echo($data2->draft_no); ?>" class="form-control" placeholder="Draft No" >
                    
                    </div>

                    <div class="form-group" id="neft_no">
                        <label>NEFT No<font color="red">*</font></label>
                        <input name="neft_no" value= "<?php echo($data2->neft_no); ?>" class="form-control" placeholder="NEFT No" >
                    
                    </div>

                    <div class="form-group"> 
                        <label>Remarks</label>
                        <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"><?php echo($data2->remarks); ?></textarea>
                    </div>

                    <input type= "hidden" name="trans_dt" value= "<?php echo ($data2->trans_dt);?>" required >
                    <input type= "hidden" name="trans_cd" value= "<?php echo ($data2->trans_cd);?>" required >


                    <div>
                       
                        <button type="submit" class="btn btn-default">Submit</button>

                    </div>

                <?php
                }?>
            
            </form>

        </div>

    </div>

</div>


<script>

/// to show and hide the pament mode fields---

    $(document).ready(function(){

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

        // to add or remove row of payment table---

        $("#addrow").click(function(){

         var newElement= '<tr><td><select class="form-control" name="fees_type_id[]" id="fees_type_id"><option value="">Select Fees</option><?php foreach($exp_type as $data3){?><option value="<?php echo ($data3->sl_no); ?>"><?php echo ($data3->expenses);?><?php } ?></select></td><td><input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                        
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



    });

</script>