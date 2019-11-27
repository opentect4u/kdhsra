<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class S_daily_coll_m extends CI_Model
    {

        public function fetch_table()
        {
            // will get data of current months - 

            $sql = $this->db->query("SELECT * FROM td_mem_collection WHERE MONTH(trans_dt) = MONTH(CURRENT_DATE()) AND YEAR(trans_dt) = YEAR(CURRENT_DATE()) ");
            return $sql->result();

            /*$this->db->select('*');
            $data = $this->db->get('td_mem_collection');
			return $data->result();*/
        }

        public function f_get_member()
        {
			$this->db->select('*');
			$data=$this->db->get('md_member');
            return $data->result(); 
        }


        public function f_get_collection()
        {
			$this->db->select('*');
			$data=$this->db->get('md_s_collection_type');
            return $data->result(); 
        }


        public function new_transCd($trans_dt)
        {
            $sql = $this->db->query("SELECT max(trans_cd) trans_cd FROM td_mem_collection WHERE trans_dt = '$trans_dt'");
            return $sql->row();

        }

        public function get_member_name($mem_id)
        {
            $sql = $this->db->query(" SELECT mem_name FROM md_member WHERE mem_id = '$mem_id' ");
            return $sql->row();

        }

        public function new_collection($trans_dt, $trans_cd, $fees_month, $fees_year, $mem_id, $mem_name,
                                        $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, 
                                        $created_by, $created_dt)
        {

            $value = array('trans_dt' => $trans_dt,
                        'trans_cd' => $trans_cd,
                        'fees_month' => $fees_month,
                        'fees_year' => $fees_year,
                        'mem_id' => $mem_id,
                        'mem_name' => $mem_name,
                        'collc_mode' => $collc_mode,
                        'bank_name' => $bank_name,
                        'draft_no' => $draft_no,
                        'neft_no' => $neft_no,
                        'total' => $total,
                        'remarks' => $remarks,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt);
            
            $this->db->insert('td_mem_collection',$value);

        }

        public function new_fees_details($trans_dt, $trans_cd, $collection_id, $collection_amount, $collection_count, $created_by, $created_dt)
        {

            for($i=0; $i<$collection_count; $i++)
            {

                $value = array('trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'collection_id' => $collection_id[$i],
                                'collection_amount' => $collection_amount[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);

                $this->db->insert('td_mem_collection_details',$value);

            }

        }


        public function f_get_edit_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query(" SELECT * FROM td_mem_collection WHERE trans_dt= '$trans_dt' AND trans_cd= '$trans_cd' ");
 
            return $result->result();

        }
        

        public function f_get_edit_coll_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query("SELECT * FROM td_mem_collection_details a, md_s_collection_type b WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' AND a.collection_id = b.sl_no");
            return $result->result();

        }

        public function Update_colls($trans_dt, $trans_cd, $fees_month, $fees_year, $mem_id, $mem_name,
                                    $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, 
                                    $modified_by, $modified_dt)
        {

            $value = array(
                        'fees_month' => $fees_month,
                        'fees_year' => $fees_year,
                        'mem_id' => $mem_id,
                        'mem_name' => $mem_name,
                        'collc_mode' => $collc_mode,
                        'bank_name' => $bank_name,
                        'draft_no' => $draft_no,
                        'neft_no' => $neft_no,
                        'total' => $total,
                        'remarks' => $remarks,
                        'modified_by' => $modified_by,
                        'modified_dt' => $modified_dt);

            $this->db->where('trans_dt', $trans_dt);
            $this->db->where('trans_cd', $trans_cd);
            $this->db->update('td_mem_collection',$value);

        }


        public function update_colls_details($trans_dt, $trans_cd, $collection_id, $collection_amount,
                                            $coll_count, $modified_by, $modified_dt)
        {

            for($i=0; $i<$coll_count; $i++)
            {
                $value = array('collection_id' => $collection_id[$i],
                            'collection_amount'=> $collection_amount[$i],
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

                $this->db->where('trans_dt', $trans_dt);
                $this->db->where('trans_cd', $trans_cd);
                $this->db->where('collection_id', $collection_id[$i]);

                $this->db->update('td_mem_collection_details',$value);

            }

        }



    }

?>