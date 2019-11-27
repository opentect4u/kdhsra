<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Society_collection_m extends CI_Model
    {

        public function fetch_table()
        {
            $this->db->select('*');
            $data = $this->db->get('md_s_collection_type');
			return $data->result();
        }

        public function new_collection($collections, $created_by, $created_dt)
        {

            $value = array('collections' => $collections,
                            'created_by'=>$created_by,
                            'created_dt'=>$created_dt);

            $this->db->insert('md_s_collection_type',$value);

        }

        public function get_edit_data($sl_no)
        {

            $sql = $this->db->query("SELECT * FROM md_s_collection_type WHERE sl_no = $sl_no");
            return $sql->result();

        }


        public function edit_collection($sl_no, $collections, $modified_by, $modified_dt)
        {

            $value = array('collections' => $collections,
                            'modified_by'=>$modified_by,
                            'modified_dt'=>$modified_dt);
            
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_s_collection_type',$value);

        }



    }

?>