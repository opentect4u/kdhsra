<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class F_collection_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('F_collection_m');
            
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
            $today = date('y-m-d');
            $fees_result['data'] = $this->F_collection_m->fetch_table($today);
            //var_dump($class_result); die;
            $this->load->view('F_collection_table', $fees_result);
        }


        public function entry()
        {
			$result_details['class_data']  = $this->F_collection_m->f_get_class(); // to get the values of "td_class" table
			$result_details['fees_data']  = $this->F_collection_m->f_get_fees(); // to get the values of "td_fees" table
            
            //to create new transaction code for this date---

            /*$trans_dt       =       date('y-m-d'); 
            $result_details['trans_data'] = $this->F_collection_m->new_transCd($trans_dt); */

            
            $this->load->view('post_login/academy/header');
            $this->load->view('F_collection_view', $result_details);
            $this->load->view('post_login/academy/footer');

        }

        public function get_student()
        {
            
            $class_name     =   $this->input->get('class_name');
            $stu_sec        =   $this->input->get('stu_sec');
            $roll_no        =   $this->input->get('roll_no');
            $academic_yr    =   $this->input->get('academic_yr'); 
            //echo $class_name; die;

            $stu_result = $this->F_collection_m->get_student($academic_yr, $class_name, $stu_sec, $roll_no);
            echo json_encode($stu_result);

        }


        public function js_get_lastPaid_month()
        {

            $class_name     =   $this->input->get('class_name');
            $stu_sec        =   $this->input->get('stu_sec');
            $roll_no        =   $this->input->get('roll_no');
            $academic_yr    =   $this->input->get('academic_yr');

            $last_transDt = $this->F_collection_m->get_last_transDt($class_name, $stu_sec, $roll_no, $academic_yr);
            $date = $last_transDt->trans_dt;

            $last_transCd = $this->F_collection_m->get_last_transCd($class_name, $stu_sec, $roll_no, $academic_yr, $date);
            $code = $last_transCd->trans_cd;

            $last_paidMonth = $this->F_collection_m->get_last_paidMonth($date, $code);
            $last_month = $last_paidMonth->fees_month; 

            echo json_encode($last_month);

        }

        public function get_feeAmount()
        {

            $class_name      =   $this->input->get('class_name');
            $fees_type_id    =   $this->input->get('fees_type_id');

            $result = $this->F_collection_m->get_feeAmount($class_name, $fees_type_id );
            echo json_encode($result);

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

                $trans_code     =  $this->F_collection_m->new_transCd($trans_dt);
                $trans_cd = ($trans_code->transCd) +1 ;
                
                //echo $trans_cd; die;

                $from_month     =       $_POST['from_month'];
                $to_month       =       $_POST['to_month'];
                $fees_year      =       $_POST['fees_year'];
                $roll_no        =       $_POST['roll_no'];
                $stu_class      =       $_POST['stu_class'];
                $stu_sec        =       $_POST['stu_sec'];
                $stu_name       =       $_POST['stu_name'];
                $collc_mode     =       $_POST['collc_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $fees_type_id   =       $_POST['fees_type_id'];
                $fees_amount    =       $_POST['fees_amount'];

                $fees_count         =     count($fees_type_id);
                $fees_amount_count  =     count($fees_amount);

                if($to_month >= $from_month)
                {
                    for($i= $from_month; $i<=$to_month; $i++)
                    {
                    
                        $checkDuplicate_entry = $this->F_collection_m->checkDuplicate_entry($i, $fees_year, $stu_class, $stu_sec, $roll_no, $fees_type_id, $fees_count );
                        //echo "<pre>";
                        //var_dump($checkDuplicate_entry); die;

                    }
                    if($checkDuplicate_entry != null)
                    {
                        echo "<script> alert('Sorry! Duplicate Entry.');
                        document.location= 'main' </script>";
                    }
                    else
                    {
                        $this->F_collection_m->new_fees($trans_dt, $trans_cd, $from_month, $to_month, $fees_year, $roll_no, $stu_class, $stu_sec, $stu_name,
                                                        $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, $fees_type_id, 
                                                        $fees_amount, $fees_count, $created_by, $created_dt);

                        echo "<script> alert('Successfully Submitted');
                        document.location= 'main' </script>";
                    }
                                    
                }
                else
                {
                    echo "<script> alert('Sorry! Try again');
                    document.location= 'main' </script>";
                }

            }
            else
            {
                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";
            } 

        }


        public function edit_entry($trans_dt, $trans_cd)
        {

            $this->load->view('post_login/academy/header');

            $edit_result['edit_data']  = $this->F_collection_m->f_get_edit_details($trans_dt, $trans_cd); 
            
			$edit_result['edit_fees_data']  = $this->F_collection_m->f_get_edit_fees_details($trans_dt, $trans_cd); 
            
            $edit_result['fees_type'] = $this->F_collection_m->f_get_fees();
            
            $this->load->view('F_collection_edit', $edit_result);
            $this->load->view('post_login/academy/footer');

        }


        public function update_fees()
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
                $fees_month     =       $_POST['fees_month'];
                $fees_year      =       $_POST['fees_year'];
                $roll_no        =       $_POST['roll_no'];
                $stu_class      =       $_POST['stu_class'];
                $stu_sec        =       $_POST['stu_sec'];
                $stu_name       =       $_POST['stu_name'];
                $collc_mode     =       $_POST['collc_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $fees_type_id   =       $_POST['fees_type_id'];
                $fees_amount    =       $_POST['fees_amount'];

                $fees_count         =     count($fees_type_id);
                $fees_amount_count  =     count($fees_amount);

                $this->F_collection_m->Update_fees($trans_dt, $trans_cd, $fees_month, $fees_year, $roll_no, $stu_class, $stu_sec, $stu_name,
                                                $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, $fees_type_id, 
                                                $fees_amount, $modified_by, $modified_dt);

                $this->F_collection_m->update_fees_details($trans_dt, $trans_cd, $fees_type_id, $fees_amount, $fees_count, $fees_amount_count, $modified_by, $modified_dt);

                echo "<script> alert('Successfully Updated');
                document.location= 'main' </script>";

            }

            else
            {
                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";
            } 


        }


        // For collection Approval section //

        public function approvalTable()
        {

            $this->load->view('post_login/academy/header');

            $tableData['data'] = $this->F_collection_m->approvalTable();
            $this->load->view('collectionApv', $tableData);

            $this->load->view('post_login/academy/footer');

        }


        public function approval($trans_dt, $trans_cd, $total)
        {

            $balanceData = $this->F_collection_m->prev_balance();
            //echo $balanceData->balance; die;
            $previousBalance = ($balanceData->balance);

            $newBalance = $previousBalance + $total;

            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            $created_dt       =     date('y-m-d H:i:s');
            
            $this->F_collection_m->insert_balance($trans_dt, $newBalance, $total, $created_by, $created_dt);

            $this->F_collection_m->approval($trans_dt, $trans_cd);

            redirect(site_url().'/F_collection_c/approvalTable');

            //approvalTable();

        }

    }

?>