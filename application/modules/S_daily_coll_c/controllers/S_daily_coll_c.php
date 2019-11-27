<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class S_daily_coll_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('S_daily_coll_m');
            
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
            $result['data'] = $this->S_daily_coll_m->fetch_table();
            $this->load->view('s_daily_coll_table', $result);

        }


        public function entry()
        {
			$result_details['member_data']  = $this->S_daily_coll_m->f_get_member(); // to get the values of "td_class" table
			$result_details['collection_data']  = $this->S_daily_coll_m->f_get_collection(); // to get the values of "td_fees" table
            //var_dump($result_details['member_data']); die;
            //to create new transaction code for this date---
            $trans_dt       =       date('y-m-d'); 
            $result_details['trans_data'] = $this->S_daily_coll_m->new_transCd($trans_dt);

            //var_dump($result_details['trans_data']); die;

            $this->load->view('post_login/society/header');
            $this->load->view('s_daily_coll_v', $result_details);
            $this->load->view('post_login/society/footer');

        }


        public function f_get_member()
        {
            $mem_id =   $this->input->get('mem_id');
			$member_details  = $this->S_daily_coll_m->get_member_name($mem_id); // to get the values of "td_class" table
            echo json_encode($member_details);

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
                $fees_month     =       $_POST['fees_month'];
                $fees_year      =       $_POST['fees_year'];
                $mem_id         =       $_POST['mem_id'];
                $mem_name       =       $_POST['mem_name'];
                $collc_mode     =       $_POST['collc_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $collection_id  =       $_POST['collection_id'];
                $collection_amount    =       $_POST['collection_amount'];


                $collection_count         =     count($collection_id);

                //public function new_transCd($trans_dt);
                //echo $trans_dt; die;

                //echo $created_by; die;     

                $this->S_daily_coll_m->new_collection($trans_dt, $trans_cd, $fees_month, $fees_year, $mem_id, $mem_name,
                                                $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, 
                                                $created_by, $created_dt);

                $this->S_daily_coll_m->new_fees_details($trans_dt, $trans_cd, $collection_id, $collection_amount, $collection_count, $created_by, $created_dt);

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
            $edit_result['edit_data']  = $this->S_daily_coll_m->f_get_edit_details($trans_dt, $trans_cd); 
			$edit_result['edit_coll_data']  = $this->S_daily_coll_m->f_get_edit_coll_details($trans_dt, $trans_cd); 
            
            //echo "<pre>";
            //var_dump($edit_result['edit_coll_data']); die;
            $edit_result['coll_type'] = $this->S_daily_coll_m->f_get_collection();

            $this->load->view('s_daily_coll_edit', $edit_result);
            $this->load->view('post_login/society/footer');

        }


        public function update()
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
                $mem_id         =       $_POST['mem_id'];
                $mem_name       =       $_POST['mem_name'];
                $collc_mode     =       $_POST['collc_mode'];
                $bank_name      =       $_POST['bank_name'];
                $draft_no       =       $_POST['draft_no'];
                $neft_no        =       $_POST['neft_no'];
                $total          =       $_POST['total'];
                $remarks        =       $_POST['remarks'];
                $collection_id  =       $_POST['collection_id'];
                $collection_amount    =       $_POST['collection_amount'];

                $coll_count         =     count($collection_id);
                

                $this->S_daily_coll_m->Update_colls($trans_dt, $trans_cd, $fees_month, $fees_year, $mem_id, $mem_name,
                                                $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, 
                                                $modified_by, $modified_dt);

                $this->S_daily_coll_m->update_colls_details($trans_dt, $trans_cd, $collection_id, $collection_amount, $coll_count, $modified_by, $modified_dt);

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