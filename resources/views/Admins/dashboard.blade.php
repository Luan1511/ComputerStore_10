@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Dashboard</div>
        <div class="">
            <div class="row" style="justify-content: center">
                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(99, 205, 99);">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(67, 197, 150);">
                        <div>
                            <div style="color: rgb(67, 197, 150)">Annual revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(0, 149, 255);">
                        <div>
                            <div style="color: rgb(0, 149, 255);">Customer</div>
                            <h4>{{ $userCount}}</h4>
                        </div>
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                {{-- <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div> --}}
            </div>

            <div class="row" style="justify-content: center">
                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(227, 163, 36);">
                        <div>
                            <div style="color: rgb(227, 163, 36);">Laptop</div>
                            <h4>{{$laptopCount}}</h4>
                        </div>
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(0, 149, 255);">
                        <div>
                            <div style="color: rgb(0, 149, 255);">Brand</div>
                            <h4>{{$brandCount}}</h4>
                        </div>
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(54, 222, 255);">
                        <div>
                            <div style="color: rgb(54, 222, 255);">Orders</div>
                            <h4>0</h4>
                        </div>
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div>

                {{-- <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
