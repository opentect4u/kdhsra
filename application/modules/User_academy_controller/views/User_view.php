<div class="row">

    <div class="col-lg-12">
        <h1 class="page-header">Admin</h1>
    </div>
    
</div>

<div class="panel panel-default">

    <div class="panel-heading">
        User Entry Form
    </div>

    <div class="panel-body">
        <div class="row">
            <div class="col-lg-6">

                <form role="form" method="POST" action= " <?php echo site_url('User_academy_controller/index') ?>" >
                <input type= "hidden" name="date_c" value= "<?php echo date('y-m-d H:i:s');?>" required >

                    <div class="form-group">
                        <label>User Name<font color="red">*</font></label>
                        <input class="form-control" name="name" placeholder="User's Name" required>
                    </div>
                    <div class="form-group">
                        <label>User's ID<font color="red">*</font></label>
                        <input class="form-control" name="user_name" placeholder="User's Name" required>
                    </div>
                    <div class="form-group">
                        <label>Password<font color="red">*</font></label>
                        <input type= "password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password<font color="red">*</font></label>
                        <input type= "password" class="form-control" name="c_password" placeholder="Password" required>
                    </div>

                    <div class="form-group">
                        <label>User Type<font color="red">*</font></label>
                        <select class="form-control" name="user_type" required >

                            <option value= "">Select User Type</option>
                            <option value= "society">society</option>
                            <option value= "academy">academy</option>
                            <!--<option value= "general">general</option> -->
                            
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Status<font color="red">*</font></label>
                        <select class="form-control" name="user_status" required >

                            <option value= "">Select User Status</option>
                            <option value= "A">Active</option>
                            <option value= "I">Inactive</option>
                            
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-default">Submit</button>

                </form>
            </div>
        </div>
    </div>

</div>