<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Monthly Collections</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <a href="<?php echo site_url('S_daily_coll_c/index'); ?>" class="btn btn-success">New Collection</a>
            </div>

            <span class="confirm-div" style="float:right; color:green;"></span>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    
                    <thead>
                        
                        <tr>
                            <th style="display:none;">Year</th>
                            <th style="display:none;">Month</th>
                            <th style="display:none;">Day</th>
                            <th>Date</th>
                            <th style="display:none;">Transaction Code</th>
                            <th>Member ID</th>
                            <th>Name</th>
                            <th>Paid Amount</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($data)
                        { 
                            foreach($data as $row){ ?>

                                <tr> 
                                    <td style="display:none;"><?php echo date('Y',strtotime($row->trans_dt)); ?></td>
                                    <td style="display:none;"><?php echo date('n',strtotime($row->trans_dt)); ?></td>
                                    <td style="display:none;"><?php echo date('d',strtotime($row->trans_dt)); ?></td>
                                    <td><?php echo date('d/m/Y',strtotime($row->trans_dt)); ?></td>
                                    <td style="display:none;"><?php echo $row->trans_cd; ?></td>
                                    <td><?php echo $row->mem_id; ?></td>
                                    <td><?php echo $row->mem_name; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                    <td><a href="<?php echo site_url('S_daily_coll_c/edit_entry/'.$row->trans_dt.'/'.$row->trans_cd.''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                                    <td><a href="<?php echo site_url('S_daily_coll_c/edit_entry/'.$row->trans_dt.'/'.$row->trans_cd.''); ?>"><i class="fa fa-trash fa-fw fa-2x"></i></a></td>
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

