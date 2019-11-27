<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Expense_cal_m extends CI_Model
    {

        public function fetch_table($today)
        {

            $this->db->select('*');
            $this->db->where('trans_dt',$today);            
            $data = $this->db->get('td_expense');
            return $data->result();  
            
            //$sql= $this->db->query("SELECT * FROM  td_expense a, md_expense b WHERE a.exp_type_id = b.sl_no AND a.trans_dt = '$today' ");
            return $sql->row();

        }


        public function f_get_expenses()
        {

            $this->db->select('*');
            $data = $this->db->get('md_expense');
			return $data->result(); 

        }

        public function new_transCd($trans_dt)
        {

            $sql = $this->db->query("SELECT max(trans_cd) transCd FROM td_expense WHERE trans_dt = '$trans_dt'");
            // "transCd" is a reference of "max(trans_cd)" to use it in view page 
            return $sql->row();

        }

        public function new_expense($trans_dt, $trans_cd, $exp_mode, $bank_name,
                                    $draft_no, $neft_no, $total, $remarks,
                                    $created_by, $created_dt)
        {

            $value = array('trans_dt' => $trans_dt,
                        'trans_cd' => $trans_cd,
                        'exp_mode' => $exp_mode,
                        'bank_name' => $bank_name,
                        'draft_no' => $draft_no,
                        'neft_no' => $neft_no,
                        'total' => $total,
                        'remarks' => $remarks,
                        'created_by' => $created_by,
                        'created_dt' => $created_dt);
            
            $this->db->insert('td_expense',$value);
            
        }


        public function new_exp_details($trans_dt, $trans_cd, $exp_type_id, $exp_amount,
                                        $exp_count, $exp_amount_count, $created_by, $created_dt)
        {

            for($i=0; $i<$exp_count; $i++)
            {

                $value = array('trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'exp_type_id' => $exp_type_id[$i],
                                'exp_amount' => $exp_amount[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);
            
                $this->db->insert('td_expense_details',$value);

            }

        }


        public function f_get_edit_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query(" SELECT * FROM td_expense WHERE trans_dt= '$trans_dt' AND trans_cd= '$trans_cd' ");
            return $result->result();

        }


        public function f_get_edit_exp_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query("SELECT * FROM td_expense_details a, md_expense b WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' AND a.exp_type_id = b.sl_no");
            return $result->result();

        }

        public function f_get_exp()
        {

            $this->db->select('*');
			$data=$this->db->get('md_expense');
            return $data->result();

        }


        public function update_expense($trans_dt, $trans_cd, $exp_mode, $bank_name,
                                        $draft_no, $neft_no, $total, $remarks,
                                        $modified_by, $modified_dt)
        {
            $value = array(
                            'exp_mode' => $exp_mode,
                            'bank_name' => $bank_name,
                            'draft_no' => $draft_no,
                            'neft_no' => $neft_no,
                            'total' => $total,
                            'remarks' => $remarks,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt);

            $this->db->where('trans_dt',$trans_dt);
            $this->db->where('trans_cd',$trans_cd);
            $this->db->update('td_expense',$value);

            
        }

        public function update_exp_details($trans_dt, $trans_cd, $exp_type_id, $exp_amount,
                                        $exp_count, $exp_amount_count, $modified_by, $modified_dt)
        {

            for($i=0; $i<$exp_count; $i++)
            {

                $value = array(
                                'exp_type_id' => $exp_type_id[$i],
                                'exp_amount' => $exp_amount[$i],
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt);

                $this->db->where('trans_dt',$trans_dt);
                $this->db->where('trans_cd',$trans_cd);
                $this->db->where('exp_type_id',$exp_type_id[$i]);
                $this->db->update('td_expense_details',$value);                   

            }

        }



    }

?>