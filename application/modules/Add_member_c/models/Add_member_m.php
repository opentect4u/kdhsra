<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Add_member_m extends CI_Model
    {
        //Select from any table
        public function f_get_particulars($table_name, $select=NULL, $where=NULL, $flag) {
        
            if(isset($select)) {
    
                $this->db->select($select);
    
            }
    
            if(isset($where)) {
    
                $this->db->where($where);
    
            }
    
            $result		=	$this->db->get($table_name);
    
            if($flag == 1) {
    
                return $result->row();
                
            }else {
    
                return $result->result();
    
            }
    
        }

        //New Member ID
        public function new_mem_id()
        {

            $sql = $this->db->query("SELECT ifnull(max(mem_id),0) + 1 mem_id FROM md_member ");
            return $sql->row();
        }

        //For inserting row
        public function f_insert($table_name, $data_array) {

            $this->db->insert($table_name, $data_array);

            return;
        }

        //For Editing row

        public function f_edit($table_name, $data_array, $where) {

            $this->db->where($where);

            $this->db->update($table_name, $data_array);

            return;

        }

    }

?>