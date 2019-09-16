<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RegistrationController extends Controller
{
    //STUDENT REGISTRATION START
    public function Index_Registration()
    {
        $get_student_status = DB::table('t_students as S')
                                ->join('t_enrollment as E','E.STUDENT_ID','S.STUDENT_ID')   
                                ->join('r_courses as C','C.COURSE_ID','E.COURSE_ID')   
                                ->join('t_applicants as A','A.APPLICANT_ID','S.APPLICANT_ID')
                                
                                ->where('S.STUDENT_ID',session('session_student_number'))->get();
        return view('student.registration',compact('get_student_status'));
    }
    //STUDENT REGISTRATION END



    
}
