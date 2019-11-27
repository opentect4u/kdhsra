
<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Fees Collection </h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            
            <div class="panel-heading">
                <a href="<?php echo site_url('F_collection_c/entry'); ?>" class="btn btn-success">Collect Fees</a>
            </div>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Date</th>
                            <!-- <th>Month</th> -->
                            <!-- <th>Year</th> -->
                            <th>Collection For</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Roll No</th>
                            <th>Total Amount</th>
                            <th>Edit</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if($data)
                        { 
                            foreach($data as $row){ ?>

                                <tr> 

                                    <td><?php echo date("d-m-Y",strtotime($row->trans_dt)); ?></td>
                                    <!-- <td><?php //echo $row->fees_month; ?></td> -->
                                    <!-- <td><?php //echo $row->fees_year; ?></td> -->

                                    <td>
                                    
                                        <?php 
                                            if($row->fees_month == 1)
                                                echo "Jan, ".$row->fees_year; 

                                            elseif($row->fees_month == 2)
                                                echo "Feb, ".$row->fees_year; 

                                            elseif($row->fees_month == 3)
                                                echo "Mar, ".$row->fees_year;

                                            elseif($row->fees_month == 4)
                                                echo "Apr, ".$row->fees_year;
                                            
                                            elseif($row->fees_month == 5)
                                                echo "May, ".$row->fees_year;

                                            elseif($row->fees_month == 6)
                                                echo "Jun, ".$row->fees_year;

                                            elseif($row->fees_month == 7)
                                                echo "Jul, ".$row->fees_year;

                                            elseif($row->fees_month == 8)
                                                echo "Aug, ".$row->fees_year;

                                            elseif($row->fees_month == 9)
                                                echo "Sep, ".$row->fees_year;

                                            elseif($row->fees_month == 10)
                                                echo "Oct, ".$row->fees_year;

                                            elseif($row->fees_month == 11)
                                                echo "Nov, ".$row->fees_year;

                                            elseif($row->fees_month == 12)
                                                echo "Dec, ".$row->fees_year;

                                        ?>

                                    </td>
                                    
                                    <td><?php echo $row->stu_class; ?></td>
                                    <td><?php echo $row->stu_sec; ?></td>
                                    <td><?php echo $row->roll_no; ?></td>
                                    <td><?php echo $row->total; ?></td>
                                
                                    <td><a href="<?php echo site_url('F_collection_c/edit_entry/'.$row->trans_dt.'/'.$row->trans_cd.''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                                
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