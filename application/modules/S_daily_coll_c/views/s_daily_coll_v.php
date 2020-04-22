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
       <p style="text-align: left; width:49%; display: inline-block;">Member Collection</p>
       <p style="text-align: right; width:50%;  display: inline-block;">Date: <?php echo date('d/m/Y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
            <form role="form" method="POST" action= "<?php echo site_url('S_daily_coll_c/index') ?>" >
                 
                <div class="col-lg-3">  

                    <div class="form-group">
                        <label>Collection Date<font color="red">*</font></label>

                        <input type="date" name="trn_dt" class="form-control" id= "trn_dt" value=<?php echo date('Y-m-d');?> required>

                    </div>

                    <div class="form-group">
                        <label>Payment For Month<font color="red">*</font></label>
                         
                        <select class="form-control" name="fees_month" required >
                            <option value= "0">Select Month</option>
                            <option value= "1">January</option>
                            <option value= "2">February</option>
                            <option value= "3">March</option>
                            <option value= "4">April</option>
                            <option value= "5">May</option>
                            <option value= "6">June</option>
                            <option value= "7">July</option>
                            <option value= "8">August</option>
                            <option value= "9">September</option>
                            <option value= "10">October</option>
                            <option value= "11">November</option>
                            <option value= "12">December</option>
                        </select>
                        
                    </div>

                    <div class="form-group">
                        <label>Member ID<font color="red">*</font></label>

                        <input type="text" name="mem_id" class="form-control" id= "mem_id" placeholder="Member Id" required>

                    </div>

                    <div class="form-group">
                        <label>Payment Mode<font color="red">*</font></label>
                        
                        <select class="form-control" name="collc_mode" id="collc_mode" required >
                            <option value= "C">Cash</option>
                            <option value= "Q">Cheque</option>
                            <option value= "B">NEFT/RTGS</option>
                        </select>
                    </div>

                </div>

                <div class="col-lg-3">

                    <div></div>

                    <br><br><br><br>
                    
                    <div class="form-group">
                        <label>Payment For Year</label>
                        
                        <input type="text" name="fees_year" class="form-control" placeholder="Year" value= "<?php echo date('Y'); ?>" readonly> 
                    
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        
                        <input type="text" name="mem_name" id="mem_name" class="form-control" placeholder="Member Name" readonly>
                    </div>

                </div>

                <div class="col-lg-10">

                    <table >
                        
                        <div class="form-group">
                            <tr>
                                <th>Collection Type</th>
                                <th>Amount</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                            <tbody id= "intro">
                                <tr>
                                    <td>
                                        <select class="form-control" name="collection_id[]" id="collection_id" required >
                                            <option value= "0">Select Collections</option>

                                            <?php foreach($colcType as $data){ ?>
                                                <option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->collections); ?></option>
                                            <?php } ?>
                                        </select>
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        <input type="number" name="collection_amount[]" id="collection_amount" class="form-control amount_cls" placeholder="Amount" required>
                                    </td>

                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td>
                                        <strong>Total:</strong>
                                    </td>
                                    <td colspan="1">
                                        <input type="number" name="total" id="total" class="form-control" placeholder="Total" readonly>  
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
                        <textarea rows="3" cols="50" name="remarks" id="remarks" class="form-control" placeholder="Remarks"></textarea>
                    </div>

                    <div>
                       
                        <button type="submit" class="btn btn-primary">Submit</button>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


<script>

    $(document).ready(function(){

//Add new year     
        $("#addrow").click(function(){

            var newElement= '<tr><td><select class="form-control" name="collection_id[]" id="collection_id"><option value="">Select Collections</option><?php foreach($colcType as $data){?><option value="<?php echo ($data->sl_no); ?>"><?php echo ($data->collections);?><?php } ?></select></td><td><input name="collection_amount[]" id="collection_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                        
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

        $("#mem_id").on("change",function(){

            var mem_id = $(this).val();

            $.get('<?php echo site_url("S_daily_coll_c/get_member"); ?>',{memId:mem_id})

                    .done(function(data){

                     var mem_data = JSON.parse(data);

                    $("#mem_name").val(mem_data.mem_name);
                    
                })
        });

    });


</script>