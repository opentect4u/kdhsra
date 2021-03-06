<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Daily Expense Table</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <a href="<?php echo site_url('S_Expense_cal/entry'); ?>" class="btn btn-success">Add Expense</a>
            </div>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Date</th>
                            <th>Transaction Code</th>
                           <!-- <th>Expense For</th>      -->                      
                            <th>Total Amount</th>
                            <th>Edit</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($data)
                        { 
                            foreach($data as $row){ ?>

                                <tr> 
                                    <td><?php echo $row->trans_dt; ?></td>
                                    <td><?php echo $row->trans_cd; ?></td>
                                    
                                    
                                    <td><?php echo $row->total; ?></td>
                                    <td><a href="<?php echo site_url('S_Expense_cal/edit_entry/'.$row->trans_dt.'/'.$row->trans_cd.''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                                </tr>

                            <?php } 
                        } ?>

                    </tbody>

                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<!-- DataTables JavaScript -->
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
$(document).ready(function() {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});
</script>
