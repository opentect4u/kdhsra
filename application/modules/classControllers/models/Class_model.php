<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Class_model extends CI_Model
    {

        public function fetch_class()
        {
            $this->db->select('*');
            $data = $this->db->get('md_class');
			return $data->result(); 
        }

        public function new_class($class_name, $date_c, $created_by)
        {

            $value = array('class_name' => $class_name,
                            'created_by' => $created_by,
                            'created_dt' => $date_c);

            $this->db->insert('md_class',$value);

        }

        public function update_class($sl_no ,$class_name, $modified_by, $date_m)
        {

            $value = array('class_name' => $class_name,
                            'modified_by' => $modified_by,
                            'modified_dt' => $date_m);
                        
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_class',$value);

        }

    }

?>