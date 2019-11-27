<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Fees_model extends CI_Model
    {

        public function fetch_table()
        {

            $this->db->select('*');
            $data = $this->db->get('md_fees');
			return $data->result(); 

        }


        public function new_fees($fees_name, $created_by, $date_c)
        {

            $value = array('fees_name' => $fees_name,
                        'created_by'=> $created_by,
                        'created_dt'=> $date_c);

            $this->db->insert('md_fees',$value);

        }


        public function f_edit_fees_data($sl_no)
        {
            $sql = $this->db->query("SELECT fees_name, sl_no FROM md_fees WHERE sl_no = $sl_no");
            return $sql->result();

        }


        public function update_fees($sl_no ,$fees_name, $modified_by, $date_m)
        {

            $value = array('fees_name' => $fees_name,
                        'modified_by'=> $modified_by,
                        'modified_dt'=> $date_m);         
                         
            $this->db->where('sl_no',$sl_no);
            $this->db->update('md_fees',$value);

        }


    // *********** For Fee Amount Section ************ //

        public function f_get_class()
        {
            $this->db->select('*');
            $data=$this->db->get('md_class');
            return $data->result(); 
        }

        public function f_get_fees()
        {
			$this->db->select('*');
			$data=$this->db->get('md_fees');
            return $data->result(); 
        }

        public function new_fees_amount($fees_type_no, $fees_amount, $class, $fees_count, $created_by, $created_dt )
        {

            for($j=0; $j<$fees_count; $j++)
            {
                $value1[] = array('fees_type_no' => $fees_type_no[$j],
                                'fees_amount' => $fees_amount[$j],
                                'class' => $class,
                                'created_by' => $created_by,
                                'created_dt' => $created_dt);
                
            }

            $this->db->insert_batch('md_fee_amount', $value1); 
            unset($value1);



        }

        public function f_get_fees_amount()
        {

            $sql = $this->db->query("SELECT a.class, a.fees_amount, a.fees_type_no, b.fees_name 
                                        FROM md_fee_amount a, md_fees b
                                        WHERE a.fees_type_no = b.sl_no 
                                        ORDER BY a.class ");
            return $sql->result();

        }


        public function f_get_fees_amountData($class, $fees_type_no)
        {

            $sql = $this->db->query(" SELECT a.class, a.fees_amount, a.fees_type_no, b.fees_name 
                                        FROM md_fee_amount a, md_fees b
                                        WHERE a.fees_type_no = b.sl_no 
                                        AND a.class = '$class'
                                        AND a.fees_type_no = $fees_type_no ");
                                        
            return $sql->result();

        }


        public function update_fees_amount($fees_type_no, $fees_amount, $class, $modified_by, $modified_dt)
        {

            $value = array( 'fees_amount' => $fees_amount,
                            'modified_by' => $modified_by,
                            'modified_dt' => $modified_dt );
                            
            $this->db->where('fees_type_no',$fees_type_no);
            $this->db->where('class',$class);
            $this->db->update('md_fee_amount',$value);

        }

        


    }

?>