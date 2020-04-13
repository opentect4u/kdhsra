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
            $result['data'] = $this->Society_collection_m->f_get_particulars("md_s_collection_type",Null,Null,0);

            $this->load->view('post_login/society/header');

            $this->load->view('s_collection_table', $result);

            $this->load->view('post_login/society/footer');

        }

        public function index()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $data   =   array(

                    'collections'       =>  $this->input->post('collections'),

                    "created_by"        =>  $this->session->userdata('loggedin')->user_name,

                    "created_dt"        =>  date('y-m-d H:i:s')
                );
                
                $this->Society_collection_m->f_insert("md_s_collection_type", $data);

                $this->session->set_flashdata('msg', 'Successfully Added!');

                redirect("Society_collection_c/main");
            
            }
            else
            {

                $this->load->view('post_login/society/header');

                $this->load->view('s_collection_form');

                $this->load->view('post_login/society/footer');

            }

        }

        public function edit()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $where  =   array(

                    'sl_no'       =>    $this->input->post('sl_no')
                );

                $data   =   array(

                    'collections'        =>  $this->input->post('collections'),

                    "modified_by"        =>  $this->session->userdata('loggedin')->user_name,

                    "modified_dt"        =>  date('y-m-d H:i:s')
                );
                
                $this->Society_collection_m->f_edit("md_s_collection_type", $data,$where);

                $this->session->set_flashdata('msg', 'Successfully Updated!');

                redirect("Society_collection_c/main");
            }else
            {
                $where          = array(

                    "sl_no"     =>  $this->input->get('sl_no')
                );

                $result['data'] = $this->Society_collection_m->f_get_particulars("md_s_collection_type",Null,$where,1);

                $this->load->view('post_login/society/header');

                $this->load->view('s_collection_edit', $result);

                $this->load->view('post_login/society/footer');
            }

        }



    }
?>