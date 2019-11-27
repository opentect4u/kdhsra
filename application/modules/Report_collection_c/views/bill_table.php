<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">

<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Monthly Bill Table</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
               <!-- <a href="<?php// echo site_url('F_collection_c/entry'); ?>" class="btn btn-success">New Fees</a> -->
            </div>  

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Date</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($bill_data)
                        { 
                            foreach($bill_data as $row){ ?>

                                <tr> 
                                    <td><?php echo $row->trans_dt; ?></td>
                                    <td><?php echo $row->stu_class; ?></td>
                                    <td><?php echo $row->stu_sec; ?></td>
                                    <td><?php echo $row->roll_no; ?></td>
                                    <td><?php echo $row->stu_name; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                    <td><a href="<?php echo site_url('Report_collection_c/modal_bill/'.$row->trans_dt.'/'.$row->trans_cd.''); ?>"><i class="fa fa-print fa-fw fa-2x"></i></a></td>
                                </tr>

                            <?php } 
                        } ?>

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