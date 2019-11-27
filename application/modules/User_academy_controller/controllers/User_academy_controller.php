<?php

	if ( ! defined('BASEPATH')) 

		exit('No direct script access allowed');
    
    class User_academy_controller extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
			$this->load->model('User_academy_model');
			
			$this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }


        public function main() // for academy
        {

            $this->load->view('post_login/academy/header');
            $this->fetch_table_a();
            $this->load->view('post_login/academy/footer');

        }

        public function s_main()  // for society 
        {

            $this->load->view('post_login/society/header');
            $this->fetch_table_s();
            $this->load->view('post_login/society/footer');

        }

        public function fetch_table_a() // for academy
        {

            $user_result['data'] = $this->User_academy_model->fetch_user_a();
            //var_dump($user_result); die;
            $this->load->view('User_table', $user_result);

        }

        public function fetch_table_s() // for society
        {

            $user_result['data'] = $this->User_academy_model->fetch_user_s();
            //var_dump($user_result); die;
            $this->load->view('User_table_s', $user_result);

        }


        public function entry() // for academy
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('User_view');
            $this->load->view('post_login/academy/footer');

        }

        public function entry_s() // for society
        {

            $this->load->view('post_login/society/header');
            $this->load->view('User_view');
            $this->load->view('post_login/society/footer');

        }
       

        public function index()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 

            }

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $name             =       $_POST['name'];
                $user_name        =       $_POST['user_name'];
                $password         =       $_POST['password'];
                $c_password       =       $_POST['c_password'];
                $user_type        =       $_POST['user_type'];
                $user_status      =       $_POST['user_status'];
                $date_c           =       $_POST['date_c'];



                $this->User_academy_model->new_user($name ,$user_name, $password, $c_password, $user_type, $user_status, $created_by, $date_c);

                echo "<script> alert('Successfully Submitted');
                    document.location= 'main' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Password Missmatch');
                document.location= 'main' </script>";

            }

        }



    }


?>