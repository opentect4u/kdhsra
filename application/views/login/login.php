<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" href="<?php echo base_url('./rahara_logo.jpg'); ?>"> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Educare</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css '); ?>" rel="stylesheet"> 

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.css '); ?>" rel="stylesheet"> 

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css '); ?>" rel="stylesheet"> 

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css '); ?>" rel="stylesheet" type="text/css"> 

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js'); ?>"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js'); ?>"></script>
    <![endif]-->

</head>

<style>
    
    .loging-img{
        width: 100%;
        height: 810px;
    }

    .logo
    {   
        padding-top: 20px;
        margin-left: 40%;
        height: 65px;
    }
    .col-xs-6{
        position: absolute;
    }
</style>
<body>

    <div class="container" style= "margin-left: -15px;">
        <div class="row" >
            <div class="col-md-8 col-xs-1">
                <img class="loging-img" src="<?php echo base_url("login_img.jpg"); ?>" alt="IMG">
            </div>
            
            <div class="col-md-4  col-xs-10">
                <div>
                    <img src="<?php echo base_url('./rahara_logo.jpg'); ?>" class="logo" alt="Logo">

                    <h3 style="text-align: center;">Khardaha Sri Ramakrishna Ashram</h3>
                </div>
                <div class="login-panel panel panel-default">
                    
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="POST" action= "<?php echo site_url('Login_controller/index');?>" onsubmit ="return validate()" method= "post" name= "vform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Name" id= "username" name="username" type="text" autofocus>
                                </div>

                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" id= "password" name="password" type="password" value="">
                                </div>

                            <!--    <a href="<?php// echo site_url('Login_controller/forgot_pass'); ?>">Forgot Password</a> -->

                            <!--    <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div> -->
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>


                <div class="panel-foor">
                    <h4 style="text-align: center;">Powered By: <a href="http://synergicsoftek.in" target="_blank">Synergic Softek Solutions Pvt. Ltd.</a></h4>
                </div>
                
            </div>
        </div>
    </div> 

    <!-- jQuery -->
    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('assets/vendor/bootstrap/js/bootstrap.min.js'); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.js'); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('assets/dist/js/sb-admin-2.js'); ?>"></script>

</body>

</html>



<script>

    var username = document.forms["vform"]["username"];
    var password = document.forms["vform"]["password"];
    
    var name_error = document.getElementById("name_error");
    var pass_error = document.getElementById("pass_error");

    username.addEventListener("blur", nameVerify, true);
    password.addEventListener("blur", passVerify, true);

    function validate()
    {

        if(username.value == "")
        {
            username.style.border = "1px solid red";
            username.focus();
            return false;
        }

        if(password.value == "")
        {
            password.style.border = "1px solid red";
            password.focus();
            return false;
        }

    }

    function nameVerify()
    {

        if(username.value != "")
        {
            username.style.border = "1px solid #2ecc71";
            return true;
        }

    }

    function passVerify()
    {
        if(password.value != "")
        {
            password.style.border = "1px solid #2ecc71";
            return true;
        } 

    }

</script>