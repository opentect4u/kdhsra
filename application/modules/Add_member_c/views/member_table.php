<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Manage Members</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <a href="<?php echo site_url('Add_member_c/index'); ?>" class="btn btn-success">Add Member</a>
            </div>

            <span class="confirm-div" style="float:right; color:green;"></span>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Member ID</th>
                            <th>Name</th>                     
                            <th>Subscription</th>
                            <th>Member Type</th>
                            <th>Edit</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($data)
                        { 
                            foreach($data as $row){ ?>

                                <tr> 
                                    <td><?php echo $row->mem_id; ?></td>
                                    <td><?php echo $row->mem_name; ?></td>
                                    <td><?php echo $row->m_sub_amount; ?></td>
                                    <td><?php if($row->mem_type=='L'){
                                                    echo "Lifetime";
                                                }else{
                                                    echo "Regular";
                                                }; 
                                        ?>
                                    </td>

                                    <td><a href="<?php echo site_url('Add_member_c/edit')?>?member_id=<?php echo $row->mem_id; ?>"
                                            data-toggle="tooltip"
                                            data-placement="bottom"
                                            title="Edit"
                                        >   
                                            <i class="fa fa-edit fa-fw fa-2x"></i>
                                        </a>
                                    </td>
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

<script>
   
    $(document).ready(function() {

    $('.confirm-div').hide();

    <?php if($this->session->flashdata('msg')){ ?>

    $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

    });

    <?php } ?>
</script>