<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class ClassControllers extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Class_model');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }

        public function main()
        {

            $this->load->view('post_login/academy/header');
            $this->fetch_table();
            $this->load->view('post_login/academy/footer');

        }


        public function fetch_table()
        {
            $class_result['data'] = $this->Class_model->fetch_class();

            //var_dump($class_result); die;

            $this->load->view('Class_table', $class_result);

        }

        public function entry()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Class_view');
            $this->load->view('post_login/academy/footer');

        }


        public function index()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $date_c            =       $_POST['date_c'];
                $class_name        =       $_POST['class_name'];

                $this->Class_model->new_class($class_name, $date_c, $created_by);

                echo "<script> alert('Successfully Submitted');
                    document.location= 'main' </script>";
            }
            else
            {
                echo "<script> alert('Sorry! Password Missmatch');
                document.location= 'main' </script>";

            }

        }

        
        public function edit_entry($sl_no, $class_name)
        {

            $this->load->view('post_login/academy/header');           
            
            $class_array['data']    =   array($sl_no, $class_name);

            $this->load->view('Class_edit_view', $class_array);

            $this->load->view('post_login/academy/footer');

        }


        public function update_entry()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $class_name         =       $_POST['class_name'];
                $sl_no              =       $_POST['sl_no'];
                $date_m             =       $_POST['date_m'];
                
                $this->Class_model->update_class($sl_no ,$class_name, $modified_by, $date_m);

                echo "<script> alert('Successfully Updated');
                    document.location= 'main' </script>";
            }
            else
            {
                echo "<script> alert('Sorry!');
                document.location= 'main' </script>";

            }            

        }

        

    }

?>