<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class F_collection_m extends CI_Model
    {

        public function fetch_table($today)
        {
            $this->db->select('*');
            $this->db->where('trans_dt',$today);                       
            $data = $this->db->get('td_fees_collection');
			return $data->result(); 
        }

        public function f_get_class()
        {
			$this->db->select('*');
			$data=$this->db->get('md_class');
            return $data->result(); 
        }

        public function get_student($academic_yr, $class_name, $stu_sec, $roll_no)
        {
        
            $sql = $this->db->query("SELECT stu_name FROM md_student WHERE class = '$class_name'
                                    AND academic_yr = '$academic_yr' AND sec = '$stu_sec'AND roll_no = $roll_no ");
            return $sql->row();
        }

        public function get_last_transDt($class_name, $stu_sec, $roll_no, $academic_yr)
        {

            $sql = $this->db->query(" SELECT MAX(a.trans_dt) AS trans_dt
                                FROM td_fees_collection a, td_fees_collection_details b
                                WHERE a.trans_dt = b.trans_dt
                                AND a.trans_cd = b.trans_cd
                                AND a.stu_class = '$class_name'
                                AND a.stu_sec = '$stu_sec'
                                AND a.roll_no = $roll_no
                                AND a.fees_year = '$academic_yr'
                                AND b.fees_type_id = 7 ");

            return $sql->row();

        }

        public function get_last_transCd($class_name, $stu_sec, $roll_no, $academic_yr, $date)
        {

            $sql = $this->db->query(" SELECT MAX(trans_cd) AS trans_cd 
                                    FROM td_fees_collection 
                                    WHERE trans_dt = '$date'
                                    AND stu_class = '$class_name'
                                    AND stu_sec = '$stu_sec'
                                    AND roll_no = $roll_no
                                    AND fees_year = '$academic_yr' ");
            return $sql->row();
                                    
        }

        public function get_last_paidMonth($date, $code)
        {

            $sql = $this->db->query(" SELECT fees_month FROM td_fees_collection
                                    WHERE trans_dt = '$date'
                                    AND trans_cd = $code ");
                                    
            return $sql->row();
        }

        public function get_feeAmount($class_name, $fees_type_id )
        {

            $sql = $this->db->query(" SELECT fees_amount FROM md_fee_amount 
                                    WHERE class = '$class_name' AND fees_type_no = $fees_type_id ");

            return $sql->row();

        }

        public function f_get_fees()
        {
			$this->db->select('*');
			$data=$this->db->get('md_fees');
            return $data->result(); 
        }


        public function new_transCd($trans_dt)
        {
            //echo $trans_dt; die;

            $sql = $this->db->query("SELECT max(trans_cd) transCd FROM td_fees_collection WHERE trans_dt = '$trans_dt'");
            // "transCd" is a reference of "max(trans_cd)" to use it in view page 
            return $sql->row();
        }
        

        public function checkDuplicate_entry($i, $fees_year, $stu_class, $stu_sec, $roll_no, $fees_type_id, $fees_count )
        {

            for($j= 0; $j< $fees_count; $j++)
            {
                $sql = $this->db->query(" SELECT * FROM td_fees_collection a, td_fees_collection_details b WHERE 
                                        a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd AND 
                                        a.fees_year = $fees_year AND
                                        a.fees_month = $i AND a.stu_class = '$stu_class' AND a.stu_sec = '$stu_sec'
                                        AND a.roll_no = $roll_no AND b.fees_type_id = $fees_type_id[$j] ");
                
                $return_data = $sql->result();
                
                if($return_data != null)
                {
                    return $return_data;
                }
                
            }

        }
        
        public function new_fees($trans_dt, $trans_cd, $from_month, $to_month, $fees_year, $roll_no, $stu_class, $stu_sec, $stu_name, $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, $fees_type_id, $fees_amount, $fees_count, $created_by, $created_dt)
        {
  
            for($i=$from_month; $i<=$to_month; $i++)            
            {
                
                $date = explode('-', $trans_dt);
                $date[0] = $fees_year;
                $date[1] = $i;
                $date[2] = '01';
                $mod_date = implode('-', $date);

                $value = array('trans_dt' => $trans_dt,
                            'trans_cd' => $trans_cd,
                            'fees_month' => $i,
                            'fees_year' => $fees_year,
                            'fee_dt' => $mod_date, 
                            'roll_no' => $roll_no,
                            'stu_class' => $stu_class,
                            'stu_sec' => $stu_sec,
                            'stu_name' => $stu_name,
                            'collc_mode' => $collc_mode,
                            'bank_name'=> $bank_name,
                            'draft_no'=> $draft_no,
                            'neft_no'=> $neft_no,
                            'total'=>$total,
                            'remarks'=>$remarks,
                            'created_by'=>$created_by,
                            'created_dt'=>$created_dt);
            
                $this->db->insert('td_fees_collection',$value);

                for($j=0; $j<$fees_count; $j++)
                {
                    $value1[] = array('trans_dt' => $trans_dt,
                                    'trans_cd' => $trans_cd,
                                    'fees_type_id' => $fees_type_id[$j],
                                    'fees_amount' => $fees_amount[$j],
                                    'created_by' => $created_by,
                                    'created_dt' => $created_dt);
                    
                }
                $this->db->insert_batch('td_fees_collection_details', $value1); 
                unset($value1);

                $trans_cd = $trans_cd+1;
            }
        }


        public function new_fees_details($trans_dt, $trans_cd, $from_month, $to_month, $fees_type_id, $fees_amount, $fees_count, $fees_amount_count, $created_by, $created_dt)
        {

            for($i=0; $i<$fees_count; $i++)
            {
                $value = array('trans_dt' => $trans_dt,
                                'trans_cd' => $trans_cd,
                                'fees_type_id' => $fees_type_id[$i],
                                'fees_amount' => $fees_amount[$i],
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);
            
                $this->db->insert('td_fees_collection_details',$value);

            }
               
            

        }


        public function f_get_edit_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query(" SELECT * FROM td_fees_collection WHERE trans_dt= '$trans_dt' AND trans_cd= '$trans_cd' ");
 
            //echo "<pre>";
            //var_dump($result->result()); die;
            return $result->result();

        }

       /* public function f_get_edit_fees_payment($trans_dt, $trans_cd)
        {
            $result = $this->db->query("SELECT * FROM td_fees_collection_details WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' ");
            return $result->result();

        } */
        
        
        public function f_get_edit_fees_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query("SELECT * FROM td_fees_collection_details a, md_fees b WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' AND a.fees_type_id = b.sl_no");
            return $result->result();

        }

        public function f_get_edit_feesCount_details($trans_dt, $trans_cd)
        {

            $result = $this->db->query("SELECT count(fees_amount) int_fees FROM td_fees_collection_details WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' ");
            return $result->row();

        }


        public function Update_fees($trans_dt, $trans_cd, $fees_month, $fees_year, $roll_no, $stu_class, $stu_sec, $stu_name,
                                    $collc_mode, $bank_name, $draft_no, $neft_no, $total, $remarks, $fees_type_id, 
                                    $fees_amount, $modified_by, $modified_dt)
        {

            $value = array(
                        'fees_month' => $fees_month,
                        'fees_year' => $fees_year,
                        'roll_no' => $roll_no,
                        'stu_class' => $stu_class,
                        'stu_sec' => $stu_sec,
                        'stu_name' => $stu_name,
                        'collc_mode' => $collc_mode,
                        'bank_name'=> $bank_name,
                        'draft_no'=> $draft_no,
                        'neft_no'=> $neft_no,
                        'total'=>$total,
                        'remarks'=>$remarks,
                        'modified_by'=>$modified_by,
                        'modified_dt'=>$modified_dt);

            $this->db->where('trans_dt',$trans_dt);
            $this->db->where('trans_cd',$trans_cd);
            $this->db->update('td_fees_collection',$value);

        }


        public function update_fees_details($trans_dt, $trans_cd, $fees_type_id, $fees_amount, $fees_count,
                                            $fees_amount_count, $modified_by, $modified_dt)
        {

            for($i=0; $i<$fees_count; $i++)
            {
                $value = array(
                                'fees_type_id' => $fees_type_id[$i],
                                'fees_amount' => $fees_amount[$i],
                                'modified_by' => $modified_by,
                                'modified_dt' => $modified_dt);

                $this->db->where('trans_dt',$trans_dt);
                $this->db->where('trans_cd',$trans_cd);
                $this->db->where('fees_type_id',$fees_type_id[$i]);
                $this->db->update('td_fees_collection_details',$value);   

            }

        }

        // For Approval Section //

        public function approvalTable()
        {

            $sql = $this->db->query(" SELECT * FROM td_fees_collection WHERE status = 'U' ");

            return $sql->result();

        }

        public function approval($trans_dt, $trans_cd)
        {

            $value = array('status' => 'A'); 

            $this->db->where('trans_dt',$trans_dt);
            $this->db->where('trans_cd',$trans_cd);   
            $this->db->update('td_fees_collection',$value);   

        }

        public function prev_balance()
        {

            $sql = $this->db->query(" SELECT balance FROM td_bal_school WHERE sl_no = (SELECT MAX(sl_no) FROM  td_bal_school) ");

            return $sql->row();

        }

        public function insert_balance($trans_dt, $newBalance, $total, $created_by, $created_dt)
        {

            $value = array('trans_dt' => $trans_dt,
                            'coll_amount' => $total,
                            'exp_amount' => 0,
                            'balance' => $newBalance,
                            'created_by' => $created_by,
                            'created_dt' => $created_dt);

            $this->db->insert('td_bal_school',$value);            

        }





    }

?>