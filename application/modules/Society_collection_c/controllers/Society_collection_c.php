<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Society_collection_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Society_collection_m');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }

        public function main()
        {
            $this->load->view('post_login/society/header');
            $this->fetch_table();
            $this->load->view('post_login/society/footer');

        }

        public function fetch_table()
        {
            $result['data'] = $this->Society_collection_m->fetch_table();
            
            $this->load->view('s_collection_table', $result);

        }


        public function entry()
        {

            $this->load->view('post_login/society/header');
            $this->load->view('s_collection_form');
            $this->load->view('post_login/society/footer');

        }


        public function index()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $collections        =       $_POST['collections'];
                //$date_c             =       $_POST['date_c'];

                $this->Society_collection_m->new_collection($collections, $created_by, $created_dt);

                //echo $created_by; die;

                echo "<script> alert('Successfully Submitted');
                    document.location= 'main' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Password Missmatch');
                document.location= 'main' </script>";

            }

        }

        public function edit_entry($sl_no, $collections)
        {

            $this->load->view('post_login/society/header');

            $result['data'] = $this->Society_collection_m->get_edit_data($sl_no);
            $this->load->view('s_collection_edit', $result);

            $this->load->view('post_login/society/footer');

        }

        public function edit()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $sl_no             =       $_POST['sl_no'];
                $collections       =       $_POST['collections'];

                $this->Society_collection_m->edit_collection($sl_no, $collections, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'main' </script>";
            }
            else
            {
                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";
            }

        }



    }
?>