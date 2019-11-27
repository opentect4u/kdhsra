<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class S_Report_expense_m extends CI_Model
    {

        public function f_get_table($startDt, $endDt)
        {

            $result = $this->db->query("SELECT * FROM td_expense a, td_expense_details b, md_expense c
                                        WHERE a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd AND b.exp_type_id = c.sl_no 
                                        AND a.trans_dt >= '$startDt' AND a.trans_dt <='$endDt' ORDER BY a.trans_dt");
            return $result->result();

        }


        public function f_get_total_collection($startDt, $endDt)
        {

            $result = $this->db->query("SELECT sum(exp_amount) total FROM td_expense_details
                                        WHERE  trans_dt >= '$startDt' AND trans_dt <='$endDt' ");
            
            return $result->row();

        }



    }

?>