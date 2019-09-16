@extends('main.base')

@section('page-css')
    
@endsection

@section('page-js')
<script type="text/javascript">

    Highcharts.chart('enrolled-students-chart', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'Number of Enrolled Students Per Year'
        },

        xAxis: {
                                                                    
            categories: [
                        @foreach($get_count_years as $value)
                        '{{$value->YEAR_ENROLLED}}', 
                        @endforeach
            ]
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: true
            }
        },
        series: [
            @foreach($get_count_years as $val)
            <?php
                                $get_count_regular =DB::table('t_enrollment as E')
                                                        ->join('r_student_status as S','E.STATUS_ID','S.STATUS_ID')
                                                        ->where('STATUS_NAME','REGULAR')->where(DB::RAW('YEAR(DATE_ENROLLED)'),$val->YEAR_ENROLLED)->count();
                                                  
                                $get_count_irregular = DB::table('t_enrollment as E')
                                                        ->join('r_student_status as S','E.STATUS_ID','S.STATUS_ID')
                                                        ->where('STATUS_NAME','IRREGULAR')->where(DB::RAW('YEAR(DATE_ENROLLED)'),$val->YEAR_ENROLLED)->count();
                                $get_count_non_graduating = DB::table('t_enrollment as E')
                                                        ->join('r_student_status as S','E.STATUS_ID','S.STATUS_ID')
                                                        ->where('STATUS_NAME','NON-GRADUATING')->where(DB::RAW('YEAR(DATE_ENROLLED)'),$val->YEAR_ENROLLED)->count();
                                $get_count_graduating = DB::table('t_enrollment as E')
                                                        ->join('r_student_status as S','E.STATUS_ID','S.STATUS_ID')
                                                        ->where('STATUS_NAME','GRADUATING')->where(DB::RAW('YEAR(DATE_ENROLLED)'),$val->YEAR_ENROLLED)->count();
                                
                            ?>    
            {
            name: 'REGULAR',
            data: [
                                                                
                {{$get_count_regular}}
                ]
        }, {
            name: 'IRREGULAR',
            data: [
                
                {{$get_count_irregular}}
                
            ]
        }, {
            name: 'NON-GRADUATING',
            data: [
                
                {{$get_count_non_graduating}}
                
            ]
        }, {
            name: 'GRADUATING',
            data: [
                
                {{$get_count_graduating}}
                
            ]
        }                                       
            @endforeach
        ]
    });
</script>
@endsection



@section('content')

<div class="container-fluid">
        <div class="block-header">
            <h2></h2>
        </div>
    </div>

    
     <!-- Widgets -->
     <div class="row clearfix">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-pink hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="content">
                        <div class="text">Students</div>
                        <div class="number" data-fresh-interval="20">{{$get_count_students}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-light-green  hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">Regular Students</div>
                        <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{$get_count_regular}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-orange hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">account_circle</i>
                    </div>
                    <div class="content">
                        <div class="text">Irregular Students</div>
                        <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">{{$get_count_irregular}}</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="info-box bg-green hover-expand-effect">
                    <div class="icon">
                        <i class="material-icons">school</i>
                    </div>
                    <div class="content">
                        <div class="text">Graduating</div>
                    <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{$get_count_graduating}}</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Widgets -->




    
        <!-- ENTROLLED STUDENTS PER YEAR Chart -->
        <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Enrolled Students Per Year</h2>
                           
                            <ul class="header-dropdown m-r--5">
                              
                            </ul>
                        </div>
                        <div class="body">
                            <div id="enrolled-students-chart" >

                                                            
                                    


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# ENROLLED STUDENTS PER YEAR  Chart -->


        
    
@endsection