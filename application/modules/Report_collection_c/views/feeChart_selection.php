<!-- for year picker --> 

<link href="<?php echo base_url('assets/vendor/Year-Picker/style.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/vendor/Year-Picker/yearpicker.js'); ?>" async ></script>



<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Class Wise Fee Chart</h1>
    </div>
    
</div> 


<div class="panel panel-default">

    <div class="panel-heading">
       
       <p style="text-align: left; width:49%; display: inline-block;">Fee Chart For: </p>
       
    </div>

    <div class="panel-body">
        
        <div class="row">

            <form role="form" method="POST" action= "<?php echo site_url('Report_collection_c/view_feeChart') ?>" >

                <div class="col-lg-6"> 

                    <div class="form-group">
                        <label>Fee Type<font color="red">*</font></label>

                        <select class="form-control" name="fee" required >
                            <option value= "">Select Fee</option>

                        <?php
                            foreach($feesData as $data1)
                            {
                            ?>
                            
                            <option value= "<?php echo($data1->sl_no); ?>"><?php echo($data1->fees_name); ?></option>
                            
                            <?php
                                } ?>
                        </select>

                    </div>

                    <div class="form-group">
                        <label>Academic Year<font color="red">*</font></label>
                        
                        <input type="text" name= "year" class="yearpicker form-control" value="" />
                        
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

