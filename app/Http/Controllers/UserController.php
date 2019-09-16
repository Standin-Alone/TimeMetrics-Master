<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{   

//VIEW-FUNCTION-START
    public function Index()
    {

        return view('admin.user_management');

    }
//VIEW-FUNCTION-END


//LOAD-TABLE-FUNCTION-START
public function Load_Table()
{

    

}
//LOAD-TABLE-FUNCTION-END

//ADD-FUNCTION-START
    public function Add()
    {



    }
//ADD-FUNCTION-END



//EDIT-FUNCTION-START
public function Edit()
{



}
//EDIT-FUNCTION-END




//REMOVE-FUNCTION-START
    public function Remove()
    {



    }
//REMOVE-FUNCTION-END




}
