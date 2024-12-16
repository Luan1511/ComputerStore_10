 @extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Register</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!-- Begin Login Content Area -->
    <div class="page-section mt-60 mb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" method="POST">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">Forgotpassword</h4>
                            <div class="row">
                                <div class="col-md-12 mb-20">
                                    <label>Email Address*</label>
                                    <input class="mb-0" type="email" name ="email" placeholder="Email Address">
                                </div>

                                <div class="col-12">
                                    <button class="register-button mt-0" type="submit">Send email</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->
    @if (Session::has('ok'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('ok') }}",
                icon: "success"
            });
        </script>
    @endif

    @if (Session::has('no'))
        <script>
            Swal.fire({
                title: "Notification",
                text: "{{ Session::get('no') }}",
                icon: "error"
            });
        </script>
    @endif
@endsection
