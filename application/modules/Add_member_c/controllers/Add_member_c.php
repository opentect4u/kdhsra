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
            $exp_result['data'] = $this->Add_member_m->f_get_particulars('md_member',NULL,NULL,0);

            $this->load->view('post_login/society/header');

            $this->load->view('member_table', $exp_result);

            $this->load->view('post_login/society/footer');
        }

        public function index()
        {

            $mem_id =   $this->Add_member_m->new_mem_id();

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $data =     array(

                    "mem_id"            => $mem_id->mem_id,
                    
                    "mem_name"          =>  $this->input->post('mem_name'),

                    "membership_dt"     =>  date('Y-m-d'),

                    "gender"            =>  $this->input->post('memb_sex'),

                    "memb_addr"         =>  $this->input->post('adr'),

                    "email"             =>  $this->input->post('email_id'),

                    "phone_no"          =>  $this->input->post('phone_no'),

                    "mem_type"          =>  $this->input->post('mem_type'),

                    "m_sub_amount"      =>  $this->input->post('amount'),
                
                    "created_by"        =>  $this->session->userdata('loggedin')->user_name,
                
                    "created_dt"        =>  date('y-m-d H:i:s')
                );

                $this->Add_member_m->f_insert("md_member", $data);

                $this->session->set_flashdata('msg', 'Successfully Added!');

                redirect("Add_member_c/main");
                                                                        
            }
            else
            {
                $this->load->view('post_login/society/header');

                $this->load->view('member_form');
                
                $this->load->view('post_login/society/footer');
            }

        }


        public function edit()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                
                $data =     array(

                    "mem_name"          =>  $this->input->post('mem_name'),

                    "gender"            =>  $this->input->post('memb_sex'),

                    "memb_addr"         =>  $this->input->post('adr'),

                    "email"             =>  $this->input->post('email_id'),

                    "phone_no"          =>  $this->input->post('phone_no'),

                    "mem_type"          =>  $this->input->post('mem_type'),

                    "m_sub_amount"      =>  $this->input->post('amount'),
                
                    "modified_by"       =>  $this->session->userdata('loggedin')->user_name,
                
                    "modified_dt"       =>  date('y-m-d H:i:s')
                );

                $where =    array(
                    "mem_id"            => $this->input->post('mem_id')
                );

                $this->Add_member_m->f_edit("md_member", $data,$where);

                $this->session->set_flashdata('msg', 'Successfully updated!');

                redirect("Add_member_c/main");

            }
            else
            {
                $memb_id = $this->input->get('member_id');

                $where   = array(

                    'mem_id'    =>  $memb_id
                );

                $member_result['data'] = $this->Add_member_m->f_get_particulars("md_member",Null,$where,1);


                $this->load->view('post_login/society/header');

                $this->load->view('member_edit', $member_result);

                $this->load->view('post_login/society/footer');

            }

        }

    }

?>