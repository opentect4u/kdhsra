<!-- for year picker --> 

<link href="<?php echo base_url('assets/vendor/Year-Picker/style.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.js'); ?>" async ></script>


<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Due Of Payment</h1>
    </div>
    
</div> 


<div class="panel panel-default">

    <div class="panel-heading">
       
       <p style="text-align: left; width:49%; display: inline-block;">Collection Due Report</p>
       
    </div>

    <div class="panel-body">
        
        <div class="row">

            <form role="form" method="POST" action= "<?php echo site_url('Report_collection_c/sw_collection_report') ?>" >

                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>Academic Year<font color="red">*</font></label>
                        
                        <input type="text" name= "academic_yr" id= "academic_yr" class="yearpicker form-control" value="" />
                        
                    </div>

                    <div class="form-group">
                        <label>Section<font color="red">*</font></label>
                        
                        <select class="form-control" name="stu_sec" id= "stu_sec" required >
                            <option value= "">Select Section</option>
                            <option value= "A">A</option>
                            <option value= "B">B</option>
                            <option value= "C">C</option>
                            <option value= "D">D</option>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Student Name<font color="red">*</font></label>
                        
                        <input type="text" name= "stu_name" id= "stu_name" class="form-control" value="" readonly/>
                        
                    </div>

                </div>
                
                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>CLass<font color="red">*</font></label>

                        <select class="form-control" id= "class_name" name="class_name" required >
                            <option value= "">Select Class</option>

                        <?php
                            foreach($classData as $data1)
                            {
                            ?>
                            
                            <option value= "<?php echo($data1->class_name); ?>"><?php echo($data1->class_name); ?></option>
                            
                            <?php
                                } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Roll No<font color="red">*</font></label>
                        
                        <input type="text" name= "roll_no" id= "roll_no" class="form-control" value="" />
                        
                    </div>

                </div>

                

                <div class="col-lg-12">

                    <div>
                       <button type="submit" class="btn btn-primary">Submit</button>
                    </div>

                </div>

            </form>

        </div>

    </div>


</div>



<!-- for Year Picker --> 

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


<!-- to select student's name as per class, sec and roll  automatically -->

<script>

    $(document).ready(function()
    {
        $('#roll_no').change( function()
        { 
            $.get('<?php echo site_url("F_collection_c/get_student");?>',{  academic_yr: $('#academic_yr').val(),
                                                                            class_name: $('#class_name').val(),
                                                                            stu_sec: $('#stu_sec').val(), 
                                                                            roll_no: $(this).val()} )
            //console.log(class_name); 
            .done( 
                function(data)
                {
                    //console.log(data);
                    var stu_name = JSON.parse(data);
                    
                    //    //var stu_name = value.stu_name;
                    $('#stu_name').val(stu_name.stu_name); 
            
                    //    $('#stu_name').val(stu_name.stu_name); 
                }

            );

        } );                                      

    });


</script>
    