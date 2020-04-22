<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class S_daily_coll_m extends CI_Model
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

        public function fetch_table()
        {
           
            $sql = $this->db->query("SELECT a.trans_dt trans_dt,a.trans_cd trans_cd,
                                            a.mem_id mem_id,b.mem_name mem_name,
                                            a.total total 
                                     FROM td_mem_collection a,md_member b
                                     WHERE a.mem_id = b.mem_id
                                     AND  MONTH(a.trans_dt) = MONTH(CURRENT_DATE()) 
                                     AND YEAR(a.trans_dt)    = YEAR(CURRENT_DATE()) ");
            return $sql->result();
        }

        public function new_transCd($trans_dt)
        {
            $sql = $this->db->query("SELECT ifnull(max(trans_cd),0) + 1 trans_cd 
                                     FROM td_mem_collection 
                                     WHERE trans_dt = '$trans_dt'");

            return $sql->row();
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


        

        public function get_member_name($mem_id)
        {
            $sql = $this->db->query(" SELECT mem_name FROM md_member WHERE mem_id = '$mem_id' ");
            return $sql->row();

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