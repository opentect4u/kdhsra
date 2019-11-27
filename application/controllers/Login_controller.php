<?php

	if ( ! defined('BASEPATH')) 

		exit('No direct script access allowed');
    
    class Login_controller extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
			$this->load->model('Login_model');
			
			$this->load->library('session'); // to pass user_name to other file via session 

        }
        
        // for jquery checking --- 

        public function f_get_userData()
        {

            $username =   $this->input->get('username');
            $password =   $this->input->get('password');

            $user_details  = $this->Login_model->f_get_userData($username, $password);

            if($user_details != NULL)
            {
                $user_data = 'sorry';

            }

            echo json_encode($user_data);

        }
        
        
        
        
        
        public function index()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
				$user_name = $_POST['username'];
				$password = $_POST['password'];
				//$user_type = $_POST['user_type'];
					
                $result = $this->Login_model->f_select_password($user_name);
                
                if($result)
                {

                    if($password == $result->password)
                    {
                        
                        $user_data = $this->Login_model->f_get_user_inf($user_name);
                        $this->session->set_userdata('loggedin',$user_data);
                        $this->Login_model->f_insert_audit_trail($user_name);
                        $this->session->set_userdata('sl_no',$this->Login_model->f_audit_trail_value($user_name));
                        //echo $user_name;
                        //die;
                        /*if($this->session->userdata('loggedin'))
                        {
                        
                            $this->load->view('home/society_home.php');
                        
                        }
                        else
                        {
                            redirect('Login_controller/login');
                        } */
                        
                        redirect('Login_controller/login');
                        
                    }
                    else
                    {
                        //redirect('login_controller/login');
                        echo "<script> alert('Password is Wrong!');
                        document.location= 'login' </script>";
                    }

                }
                else
                {
                    echo "<script> alert('Sorry! Not Valid User.');
                        document.location= 'login' </script>";
                }

			}
			else
			{
                redirect('login_controller/login');
            }

        }


        public function login()
        {

			if($this->session->userdata('loggedin'))
			{
                $user_name    =   $this->session->userdata('loggedin')->user_name;
                //echo $user_name; die;
                $user_data = $this->Login_model->f_get_user_inf($user_name);

                //var_dump($user_data->user_type); die;

                if($user_data)
                {
                
                    if($user_data->user_status == 'A')
                    {
                        if($user_data->user_type == 'society')
                        {
                            $this->load->view('home/society_home');
                        }
                        elseif($user_data->user_type == 'academy')
                        {
                            $this->load->view('home/academy_home');
                        }
                        else
                        {
                            $this->load->view('login/login');
                            //$this->load->view('login/new_login');

                        }
                    }
                    else
                    {
                        $this->load->view('login/login');
                        //$this->load->view('login/new_login');

                    }
                }
                else
                {
                    $this->load->view('login/login');
                    //$this->load->view('login/new_login');

                }
			}
            else
            {
                $this->load->view('login/login');
                //$this->load->view('login/new_login');
                
			}
		}


        public function logout(){

            if($this->session->userdata('loggedin'))
            {

				$user_name    =   $this->session->userdata('loggedin')->user_name;				
			    
				$this->Login_model->f_update_audit_trail($user_name);

				$this->session->unset_userdata('loggedin');

				$this->session->unset_userdata('sl_no');
				
				redirect('Login_controller/login');

            }
            else
            {
				redirect('Login_controller/login');
			}
		}

        
    }

?>