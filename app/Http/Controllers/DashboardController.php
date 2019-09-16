<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class DashboardController extends Controller
{
    //REGISTRAR DASHBOARD START
    public function Index_Registrar_Dashboard()
    {   
        $get_count_students = DB::table('t_students')->where('STUDENT_NUMBER','!=',null)->count();

        $get_count_regular = DB::table('t_enrollment as E')
                                ->join('r_student_status as S','E.STATUS_ID','S.STATUS_ID')
                                ->where('STATUS_NAME','REGULAR')->count();

        $get_count_irregular = DB::table('t_enrollment as E')
                                ->join('r_student_status as  S','E.STATUS_ID','S.STATUS_ID')
                                ->where('STATUS_NAME','IRREGULAR')->count();

        $get_count_years = DB::table('t_enrollment as E')
                                ->select(DB::raw('DISTINCT YEAR(DATE_ENROLLED) as YEAR_ENROLLED'))
                                ->join('t_students as  S','E.STUDENT_ID','S.STUDENT_ID')
                                ->get();                            
        $get_count_graduating = DB::table('t_enrollment as E')
                                ->join('r_student_status as  S','E.STATUS_ID','S.STATUS_ID')
                                ->where('STATUS_NAME','GRADUATING')->count();
        return view('registrar.dashboard',compact('get_count_students','get_count_regular','get_count_irregular','get_count_years','get_count_graduating'));
    }
    //REGISTRAR DASHBOARD END

}
