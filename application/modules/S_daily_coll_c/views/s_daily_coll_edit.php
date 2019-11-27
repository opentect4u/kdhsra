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
        <h1 class="page-header">Transaction</h1>
    </div>
    
</div> 

<div class="panel panel-default">

    <div class="panel-heading">
       <!-- <p align="right">Fees Entry Form</p> -->
       <p style="text-align: left; width:49%; display: inline-block;">Edit Member Collection</p>
       <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('S_daily_coll_c/update') ?>" >
                 
                <?php 
                foreach($edit_data as $row)
                { ?>
                
                    <div class="col-lg-3">  

                        <div class="form-group">
                            <label>Payment For<font color="red">*</font></label>
                            
                        <!--  <input id="bday-month" class="form-control" type="month" name="fees_month" value="2018-12"> -->
                        
                            <select class="form-control" name="fees_month" required >
                                <option value= "<?php echo($row->fees_month); ?>"><?php echo($row->fees_month); ?></option>
                                
                               <!-- <option value= "1">January</option>
                                <option value= "2">February</option>
                                <option value= "3">March</option>
                                <option value= "4">Appril</option>
                                <option value= "5">May</option>
                                <option value= "6">June</option>
                                <option value= "7">July</option>
                                <option value= "8">August</option>
                                <option value= "9">September</option>
                                <option value= "10">October</option>
                                <option value= "11">November</option>
                                <option value= "12">December</option> -->
                            </select>

                        </div>

                        <br>
                        <div class="form-group">
                            <label>Member Id<font color="red">*</font></label>

                            <input name="mem_id" class="form-control" id= "mem_id" value= "<?php echo($row->mem_id); ?>" placeholder="Member Id" required>

                        </div>

                        <br>
                        <div class="form-group">
                            <label>Payment Mode<font color="red">*</font></label>
                            
                            <select class="form-control" name="collc_mode" id="collc_mode" required >
                                <option value= "<?php echo($row->collc_mode); ?>"><?php echo($row->collc_mode); ?></option>
                               <!-- <option value= "cash">Cash</option>
                                <option value= "draft">Draft</option>
                                <option value= "neft">NEFT</option> -->
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

                    <input type = "hidden" name="trans_dt" class="form-control" value= "<?php echo($row->trans_dt);?>">
                
                    <!-- for transaction code ---// using the reference "transCd" not "max(--)" function -->
                    <input type = "hidden" class = "form-control" name= "trans_cd" value= "<?php echo($row->trans_cd);?>"/>
                    
                    <div class="col-lg-3">
                    
                        <div class="form-group">
                            <label>Payment For</label>
                            
                            <input name="fees_year" class="form-control" placeholder="Year" value= "<?php echo($row->fees_year);?>" readonly> 

                        </div>

                        <br>

                        <div class="form-group">
                            <label>Name<font color="red">*</font></label>
                            
                            <input name="mem_name" id="mem_name" class="form-control" value= "<?php echo($row->mem_name);?>" placeholder="Student Name" readonly>
                        </div>

                    </div>

                    <div class="col-lg-10">

                        <table>
                            
                            <div class="form-group">
                                <tr>
                                    <th>Collections</th>
                                    <th>Amount</th>
                                    <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                    
                                </tr>

                                <tbody id= "intro">

                                    <?php   
                                    foreach($edit_coll_data as $data1)
                                    {?>
                                        <tr>
                                            <td>
                                            
                                                <select class="form-control" name="collection_id[]" id="collection_id" required >
                        
                                                        <option value="<?php echo($data1->sl_no); ?>"><?php echo($data1->collections); ?></option>
                                                
                                                </select>
                                            
                                            </td>
                                            
                                            <td>
                                                
                                                <input name="collection_amount[]" id="collection_amount" value= "<?php echo($data1->collection_amount); ?>" class="form-control amount_cls" placeholder="Amount" required>
                                                
                                            </td>
                                            
                                            <td></td>

                                        </tr>

                                    <?php
                                    }?>

                                </tbody>

                                <tfoot>
                                    <tr>
                                        <td>
                                            <strong>Total:</strong>
                                        </td>
                                        <td colspan="2">
                                            <input name="total" id="total" class="form-control" value= "<?php echo ($row->total); ?>" placeholder="Total" readonly>  
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
                            <textarea name="remarks" id="remarks" class="form-control" placeholder="Remarks"><?php echo ($row->remarks); ?></textarea>
                        </div>
                        
                        <br>
                        <div>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                    </div>

                <?php
                }?>

            </form>

        </div>

    </div>

</div>




<script>

    $(document).ready(function(){

        //$("#fees_year").document.write(new Date().getFullYear());
        
        $("#addrow").click(function(){

            var newElement= '<tr><td><select class="form-control" name="collection_id[]" id="collection_id"><option value="">Select Collections</option><?php foreach($coll_type as $data2){?><option value="<?php echo ($data2->sl_no); ?>"><?php echo ($data2->collections);?><?php } ?></select></td><td><input name="collection_amount[]" id="collection_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                        
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


    });

</script>