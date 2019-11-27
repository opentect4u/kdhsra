<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Report_expense_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Report_expense_m');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }


        public function main()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Report_expense_v');
            $this->load->view('post_login/academy/footer');

        }


        public function index()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                //echo $splittedstring[1];
                //echo $splittedstring[0];

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->f_get_table($startDt, $endDt);
                
            }

        }


        public function f_get_table($startDt, $endDt)
        {

            $modal_data['data1'] = $this->Report_expense_m->f_get_table($startDt, $endDt); 
            //var_dump($table_data['data1']); die;
            $modal_data['data2'] = $this->Report_expense_m->f_get_total_collection($startDt, $endDt);

            $modal_data['data'] = array($startDt, $endDt);

            $this->load->view('post_login/academy/header');
            $this->load->view('expense_modal', $modal_data);
            $this->load->view('post_login/academy/footer');

        }

        // For Balance report Section //

        public function balanceReport()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('balanceRep_selection');            
            $this->load->view('post_login/academy/footer');

        }
    
        public function show_balRep()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $this->f_get_balRep($startDt, $endDt);
                
            }

        }

        public function f_get_balRep($startDt, $endDt)
        {

            $modal_data['data1'] = $this->Report_expense_m->f_get_balanceTable($startDt, $endDt); 
            //echo "<pre>";
            //var_dump($modal_data['data1']); die;

            $modal_data['data'] = array($startDt, $endDt);

            $this->load->view('post_login/academy/header');
            $this->load->view('balanceReport', $modal_data);
            $this->load->view('post_login/academy/footer');

        }


    // For Head Wise Payment Report //

        public function hw_payment()
        {

            $this->load->view('post_login/academy/header');

            $expense_result['data_expense'] = $this->Report_expense_m->f_get_expenses();
            $this->load->view('hw_expenseSelection', $expense_result);   

            $this->load->view('post_login/academy/footer');

        }

        public function hw_expenseReport()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter         =       $_POST['datefilter'];
                $expense_type       =       $_POST['expense_type'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $report_data['data'] = $this->Report_expense_m->f_get_hwExpense($startDt, $endDt, $expense_type); 
                $report_data['total'] = $this->Report_expense_m->f_get_tot_hwExpense($startDt, $endDt, $expense_type); 
                $report_data['start_dt'] = $startDt;
                $report_data['end_dt'] = $endDt;
                $report_data['exp_name'] = $this->Report_expense_m->f_get_hwExpenseName($expense_type);

                $this->load->view('post_login/academy/header');

                $this->load->view('hw_expenseReport', $report_data);   

                $this->load->view('post_login/academy/footer');
                
            }

        }


    // ************************* For Collection Expense Summery Report ************************************ //

        public function summery_report()
        {

            $this->load->view('post_login/academy/header');

            $this->load->view('summeryRep_selection');

            $this->load->view('post_login/academy/footer');
            
        }

        public function show_summeryRep()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter         =       $_POST['datefilter'];
                
                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $report_data['data1'] = $this->Report_expense_m->f_get_collectionSummery($startDt, $endDt); 
                $report_data['data2'] = $this->Report_expense_m->f_get_expenseSummery($startDt, $endDt); 

                $report_data['start_dt'] = $startDt;
                $report_data['end_dt'] = $endDt;
                //$report_data['exp_name'] = $this->Report_expense_m->f_get_hwExpenseName($expense_type);

                $this->load->view('post_login/academy/header');

                $this->load->view('summery_report', $report_data);   

                $this->load->view('post_login/academy/footer');
                
            }

        }

        public function payment_summery()
        {

            $this->load->view('post_login/academy/header');

            $this->load->view('payment_summery_selection');

            $this->load->view('post_login/academy/footer');

        }

        public function show_paymentSummery()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter         =       $_POST['datefilter'];
                
                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $report_data['data1'] = $this->Report_expense_m->f_get_paymentSummery($startDt, $endDt); 
                $report_data['data2'] = $this->Report_expense_m->f_get_expenseSummery($startDt, $endDt); 

                $report_data['start_dt'] = $startDt;
                $report_data['end_dt'] = $endDt;
                //$report_data['exp_name'] = $this->Report_expense_m->f_get_hwExpenseName($expense_type);

                $this->load->view('post_login/academy/header');

                $this->load->view('paymentSummery_rep', $report_data);   

                $this->load->view('post_login/academy/footer');
                
            }

        }






    }

?>