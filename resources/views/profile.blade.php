@extends('layouts.user-layout')

@section('content-user')
    <h3 class="mb-4 text-center">MY ACCOUNT</h3>
    <div class="avatar-container">
        <img src="/images/user/admin.jpg" alt="Admin Avatar" class="img-fluid admin-avatar">
        <button type="button" class="btn update-avatar-btn">
            <i class="bi bi-camera"></i> Update image
        </button>
    </div>

    <form id="profile-form" action="" method="POST"
    enctype="multipart/form-data">
        @csrf
        <div class="mb-12 row">
            <div class="col-md-11">
                @if (Auth::check())
                    <input type="text" class="form-control bang" id="name" value="{{ Auth::user()->name }}">
                @else
                    <input type="text" class="form-control bang" id="name" placeholder="Fullname">
                @endif
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-md-11">
                @if (Auth::check())
                    <input type="text" class="form-control bang" id="email" value="{{ Auth::user()->email }}">
                @else
                    <input type="text" class="form-control border-bottom-only" id="email" placeholder="Email">
                @endif
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-md-11">
                <select class="form-select border-bottom-only" id="gender">
                    <option selected>Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Others</option>
                </select>
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-md-11">
                <input type="tel" class="form-control border-bottom-only" id="phone" placeholder="Phone">
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-md-11">
                <input type="text" class="form-control border-bottom-only" id="phone" placeholder="Address">
            </div>
        </div>
        <div class="mb-2 row">
            <div class="col-md-11">
                <input type="date" class="form-control border-bottom-only" id="birthdate">
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background: #90e0ef">Update</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#purchase-nav').removeClass('active-nav-user');
            $('#account-nav').addClass('active-nav-user');
            $('#voucher-nav').removeClass('active-nav-user');
            $('#support-nav').removeClass('active-nav-user');
        });
    </script>
@endsection
