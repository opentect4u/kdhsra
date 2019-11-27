<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">User Table</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <a href="<?php echo site_url('User_academy_controller/entry_s'); ?>" class="btn btn-success">Add User</a>
            </div>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Sl No</th>
                            <th>User Name</th>
                            <th>User ID</th>
                            <th>User Status</th>
                            <th>Edit</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($data)
                        { 

                            foreach($data as $row){ ?>

                                <tr> 

                                    <td><?php echo $row->sl_no; ?></td>
                                    <td><?php echo $row->name; ?></td>
                                    <td><?php echo $row->user_name; ?></td>
                                    <td><?php echo $row->user_status; ?></td>
                                    <td><a href="<?php echo site_url('Class_controller/edit_entry/'.$row->sl_no.'/'.$row->user_name.''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                                
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
