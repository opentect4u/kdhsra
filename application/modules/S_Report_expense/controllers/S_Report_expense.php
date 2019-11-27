<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class S_Report_expense extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('S_Report_expense_m');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }


        public function main()
        {

            $this->load->view('post_login/society/header');
            $this->load->view('Report_expense_v');
            $this->load->view('post_login/society/footer');

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

            $modal_data['data1'] = $this->S_Report_expense_m->f_get_table($startDt, $endDt); 
            //var_dump($table_data['data1']); die;
            $modal_data['data2'] = $this->S_Report_expense_m->f_get_total_collection($startDt, $endDt);

            $modal_data['data'] = array($startDt, $endDt);

            $this->load->view('expense_modal', $modal_data);

        }


    
    }

?>