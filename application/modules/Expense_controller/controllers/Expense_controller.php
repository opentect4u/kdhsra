<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Expense_controller extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Expense_model');
            
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
            $expense_result['data'] = $this->Expense_model->fetch_table();

            //var_dump($class_result); die;

            $this->load->view('Expense_table', $expense_result);

        }

        public function entry()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Expense_view');
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
                $expense_name        =       $_POST['expense_name'];
                $date_c              =       $_POST['date_c'];

                $this->Expense_model->new_expense($expense_name, $created_by, $date_c);

                echo "<script> alert('Successfully Submitted');
                    document.location= 'main' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Password Missmatch');
                document.location= 'main' </script>";

            }

        }

        public function edit_entry($sl_no)
        {

            $this->load->view('post_login/academy/header');           
            
            $expense_array['data']    =   $this->Expense_model->f_edit_expense_data($sl_no);
            

            $this->load->view('Expense_edit_view', $expense_array);

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

                $expense_name       =       $_POST['expense_name'];
                $sl_no              =       $_POST['sl_no'];
                $date_m             =       $_POST['date_m'];
                
                $this->Expense_model->update_expense($sl_no ,$expense_name, $modified_by, $date_m);

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