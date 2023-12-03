<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/ico" href="{{asset('assets')}}/dist/img/owl-logo.svg">
    <title>{{ env('APP_NAME') }} | Login</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('assets')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('assets')}}/dist/css/adminlte.min.css">
    <style>
        .card-dark-moon.card-outline {
            border-top: 3px solid #1B3750;
        }

        .btn-dark-moon {
            background: #141E30;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #5f7792, #141E30);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #546880, #141E30); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            color: #fff;
            border: 3px solid #eee;
            border-radius: 6px;
        }

        .btn-dark-moon:hover,:focus{
            color: #F15B2B;
        }

        .icheck-primary > input:first-child:not(:checked):not(:disabled):hover + label::before,
        .icheck-primary > input:first-child:not(:checked):not(:disabled):hover + input[type="hidden"] + label::before {
            border-color: #F15B2B;
        }

        .icheck-primary > input:first-child:not(:checked):not(:disabled):focus + label::before,
        .icheck-primary > input:first-child:not(:checked):not(:disabled):focus + input[type="hidden"] + label::before {
            border-color: #F15B2B;
        }

        .icheck-primary > input:first-child:checked + label::before,
        .icheck-primary > input:first-child:checked + input[type="hidden"] + label::before {
            background-color: #141E30;
            border-color: #141E30;
        }
        
        .form-control:focus{
            border: 1px solid #F15B2B;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-dark-moon card-outline">
            <div class="card-header text-center">
                <a href="#" class="h1">
                    <img src="{{asset('assets')}}/dist/img/main-logo.svg" alt="Logo" height="40" width="60"> Clubspectre
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Coaching Management System</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required autocomplete="current-password">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-dark-moon btn-block">LogIn</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-dark-moon">
                        <i class="fas fa-question"></i> I forgot my password
                    </a>
                    {{-- <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a> --}}
                </div>
                <!-- /.social-auth-links -->

                {{-- <p class="mb-1">
                    <a href="forgot-password.html">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p> --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{asset('assets')}}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('assets')}}/dist/js/adminlte.min.js"></script>
</body>

</html>
