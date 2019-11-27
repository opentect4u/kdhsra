<?php

    defined('BASEPATH') OR exit('No direct script access allowed');

    class Report_collection_m extends CI_Model
    {

        public function f_get_table($startDt, $endDt)
        {

           /* $result = $this->db->query("SELECT * FROM td_fees_collection a, td_fees_collection_details b, md_fees c
                                        WHERE a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd AND b.fees_type_id = c.sl_no 
                                        AND a.trans_dt >= '$startDt' AND a.trans_dt <='$endDt' ORDER BY a.trans_dt"); */

            $result = $this->db->query( "SELECT trans_dt,
                                                roll_no,
                                                stu_class,
                                                stu_sec,
                                                stu_name,
                                                SUM(total) AS total
                                        FROM td_fees_collection 
                                        WHERE trans_dt >= '$startDt' 
                                        AND trans_dt <='$endDt'
                                        GROUP BY trans_dt,
                                                stu_name,
                                                stu_class,
                                                stu_sec,
                                                roll_no" );

            return $result->result();

        }

        public function f_get_total_collection($startDt, $endDt)
        {

            /*$result = $this->db->query("SELECT sum(fees_amount) total FROM td_fees_collection_details
                                        WHERE  trans_dt >= '$startDt' AND trans_dt <='$endDt' "); */


            $result = $this->db->query(" SELECT SUM(total) AS g_total FROM
                                        (SELECT trans_dt,
                                                roll_no,
                                                stu_class,
                                                stu_sec,
                                                stu_name,
                                                SUM(total) AS total
                                        
                                        FROM td_fees_collection 
                                        
                                        WHERE trans_dt >= '$startDt' 
                                        AND trans_dt <='$endDt'
                                        
                                        GROUP BY trans_dt,
                                                stu_name,
                                                stu_class,
                                                stu_sec,
                                                roll_no) T ");
                                                                    
            
            return $result->row();

        }

        public function fetch_class()
        {

            $sql = $this->db->query(" SELECT class_name FROM md_class ");
            return $sql->result();

        }

 
        public function f_get_bill_table($month, $year, $class)
        {

            $sql = $this->db->query("SELECT * FROM td_fees_collection WHERE
                                    fees_month = '$month' AND fees_year = '$year' AND stu_class = '$class' ");

            return $sql->result();

        }


        public function f_modal_bill($trans_dt, $trans_cd)
        {

            $sql = $this->db->query("SELECT * FROM td_fees_collection_details a, md_fees b
                                    WHERE a.trans_dt = '$trans_dt' AND a.trans_cd = '$trans_cd' AND
                                    a.fees_type_id = b.sl_no ");

            return $sql->result();

        }

        public function f_stuDetails_bill($trans_dt, $trans_cd)
        {

            $sql = $this->db->query("SELECT * FROM td_fees_collection
                                    WHERE trans_dt = '$trans_dt' AND trans_cd = '$trans_cd' ");

            return $sql->result();

        }



        // ************* For Due report section *************** //


        public function f_get_feesType()
        {

            $sql = $this->db->query("SELECT * FROM md_fees ");
                                    
            return $sql->result();

        }

        public function tutionFee_dueReport($class, $fee_type, $stu_sec, $year, $month)
        {

            // $sql1 = $this->db->query(" SELECT x.stu_name,
            //                                 x.roll_no
                                            
            //                         FROM md_student x, 
                                    
            //                         (SELECT a.stu_name,
            //                                 a.roll_no
                                    
            //                         FROM td_fees_collection a, td_fees_collection_details b 
                                    
            //                         WHERE a.trans_dt = b.trans_dt
            //                         AND a.trans_cd = b.trans_cd
                                    
            //                         AND a.stu_class = '$class'
            //                         AND a.stu_sec = '$stu_sec'
            //                         AND a.fees_month = $month
            //                         AND a.fees_year = '$year'
            //                         AND b.fees_type_id = $fee_type) t
                                    
            //                         WHERE x.roll_no != t.roll_no
            //                         AND x.class = '$class'
            //                         AND x.sec = '$stu_sec'
            //                         GROUP BY x.stu_name, x.roll_no
            //                         ORDER BY x.roll_no ");


            $sql1 = $this->db->query(" SELECT roll_no, stu_name FROM `md_student` 
                                        WHERE academic_yr = '$year' AND class = '$class' AND sec = '$stu_sec' 
                                        AND roll_no NOT IN
                                        (SELECT roll_no FROM td_fees_collection a, td_fees_collection_details b WHERE 
                                        a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd
                                        AND a.fees_year = '$year' AND a.fees_month = $month AND a.stu_class = '$class' AND a.stu_sec = '$stu_sec' AND b.fees_type_id = $fee_type)
                                         ");

            $report_data['rep_data'] = $sql1->result();
            $report_data['num_data'] = COUNT($sql1->result());
            
            return $report_data;                                    

        }


        public function otherFee_dueReport($class, $fee_type, $stu_sec, $year )
        {

            // $sql = $this->db->query(" SELECT x.stu_name,
            //                                 x.roll_no
                                            
            //                         FROM md_student x, 
                                    
            //                         (SELECT a.stu_name,
            //                                 a.roll_no
                                    
            //                         FROM td_fees_collection a, td_fees_collection_details b 
                                    
            //                         WHERE a.trans_dt = b.trans_dt
            //                         AND a.trans_cd = b.trans_cd
                                    
            //                         AND a.stu_class = '$class'
            //                         AND a.stu_sec = '$stu_sec'
            //                         AND a.fees_year = '$year'
            //                         AND b.fees_type_id = $fee_type) t
                                    
            //                         WHERE x.roll_no != t.roll_no
            //                         AND x.class = '$class'
            //                         AND x.sec = '$stu_sec'
                                    
            //                         GROUP BY x.stu_name, x.roll_no
            //                         ORDER BY x.roll_no ");

            $sql2 = $this->db->query(" SELECT roll_no, stu_name FROM `md_student` 
                                    WHERE academic_yr = '$year' AND class = '$class' AND sec = '$stu_sec' 
                                    AND roll_no NOT IN
                                    (SELECT roll_no FROM td_fees_collection a, td_fees_collection_details b WHERE 
                                    a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd
                                    AND a.fees_year = '$year' AND a.stu_class = '$class' 
                                    AND a.stu_sec = '$stu_sec' AND b.fees_type_id = $fee_type) 
                                    ");

            $report_data['rep_data'] = $sql2->result();
            $report_data['num_data'] = COUNT($sql2->result());
            
            return $report_data;  

        }

        public function feeType_report($fee_type)
        {

            $sql = $this->db->query("SELECT fees_name FROM md_fees WHERE sl_no = $fee_type ");
                                    
            return $sql->row();

        }

        public function get_feeAmount($fee_type, $class)
        {

            $sql = $this->db->query(" SELECT fees_amount FROM md_fee_amount
                                    WHERE fees_type_no = $fee_type AND class = '$class' ");

            return $sql->row();

        }


        public function tutionFee_collectionReport($fee_type, $year, $month)
        {

            $sql = $this->db->query(" SELECT SUM(fees_amount) AS fees_amount FROM td_fees_collection_details a, td_fees_collection b
                                    WHERE a.trans_dt = b.trans_dt AND
                                    a.trans_cd = b.trans_cd AND 
                                    b.fees_year = '$year' AND
                                    b.fees_month = $month AND
                                    a.fees_type_id = $fee_type ");
            
            return $sql->row();

        }

        public function otherFee_collectionReport($fee_type, $year)
        {

            $sql = $this->db->query(" SELECT SUM(fees_amount) AS fees_amount FROM td_fees_collection_details a, td_fees_collection b
                                    WHERE a.trans_dt = b.trans_dt AND
                                    a.trans_cd = b.trans_cd AND 
                                    b.fees_year = '$year' AND
                                    a.fees_type_id = $fee_type ");
            
            return $sql->row();

        }

        public function sw_collectionReport($academic_yr, $class_name, $stu_sec, $roll_no)
        {

            $sql = $this->db->query(" SELECT a.trans_dt, b.fees_amount, c.fees_name  FROM td_fees_collection a, td_fees_collection_details b, md_fees c
                                    WHERE a.trans_dt = b.trans_dt AND a.trans_cd = b.trans_cd AND b.fees_type_id = c.sl_no 
                                    AND fees_year = '$academic_yr' AND stu_class = '$class_name' AND stu_sec = '$stu_sec' AND roll_no = $roll_no
                                    ORDER BY a.trans_dt ");
            return $sql->result();
            
        }

        public function sw_totCollectionReport($academic_yr, $class_name, $stu_sec, $roll_no)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS total FROM td_fees_collection WHERE fees_year = '$academic_yr' AND 
                                    stu_class = '$class_name' AND stu_sec = '$stu_sec' AND roll_no = $roll_no ");
            return $sql->row();

        }


        public function monthly_colSummery($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT stu_class, stu_sec, SUM(total) AS total FROM td_fees_collection 
                                    WHERE trans_dt >= '2019-04-01' AND trans_dt <= '2019-04-11'
                                    GROUP BY stu_class, stu_sec ");

            return $sql->result();

        }

        public function monthly_tot_colSummery($startDt, $endDt)
        {

            $sql = $this->db->query(" SELECT SUM(total) AS total FROM td_fees_collection 
                                    WHERE trans_dt >= '$startDt' AND trans_dt <= '$endDt' ");
            
             return $sql->row();

        }


        // For tution fee chart --
        public function f_get_tutionFeeReport_chart($fee, $year)
        {

            $sql = $this->db->query(" SELECT a.class class, a.sec sec, COUNT(a.stu_name) AS tot_stu, b.fees_amount fees, COUNT(a.stu_name) * b.fees_amount as fess_tot 
                                    FROM  md_student a,md_fee_amount b
                                    where a.class = b.class
                                    and a.academic_yr = '$year'
                                    and   b.fees_type_no = $fee
                                    group by a.class, a.sec ");
            
            return $sql->result();

        }


        public function f_get_tutionFeeReport_chart_total($fee, $year)
        {

            $sql  =  $this->db->query(" SELECT SUM(tot_stu) AS tot_stu, SUM(fess_tot) AS fess_tot FROM
                                        (SELECT a.class class, a.sec sec, COUNT(a.stu_name) AS tot_stu, b.fees_amount fees, COUNT(a.stu_name) * b.fees_amount as fess_tot 
                                    FROM  md_student a,md_fee_amount b
                                    where a.class = b.class
                                    and a.academic_yr = '$year'
                                    and   b.fees_type_no = $fee
                                    group by a.class, a.sec) T
                                    ");

            return $sql->result();

        }

        //Fee Collection Chart
        public function f_get_collcFeeReport_chart($fee, $year)
        {

            $sql = $this->db->query(" SELECT a.stu_class class, a.stu_sec sec, sum(b.fees_amount) AS fees_amt 
                                    FROM  td_fees_collection a,
                                    td_fees_collection_details b
                                    where  a.trans_dt = b.trans_dt
                                    and   a.trans_cd = b.trans_cd
                                    and a.fees_year = '$year'
                                    and   b.fees_type_id = $fee
                                    group by a.stu_class, a.stu_sec ");
            
            return $sql->result();

        }


        public function f_get_tutionFeeReport_collc_total($fee, $year)
        {

            $sql  =  $this->db->query(" SELECT sum(b.fees_amount) AS tot_fees_amt 
                                    FROM  td_fees_collection a,
                                    td_fees_collection_details b
                                    where  a.trans_dt = b.trans_dt
                                    and   a.trans_cd = b.trans_cd
                                    and a.fees_year = '$year'
                                    and   b.fees_type_id = $fee
                                    ");

            return $sql->result();

        }

        // For student ledger -- 
        public function f_get_ledgerdtls($class, $stu_sec, $from_dt, $to_dt, $diff)
        {

            $sql = $this->db->query(" SELECT a.roll_no, a.stu_name, SUM(b.fees_amount) AS rcvbl, c.fees_amount*$diff AS payable
                                    FROM td_fees_collection a, td_fees_collection_details b, md_fee_amount c WHERE
                                    a.trans_dt = b.trans_dt
                                    AND a.trans_cd = b.trans_cd
                                    AND a.stu_class = c.class
                                    AND b.fees_type_id = c.fees_type_no
                                    AND b.fees_type_id = 7
                                    AND a.fee_dt >= '$from_dt'
                                    AND a.fee_dt <= '$to_dt'
                                    AND a.stu_class = '$class'
                                    AND a.stu_sec = '$stu_sec'
                                    GROUP BY a.roll_no, a.stu_name, c.fees_amount ");

            return $sql->result();

        }


        public function f_get_ledger_totaldtls($class, $stu_sec, $from_dt, $to_dt, $diff)
        {

            $sql = $this->db->query(" SELECT SUM(rcvbl) AS tot_rcvbl, SUM(payable) AS tot_payable FROM 
                                    (SELECT a.roll_no,SUM(b.fees_amount) AS rcvbl, c.fees_amount*$diff AS payable
                                    FROM td_fees_collection a, td_fees_collection_details b, md_fee_amount c WHERE
                                    a.trans_dt = b.trans_dt
                                    AND a.trans_cd = b.trans_cd
                                    AND a.stu_class = c.class
                                    AND b.fees_type_id = c.fees_type_no
                                    AND b.fees_type_id = 7
                                    AND a.fee_dt >= '$from_dt'
                                    AND a.fee_dt <= '$to_dt'
                                    AND a.stu_class = '$class'
                                    AND a.stu_sec = '$stu_sec'
                                    GROUP BY a.roll_no,c.fees_amount) t ");

            return $sql->result();

        }


        // For exam fee ledger -- 
        public function f_get_exam_ledgerdtls($class, $stu_sec, $from_dt, $to_dt, $exam_type)
        {

            $sql = $this->db->query(" SELECT a.roll_no, a.stu_name, SUM(b.fees_amount) AS rcvbl, c.fees_amount AS payable
                                    FROM td_fees_collection a, td_fees_collection_details b, md_fee_amount c WHERE
                                    a.trans_dt = b.trans_dt
                                    AND a.trans_cd = b.trans_cd
                                    AND a.stu_class = c.class
                                    AND b.fees_type_id = c.fees_type_no
                                    AND b.fees_type_id = $exam_type
                                    AND a.fee_dt >= '$from_dt'
                                    AND a.fee_dt <= '$to_dt'
                                    AND a.stu_class = '$class'
                                    AND a.stu_sec = '$stu_sec'
                                    GROUP BY a.roll_no, a.stu_name, c.fees_amount ");

            return $sql->result();

        }


        public function f_get_exam_ledger_totaldtls($class, $stu_sec, $from_dt, $to_dt, $exam_type)
        {

            $sql = $this->db->query(" SELECT SUM(rcvbl) AS tot_rcvbl, SUM(payable) AS tot_payable FROM 
                                    (SELECT a.roll_no, a.stu_name, SUM(b.fees_amount) AS rcvbl, c.fees_amount AS payable
                                    FROM td_fees_collection a, td_fees_collection_details b, md_fee_amount c WHERE
                                    a.trans_dt = b.trans_dt
                                    AND a.trans_cd = b.trans_cd
                                    AND a.stu_class = c.class
                                    AND b.fees_type_id = c.fees_type_no
                                    AND b.fees_type_id = $exam_type
                                    AND a.fee_dt >= '$from_dt'
                                    AND a.fee_dt <= '$to_dt'
                                    AND a.stu_class = '$class'
                                    AND a.stu_sec = '$stu_sec'
                                    GROUP BY a.roll_no, a.stu_name, c.fees_amount) t ");

            return $sql->result();

        }

















    }

?>