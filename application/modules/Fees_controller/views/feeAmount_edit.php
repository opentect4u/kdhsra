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
        
            <form role="form" method="POST" action= "<?php echo site_url('Fees_controller/update_feeAmount') ?>" >
                
                <?php
                foreach($data as $row)
                { ?>

                    <div class="col-lg-12">  

                        <table class="table table-striped">

                            <div class="form-group">
                                <tr>
                                    <th>Fees Name</th>
                                    <th>Amount</th>
                                    
                                </tr>

                                <tbody id= "intro">

                                    <tr>
                                        <td>
                                        
                                            <select class="form-control" name="fees_type_id" id="fees_type_id" required >
                                                
                                                <option value= "<?php echo $row->fees_type_no; ?>"><?php echo $row->fees_name; ?></option>

                                            </select>

                                        </td>
                                        
                                        <td>
                                            
                                            <input name="fees_amount" value= "<?php echo $row->fees_amount; ?>" class="form-control amount_cls" placeholder="Amount" required>
                                            
                                        </td>

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
                                
                                <option value= "<?php echo ($row->class); ?>"><?php echo ($row->class); ?></option>

                            </select>
                        </div>
                    
                        <div>
                        
                            <button type="submit" class="btn btn-primary">Submit</button>

                        </div>

                <?php
                    }
                    ?>
                    
                </div>

            </div>
        </div>
    </div>

</div>

