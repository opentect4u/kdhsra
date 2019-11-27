<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>


<div class="panel panel-default">

    <div class="panel-heading">
    
        Upload Student CSV File 
        
    </div>

    <div class="panel-body">

        <div class="row">

            <form method= "post" id= "upload_file" enctype= "multipart/form-data" action= "<?php echo site_url('Student_controller/upload_csv')?> ">

                <input type= "file"  name= "csv_file" id= "csv_file" />
                <br/><br/>
                <input type= "submit" name= "upload" id= "upload" value= "upload" />
                
            <form>

        </div>

    </div>

</div>