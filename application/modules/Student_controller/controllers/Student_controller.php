<?php

    if ( ! defined('BASEPATH'))  exit('No direct script access allowed');
    
    class Student_controller extends MX_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Student_model');
            
            $this->load->library('session'); //to get user_name from login_controller via session 

            if(!$this->session->userdata('loggedin'))
            {
                redirect('login_controller/login');
            }
            
        }


        public function main()
        {

            $this->load->view('post_login/academy/header');
            $this->fetch_table();
            $this->load->view('post_login/academy/footer');

        }


        public function fetch_table()
        {
            $date = date('d-m-y');
            $date_array = explode("-", $date);
            $current_yr = '20'.$date_array[2];

            //echo $current_yr; die;

            $Student_result['data'] = $this->Student_model->fetch_table($current_yr); // to get current year's student list
            //var_dump($class_result); die;
            $this->load->view('Student_table', $Student_result);

        }

        // For JS -> to get student list of other academic year // 

        public function f_grt_stuTable()
        {

            $academic_yr     =   $this->input->get('academic_yr');
            $result = $this->Student_model->f_get_stuTable($academic_yr);

            echo json_encode($result);

        }

        public function entry()
        {

            $this->load->view('post_login/academy/header');
            $this->fetch_class();
            $this->load->view('post_login/academy/footer');

        }


        public function fetch_class()
        {

			$result_class['class_data']  = $this->Student_model->f_get_class();
			$this->load->view('Student_view',$result_class);

        }


        public function add_csv()
        {

            $this->load->view('post_login/academy/header');
            $this->load->view('Student_csv');
            $this->load->view('post_login/academy/footer');

        }


        public function upload_csv()
        {

            if(isset($_FILES["csv_file"]["name"]))
            {
                if($_SERVER['REQUEST_METHOD']=="POST")
                {

                    $csvMimes = array('text/x-comma-separated-values',
					   'text/comma-separated-values',
					   'application/octet-stream',
					   'application/vnd.ms-excel',
					   'application/x-csv',
					   'text/x-csv',
					   'text/csv',
					   'application/csv',
					   'application/excel',
					   'application/vnd.msexcel',
                       'text/plain');
                       
                    if(!empty($_FILES['csv_file']['name']) && in_array($_FILES['csv_file']['type'],$csvMimes))
                    {
                        if($_FILES['csv_file']['tmp_name'])
                        { 
                            $csvFile = fopen($_FILES['csv_file']['tmp_name'], 'r');
                            while(($line = fgetcsv($csvFile)) !== FALSE)
                            { 
                                /*if($line[0]!='' && $line[0]!='Name')
                                {*/
                                    if($this->session->userdata('loggedin'))
                                    {
                                        $user_name   =  $this->session->userdata('loggedin')->user_name; 

                                    }
                                    $date    = date('Y-m-d h:i:s');

                                    $data = array(
                                        "academic_yr"   =>  $line[0],
                                        "stu_name"   	=>  $line[1],
  									    "roll_no"		=>  $line[2],
				   			   		    "class"   	    =>  $line[3],
						   			    "sec"	        =>  $line[4],
			   			   			    "guardian"		=>  $line[5],
                                        "mob_no"	    =>  $line[6],
                                        "mail_id"	    =>  $line[7],
                                        "addr"	        =>  $line[8],
                                        "created_by"   	=>  $user_name,
									    "created_dt"   	=>  $date ); 	   

                                    $this->Student_model->new_student_csv($data);

                                    
                                    echo "<script> alert('Successfully Submitted');
                                        document.location= 'main' </script>";
                                //}
                            
                            }
                            fclose($csvFile);
                            echo "<script> alert('Sorry! Try again');
                                    document.location= 'main' </script>"; 

                        }
                        echo "<script> alert('Sorry! Try again');
                                document.location= 'main' </script>"; 
                    }
                    echo "<script> alert('Sorry! Try again');
                            document.location= 'main' </script>";

                }
            }

        }



        public function index()
        {
            if($this->session->userdata('loggedin'))
            {
                $created_by   =  $this->session->userdata('loggedin')->user_name; 
            }

            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                $academic_yr    =       $_POST['academic_yr'];
                $stu_name       =       $_POST['stu_name'];
                $roll_no        =       $_POST['roll_no'];
                $class_name     =       $_POST['class_name'];
                $sec_name       =       strtoupper($_POST['sec_name']);
                $guardian       =       $_POST['guardian'];
                $mob_no         =       $_POST['mob_no'];
                $mail_id        =       $_POST['mail_id'];
                $addr           =       $_POST['addr'];
                $date_c         =       $_POST['date_c'];

                $this->Student_model->new_student($academic_yr, $stu_name, $roll_no, $class_name, $sec_name, $guardian, $mob_no, $mail_id, $addr, $created_by, $date_c);

                echo "<script> alert('Successfully Submitted');
                    document.location= 'main' </script>";

            }
            else
            {

                echo "<script> alert('Sorry! Try again');
                document.location= 'main' </script>";

            }            

        }


        public function edit_entry($sl_no, $stu_name)
        {

            $this->load->view('post_login/academy/header');           
            
            $result_student['student_data'] = $this->Student_model->edit_data_fetch($sl_no, $stu_name);

            $this->load->view('Student_edit_view', $result_student);

            $this->load->view('post_login/academy/footer');

        }


        public function update_entry()
        {
            if($_SERVER['REQUEST_METHOD']=="POST")
            {
                if($this->session->userdata('loggedin'))
                {
                    $modified_by   =  $this->session->userdata('loggedin')->user_name; 
                }

                $sl_no              =       $_POST['sl_no'];
                $stu_name           =       $_POST['stu_name'];
                $roll_no            =       $_POST['roll_no'];
                $class_name         =       $_POST['class_name'];
                $sec_name           =       $_POST['sec_name'];
                $guardian           =       $_POST['guardian'];
                $mob_no             =       $_POST['mob_no'];
                $mail_id            =       $_POST['mail_id'];
                $addr               =       $_POST['addr'];
                $date_m             =       $_POST['date_m'];

                $this->Student_model->update_student($sl_no ,$stu_name, $roll_no, $class_name, $sec_name, $guardian, $mob_no, $mail_id, $addr, $modified_by, $date_m);

                echo "<script> alert('Successfully Updated');
                    document.location= 'main' </script>";
            }
            else
            {
                echo "<script> alert('Sorry!');
                document.location= 'main' </script>";
            }            

        }

        

    }

?>