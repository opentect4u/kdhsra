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

            <form role="form" method="POST" action= "<?php echo site_url('Report_collection_c/due_report') ?>" >

                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>CLass<font color="red">*</font></label>

                        <select class="form-control" name="class" required >
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
                        <label>Fee Type<font color="red">*</font></label>

                        <select class="form-control" name="fee_type" id="fee_type" required >
                            <option value= "">Select Fee</option>

                            <?php
                                foreach($feesData as $data2)
                                {
                            ?>
                            
                            <option value= "<?php echo($data2->sl_no); ?>"><?php echo($data2->fees_name); ?></option>

                            <?php 
                                } ?>

                        </select>

                    </div>
                    
                </div>

                <div class="col-lg-6"> 

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
                        <label>Payment For(Year)<font color="red">*</font></label>
                        
                        <input type="text" name= "year" class="yearpicker form-control" value="" />
                        
                    </div>
                    

                </div>

                <div class="col-lg-6"> 

                    <div class="form-group" id= "month">

                        <label>Payment For(month)<font color="red">*</font></label>

                        <select class="form-control" name="month" >
                            <option value="">Select Month</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>

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


<script>

    $(document).ready(function()
                {
                    $("#month").hide();

                    $('#fee_type').on('change',function()
                                    {

                                        var selection = $(this).val();
                                        
                                        if(selection == 7 )
                                        {

                                            $("#month").show();

                                        }

                                    });      

                });

</script>
    