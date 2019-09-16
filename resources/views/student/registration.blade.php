@extends('main.base')

@section('page-css')
    
@endsection

@section('page-js')
    
@endsection



@section('content')

<div class="container-fluid">
        <div class="block-header">
            <h2></h2>
        </div>
    </div>
    <div class="alert alert-danger">
            <center><strong>Registration is not yet open.</strong></center>
        </div>
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Your Current Registration Information
                            
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <form>
                            @foreach($get_student_status as $value)
                            <div class="row">
                                    <div class="col-md-6">                            
                                            
                                            <h4>Student Name :   <span style="font-weight: 100">{{$value->LAST_NAME}} , {{$value->FIRST_NAME}} {{$value->MIDDLE_NAME}} </span></h4>                              
                                        </div>

                                    <div class="col-md-6">                            
                                                <h4>Student Number :  {{$value->STUDENT_NUMBER}}  </h4>                                
                                            </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">                            
                                            <h4>Course :</h4>                                
                                        </div>

                                    <div class="col-md-6">                            
                                                <h4>Year Level :</h4>                                
                                            </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">                            
                                            <h4>Status :</h4>                                
                                        </div>

                                    <div class="col-md-6">                            
                                                <h4>Section :</h4>                                
                                            </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6">                            
                                            <h4>Student Number :</h4>                                
                                        </div>

                                    <div class="col-md-6">                            
                                                <h4>Student Number :</h4>                                
                                            </div>
                            </div>
                            

                            
                            @endforeach
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Vertical Layout | With Floating Label -->
    
@endsection