@extends('main.base')

@section('page-css')
    
@endsection

@section('page-js')
    





<script>

    $(function(){
        $('.main-table').DataTable({
          responsive: true,
          serverSide: true,        
          ajax:"{{ route('LoadResidents') }}",
        });
    })
    

    


</script>

@endsection



@section('content')

<div class="container-fluid">
        <div class="block-header">

            <h2>User Management</h2>
        </div>
    </div>

    <!-- Main Content Start-->

            <h2></h2>
        </div>
    </div>

    <!-- Vertical Layout | With Floating Label -->

    <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>

                            User Management
                            <small>Configurations for users account.</small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            
                        </ul>
                    </div>
                    <div class="body">
                            <div class="table-responsive">
                                    <table class="table main-table " >
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                        </thead>                                      
                                        <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            {{-- <div class="form-group form-float">
=======
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
                            VERTICAL LAYOUT
                            <small>With floating label</small>
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
                            <div class="form-group form-float">
<<<<<<< HEAD
=======
>>>>>>> 03b6515c4f5c1b99eb168916b2f66930f41af0c9
>>>>>>> 62d32b97c740eda1d51811800251cb80418504d5
                                <div class="form-line">
                                    <input type="text" id="email_address" class="form-control">
                                    <label class="form-label">Email Address</label>
                                </div>
                            </div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="password" id="password" class="form-control">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>

                            <input type="checkbox" id="remember_me_2" class="filled-in">
                            <label for="remember_me_2">Remember Me</label>
                            <br>

                            <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
                        </form>

                            <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button> --}}            

                            <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <!-- Vertical Layout | With Floating Label -->
    
@endsection

        <!-- Main Content End -->
    
@endsection

=======
        <!-- Vertical Layout | With Floating Label -->
    
@endsection
