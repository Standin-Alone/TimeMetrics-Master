
<!DOCTYPE html>
<html>
   
<?php echo
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: text/html');?>     
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Time Metrics | Sign In</title>
    <!-- Favicon-->
    <link rel="icon" href="QCU-LOGO.png" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href=" {{asset('material.css')}}" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href=" {{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href=" {{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href=" {{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Sweetalert Css -->
    <link href="{{asset('plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
    <!-- Custom Css -->
    <link href=" {{asset('css/style.css')}}" rel="stylesheet">
</head>

<body class="login-page" style="background-color: #03a9f4">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Time<b>Metrics</b></a>
            <small>Quezon City University</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="login-form" >
                    <div class="msg"></div>
                    <div class="input-group form-float">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" id="username-txt" placeholder="Username" required autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" id="password-txt"  placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" id="login-btn">SIGN IN</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        
                        {{-- <div class="col-xs-6 align-right">
                            <a href="forgot-password.html">Forgot Password?</a>
                        </div> --}}
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap Core Js -->
    <script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

    <!-- Waves Effect Plugin Js -->
    <script src=" {{asset('plugins/node-waves/waves.js')}}"></script>

    <!-- Validation Plugin Js -->
    <script src=" {{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>
    <!-- SweetAlert Plugin Js -->
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
    <!-- Waves  Js -->
    <script src="{{asset('plugins/node-waves/waves.js')}}"></script>
    <!-- Custom Js -->
    <script src=" {{asset('js/admin.js')}}"></script>
    <script src=" {{asset('js/pages/examples/sign-in.js')}}"></script>
    

    <script>       
        $(document).ready(function(){

            $("#login-btn").click((e)=>{
                e.preventDefault();
                username = $("#username-txt").val();
                password = $("#password-txt").val();
                token = '{{csrf_token()}}';
                if(username != '' && password != '' )
                {
                    $.ajax({
                        url:'Sign_In',
                        type:'post',
                        data:{'username':username,'password':password,'_token':token},
                        success:function(data){
                            if(data == 'A')
                            {   
                                location.href="{{route('Users')}}";
                                
                            }
                            else if(data == 'R')
                            {

                                location.href="{{route('Dashboard')}}";


                                // location.href="";

                                location.href="{{route('Dashboard')}}";

                            }
                            else if(data == 'F')
                            {
                                location.href="";
                            } 
                            else if(data == 'S')
                            {

                                location.href="{{route('Registration')}}";

                                location.href="";

                            }
                            else
                            {
                                swal('Incorrect Username or Password!','','error');
                            }  

                        },
                        error:function(){
                            swal('There is something wrong','','error');
                        }
                    });     
                }    
                
            });

        });        
    </script>
</body>
</html>