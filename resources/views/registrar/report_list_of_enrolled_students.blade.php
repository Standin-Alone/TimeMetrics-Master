@extends('main.base')
@section('title','List of Enrolled Students')

@section('page-css')
    
@endsection

@section('page-js')

<script>
$(".load-table").dataTable({
        dom: 'Bfrtip',
        responsive: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });



$("#filter-btn").click(function(){

    start_date = $("#start-date-txt").val();
    end_date = $("#end-date-txt").val();
    status_id = $("#status-txt option:selected").val();
    location.href = "ListOfEnrolledStudents?start_date="+start_date+"&end_date="+end_date+"&status_id="+status_id;

});
	

</script>
@endsection



@section('content')

<div class="container-fluid">
        <div class="block-header">
            <h2></h2>
        </div>
    </div>

    <!-- Content Start -->
    <div class="">
            <div class="col-lg-12 ">
                <div class="card">
                    <div class="header">
                        <h2>
                            List of Enrolled students
                            <small></small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            
                        </ul>
                    </div>
                    
                    <div class="body">
                            <h2 class="card-inside-title">Filter by student status</h2>
                            <select class="form-control show-tick" id="status-txt">
                                <option value="" selected disabled>-- Please select student status --</option>
                                @foreach ($get_status as $val )
                                    <option value="{{$val->STATUS_ID}}">{{$val->STATUS_NAME}}</option>
                                @endforeach
                            </select>
                        
                        <h2 class="card-inside-title">Filter by date</h2>
                        <div class="input-daterange input-group" id="bs_datepicker_range_container">
                            <div class="form-line">
                                <input type="text" class="form-control" id="start-date-txt" placeholder="Date start...">
                            </div>
                            <span class="input-group-addon">to</span>
                            <div class="form-line">
                                <input type="text" class="form-control" id="end-date-txt" placeholder="Date end...">
                            </div>
                        </div>
                        
                        <button type="button" class="btn btn-lg bg-green waves-effect" id="filter-btn">Filter</button>
                        <br>
                        <br>
                        <br>
                        <div class="table-responsive">

                            {{-- main table --}}
                            <table class="table  table-striped table-hover load-table  " id="load-table">
                                <thead>
                                    <tr>
                                        <th hidden>Id</th>
                                        
                                        <th>Student Info</th>
                                        <th>Course</th>
                                        <th>Year Level</th>                                       
                                        <th>Date Enrolled</th>      
                                        <th>Status</th>                                       
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach($get_filtered_by_date as $val)
                                    <tr>
                                        <td hidden>{{$val->STUDENT_ID}}</td>
                                        
                                        <td>{{str_pad($val->STUDENT_NUMBER,6,0,STR_PAD_LEFT)}} <br>
                                            {{$val->LAST_NAME}}, {{$val->FIRST_NAME}} {{$val->MIDDLE_NAME}}
                                        </td>
                                        <td> {{$val->COURSE_DESCRIPTION}}</td>
                                        <td>{{$val->YEAR_LEVEL}}</td>                                       
                                        <td>{{$val->DATE_ENROLLED}}</td>    
                                        <td>{{$val->STATUS_NAME}}</td>                                       
                                    </tr>
                                    @endforeach
                                                                    
                                </tbody>
                            </table>
                            {{-- main table end --}}
                        </div>                        
                    </div>
                </div>
                
            </div>
        </div>
        <!-- Content End-->
    
@endsection