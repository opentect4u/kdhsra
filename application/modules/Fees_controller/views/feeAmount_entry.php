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
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        <p style="text-align: left; width:49%; display: inline-block;">Fees Amount Form</p>
        <p style="text-align: right; width:50%;  display: inline-block;"><strong>Date:</strong> <?php echo date('d/m/y');?> </p>
    </div>

    <div class="panel-body">
        
        <div class="row">
        
            <form role="form" method="POST" action= "<?php echo site_url('Fees_controller/amount_entry') ?>" >
                
                <div class="col-lg-12">  

                    <table class="table table-striped">
                        <div class="form-group">
                            <tr>
                                <th>Fees Name</th>
                                <th>Amount</th>
                                <th><button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button></th>
                                
                            </tr>

                            <tbody id= "intro">
                                <tr>
                                    <td>
                                    
                                        <select class="form-control" name="fees_type_id[]" id="fees_type_id" required >
                                            <option value= "">Select Expense</option>

                                        <?php    
                                            foreach($fees_data as $data1)
                                            { 
                                            ?>
                                                <option value= "<?php echo ($data1->sl_no); ?>"><?php echo ($data1->fees_name); ?></option>
                                        <?php   
                                            } 
                                            ?>
                                        </select>
                                    
                                    </td>
                                    
                                    <td>
                                        
                                        <input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required>
                                        
                                    </td>

                                    <td></td>
                                    
                                   <!-- <td>
                                        
                                        <button class="btn btn-success" type="button" id="addrow" data-toggle="tooltip" data-original-title="Add Row" data-placement="bottom"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                        
                                    </td> -->

                                </tr>

                            </tbody>

                        </div>

                    </table>

                </div>

                <div class="col-lg-6">

                    <br>
                    <div class="form-group">

                        <label>Class<font color="red">*</font></label>
                        
                        <select class="form-control" name="stu_class" id= 'class_name' required >
                            <option value= "">Select Class</option>

                        <?php    
                            foreach($class_data as $data2)
                            { 
                             ?>
                                <option value="<?php echo ($data2->class_name); ?>"><?php echo ($data2->class_name); ?></option>
                        <?php   
                            } 
                            ?>
                        </select>

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

            var newElement= '<tr><td><select class="form-control" name="fees_type_id[]" id="fees_type_id"><option value="">Select Fees</option><?php foreach($fees_data as $data1){?><option value="<?php echo ($data1->sl_no); ?>"><?php echo ($data1->fees_name);?><?php } ?></select></td><td><input name="fees_amount[]" id="fees_amount" class="form-control amount_cls" placeholder="Amount" required></td><td><button class="btn btn-danger" type= "button" data-toggle="tooltip" data-original-title="Remove Row" data-placement="bottom" id="removeRow"><i class="fa fa-remove" aria-hidden="true"></i></button></td></tr>';
                                                
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





