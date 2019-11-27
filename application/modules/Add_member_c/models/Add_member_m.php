<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Add_member_m extends CI_Model
    {

        public function fetch_table()
        {

            $this->db->select('*');            
            $data = $this->db->get('md_member');
            return $data->result();  
        
            return $sql->row();

        }

        
        public function new_mem_id()
        {

            $sql = $this->db->query("SELECT max(mem_id) mem_id FROM md_member ");
            return $sql->row();
        }


        public function new_member($mem_id, $mem_name, $phone_no, $mem_type, $m_sub_amount, $created_by, $created_dt)
        {
            $value = array('mem_id' => $mem_id,
                            'mem_name'=>$mem_name,
                            'phone_no'=>$phone_no,
                            'mem_type'=>$mem_type,
                            'm_sub_amount'=>$m_sub_amount,
                            'created_by'=> $created_by,
                            'created_dt'=> $created_dt);
            
            $this->db->insert('md_member',$value);
            
        }


        public function get_mem_data($mem_id)
        {

            $sql = $this->db->query("SELECT * FROM md_member WHERE mem_id = $mem_id");
            return $sql->result();

        }


        public function edit_member($mem_id, $mem_name, $phone_no, $mem_type, $m_sub_amount, $modified_by, $modified_dt)
        {

            $value = array(
                            'mem_name'=>$mem_name,
                            'phone_no'=>$phone_no,
                            'mem_type'=>$mem_type,
                            'm_sub_amount'=>$m_sub_amount,
                            'modified_by'=> $modified_by,
                            'modified_dt'=> $modified_dt);

            $this->db->where('mem_id',$mem_id);            
            $this->db->update('md_member',$value);

        }



        
    }

?>