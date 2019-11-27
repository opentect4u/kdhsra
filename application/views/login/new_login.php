<!DOCTYPE html>
<html lang="en">

    <head>

        <link rel="icon" href="<?php echo base_url('./om.jpg'); ?>"> 
        <meta charset = "utf-8">
        <title> Educare </title>
        <link rel= "stylesheet" href= "<?php echo base_url('new_login.css '); ?>">

    </head>

    <body>
        <h1 style= "text-align: center">Khardaha Sri Ramakrishna Ashram</h1>
        <form class= "box" action="<?php echo site_url('Login_controller/index');?>" method= "post">
            
            <h2>Login</h2>
            <input type="text" name= "username" placeholder="User Name" required>
            <input type="password" name= "password" placeholder="password" required>
            <input type="submit" name= "" value= "Login">
            
        </form>

    </body>
</html>