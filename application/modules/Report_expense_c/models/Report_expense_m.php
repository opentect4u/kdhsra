<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Report_expense_m extends CI_Model
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
                                        WHERE  trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            
            return $result->row();

        }

    // For Balance Report //

        public function f_get_balanceTable($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT * FROM td_bal_school WHERE trans_dt >= '$startDt' AND trans_dt<= '$endDt' ");

            return $sql->result();
            
        }

    // For head wise Payment Report //

        public function f_get_expenses()
        {

            $sql = $this->db->query(" SELECT * FROM md_expense ");
            return $sql->result();

        }


        public function f_get_hwExpense($startDt, $endDt, $expense_type)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, a.exp_amount, b.expenses FROM td_expense_details a, md_expense b
                                    WHERE a.exp_type_id = b.sl_no AND
                                    a.trans_dt >= '$startDt' AND
                                    a.trans_dt <= '$endDt' AND 
                                    a.exp_type_id = $expense_type ");

            return $sql->result();

        }

        public function f_get_tot_hwExpense($startDt, $endDt, $expense_type)
        {

            $sql = $this->db->query(" SELECT SUM(exp_amount) AS tot_expense FROM td_expense_details WHERE
                                    trans_dt >= '$startDt' AND trans_dt <= '$endDt' AND exp_type_id = '$expense_type' ");
            return $sql->row();

        }

        public function f_get_hwExpenseName($expense_type)
        {

            $sql = $this->db->query(" SELECT expenses FROM md_expense WHERE sl_no = $expense_type ");
            return $sql->row();

        }


    // ********************** For Collection Expense Summery ************************** //

        public function f_get_collectionSummery($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS col_total FROM td_fees_collection WHERE
                                    trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }


        public function f_get_expenseSummery($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS exp_total FROM td_expense WHERE
                                    trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            return $sql->row();

        }

        
    // *************************** For Payment Summery Report *********************************** //

        public function f_get_paymentSummery($startDt, $endDt)
        {

            $sql= $this->db->query(" SELECT  a.exp_type_id,
                                            b.expenses,
                                            SUM(a.exp_amount)  AS tot_expense   
                                    FROM    td_expense_details a, md_expense b
                                    WHERE a.exp_type_id = b.sl_no
                                    AND a.trans_dt >= '$startDt' 
                                    AND a.trans_dt <= '$endDt' 
                                    GROUP BY    a.exp_type_id ");
                                    
            return $sql->result();

        }





    }

?>