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
                <h4 style="margin-left: 25px;"> <?php echo "Academy - ".$this->session->userdata('loggedin')->name; ?></h4>
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
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
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
                        <li>
                            <a href="<?php echo site_url('Login_controller/login'); ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="#"><i class="fa  fa-institution fa-fw"></i>Admin<span class="fa arrow"></span></a>
                           
                            <ul class="nav nav-second-level">

                                
                                <li>
                                    <a href="<?php echo site_url('classControllers/main'); ?>">Add Class</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Expense_controller/main'); ?>">Add Expenses</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Fees_controller/main'); ?>">Add Fee Type</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Fees_controller/feeAmount_Table'); ?>">Add Fee Amount</a>
                                </li>
                                
                                <li>
                                    <a href="<?php echo site_url('Student_controller/main'); ?>">Add Student</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('User_academy_controller/main'); ?>">Add User</a>
                                </li>
                                
                            <!-- In future Section can be added if required --> 

                            <!--    <li>
                                    <a href="<?php //echo site_url('Section_controller/main'); ?>">Add Section</a>
                                </li> -->
                                
                                


                            </ul>
                            <!-- /nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-money fa-fw"></i>Transaction<span class="fa arrow"></span></a>
                           
                            <ul class="nav nav-second-level">

                                <li>
                                    <a href="<?php echo site_url('F_collection_c/main'); ?>">Collection</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('Expense_cal/main'); ?>">Expenses</a>
                                </li>
                                <li>
                                    <!-- <a href="<?php //echo site_url('F_collection_c/approvalTable'); ?>">Approval of Collection</a> -->
                                </li>
                                <li>
                                    <!-- <a href="<?php //echo site_url('Expense_cal/approvalTable'); ?>">Approval of Expense</a> -->
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-file-zip-o fa-fw"></i> Report <span class="fa arrow"></a>
                        
                            <ul class="nav nav-second-level">
                                
                                <hr>
                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/feeChart_report'); ?>">Fee Chart </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/feeCollc_report'); ?>">Fee Collection Chart </a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/tutionFee_ledger'); ?>">Tution Fee Ledger</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/examFee_ledger'); ?>">Exam Fee Ledger</a>
                                </li>

                                <hr>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/main'); ?>">Total Collection</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/fwCollection_report'); ?>">Feetype Wise Collection</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/swCollection_report'); ?>">Student Wise Collection</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/Collection_summery'); ?>">Monthly Collection Summery</a>
                                </li>

                                <hr>


                                <li>
                                    <a href="<?php echo site_url('Report_expense_c/main'); ?>">Total Payment</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_expense_c/hw_payment'); ?>">Head Wise Payment</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_expense_c/payment_summery'); ?>">Payment Summery</a>
                                </li>

                                <hr>

                                <li>
                                    <a href="<?php echo site_url('Report_expense_c/summery_report'); ?>">Collection Payment Summary</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/due'); ?>">Due Report</a>
                                </li>

                                <li>
                                    <a href="<?php echo site_url('Report_collection_c/bill'); ?>">Fees Receipt</a>
                                </li>

                                <hr>

                            </ul>
                        
                        </li>
                    </ul>

                </div>
                
            </div>
           
        </nav>

    <div id="page-wrapper">
        <!-- page-wrapper starts -->
