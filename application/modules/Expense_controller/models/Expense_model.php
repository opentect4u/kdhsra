<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Expense_model extends CI_Model
    {

        public function fetch_table()
        {

            $this->db->select('*');
            $data = $this->db->get('md_expense');
			return $data->result(); 

        }

        public function new_expense($expense_name, $created_by, $date_c)
        {

            $value = array('expenses' => $expense_name,
                            'created_by'=> $created_by,
                            'created_dt'=> $date_c);

            $this->db->insert('md_expense',$value);

        }


        public function f_edit_expense_data($sl_no)
        {

            $sql = $this->db->query("SELECT expenses, sl_no FROM md_expense WHERE sl_no = $sl_no");
            return $sql->result();

        }

        public function update_expense($sl_no ,$expense_name, $modified_by, $date_m)
        {

            $value = array('expenses' => $expense_name,
                            'modified_by'=> $modified_by,
                            'modified_dt'=> $date_m);          
                            
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_expense',$value);

        }


        

    }

?>