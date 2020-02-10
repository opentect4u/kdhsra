<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Report_collection_c extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Report_collection_m');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }

        public function main()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Report_collection_v');
            $this->load->view('post_login/academy/footer');

        }


        public function bill()
        {

            $this->load->view('post_login/academy/header');
            //$this->load->view('collection_billForm');
            $this->fetch_class();
            $this->load->view('post_login/academy/footer');

        }


        public function fetch_class()
        {

            $result_data['class_data'] = $this->Report_collection_m->fetch_class(); 
            $this->load->view('collection_billForm', $result_data);

        }


        public function bill_form()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $month = $_POST['month'];
                $class = $_POST['class'];
                $year = $_POST['year'];

                $bill_data['bill_data'] = $this->Report_collection_m->f_get_bill_table($month, $year, $class); 

                $this->load->view('post_login/academy/header');
                $this->load->view('bill_table', $bill_data);
                $this->load->view('post_login/academy/footer');



            }

        }


        public function index()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                //echo $startDt.' $ '.$endDt; die;
               
                $this->f_get_table($startDt, $endDt);
                
            }

        }


        public function f_get_table($startDt, $endDt)
        {

            $modal_data['data1'] = $this->Report_collection_m->f_get_table($startDt, $endDt); 
            //var_dump($table_data['data1']); die;
            $modal_data['data2'] = $this->Report_collection_m->f_get_total_collection($startDt, $endDt);

            $modal_data['data'] = array($startDt, $endDt);

            $this->load->view('post_login/academy/header');
            $this->load->view('collection_modal', $modal_data);
            $this->load->view('post_login/academy/footer');


        }

        public function modal_bill($trans_dt, $trans_cd)
        {

            $modal_data['data1'] = $this->Report_collection_m->f_modal_bill($trans_dt, $trans_cd); 
            $modal_data['data2'] = $this->Report_collection_m->f_stuDetails_bill($trans_dt, $trans_cd); 
            $modal_data['data3'] = $trans_dt; 

            $this->load->view('post_login/academy/header');
            $this->load->view('collectionBill_modal', $modal_data);
            $this->load->view('post_login/academy/footer');

        }



        // ********************** For Due Report Section ********************* //


        public function due()
        {

            $this->load->view('post_login/academy/header');

            $selectionData['classData'] = $this->Report_collection_m->fetch_class();
            $selectionData['feesData'] = $this->Report_collection_m->f_get_feesType();

            $this->load->view('due_selection.php', $selectionData);

            $this->load->view('post_login/academy/footer');

        }


        public function due_report()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $class          =       $_POST['class'];
                $fee_type       =       $_POST['fee_type'];
                $stu_sec        =       $_POST['stu_sec'];
                $year           =       $_POST['year'];
                $month          =       $_POST['month'];

                
                if($month != null)
                {
                    
                    $array = $this->Report_collection_m->tutionFee_dueReport($class, $fee_type, $stu_sec, $year, $month);
                    $reportData['data'] = $array['rep_data'];
                    
                    //echo "<pre>";
                    //var_dump($reportData['data']); die;
                    
                    $reportData['class'] = $class;
                    $reportData['sec'] = $stu_sec;
                    $reportData['fee'] = $this->Report_collection_m->feeType_report($fee_type);

                    $reportData['tot_data1'] = $array['num_data'];
                    $reportData['tot_data2'] = $this->Report_collection_m->get_feeAmount($fee_type, $class);

                    $this->load->view('post_login/academy/header');

                    $this->load->view('due_report.php', $reportData);

                    $this->load->view('post_login/academy/footer');
                    
                }
                else
                {
                    $array = $this->Report_collection_m->otherFee_dueReport($class, $fee_type, $stu_sec, $year );
                    $reportData['data'] = $array['rep_data'];
                    
                    //echo "<pre>";
                    //var_dump($array['num_data']); die;

                    $reportData['class'] = $class;
                    $reportData['sec'] = $stu_sec;
                    $reportData['fee'] = $this->Report_collection_m->feeType_report($fee_type);

                    $reportData['tot_data1'] = $array['num_data'];
                    $reportData['tot_data2'] = $this->Report_collection_m->get_feeAmount($fee_type, $class);

                    $this->load->view('post_login/academy/header');

                    $this->load->view('due_report.php', $reportData);                    

                    $this->load->view('post_login/academy/footer');

                }

            }

        }


    // For Fee Wise Collection Report //
        
        public function fwCollection_report()
        {

            $this->load->view('post_login/academy/header');

            $selectionData['feesData'] = $this->Report_collection_m->f_get_feesType();

            $this->load->view('fw_selection.php', $selectionData);

            $this->load->view('post_login/academy/footer');

        }

        public function show_fw_report()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $fee_type       =       $_POST['fee_type'];
                $year           =       $_POST['year'];
                $month          =       $_POST['month'];
                
                if($month != null)
                {
                   
                    $reportData['data'] = $this->Report_collection_m->tutionFee_collectionReport($fee_type, $year, $month);
                    
                    $reportData['fee'] = $this->Report_collection_m->feeType_report($fee_type);
                    $reportData['year'] = $year;
                    $reportData['month'] = $month;

                    $this->load->view('post_login/academy/header');

                    $this->load->view('fw_report', $reportData);

                    $this->load->view('post_login/academy/footer');
                    
                }
                else
                {
                   
                    $reportData['data'] = $this->Report_collection_m->otherFee_collectionReport($fee_type, $year);
                    
                    $reportData['fee'] = $this->Report_collection_m->feeType_report($fee_type);
                    $reportData['year'] = $year;
                    $reportData['month'] = 0;

                    $this->load->view('post_login/academy/header');

                    $this->load->view('fw_report', $reportData);                    

                    $this->load->view('post_login/academy/footer');

                }

            }

        }

    // For Student Wise Collection Report //

        public function swCollection_report()
        {

            $this->load->view('post_login/academy/header');

            $selectionData['classData'] = $this->Report_collection_m->fetch_class();                        
            $this->load->view('sw_selection.php', $selectionData);

            $this->load->view('post_login/academy/footer');

        }

        public function sw_collection_report()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $academic_yr        =       $_POST['academic_yr'];
                $class_name         =       $_POST['class_name'];
                $stu_sec            =       $_POST['stu_sec'];
                $roll_no            =       $_POST['roll_no'];
                $stu_name           =       $_POST['stu_name'];

                $reportData['data'] = $this->Report_collection_m->sw_collectionReport($academic_yr, $class_name, $stu_sec, $roll_no);
                $reportData['total'] = $this->Report_collection_m->sw_totCollectionReport($academic_yr, $class_name, $stu_sec, $roll_no);
                $reportData['name'] = $stu_name;
                $reportData['class'] = $class_name;
                $reportData['sec'] = $stu_sec;
                $reportData['roll'] = $roll_no;

                $this->load->view('post_login/academy/header');
                
                $this->load->view('sw_collectionReport', $reportData);

                $this->load->view('post_login/academy/footer');
                
            }

        }

    // ************************** For Collection Summery Report *************************** //

        public function Collection_summery()
        {

            $this->load->view('post_login/academy/header');
                      
            $this->load->view('collectionSummery_selection');

            $this->load->view('post_login/academy/footer');

        }

        public function show_colSummery()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $datefilter     =       $_POST['datefilter'];

                $splittedstring = explode("  ",$datefilter);

                $startDt = $splittedstring[0];
                $endDt = $splittedstring[1];

                $report_data['data1'] =  $this->Report_collection_m->monthly_colSummery($startDt, $endDt);
                $report_data['data2'] =  $this->Report_collection_m->monthly_tot_colSummery($startDt, $endDt);

                $report_data['start_dt'] = $startDt;
                $report_data['end_dt'] = $endDt;

                $this->load->view('post_login/academy/header');
                      
                $this->load->view('collectionSummery_report', $report_data);

                $this->load->view('post_login/academy/footer');

            }

        }


        // For tution fee chart report---
        public function feeChart_report()
        {

            //$report['data1'] = $this->Report_collection_m->f_get_tutionFeeReport_chart();
            
            $this->load->view('post_login/academy/header');
            
            $selectionData['feesData'] = $this->Report_collection_m->f_get_feesType();
            $this->load->view('feeChart_selection',$selectionData);

            $this->load->view('post_login/academy/footer');

        }


        public function view_feeChart()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $fee        =       $_POST['fee'];
                $year       =       $_POST['year'];

                $reportData['fee']          =       $this->Report_collection_m->feeType_report($fee);
                $reportData['data1']        =       $this->Report_collection_m->f_get_tutionFeeReport_chart($fee, $year);
                $reportData['data2']        =       $this->Report_collection_m->f_get_tutionFeeReport_chart_total($fee, $year);
                $reportData['year']         =       $year;

                $this->load->view('post_login/academy/header');                

                $this->load->view('feeChart_report', $reportData);

                $this->load->view('post_login/academy/footer');

            }

        }

        //Fee Collection chart report

        public function feeCollc_report()
        {

            
            $this->load->view('post_login/academy/header');
            
            $selectionData['feesData'] = $this->Report_collection_m->f_get_feesType();
            $this->load->view('feeCollc_selection',$selectionData);

            $this->load->view('post_login/academy/footer');

        }


        public function view_collc_feeChart()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $fee        =       $_POST['fee'];
                $year       =       $_POST['year'];

                $reportData['fee']          =       $this->Report_collection_m->feeType_report($fee);
                $reportData['data1']        =       $this->Report_collection_m->f_get_collcFeeReport_chart($fee, $year);
                $reportData['data2']        =       $this->Report_collection_m->f_get_tutionFeeReport_collc_total($fee, $year);
                $reportData['year']         =       $year;

                $this->load->view('post_login/academy/header');                

                $this->load->view('feeCollc_report', $reportData);

                $this->load->view('post_login/academy/footer');

            }

        }



        // For student tution fee ledger --
        public function tutionFee_ledger()
        {

            $this->load->view('post_login/academy/header');
            
            $selectionData['classData'] = $this->Report_collection_m->fetch_class();
            $this->load->view('studentLedger_selection',$selectionData);

            $this->load->view('post_login/academy/footer');


        }

        public function view_tutionLedger()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $class        =       $_POST['class'];
                $stu_sec      =       $_POST['stu_sec'];
                $from_dt      =       $_POST['from_dt'];
                $to_dt        =       $_POST['to_dt'];

                $ts1 = strtotime($from_dt);
                $ts2 = strtotime($to_dt);

                $year1 = date('Y', $ts1);
                $year2 = date('Y', $ts2);

                $month1 = date('m', $ts1);
                $month2 = date('m', $ts2);

                $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

                $reportData['data'] = $this->Report_collection_m->f_get_ledgerdtls($class, $stu_sec, $from_dt, $to_dt, $diff);
                $reportData['from_dt'] = $from_dt;
                $reportData['to_dt'] = $to_dt;
                $reportData['class'] = $class;
                $reportData['stu_sec'] = $stu_sec;

                $reportData['footer'] = $this->Report_collection_m->f_get_ledger_totaldtls($class, $stu_sec, $from_dt, $to_dt, $diff);

                $this->load->view('post_login/academy/header');                

                $this->load->view('tutionLedger_report', $reportData);

                $this->load->view('post_login/academy/footer');

            }

        }

        // For exam fee ledger -- 
        public function examFee_ledger()
        {

            $this->load->view('post_login/academy/header');
            
            $selectionData['classData'] = $this->Report_collection_m->fetch_class();
            $this->load->view('examFeeLedger_selection',$selectionData);

            $this->load->view('post_login/academy/footer');

        }

        public function view_examLedger()
        {

            if($_SERVER['REQUEST_METHOD']=="POST")
            {

                $class          =       $_POST['class'];
                $stu_sec        =       $_POST['stu_sec'];
                $from_dt        =       $_POST['from_dt'];
                $to_dt          =       $_POST['to_dt'];
                $exam_type      =       $_POST['exam_type'];

                $reportData['data'] = $this->Report_collection_m->f_get_exam_ledgerdtls($class, $stu_sec, $from_dt, $to_dt, $exam_type);
                $reportData['from_dt'] = $from_dt;
                $reportData['to_dt'] = $to_dt;
                $reportData['class'] = $class;
                $reportData['stu_sec'] = $stu_sec;
                if($exam_type == 8)
                {
                    $reportData['exam'] = 'Half Yearly Exam.';
                }
                elseif($exam_type == 10)
                {
                    $reportData['exam'] = 'Final Exam';
                }
                
                $reportData['footer'] = $this->Report_collection_m->f_get_exam_ledger_totaldtls($class, $stu_sec, $from_dt, $to_dt, $exam_type);

                $this->load->view('post_login/academy/header');                

                $this->load->view('examLedger_report', $reportData);

                $this->load->view('post_login/academy/footer');

            }

        }



    }
?>