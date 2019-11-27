<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class S_report_coll_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('S_report_coll_m');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }

        }

        public function main()
        {

            $this->load->view('post_login/society/header');
            $this->load->view('s_report_coll_v');
            $this->load->view('post_login/society/footer');

        }

        public function index()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //$this->f_get_table($startDt, $endDt);
                $modal_data['data1'] = $this->S_report_coll_m->f_get_table($startDt, $endDt); 
                //var_dump($table_data['data1']); die;
                $modal_data['data2'] = $this->S_report_coll_m->f_get_total_collection($startDt, $endDt);

                $modal_data['data'] = array($startDt, $endDt);
                
                $this->load->view('s_coll_modal', $modal_data);
            }

        }



    }

?>