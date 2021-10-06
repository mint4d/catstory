@extends('layouts.frontend.app')

@section('title', 'Login')

    @push('css')

        <!--Bootsrap 4 CDN-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link href="{{ asset('assets/frontend/css/auth/styles.css') }}" rel="stylesheet">



        <!--Fontawesome CDN-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
            integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">


        <!--Custom styles-->
        <link rel="stylesheet" type="text/css" href="styles.css">
        <link href="{{ asset('assets/frontend/css/auth/responsive.css') }}" rel="stylesheet">

        <style>
            html,
            body {
                background-image: url('https://images.unsplash.com/photo-1560114928-40f1f1eb26a0?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=1080&fit=max');
                background-size: cover;
                background-repeat: no-repeat;
                height: 100%;
                font-family: 'Numans', sans-serif;
            }

            .container {
                height: 100%;
                align-content: center;
            }

            .card {
                height: 370px;
                margin-top: auto;
                margin-bottom: auto;
                width: 400px;
                background-color: rgba(185, 185, 185, 0.5) !important;
            }

            .social_icon span {
                font-size: 60px;
                margin-left: 10px;
                color: #FFC312;
            }

            .btn {
                background-color: #ffd900c5;
                color: rgb(255, 255, 255);
                width: 100px;
                margin-right: 10px;

            }

            .social_icon span:hover {
                color: white;
                cursor: pointer;
            }

            .card-header h3 {
                color: white;
            }

            .social_icon {
                position: absolute;
                right: 20px;
                top: -45px;
            }

            .input-group-prepend span {
                width: 100px;
                background-color: #FFC312;
                color: black;
                border: 0 !important;
            }

            input:focus {
                outline: 0 0 0 0 !important;
                box-shadow: 0 0 0 0 !important;

            }

            .remember {
                color: white;
            }

            .remember input {
                width: 20px;
                height: 20px;
                margin-left: 15px;
                margin-right: 5px;
            }

            .login_btn {
                color: black;
                background-color: #3995eb;
                width: 100px;
            }

            .login_btn:hover {
                color: black;
                background-color: white;
            }

            .links {
                color: #e6e6ee;
            }

            .links a {
                margin-left: 4px;
               
            }
          

        </style>
    @endpush

@section('content')

    <div class="slider display-table center-text">
        <h1 class="title display-table-cell"><b>LOGIN</b></h1>
    </div><!-- slider -->

    <body>
        <div class="container">
            <div class="container">
                <div class="d-flex justify-content-center ">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sign In</h3>

                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="input-group-text"><i class="fas fa-user"></i></label>

                                        <div class="col-md-10">
                                            <input id="email" type="email" placeholder="E-mail Address"
                                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                name="email" value="{{ old('email') }}" required autofocus>

                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="input-group-text"><i class="fas fa-key"></i></label>

                                        <div class="col-md-10">
                                            <input id="password" type="password" placeholder="password"
                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                name="password" required>

                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-12 ">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    {{ __('Remember Me') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-3 offset-md-7">
                                            <button type="submit" class="btn">
                                                {{ __('Login') }}
                                            </button>
                                        </div>
                                    </div>
                            </div>

                            <div class="col-md-12 ">

                                <div class="card-footer">
                                    <div class="d-flex justify-content-center links">
                                        Don't have an account?<a href="{{ route('register') }}">Sign Up</a>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('password.request') }}">Forgot your password?</a>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    </form>
                </div><!-- post-wrapper -->
            </div><!-- col-sm-8 col-sm-offset-2 -->
        </div><!-- row -->

        </div><!-- container -->
    </body><!-- section -->


@endsection

@push('js')

@endpush
