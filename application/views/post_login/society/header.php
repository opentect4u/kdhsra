<!DOCTYPE html>
<html>

<head>

    <link rel="icon" href="<?php echo base_url('./rahara_logo.jpg'); ?>"> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Educare</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('assets/vendor/metisMenu/metisMenu.min.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('assets/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url('assets/vendor/morrisjs/morris.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <script src="<?php echo base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
    
    <style> 
        #page-wrapper
        {
            min-height:582px;
        }
    </style>
   
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button> 
                
                <h4 style="margin-left: 25px;"> <?php echo "Society - ".$this->session->userdata('loggedin')->name; ?></h4>

            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                      <!--  <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('Login_controller/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>

                        <li>
                            <a href="<?php echo site_url('Login_controller/login'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa  fa-institution fa-fw"></i>Admin<span class="fa arrow"></span></a>
                           
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('Add_member_c/main'); ?>">Add Member</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Society_collection_c/main'); ?>">Add Collections</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('User_academy_controller/s_main'); ?>">Add User</a>
                                </li>

                            </ul>
                            <!-- /nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i>Transaction<span class="fa arrow"></span></a>
                           
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('S_daily_coll_c/main'); ?>">Member Collection</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('S_Expense_cal/main'); ?>">Expenses</a> 
                                </li>
                                

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-file-zip-o fa-fw"></i>Report<span class="fa arrow"></span></a>
                            
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo site_url('S_report_coll_c/main'); ?>">Collection Report</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('S_Report_expense/main'); ?>">Expense Report</a>
                                </li>

                            </ul>
                        </li>
                    </ul>

                </div>
                
            </div>
           
        </nav>

        <div id="page-wrapper">
        <!-- page-wrapper starts -->
