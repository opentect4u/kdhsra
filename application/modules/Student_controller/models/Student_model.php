<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Student_model extends CI_Model
    {

        public function fetch_table($current_yr)
        {

            $this->db->select('*');
            $this->db->where('academic_yr', $current_yr);            
            $data = $this->db->get('md_student');
			return $data->result(); 

        }


        public function f_get_stuTable($academic_yr)
        {

            $sql = $this->db->query(" SELECT * FROM  md_student WHERE academic_yr = '$academic_yr' ");
            return $sql->result();

        }

        public function f_get_class()
        {

			$this->db->select('*');
			$data=$this->db->get('md_class');

			return $data->result();

        }


        public function new_student_csv($data)
        {
            $this->db->insert('md_student',$data);
        }

        public function new_student($academic_yr, $stu_name, $roll_no, $class_name, $sec_name, $guardian, $mob_no, $mail_id, $addr, $created_by, $date_c)
        {

            $value = array('academic_yr' => $academic_yr,
                        'stu_name' => $stu_name,
                        'roll_no' => $roll_no,
                        'class' => $class_name,
                        'sec' => $sec_name,
                        'guardian' => $guardian,
                        'mob_no' => $mob_no,
                        'mail_id' => $mail_id,
                        'addr' => $addr,
                        'created_by'=> $created_by,
                        'created_dt'=> $date_c);
                        
            $this->db->insert('md_student',$value);
            
        }


        public function edit_data_fetch($sl_no, $stu_name)
        {

            $this->db->select('*');
            $this->db->where('sl_no', $sl_no);
            $data = $this->db->get('md_student');

			return $data->result();            
            
        }

        
        public function update_student($sl_no ,$stu_name, $roll_no, $class_name, $sec_name, $guardian, $mob_no, $mail_id, $addr, $modified_by, $date_m)
        {

            $value = array('stu_name' => $stu_name,
                            'roll_no' => $roll_no,
                            'class' => $class_name,
                            'sec' => $sec_name,
                            'guardian' => $guardian,
                            'mob_no' => $mob_no,
                            'mail_id' => $mail_id,
                            'addr' => $addr,
                            'modified_by' => $modified_by,
                            'modified_dt' => $date_m);
                        
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_student',$value);

        }

    }
?>