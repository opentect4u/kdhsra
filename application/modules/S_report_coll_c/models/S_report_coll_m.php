<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class S_report_coll_m extends CI_Model
    {

        public function f_get_table($startDt, $endDt)
        {

            $result = $this->db->query("SELECT * FROM td_mem_collection a, td_mem_collection_details b, md_s_collection_type c
                                        WHERE a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd AND b.collection_id = c.sl_no 
                                        AND a.trans_dt >= '$startDt' AND a.trans_dt <='$endDt' ORDER BY a.trans_dt");
            return $result->result();

        }

        public function f_get_total_collection($startDt, $endDt)
        {

            $result = $this->db->query("SELECT sum(collection_amount) total FROM td_mem_collection_details
                                        WHERE  trans_dt >= '$startDt' AND trans_dt <='$endDt' ");
            
            return $result->row();

        }

        
    }

?>