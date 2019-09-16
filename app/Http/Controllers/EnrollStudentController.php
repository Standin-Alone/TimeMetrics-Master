<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class EnrollStudentController extends Controller
{
    //view page
    public function index()
    {

        $get_registered_students = DB::table('t_enrollment as E')
                                        ->join('r_courses as C','C.COURSE_ID','E.COURSE_ID')
                                        ->join('t_students as S','S.STUDENT_ID','E.STUDENT_ID')
                                        ->join('t_applicants as A','A.APPLICANT_ID','S.STUDENT_ID') 
                                        ->where('STATUS','REGISTERED')                                                                               
                                        ->get();
        $get_algo = DB::table('t_algo')                                                                          
                        ->get();

                                        
        return view('registrar.enroll_student',compact('get_registered_students','get_algo'));
    }

    //insert  fcfs algo start
    public function Store_FCFS()
    {
                
        $connect = mysqli_connect("localhost", "root", "", "time_metrics_v2_db");

        $count_id = $_POST["count_id"]; 
        if ($count_id > 1)
        {
            $mMili = 60000; $sMili = 1000; $hMili = 3600000;
            $enrollment_id = $_POST['enrollment_id'];
            $get_student_queue = array();
            $get_array = array();
        DB::table('t_enrollment')->update(['DATE_ENROLLED' => DB::raw('DATE(CURRENT_TIMESTAMP)')
                                           ,'STATUS' => 'ENROLLED']);
        foreach($enrollment_id as $value)
        {

            
            $view_enrollee = mysqli_query($connect,"SELECT E.TIME_IN_S, E.TIME_IN_M, E.TIME_IN_H,
            E.TIME_OUT_S, E.TIME_OUT_M, E.TIME_OUT_H, TSI.STUDENT_NUMBER, E.TIME_IN_MILI, E.TIME_OUT_MILI, E.STUDENT_ID
            FROM t_enrollment AS E
                    INNER JOIN t_students AS TSI
                    ON tsi.STUDENT_ID = E.STUDENT_ID
                    WHERE enrollment_id = $value");
        

            while($row = mysqli_fetch_assoc($view_enrollee))
            {   
                
                $compute_arrival_time = ($row['TIME_IN_M'] * $mMili) + ($row['TIME_IN_S'] * $sMili) + ($row['TIME_IN_H'] * $hMili) + $row['TIME_IN_MILI'];
                $compute_burst_time =  ($row['TIME_OUT_M'] * $mMili) + ($row['TIME_OUT_S'] * $sMili) + ($row['TIME_OUT_H'] * $hMili) + $row['TIME_OUT_MILI'];
            
                
                array_push($get_student_queue,array(
                    [
                        'Student_Number' => $row['STUDENT_NUMBER'],
                        'ARRIVAL_TIME' => $compute_arrival_time,
                        'BURST_TIME' => $compute_burst_time,
                        'HOUR' => $row['TIME_IN_H'],
                        'STUDENT_ID' => $row['STUDENT_ID']
                        
                    ]));
            }


        }

        // APPLY FCFS ALGORITHM (SORT BY ARRIVAL TIME)
        usort($get_student_queue, function($a, $b) { 
            return $a[0]['ARRIVAL_TIME'] - $b[0]['ARRIVAL_TIME'];
        });



        $turn_around_time=0;
        $completion_time=0;
        $get_total_tat=0;
        $get_total_wat=0;
        $gant = 0;
        $j =0;
        $idle = 0;
        $display_fcfs = [];
        // APPLY FCFS ALGORITHM
        $i = 0;
        echo "AT BT CT TAT WAT <br>";  
        foreach($get_student_queue as $val)
        {
            
            if($i++ == 0) 
            { 
                $completion_time += $val[0]['BURST_TIME'];
                $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];
                $gant += $val[0]['BURST_TIME'];
                $waiting_time = 0;

                array_push( $display_fcfs, array(
                    [
                        'ARRIVAL_TIME' => $val[0]['ARRIVAL_TIME'],
                        'BURST_TIME' => $val[0]['BURST_TIME'],
                        'TURN_AROUND_TIME' => $turn_around_time,
                        'WAITING_TIME' => $waiting_time
                    
                    ]));
                    echo 'waiting time = '.$waiting_time;
                    
            }
            else
            {

                
                $waiting_time = $gant - $val[0]['ARRIVAL_TIME'];

                
                if($waiting_time <= 0)
                {
                    $waiting_time = 0;
                    $idle = $val[0]['ARRIVAL_TIME'] - $gant;
                    $gant += $idle;
                    $gant += $val[0]['BURST_TIME'];
                    $completion_time = $gant;
                    $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];   

                }
                else
                {
                    //$idle = 0;
                    $gant += $val[0]['BURST_TIME'];
                    $completion_time = $gant;
                    $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];
                }

                
                array_push( $display_fcfs, array(
                    [
                        'ARRIVAL_TIME' => $val[0]['ARRIVAL_TIME'],
                        'BURST_TIME' => $val[0]['BURST_TIME'],
                        'TURN_AROUND_TIME' => $turn_around_time,
                        'WAITING_TIME' => $waiting_time,
                        'IDLE_TIME' => $idle
                    ]
                    
                    ));
                    echo 'waiting time = '.$waiting_time;
            }
            
            
            $get_total_tat += $turn_around_time;
            $get_total_wat += $waiting_time;

            //  if ($idle != 0) {
            //     $waiting_time = $idle;
            // }
            
            
            $insert_process = "INSERT INTO T_PROCESS (STUDENT_ID, FCFS_ARRIVAL_TIME, FCFS_BURST_TIME, FCFS_TURNAROUND_TIME,FCFS_WAITING_TIME, FCFS_IDLE_TIME ) 
                            VALUES ((select STUDENT_ID from t_students where STUDENT_NUMBER = {$val[0]['Student_Number']}), '{$val[0]['ARRIVAL_TIME']}', '{$val[0]['BURST_TIME']}','$turn_around_time','$waiting_time','$idle')";
            mysqli_query($connect, $insert_process);

        }

        $curr_id = "SELECT MIN(BATCH_NO) AS BATCH_NO FROM t_algo";

            $getquery = mysqli_query($connect, $curr_id);
            
            while ($row = mysqli_fetch_assoc($getquery)) 
            {
                $cs_sec_id = 1;
            }
        
            // if ($cs_sec_id == null) { $cs_sec_id = 1; }
            // else
            // {
            //     $get_max_id = "SELECT MAX(CS_SEC_ID) AS CS_SEC_ID FROM t_cs_section";
            //     $getmaxquery = mysqli_query($connect, $get_max_id);
            //     while ($row = mysqli_fetch_assoc($getmaxquery)) { $max_sec_id = $row['CS_SEC_ID']; }
            //     $cs_sec_id = $max_sec_id + 1;
            // }
            


        $average_tat = $get_total_tat/count($get_student_queue);
        $average_wat = $get_total_wat/count($get_student_queue);
        array_push($display_fcfs,array(
            [
                'fcfs_average_tat' => $average_tat,
                'fcfs_average_wat' => $average_wat,
                //'fcfs_total_tat' => $get_total_tat
            ]));
            
            $insert_queue = "INSERT INTO T_ALGO (BATCH_NO,FCFS_AVG_TURNAROUND_TIME, FCFS_AVG_WAITING_TIME) 
                            VALUES ('$cs_sec_id','$average_tat','$average_wat')";
            mysqli_query($connect, $insert_queue);

        echo json_encode($display_fcfs);
            
        }
        else
        {
            echo "it must be greater than 1 student to compute the algorithm";
        }

                                   
    }
    
    //insert  fcfs algo end 

    //insert  sjf algo start
    public function Store_SJF()
    {

                        
                $connect = mysqli_connect("localhost", "root", "", "time_metrics_v2_db");

                $count_id = $_POST["count_id"];
                if ($count_id > 1)
                {
                    $mMili = 60000; $sMili = 1000; $hMili = 3600000;
                    $enrollment_id = $_POST['enrollment_id'];
                    $get_student_queue=array();
                    $get_array=array();
                    $sjf_count_subject = 0;
                    $countof_sub = 0;
                

                foreach($enrollment_id as $value)
                {

                    
                    $view_enrollee = mysqli_query($connect,"SELECT E.TIME_IN_S, E.TIME_IN_M, E.TIME_IN_H,
                    E.TIME_OUT_S, E.TIME_OUT_M, E.TIME_OUT_H, TSI.STUDENT_NUMBER, E.TIME_IN_MILI, E.TIME_OUT_MILI, E.STUDENT_ID
                    FROM t_enrollment AS E
                            INNER JOIN t_students AS TSI
                            ON tsi.STUDENT_ID = E.STUDENT_ID
                            WHERE enrollment_id  = $value");
                
                    
                    while($row = mysqli_fetch_assoc($view_enrollee))
                    {   
                        $get_count_query = "SELECT COUNT(ENROLLED_SUBJECT_ID) AS SUB_COUNT
                                            FROM t_enrollment AS E   
                                                INNER JOIN t_students AS TSI ON tsi.STUDENT_ID = E.STUDENT_ID
                                                INNER JOIN t_enrolled_subjects AS TSUB ON TSUB.ENROLLMENT_ID = E.ENROLLMENT_ID
                                                INNER JOIN r_course_subject_sections AS TCS ON TCS.CS_SECTION_ID = TSUB.CS_SECTION_ID
                                                WHERE E.STUDENT_ID = {$row['STUDENT_ID']}";

                        $getquery_result = mysqli_query($connect, $get_count_query);
                        while ($row1 = mysqli_fetch_assoc($getquery_result)) { $countof_sub = $row1['SUB_COUNT']; }
                        if ($countof_sub <= 4) {
                            $sjf_count_subject = $countof_sub * 1000;
                        }

                        $compute_arrival_time = ($row['TIME_IN_M'] * $mMili) + ($row['TIME_IN_S'] * $sMili) + ($row['TIME_IN_H'] * $hMili) + $row['TIME_IN_MILI'];
                        $compute_burst_time =  ($row['TIME_OUT_M'] * $mMili) + ($row['TIME_OUT_S'] * $sMili) + ($row['TIME_OUT_H'] * $hMili) + $row['TIME_OUT_MILI'];

                        $compute_burst_time -= $sjf_count_subject;

                        array_push($get_student_queue,array(
                            [
                                'Student_Number' => $row['STUDENT_NUMBER'],
                                'ARRIVAL_TIME' => $compute_arrival_time,
                                'BURST_TIME' => $compute_burst_time,
                                'HOUR' => $row['TIME_IN_H'],
                                'STUDENT_ID' => $row['STUDENT_ID'],
                                
                            ]));
                    }
                }

                // APPLY SJF ALGORITHM (SORT BY BURST TIME)
                usort($get_student_queue, function($a, $b) { 
                    return $a[0]['BURST_TIME'] - $b[0]['BURST_TIME'];
                });

                echo json_encode($get_student_queue);

                $turn_around_time = 0;
                $completion_time = 0;
                $get_total_tat = 0;
                $get_total_wat = 0;
                $gant = 0;
                $display_fcfs = [];
                $idle = 0;

                // APPLY SJF ALGORITHM
                $i = 0;

                foreach($get_student_queue as $val)
                {
                
                    echo $val[0]['ARRIVAL_TIME'];
                    if($i++ == 0){

                        $completion_time += $val[0]['BURST_TIME'];
                        $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];
                        $gant += $val[0]['BURST_TIME'];
                        $waiting_time = 0;

                        array_push( $display_fcfs, array(
                            [
                                'ARRIVAL_TIME' => $val[0]['ARRIVAL_TIME'],
                                'BURST_TIME' => $val[0]['BURST_TIME'],
                                'TURN_AROUND_TIME' => $turn_around_time,
                                'WAITING_TIME' => $waiting_time
                            
                            ]));

                    }
                    else
                    {
                        $waiting_time = $gant - $val[0]['ARRIVAL_TIME'];
                        if($waiting_time <= 0)
                        {
                            $waiting_time = 0;
                            $idle =  $val[0]['ARRIVAL_TIME'] - $gant;
                            $gant += $idle;
                            $gant += $val[0]['BURST_TIME'];
                            $completion_time = $gant;
                            $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];   

                        }
                        else
                        {
                            $gant += $val[0]['BURST_TIME'];
                            $completion_time = $gant;
                            $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];
                        }
                        array_push( $display_fcfs, array(
                            [
                                'ARRIVAL_TIME' => $val[0]['ARRIVAL_TIME'],
                                'BURST_TIME' => $val[0]['BURST_TIME'],
                                'TURN_AROUND_TIME' => $turn_around_time,
                                'WAITING_TIME' => $waiting_time,
                                'IDLE_TIME' => $idle
                            ]
                            
                            ));

                    }
                    
                
                    $get_total_tat+=$turn_around_time;
                    $get_total_wat+=$waiting_time;
                    
                    
                    // echo json_encode(array(['ARRIVAL_TIME'=>$val[0]['ARRIVAL_TIME'],'BURST_TIME'=>$val[0]['BURST_TIME'],'TURN_AROUND_TIME'=>$turn_around_time,'WAITING_TIME'=>$waiting_time]));
                    // $insert_process = "INSERT INTO T_PROCESS (STUDENT_NUMBER, ARRIVAL_TIME, BURST_TIME, TURN_AROUND_TIME, WAITING_TIME, IDLE_TIME, ALGO_TYPE_ID, CREATED_AT) 
                    //                 VALUES ('{$val[0]['Student_Number']}', '{$val[0]['ARRIVAL_TIME']}', '{$val[0]['BURST_TIME']}','$turn_around_time','$waiting_time','$idle',2,CURRENT_TIMESTAMP)";
                    $insert_process = "UPDATE T_PROCESS AS P INNER JOIN  T_STUDENTS AS  S ON S.STUDENT_ID = P.STUDENT_ID SET SJF_ARRIVAL_TIME = '{$val[0]['ARRIVAL_TIME']}' ,SJF_BURST_TIME =  '{$val[0]['BURST_TIME']}', SJF_TURNAROUND_TIME =  '$turn_around_time', SJF_WAITING_TIME =  '$waiting_time' , SJF_IDLE_TIME =  '$idle'  WHERE STUDENT_NUMBER = '{$val[0]['Student_Number']}' ";                                               
                    mysqli_query($connect, $insert_process);
                }


                echo json_encode($display_fcfs);
                    $curr_id = "SELECT MIN(BATCH_NO) AS BATCH_NO FROM t_algo";
                    $getquery = mysqli_query($connect, $curr_id);
                    while ($row = mysqli_fetch_assoc($getquery)) { $cs_sec_id = $row['BATCH_NO']; }
                
                    // if ($cs_sec_id == null) { $cs_sec_id = 1; }
                    // else
                    // {
                    //     $get_max_id = "SELECT MAX(CS_SEC_ID) AS CS_SEC_ID FROM r_course_subject_sections";
                    //     $getmaxquery = mysqli_query($connect, $get_max_id);
                    //     while ($row = mysqli_fetch_assoc($getmaxquery)) { $max_sec_id = $row['CS_SEC_ID']; }
                    //     $cs_sec_id = $max_sec_id + 1;
                    // }

                    $average_tat=$get_total_tat/count($get_student_queue);
                    $average_wat=$get_total_wat/count($get_student_queue);

                    array_push($display_fcfs,array(['sjf_average_tat'=>$average_tat,'sjf_average_wat'=>$average_wat,'sjf_total_tat'=>$get_total_tat])); 
                    // $insert_queue = "INSERT INTO T_ALGO (BATCH_NO, ALGO_NAME, AVG_TURNAROUND_TIME, AVG_WAITING_TIME) 
                    //                     VALUES ('$cs_sec_id','SHORTEST JOB FIRST','$average_tat','$average_wat')";
                    $insert_queue = "UPDATE T_ALGO SET SJF_AVG_TURNAROUND_TIME ='$average_tat',  SJF_AVG_WAITING_TIME ='$average_wat' WHERE BATCH_NO = '$cs_sec_id' ";
                    mysqli_query($connect, $insert_queue);


                }
                else
                {
                    echo "it must be greater than 1 student to compute the algorithm";
                }


                                          
    }
    //insert  sjf algo end







    
    //insert priority algo start
    public function Store_Priority()
    {   

                
        $connect = mysqli_connect("localhost", "root", "", "time_metrics_v2_db");

        $count_id = $_POST["count_id"]; 
        if($count_id > 1)
        {   
            $mMili = 60000; $sMili = 1000; $hMili = 3600000;
            $enrollment_id = $_POST['enrollment_id'];
            $get_student_queue = array();
            $get_array = array();

            foreach($enrollment_id as $value)
            {

                
                $view_enrollee = mysqli_query($connect,"SELECT * FROM t_enrollment AS E
                INNER JOIN t_studentS AS TSI
                on TSI.STUDENT_ID = E.STUDENT_ID
                INNER JOIN r_student_status AS SS
                ON SS.STATUS_ID = E.STATUS_ID
                WHERE enrollment_id = $value");
            
                
                while($row = mysqli_fetch_assoc($view_enrollee))
                {   
                    
                    $compute_arrival_time = ($row['TIME_IN_M'] * $mMili) + ($row['TIME_IN_S'] * $sMili) + ($row['TIME_IN_H'] * $hMili) + $row['TIME_IN_MILI'];
                    $compute_burst_time =  ($row['TIME_OUT_M'] * $mMili) + ($row['TIME_OUT_S'] * $sMili) + ($row['TIME_OUT_H'] * $hMili) + $row['TIME_OUT_MILI'];
                    $compute_burst_time -= 8000;
                    array_push($get_student_queue,array(
                    [
                        'Student_Number' => $row['STUDENT_NUMBER'],
                        'ARRIVAL_TIME' => $compute_arrival_time,
                        'BURST_TIME' => $compute_burst_time,
                        'HOUR' => $row['TIME_IN_H'],
                        'STUDENT_ID' => $row['STUDENT_ID'],
                        'PRIORITY' => $row['PRIORITY']
                        
                    ]));
                }
            }

            //SORT BY PRIORITY
            usort($get_student_queue, function($a, $b) { 
                return $a[0]['PRIORITY'] - $b[0]['PRIORITY'];
            });

            echo json_encode($get_student_queue).'<br>';

            $turn_around_time=0;
            $completion_time=0;
            $get_total_tat=0;
            $get_total_wat=0;
            $gant = 0;
            $display_fcfs = [];
            $idle = 0;
            // APPLY FCFS ALGORITHM
            $i = 0;
            echo "AT &nbsp;&nbsp;&nbsp;&nbsp;BT CT TAT WAT <br>";  
            foreach($get_student_queue as $val){

                if($i++ == 0)
                {
                    $completion_time += $val[0]['BURST_TIME'];
                    $turn_around_time = $completion_time-$val[0]['ARRIVAL_TIME'];   
                    $waiting_time = 0;
                    $gant += $val[0]['BURST_TIME'];
                    array_push($display_fcfs, array(['ARRIVAL_TIME' => $val[0]['ARRIVAL_TIME'],
                        'BURST_TIME' => $val[0]['BURST_TIME'],
                        'TURN_AROUND_TIME' => $turn_around_time,
                        'WAITING_TIME' => $waiting_time]));

                }
                else
                {
                    $waiting_time = $gant - $val[0]['ARRIVAL_TIME'];
                    if($waiting_time <= 0)
                    {
                        $waiting_time = 0;
                        $idle =  $val[0]['ARRIVAL_TIME'] - $gant;
                        $gant += $idle;
                        $gant += $val[0]['BURST_TIME'];
                        $completion_time = $gant;
                        $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];   

                    }
                    else
                    {
                        $gant += $val[0]['BURST_TIME'];
                        $completion_time = $gant;
                        $turn_around_time = $completion_time - $val[0]['ARRIVAL_TIME'];
                    }
                }
                
                
                $get_total_tat += $turn_around_time;
                $get_total_wat += $waiting_time;
                
                echo $idle;
                // $insert_process = "INSERT INTO T_PROCESS (STUDENT_NUMBER, ARRIVAL_TIME, BURST_TIME, TURN_AROUND_TIME, WAITING_TIME, IDLE_TIME, ALGO_TYPE_ID, CREATED_AT) 
                //             VALUES ('{$val[0]['Student_Number']}', '{$val[0]['ARRIVAL_TIME']}', '{$val[0]['BURST_TIME']}','$turn_around_time','$waiting_time','$idle',3,CURRENT_TIMESTAMP)";

                $insert_process = "UPDATE T_PROCESS AS P INNER JOIN  T_STUDENTS AS  S ON S.STUDENT_ID = P.STUDENT_ID SET PRIORITY_ARRIVAL_TIME = '{$val[0]['ARRIVAL_TIME']}' ,PRIORITY_BURST_TIME =  '{$val[0]['BURST_TIME']}', PRIORITY_TURNAROUND_TIME =  '$turn_around_time', PRIORITY_WAITING_TIME =  '$waiting_time' , PRIORITY_IDLE_TIME =  '$idle'  WHERE STUDENT_NUMBER = '{$val[0]['Student_Number']}' ";           

                mysqli_query($connect, $insert_process);
            }

            $curr_id = "SELECT MIN(BATCH_NO) AS BATCH_NO FROM t_algo";

            $getquery = mysqli_query($connect, $curr_id);
            
            while ($row = mysqli_fetch_assoc($getquery)) 
            {
                $cs_sec_id = $row['BATCH_NO'];
            }
        
            // if ($cs_sec_id == null) { $cs_sec_id = 1; }
            // else
            // {
            //     $get_max_id = "SELECT MAX(CS_SEC_ID) AS CS_SEC_ID FROM t_cs_section";
            //     $getmaxquery = mysqli_query($connect, $get_max_id);
            //     while ($row = mysqli_fetch_assoc($getmaxquery)) { $max_sec_id = $row['CS_SEC_ID']; }
            //     $cs_sec_id = $max_sec_id + 1;
            // }

            $average_tat = $get_total_tat / count($get_student_queue);
            $average_wat = $get_total_wat / count($get_student_queue);
            array_push($display_fcfs,array(
                [
                    'priority_average_tat' => $average_tat,
                    'priority_average_wat' => $average_wat,
                    'priority_total_tat' => $get_total_tat
                ]));

            // $insert_queue = "INSERT INTO T_ALGO (BATCH_NO, ALGO_NAME, AVG_TURNAROUND_TIME, AVG_WAITING_TIME) 
            //                 VALUES ('$cs_sec_id','PRIORITY','$average_tat','$average_wat')";
            $insert_queue = "UPDATE T_ALGO SET PRIORITY_AVG_TURNAROUND_TIME ='$average_tat',  PRIORITY_AVG_WAITING_TIME ='$average_wat' WHERE BATCH_NO = '$cs_sec_id' ";
            mysqli_query($connect, $insert_queue);


            echo json_encode($display_fcfs);
        }
        else
        {
            echo "it must be greater than 1 student to compute the algorithm";
        }

                                             
    }
    //insert priority algo end

    //get algo process
    public function Get_Algo_Process()
    {
        $get_batch_no = request('batch_no');
        $get_data = DB::table('t_process as P')                                                                                                  
                        ->join('t_students as S','S.STUDENT_ID','P.STUDENT_ID')
                        ->join('t_applicants as A','A.APPLICANT_ID','S.APPLICANT_ID')
                        ->join('t_enrollment as E','S.STUDENT_ID','E.STUDENT_ID')
                        ->where('BATCH_NO',$get_batch_no)
                        ->get();
        echo $get_data;                                      
    }

    //load chart 
    public function Load_Bar_Chart()
    {
        $get_batch_no = request('batch_no');
        $get_data = DB::table('t_algo')                                                                          
                        ->where('BATCH_NO',$get_batch_no)
                        ->get();
        echo $get_data;                                      
    }
}
