<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Login_model extends CI_Model
    {

        public function f_select_password($user_name)
        {

			$this->db->select('password');
			$this->db->where('user_name',$user_name);
            $data=$this->db->get('md_login_user');

			return $data->row();
        
        }


        public function f_get_user_inf($user_name)
        {
            //echo $user_name;die;

            $this->db->select('*');
            $this->db->where('user_name',$user_name);
            $data=$this->db->get('md_login_user');

            return $data->row();
        }


        public function f_insert_audit_trail($user_name)
        {

            $time = date("Y-m-d h:i:s");
			$pcaddr = $_SERVER['REMOTE_ADDR'];

			$value = array('login_dt'=> $time,
				        'user_name' => $user_name,
                        'terminal_name'=>$pcaddr);
                             
			$this->db->insert('t_audit_trail',$value);

        }


        public function f_audit_trail_value($user_name)
        {

            $this->db->select_max('sl_no');
    		$this->db->where('user_name', $user_name);
    		$details = $this->db->get('t_audit_trail');
            return $details->row();

        }


        public function f_update_audit_trail($user_name)
        {

			$time = date("Y-m-d h:i:s");
			$sl_no= $this->session->userdata('sl_no')->sl_no;
			$value= array('logout_dt'=>$time);
			$this->db->where('sl_no',$sl_no);
			$this->db->update('t_audit_trail',$value);

		}


    }

?>