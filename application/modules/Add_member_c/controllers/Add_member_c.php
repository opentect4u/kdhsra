<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Add_member_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Add_member_m');
            
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
            //$today = date('y-m-d');
            $exp_result['data'] = $this->Add_member_m->fetch_table();

            //var_dump($exp_result); die;
            $this->load->view('member_table', $exp_result);
        }


        public function entry()
        {
            $member_result['data'] = $this->Add_member_m->new_mem_id();
            //$member_result['trans_data'] = $this->Expense_cal_m->new_transCd($trans_dt);

            $this->load->view('post_login/society/header');
            $this->load->view('member_form', $member_result);
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

                $mem_id         =       $_POST['mem_id'];
                $mem_name       =       $_POST['mem_name'];
                $phone_no       =       $_POST['phone_no'];
                $mem_type       =       $_POST['mem_type'];

                if($mem_type == "MS")
                {
                    $m_sub_amount   =       $_POST['m_sub_amount'];
                }
                else
                {
                    $m_sub_amount   =       0.00;
                }

                $this->Add_member_m->new_member($mem_id, $mem_name, $phone_no, $mem_type, $m_sub_amount, $created_by, $created_dt);

                echo "<script> alert('Successfully Submitted');
                document.location= 'main' </script>"; 

            }
            else
            {
                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";
            }


        }

        public function edit_entry($mem_id, $mem_type)
        {

            //echo $mem_id; die;
            $this->load->view('post_login/society/header');

            $member_result['data'] = $this->Add_member_m->get_mem_data($mem_id);
            //echo"<pre>";
            //var_dump($member_result); die;
            $this->load->view('member_edit', $member_result);

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

                $mem_id         =       $_POST['mem_id'];
                $mem_name       =       $_POST['mem_name'];
                $phone_no       =       $_POST['phone_no'];
                $mem_type       =       $_POST['mem_type'];
                $m_sub_amount   =       $_POST['m_sub_amount'];

                $this->Add_member_m->edit_member($mem_id, $mem_name, $phone_no, $mem_type, $m_sub_amount, $modified_by, $modified_dt);

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