<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Fees_controller extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Fees_model');
            
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
            $fees_result['data'] = $this->Fees_model->fetch_table();

            //var_dump($class_result); die;

            $this->load->view('Fees_table', $fees_result);

        }


        public function entry()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Fees_view');
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
                $fees_name          =       $_POST['fees_name'];
                $date_c             =       $_POST['date_c'];

                $this->Fees_model->new_fees($fees_name, $created_by, $date_c);

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

        
        public function edit_entry($sl_no, $fees_name)
        {

            $this->load->view('post_login/academy/header');           
            
            //$fees_array['data']    =   array($sl_no, $fees_name);
            $fees_array['data'] = $this->Fees_model->f_edit_fees_data($sl_no);

            $this->load->view('Fees_edit_view', $fees_array);

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

                $fees_name         =       $_POST['fees_name'];
                $sl_no              =       $_POST['sl_no'];
                $date_m             =       $_POST['date_m'];
                
                $this->Fees_model->update_fees($sl_no ,$fees_name, $modified_by, $date_m);

                echo "<script> alert('Successfully Updated');
                    document.location= 'main' </script>";

            }
            else
            {

                echo "<script> alert('Sorry!');
                document.location= 'main' </script>";

            }            

        }


        // ***************** For Fee amount Section ****************** //


        public function fee_amount()
        {

            $this->load->view('post_login/academy/header');           

            $result_details['class_data']  = $this->Fees_model->f_get_class(); // to get the values of "td_class" table
			$result_details['fees_data']  = $this->Fees_model->f_get_fees(); // to get the values of "td_fees" table
            
            $this->load->view('feeAmount_entry', $result_details);

            $this->load->view('post_login/academy/footer');

        }

        
        public function amount_entry()
        {

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $created_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $fees_type_no           =       $_POST['fees_type_id'];
                $fees_amount            =       $_POST['fees_amount'];
                $class                  =       $_POST['stu_class'];

                $fees_count         =     count($fees_type_no);                
                
                $this->Fees_model->new_fees_amount($fees_type_no, $fees_amount, $class, $fees_count, $created_by, $created_dt );

                //echo $created_by; die;

                echo "<script> alert('Successfully Submitted');
                    document.location= 'feeAmount_Table' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Try Again');
                document.location= 'feeAmount_Table' </script>";

            }

            
        }


        public function feeAmount_Table()
        {

            $this->load->view('post_login/academy/header');           

            $table_result['data']  = $this->Fees_model->f_get_fees_amount();
            $this->load->view('feeAmount_table', $table_result);

            $this->load->view('post_login/academy/footer');

        }


        public function edit_feeAmount($class, $fees_type_no)
        {

            $this->load->view('post_login/academy/header');           

            $edit_data['data'] = $this->Fees_model->f_get_fees_amountData($class, $fees_type_no);
            $this->load->view('feeAmount_edit', $edit_data);

            $this->load->view('post_login/academy/footer');            

        }

        public function update_feeAmount()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }
            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $fees_type_no           =       $_POST['fees_type_id'];
                $fees_amount            =       $_POST['fees_amount'];
                $class                  =       $_POST['stu_class'];

                
                $this->Fees_model->update_fees_amount($fees_type_no, $fees_amount, $class, $modified_by, $modified_dt );

                //echo $created_by; die;

                echo "<script> alert('Successfully Updated');
                    document.location= 'feeAmount_Table' </script>";
            
            }
            else
            {

                echo "<script> alert('Sorry! Try Again');
                document.location= 'feeAmount_Table' </script>";

            }

        }


    }

?>