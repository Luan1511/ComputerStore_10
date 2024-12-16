@extends('layouts.app')

@section('content')
    <header>
        @vite(['resources/css/user.css'])
    </header>

    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1"></div>

            <!-- Sidebar menu -->
            <div class="col-md-2">
                <div class="list-group shadow-sm rounded-3 p-2 sidebar-menu">
                    <a href="{{ url('user/purchase') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-card-list"></i> Purchase History
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Your account
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Your vouchers
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-telephone"></i> Support
                        {{-- <span class="badge bg-danger text-white">NEW</span> --}}
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-box-arrow-right"></i> Log out of account
                    </a>
                </div>
                <div class="member-pointer">
                    <span>Your point: </span>
                    @php
                        if (isset(Auth::user()->point->point)) {
                            echo '<a onclick="displayVoucherPanel()" style="color: #0363cd">' .
                                Auth::user()->point->point .
                                '</a>';
                        } else {
                            echo '<iframe src="' . route('error.point') . '" style="display:none"></iframe>';
                            header('Refresh:0');
                            exit();
                        }
                    @endphp
                </div>
            </div>

            <div class="col-md-8">
                <div class="rounded-3 p-4 content-container">
                    @yield('content-user')
                </div>
            </div>

            <div class="col-md-1"></div>
        </div>
    </div>

    {{-- Voucher --}}
    <div class="voucher-panel">
        <a><i class="fa fa-times-circle" aria-hidden="true" onclick="displayVoucherPanel()"></i></a>
        <div class="voucher-container row" id="voucher">
            <li class="voucher-item">
                <img src="{{ asset('storage/images/vouchers/5.png') }}" alt="voucher1" class="voucher-img">
                <div class="">
                    <h5>Voucher 1</h5>
                    <p>Get 5% off your next purchase</p>
                </div>
                @if (Auth::user()->point->point >= 500)
                    <a href="{{ url('user/voucher/create/5') }}" class="brand-btn pl-20 pr-20">500</a>
                @else
                    <a class="brand-btn disable-btn pl-20 pr-20">500</a>
                @endif
            </li>
            <li class="voucher-item">
                <img src="{{ asset('storage/images/vouchers/7.png') }}" alt="voucher1" class="voucher-img">
                <div class="">
                    <h5>Voucher 1</h5>
                    <p>Get 7% off your next purchase</p>
                </div>
                @if (Auth::user()->point->point >= 700)
                    <a href="" class="brand-btn pl-20 pr-20">700</a>
                @else
                    <a class="brand-btn disable-btn pl-20 pr-20">700</a>
                @endif
            </li>
            <li class="voucher-item">
                <img src="{{ asset('storage/images/vouchers/10.png') }}" alt="voucher1" class="voucher-img">
                <div class="">
                    <h5>Voucher 1</h5>
                    <p>Get 10% off your next purchase</p>
                </div>
                @if (Auth::user()->point->point >= 1000)
                    <a onclick="testSwal()" class="brand-btn pl-20 pr-20">1000</a>
                @else
                    <a class="brand-btn disable-btn pl-20 pr-20">1000</a>
                @endif
            </li>
        </div>
    </div>
    @include('components.response-voucher')

    <script>
        function displayVoucherPanel() {
            $('.voucher-panel').toggleClass('display-voucher');
            // fetchLaptop();
        }

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('status') === 'Created Successfully')
                Swal.fire({
                    title: "Success!",
                    text: "Code: " + @json(session('code')),
                    icon: "success",
                    buttons: true,
                    confirmButtonText: "Copy the code",
                }).then(() => {
                    let textToCopy = @json(session('code'));
                    navigator.clipboard.writeText(textToCopy).then(() => {
                        Swal.fire("Success!", "The code was copied!", "success");
                    });
                });
            @endif
        });
    </script>
@endsection
