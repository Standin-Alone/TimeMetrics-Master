<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\TReport;
use App\Models\SsUser;
use DB;
use DataTables;
use App\Message;
use App\Events\UlatEvent;
use Mail;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
  
//VIEW-FUNCTION-START
    public function Index()
    {       

        return view('sign_in');

    }
//VIEW-FUNCTION-END



//LOGIN-FUNCTION-START
    public function Login()
    {   

            if(session('session_userid')!='')
        {
                return redirect()->intended(route('Dashboard'));
        }
        else
        {

                    
        return view('sign_in');


        }


    }

//LOGIN-FUNCTION-END
    

//SIGN-IN-FUNCTION-START
public function Sign_In()
{   

    $username = request('username');
    $password = request('password');

    $get_users = DB::table('r_users as U')
                    ->join('r_roles as R','U.ROLE_ID','R.ROLE_ID')
                    ->where('USERNAME',$username)
                    ->where('PASSWORD',$password)
                    ->get();

    if(!$get_users->isEmpty())
    {        
        foreach($get_users as $value)
        {  
            
            if($value->ROLE_NAME == 'Admin')
            {   
            
                $get_name = DB::table('r_admins')->select(DB::raw("CONCAT(FIRST_NAME,' ',MIDDLE_NAME,' ',LAST_NAME)"))->where('ADMIN_ID',$value->ACCOUNT_ID)->value('FULL_NAME');
                session(['session_user_id' => $value->USER_ID]);
                session(['session_name'    => $get_name]);
                session(['session_role' => $value->ROLE_NAME]);                
                echo 'A';
                
            }
            else if($value->ROLE_NAME == 'Registrar')
            {   
                $get_name = DB::table('r_registrars')->select(DB::raw("CONCAT(FIRST_NAME,' ',MIDDLE_NAME,'',LAST_NAME) as FULL_NAME"))->where('REGISTRAR_ID',$value->ACCOUNT_ID)->value('FULL_NAME');
                session(['session_user_id' => $value->USER_ID]);
                session(['session_name'    => $get_name]);
                session(['session_role' => $value->ROLE_NAME]);
                echo 'R';
            }
            else if($value->ROLE_NAME == 'Faculty')
            {   
                $get_name = DB::table('r_instructors')->select(DB::raw("CONCAT(FIRST_NAME,' ',MIDDLE_NAME,'',LAST_NAME) as FULL_NAME"))->where('INSTRUCTOR_ID',$value->ACCOUNT_ID)->value('FULL_NAME');
                session(['session_user_id' => $value->USER_ID]);
                session(['session_name'    => $get_name]);
                session(['session_role' => $value->ROLE_NAME]);
                echo 'F';
            } 
            else if($value->ROLE_NAME == 'Student')
            {   
                $get_name = DB::table('t_students as S')
                                ->join('t_applicants as A','A.APPLICANT_ID','S.APPLICANT_ID')
                                ->select(DB::raw("CONCAT(FIRST_NAME,' ',MIDDLE_NAME,' ',LAST_NAME) as FULL_NAME"))->where('STUDENT_ID',$value->ACCOUNT_ID)->value('FULL_NAME');
                $get_student_number = DB::table('t_students as S')
                                ->join('t_applicants as A','A.APPLICANT_ID','S.APPLICANT_ID')
                                ->select('STUDENT_NUMBER')->where('STUDENT_ID',$value->ACCOUNT_ID)->value('STUDENT_NUMBER');
                session(['session_user_id' => $value->USER_ID]);
                session(['session_student_number' => $get_student_number]);
                session(['session_name'    => $get_name]);
                session(['session_role' => $value->ROLE_NAME]);
                echo 'S';
            }      
        }
    }
    else
    {

        echo '0';
    }


    
}


    public function Sign_Out()
    {
            // session()->flush();
            session()->forget('session_user_id');
            session()->forget('session_name');
            session()->forget('session_role');
        

            return redirect()->route('Login');
        
    }



    
}
