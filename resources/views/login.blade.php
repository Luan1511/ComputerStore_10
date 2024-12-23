@extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Login</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!-- Begin Login Content Area -->
    <div class="page-section mb-60 mt-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form -->
                    <form action="{{ route('post-login') }}" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Login</h4>

                            @if (Session::has('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ Session::get('error') }}</strong>
                                </div>
                            @endif


                            <div class="row">
                                <!-- Email input -->
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name="email" placeholder="Email Address"
                                        required>
                                </div>

                                <!-- Password input -->
                                <div class="col-12 mb-20">
                                    <label>Password</label>
                                    <input class="mb-0" type="password" name="password" placeholder="Password" required>
                                </div>

                                <!-- Remember me checkbox -->
                                <div class="col-md-8">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me" name="remember">
                                        <label for="remember_me">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                    <a href="{{ route('forgot_password') }}">Forgotten password?</a>
                                </div>

                                <!-- Login button -->
                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0">Login</button>
                                </div>
                            </div>
                        </div>

                    </form>

                    <!-- Display login error message if exists -->
                    @if (session('no'))
                        <div class="alert alert-danger mt-3">
                            {{ session('no') }}
                        </div>
                    @elseif (session('ok'))
                        <div class="alert alert-success mt-3">
                            {{ session('ok') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
@endsection
