<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use DB;

class CourseSetupController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function CourseIndex()
    {
        $DisplayCourse = DB::Table('r_courses')
                            ->select('course_id'
                                    , 'course_code'
                                	, 'course_description'
                                	, 'year_level'
                                	, 'semester')
                            ->get();
        
        return view('admin.course', compact('DisplayCourse'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

}
