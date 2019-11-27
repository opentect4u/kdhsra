
<!-- DataTables CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-plugins/dataTables.bootstrap.css'); ?>" rel="stylesheet">

<!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/vendor/datatables-responsive/dataTables.responsive.css'); ?>" rel="stylesheet">


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Student Table</h1>
    </div>
   
</div>

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            
            <div class="panel-heading">
                
                <a href="<?php echo site_url('Student_controller/entry'); ?>" class="btn btn-success">Add Student</a>
            
                <a href="<?php echo site_url('Student_controller/add_csv'); ?>" class="btn btn-success">Add CSV</a>
                 
                <div class= "col-lg-6">
            
                    <?php 
                        $already_selected_value = date('y');
                        $earliest_year = 2100;
                        
                        print ' <select name="academic_yr" id= "academic_yr" class= "form-control">';
                        foreach (range(date('Y'), $earliest_year) as $x) 
                        {
                            print '<option value="'.$x.'"'.($x === $already_selected_value ? ' selected="selected"' : '').'>'.$x.'</option>';
                        }
                        print '</select>';
                    ?>  

                </div>

            </div>

            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        
                        <tr>
                            <th>Sl No</th>
                            <th>Student Name</th>
                            <th>Roll No</th>
                            <th>Class Name</th>
                            <th>Section</th>
                            <th>Mobile</th>
                            <th>Edit</th>
                        </tr>

                    </thead>

                    <tbody id= "stu_list">

                        <?php if($data)
                        { 
                            foreach($data as $row){ ?>
                                <tr> 

                                    <td><?php echo $row->sl_no; ?></td>
                                    <td><?php echo $row->stu_name; ?></td>
                                    <td><?php echo $row->roll_no; ?></td>
                                    <td><?php echo $row->class; ?></td>
                                    <td><?php echo $row->sec; ?></td>
                                    <td><?php echo $row->mob_no; ?></td>
                                    <td><a href="<?php echo site_url('Student_controller/edit_entry/'.$row->sl_no.'/'.$row->stu_name.''); ?>"><i class="fa fa-edit fa-fw fa-2x"></i></a></td>
                                
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

$(document).ready(function()
    {
        $('#academic_yr').change(function()
            {
                $.get('<?php echo site_url("Student_controller/f_grt_stuTable");?>',{ academic_yr: $(this).val()} )
                                     

                .done(function(data)
                {

                    var datas = JSON.parse(data);
                    var dataArr = '';
                    $('#stu_list').children().remove();
                    
                    $.each(datas, function(key, value){

                        dataArr +=  `<tr><td>${value.sl_no}</td>
                                    <td>${value.stu_name}</td>
                                    <td>${value.roll_no}</td>
                                    <td>${value.class}</td>
                                    <td>${value.sec}</td>
                                    <td>${value.mob_no}</td>
                                    <td></td></tr>`;
                                
                    });
                    
                    $('#stu_list').html(dataArr);

                });

            }

        );

    });


</script>
