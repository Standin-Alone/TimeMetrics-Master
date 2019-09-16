@extends('main.base')

@section('page-css')
    
@endsection

@section('page-js')

<script>
$(".load-table").dataTable();

$("#enroll-btn").click(function(e){
    e.preventDefault();
    enrollment_id = [];
    get_token = "{{csrf_token()}}";
    $(".sub_check").each(function(){
        enrollment_id.push($(this).val());       
      });
    var count_id = enrollment_id.length;
    
    if(count_id >= 1 )
    {
        swal({
            title: "Are you sure?",
            text: "This students will be enrolled",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#8BC34A",
            confirmButtonText: "Yes",        
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                url:'StoreFCFS',
                type:'post',
                data:{'enrollment_id':enrollment_id, 'count_id':count_id,_token:get_token},
                success:function(data){                
                
                },
                error:function(data){
                    alert(data);
                }
                });

            $.ajax({
                url:'StorePriority',
                type:'post',
                data:{'enrollment_id':enrollment_id, 'count_id':count_id,_token:get_token},
                success:function(data){                
                
                },
                error:function(data){
                    alert(data);
                }
                });
                $.ajax({
                url:'StoreSJF',
                type:'post',
                data:{'enrollment_id':enrollment_id, 'count_id':count_id,_token:get_token},
                success:function(data){                
                
                },
                error:function(data){
                    alert(data);
                }
                });
                swal("Data has been successfully submitted.", "", "success").then(function(){
                    location.reload();
                });
            } else {
                swal("Cancelled", "", "error");
            }
        }); 
   }else{

    swal("Please select 10 students.", "", "error");
   }
 
});

$("#view-batch-btn").click(function(e){
    
    e.preventDefault();
    
    
    get_batch_no = $(this).attr('batch-no');
    get_token = "{{csrf_token()}}";
    $("#view-batch-title").text(get_batch_no);



    $.ajax(
    {
        url:'GetAlgoProcess',
        type:'post',
        data:{
              batch_no: get_batch_no
             ,_token: get_token
            },
        success: function(data){
            convert_to_json = JSON.parse(data);
            html = '';
            convert_to_json.map((val)=>{

                $('.algo-table').DataTable().row.add([val.STUDENT_NUMBER,val.LAST_NAME+','+val.FIRST_NAME+' '+val.MIDDLE_NAME
                                                     ,'Arrival Time : '+val.FCFS_ARRIVAL_TIME.toLocaleString()+'<br>'+
                                                      'Burst Time : '+val.FCFS_BURST_TIME.toLocaleString()+' <br>'+
                                                      'Turn Around Time : '+val.FCFS_TURNAROUND_TIME.toLocaleString()+'  <br>'+
                                                      'Waiting Time :  '+val.FCFS_WAITING_TIME.toLocaleString()+' <br>'+
                                                      'Idle Time : '+val.FCFS_IDLE_TIME.toLocaleString()

                                                     ,'Arrival Time : '+val.SJF_ARRIVAL_TIME.toLocaleString()+'<br>'+
                                                      'Burst Time : '+val.SJF_BURST_TIME.toLocaleString()+' <br>'+
                                                      'Turn Around Time : '+val.SJF_TURNAROUND_TIME.toLocaleString()+'  <br>'+
                                                      'Waiting Time :  '+val.SJF_WAITING_TIME.toLocaleString()+' <br>'+
                                                      'Idle Time : '+val.SJF_IDLE_TIME.toLocaleString()

                                                     ,'Arrival Time : '+val.PRIORITY_ARRIVAL_TIME.toLocaleString()+'<br>'+
                                                      'Burst Time : '+val.PRIORITY_BURST_TIME.toLocaleString()+' <br>'+
                                                      'Turn Around Time : '+val.PRIORITY_TURNAROUND_TIME.toLocaleString()+'  <br>'+
                                                      'Waiting Time :  '+val.PRIORITY_WAITING_TIME.toLocaleString()+' <br>'+
                                                      'Idle Time : '+val.PRIORITY_IDLE_TIME.toLocaleString()
                ]).draw();
               
            })
        
            

        },
        error: function(){
            swal('error','','error');
        }
    });
    $.ajax(
    {
        url:'LoadBarChart',
        type:'post',
        data:{
              batch_no: get_batch_no
             ,_token: get_token
            },
        success: function(data){
            convert_to_json = JSON.parse(data);
            

            
            Algo_Data(convert_to_json);
            
            
        },
        error: function(){
            swal('error','','error');
        }

    })
})


// bar script chart start
function Algo_Data(data)
{
    var get_chart = Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'OS Scheduling Algorithms Comparison '
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: ['First Come First Serve', 'Priority', 'Shortest Job First'],
        title: {
            text: null
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Miliseconds ',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        }
    },
    tooltip: {
        valueSuffix: ''
    },
    plotOptions: {
        bar: {
            dataLabels: {
                enabled: true
            }
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    credits: {
        enabled: false
    },
    
});
    
    data.map((value)=>{

        
        get_chart.addSeries(
            {
        name: 'Average Turn Around Time',
        data: [                
                value.FCFS_AVG_TURNAROUND_TIME
               ,value.PRIORITY_AVG_TURNAROUND_TIME         
               ,value.SJF_AVG_TURNAROUND_TIME
                      
                ]
            },false);

            get_chart.addSeries(
                {
                name: 'Average Waiting Time',
                data: [                           
                     value.FCFS_AVG_WAITING_TIME   
                    ,value.PRIORITY_AVG_WAITING_TIME
                    ,value.SJF_AVG_WAITING_TIME   
                    
                    ]
            }   ,false);
            
    get_chart.redraw();
    });

}


	
// bar script chart end
</script>
@endsection



@section('content')

<div class="container-fluid">
        <div class="block-header">
            <h2></h2>
        </div>
    </div>

    <!-- Content Start -->
    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Student Queue
                            <small>Enrolling the registered students</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            {{-- main table --}}
                            <table class="table  table-striped table-hover load-table  dataTable" id="load-table">
                                <thead>
                                    <tr>
                                        <th hidden>Id</th>
                                        <th >&nbsp;</th>
                                        <th>Student Info</th>
                                        <th>Course</th>
                                        <th>Year Level</th                                        
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @foreach ( $get_registered_students as $value )                                        
                                    <tr>
                                        <td hidden>{{$value->STUDENT_NUMBER}}</td>
                                        <td >
                                            <input type="checkbox" id="basic_checkbox_{{$value->STUDENT_NUMBER}}" class="filled-in sub_check" value="{{$value->ENROLLMENT_ID}}"/>
                                            <label for="basic_checkbox_{{$value->STUDENT_NUMBER}}">&nbsp;</label>
                                        </td>
                                        <td><h4>{{str_pad($value->STUDENT_NUMBER,6,0,STR_PAD_LEFT)}}</h4><br> {{$value->LAST_NAME}}, {{$value->FIRST_NAME}} {{$value->MIDDLE_NAME}} </td>
                                        <td>{{$value->COURSE_DESCRIPTION}}</td>
                                        <td>{{$value->YEAR_LEVEL}}</td>                                        
                                    </tr>
                                    @endforeach                                    
                                </tbody>
                            </table>
                            {{-- main table end --}}
                        </div>
                        <center>
                            
                            <button type="button" class="btn btn-lg bg-green waves-effect" id="enroll-btn">Enroll</button>
                        </center>
                    </div>
                </div>
                <div class="card">
                        <div class="header">
                            <h2>
                                Enrolled Per Batch
                                <small>Average turn around time and average waiting time per batch</small>
                            </h2>                            
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                {{-- main table --}}                                
                                <table class="table  table-striped table-hover load-table dataTable" id="load-table">
                                    <thead>
                                        <tr>
                                            <th hidden>Id</th>
                                            
                                            <th>Batch No.</th>
                                            <th>First Come First Serve</th>
                                            <th>Shortest Job First</th>
                                            <th>Priority Scheduling</th>
                                            <th>Action</th>                                                                                                                           
                                        </tr>
                                    </thead>                                    
                                    <tbody>
                                        @foreach($get_algo as $val)                                  
                                        <tr>
                                            <td hidden>{{$val->ALGO_ID}}</td>                                            
                                            <td>{{$val->BATCH_NO}}</td>
                                            <td>Average Turn Around Time : {{ number_format($val->FCFS_AVG_TURNAROUND_TIME)}}  <br>
                                                Average Waiting Time :  {{ number_format($val->FCFS_AVG_WAITING_TIME)}} 
                                            </td>
                                            <td>Average Turn Around Time : {{ number_format($val->SJF_AVG_TURNAROUND_TIME)}}  <br>
                                                Average Waiting Time :  {{ number_format($val->SJF_AVG_WAITING_TIME)}}
                                            </td>
                                            <td>Average Turn Around Time : {{ number_format($val->PRIORITY_AVG_TURNAROUND_TIME)}}  <br>
                                                Average Waiting Time :  {{ number_format($val->PRIORITY_AVG_WAITING_TIME)}} </td>
                                            <td><button type="button" class="btn btn-lg bg-orange waves-effect " batch-no="{{$val->BATCH_NO}}" id="view-batch-btn"  data-toggle="modal" data-target="#modal-batch"> <i class="material-icons"  data-toggle="tooltip" data-placement="right" title="Tooltip on right"  >pageview</i> </button></td>                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- main table end --}}                                
                            </div>
                        </div>
                    </div>
                    {{-- VIEW BATCH MODAL START --}}
                    <div class="modal fade " id="modal-batch" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content" style="width:1200px;">
                                    <div class="modal-header  bg-orange">
                                        <h4 class="modal-title" id="largeModalLabel">VIEW BATCH #<h4 id="view-batch-title" ></h4> </h4>
                                    </div>
                                    <div class="modal-body" >
                                        {{-- modal body content start --}}
                                        <br>
                                        <table class="table  table-striped table-hover load-table  algo-table dataTable" id="load-table">
                                                <thead>
                                                    <tr>
                                                        
                                                        
                                                        <th>Student Number</th>
                                                        <th>Student Name</th>
                                                        <th>First Come First Serve</th>
                                                        <th>Shortest Job First</th>
                                                        <th>Priority Scheduling</th>                                                                                                                    
                                                    </tr>
                                                </thead>                                    
                                                <tbody>
                                               
                                            
                                                    
                                                </tbody>
                                            </table>    
                                        <br><br>
                                        <div id="container">
                                        </div>
                                        {{-- modal body content end --}}
                                    </div>
                                    <div class="modal-footer bg-orange">
                                        {{-- modal footer content start --}}                                        
                                        {{-- <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button> --}}
                                        <button type="button" class="btn btn-link waves-effect col-white" data-dismiss="modal">CLOSE</button>
                                        {{-- modal footer content end --}}                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    {{-- VIEW BATCH MODAL END --}}
            </div>
        </div>
        <!-- Content End-->
    
@endsection