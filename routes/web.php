<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//MAIN-ROUTES-START
Route::group(['middleware' => ['csrf']], function (){

    Route::GET('/','Controller@Login')
            ->name('Login');

    Route::POST('/Sign_In','Controller@Sign_In')
            ->name('Sign_In');
    Route::GET('/Sign_Out','Controller@Sign_Out')
            ->name('Sign_Out');
    

});
//MAIN-ROUTES-END


//ADMIN-ROUTES-START

Route::group(['middleware' => ['csrf']], function (){

    Route::GET('/Users','UserController@Index')
            ->name('Users');
    
});
//ADMIN-ROUTES-END


//STUDENT-ROUTES-START

Route::group(['middleware' => ['csrf']], function (){

        Route::GET('/Registration','RegistrationController@Index_Registration')
        ->name('Registration');
});
//STUDENT-ROUTES-END


//REGISTRAR-ROUTES-START

Route::group(['middleware' => ['csrf']], function (){
        Route::GET('/Dashboard','DashboardController@Index_Registrar_Dashboard')
        ->name('Dashboard');

    Route::GET('/EnrollStudent','EnrollStudentController@Index')
        ->name('EnrollStudent');

    Route::POST('/LoadBarChart','EnrollStudentController@Load_Bar_Chart')
        ->name('LoadBarChart');

    Route::POST('/GetAlgoProcess','EnrollStudentController@Get_Algo_Process')
        ->name('GetAlgoProcess');
//INSERT ALGORITHMS
    Route::POST('/StoreFCFS','EnrollStudentController@Store_FCFS')
        ->name('StoreFCFS');

    Route::POST('/StorePriority','EnrollStudentController@Store_Priority')
        ->name('StorePriority');
    Route::POST('/StoreSJF','EnrollStudentController@Store_SJF')
        ->name('StoreSJF');

    Route::GET('/ListOfEnrolledStudents','ReportController@Index_List_Of_Enrolled_Students')
        ->name('ListOfEnrolledStudents');        

    
});
//REGISTRAR-ROUTES-END

//COURSE-SETUP-ROUTES-START
Route::group(['' => ''], function (){
        Route::get('/CourseSetup', 'CourseSetupController@CourseIndex')
            ->name('CourseSetup');
    
        Route::POST('/CourseAdd', 'CourseSetupController@CourseStore')
                ->name('CourseAdd');
    });