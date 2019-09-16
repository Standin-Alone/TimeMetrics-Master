<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReportController extends Controller
{
    public function Index_List_Of_Enrolled_Students()
    {

        $start_date = date('Y-m-d',strtotime(request('start_date')));
        $end_date = date('Y-m-d',strtotime(request('end_date')));
        $status_id = request('status_id');

        
        $get_filtered_by_date = DB::table('t_enrollment as E')
                                        ->join('r_courses as C','C.COURSE_ID','E.COURSE_ID')
                                        ->join('t_students as S','S.STUDENT_ID','E.STUDENT_ID')
                                        ->join('t_applicants as A','A.APPLICANT_ID','S.STUDENT_ID') 
                                        ->join('r_student_status as SS','SS.STATUS_ID','E.STATUS_ID') 
                                        ->where('SS.STATUS_ID',$status_id)                                                                               
                                        ->whereBetween('DATE_ENROLLED',array($start_date,$end_date))                                                                               
                                        ->get();
        $get_status =DB::table('r_student_status')->get();
        return view('registrar.report_list_of_enrolled_students',compact('get_filtered_by_date','start_date','end_date','get_status'));
    }


}
