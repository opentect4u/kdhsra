<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class S_Expense_cal extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Expense_cal_m');
            
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
            $today = date('y-m-d');
            $exp_result['data'] = $this->Expense_cal_m->fetch_table($today);

            //var_dump($exp_result); die;
            $this->load->view('expense_cal_table', $exp_result);
        }


        public function entry()
        {

            $trans_dt       =       date('y-m-d'); 

            $expense_result['data_expense'] = $this->Expense_cal_m->f_get_expenses();
            $expense_result['trans_data'] = $this->Expense_cal_m->new_transCd($trans_dt);

            //echo "<pre>";
            //var_dump($expense_result); die;

            $this->load->view('post_login/society/header');
            $this->load->view('expense_cal_view', $expense_result);
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
                
                $trans_dt       =       $_POST['trans_dt'];
                $trans_cd       =       $_POST['trans_cd'];
                
                $exp_mode       =       $_POST['exp_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $exp_type_id    =       $_POST['exp_type_id'];
                $exp_amount     =       $_POST['exp_amount'];


                $exp_count         =     count($exp_type_id);
                $exp_amount_count  =     count($exp_amount);

                //echo $exp_count; die;
                //var_dump($exp_type_id); die;

                $this->Expense_cal_m->new_expense($trans_dt, $trans_cd, $exp_mode, $bank_name,
                                                    $draft_no, $neft_no, $total, $remarks,
                                                    $created_by, $created_dt);
                

                $this->Expense_cal_m->new_exp_details($trans_dt, $trans_cd, $exp_type_id, $exp_amount,
                                                        $exp_count, $exp_amount_count, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'main' </script>";                                       
            }
            else
            {
                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";
            }


        }


        public function edit_entry($trans_dt, $trans_cd)
        {

            $this->load->view('post_login/society/header');
            $edit_result['edit_data']  = $this->Expense_cal_m->f_get_edit_details($trans_dt, $trans_cd); 

			$edit_result['edit_exp_data'] = $this->Expense_cal_m->f_get_edit_exp_details($trans_dt, $trans_cd); 
            
            $edit_result['exp_type'] = $this->Expense_cal_m->f_get_exp();

            $this->load->view('expense_cal_edit', $edit_result);
            $this->load->view('post_login/society/footer');
            
        } 


        public function update_exp()
        {

            if($this->session->userdata('loggedin'))
            {
                $modified_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $modified_dt       =     date('y-m-d H:i:s');

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $trans_dt       =       $_POST['trans_dt'];
                $trans_cd       =       $_POST['trans_cd'];
                
                $exp_mode       =       $_POST['exp_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $exp_type_id    =       $_POST['exp_type_id'];
                $exp_amount     =       $_POST['exp_amount'];


                $exp_count         =     count($exp_type_id);
                $exp_amount_count  =     count($exp_amount);


                $this->Expense_cal_m->update_expense($trans_dt, $trans_cd, $exp_mode, $bank_name,
                                                    $draft_no, $neft_no, $total, $remarks,
                                                    $modified_by, $modified_dt);
                

                $this->Expense_cal_m->update_exp_details($trans_dt, $trans_cd, $exp_type_id, $exp_amount,
                                                        $exp_count, $exp_amount_count, $modified_by, $modified_dt);

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