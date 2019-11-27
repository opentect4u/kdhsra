<?php

    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class User_academy_model extends CI_Model
    {
   
        public function fetch_user_a() // academy
        {

            $sql = $this->db->query("SELECT * FROM md_login_user WHERE user_type = 'academy' ");
            return $sql->result();

        }

        public function fetch_user_s() // Society
        {

            $sql = $this->db->query("SELECT * FROM md_login_user WHERE user_type = 'society' ");
            return $sql->result();

        }

        public function new_user($name, $user_name, $password, $c_password, $user_type, $user_status, $created_by, $date_c)
        {

            if($password == $c_password)
            {    
                $value = array('name' => $name,
                                'user_name' => $user_name,
                                'password'=> $password,
                                'user_type'=> $user_type,
                                'user_status'=> $user_status,
                                'created_by'=> $created_by,
                                'created_dt'=> $date_c);

                $this->db->insert('md_login_user',$value);
            }

        }


        
    }

?>