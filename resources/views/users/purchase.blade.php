@extends('layouts.user-layout')

@section('content-user')
    <div class="purchase-nav">
        <li class="purchase-nav-item col-3">
            <a class="item-active making-nav" onclick="toggleMaking()"><i class="fa-regular fa-file-lines"></i>Order made</a>
        </li>
        <li class="purchase-nav-item col-3">
            <a class="delivering-nav" onclick="toggleDelivering()"><i class="fa fa-truck" aria-hidden="true"></i>Delivering</a>
        </li>
        <li class="purchase-nav-item col-3">
            <a class="completed-nav" onclick="toggleCompleted()"><i class="fa-solid fa-check-to-slot"></i>Completed</a>
        </li>
        <li class="purchase-nav-item col-3">
            <a class="denied-nav" onclick="toggleDenied()"><i class="fa-solid fa-ban"></i>Denied</a>
        </li>
    </div>

    <div class="purchase-list">
        @include('users.render-purchase')
        {{-- <div class="single-purchase">
            <div class="order-info">
                <b>Information</b>
                <div>Some inform</div>
            </div>
            <hr class="col-11 mr-auto ml-auto mb-0">
            <div class="laptop-list">
                <b>Laptop</b>
                <div class="single-laptop">
                    <img src="{{ asset('storage/images/others/image.png') }}" alt="laptop" height="90px" class="col-3 col-md-2">

                    <div class="laptop-info col-5">
                        <li>Product Name: Asus VivoBook X515</li>
                        <li>Price: $1200</li>
                        <li>Quantity: 1</li>
                    </div>

                    <div class="col-2 col-md-3"></div>

                    <div class="cost-container col-2">
                        <div>1500$</div>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>

    <script>
        function toggleMaking() {
            $(".making-nav").addClass("item-active");
            $(".delivering-nav").removeClass("item-active");
            $(".completed-nav").removeClass("item-active");
            $(".denied-nav").removeClass("item-active");

            $.ajax({
                url: 'purchase/making',
                type: 'GET',
                success: function(response) {
                    $('.purchase-list').html(response);
                },
                error: function(xhr) {
                    console.error('Error fetching messages:', xhr.responseText);
                }
            });
        }

        function toggleDelivering() {
            $(".making-nav").removeClass("item-active");
            $(".delivering-nav").addClass("item-active");
            $(".completed-nav").removeClass("item-active");
            $(".denied-nav").removeClass("item-active");

            $.ajax({
                url: 'purchase/delivering',
                type: 'GET',
                success: function(response) {
                    $('.purchase-list').html(response);
                },
                error: function(xhr) {
                    console.error('Error fetching messages:', xhr.responseText);
                }
            });
        }

        function toggleCompleted() {
            $(".making-nav").removeClass("item-active");
            $(".delivering-nav").removeClass("item-active");
            $(".completed-nav").addClass("item-active");
            $(".denied-nav").removeClass("item-active");

            $.ajax({
                url: 'purchase/completed',
                type: 'GET',
                success: function(response) {
                    $('.purchase-list').html(response);
                },
                error: function(xhr) {
                    console.error('Error fetching messages:', xhr.responseText);
                }
            });
        }

        function toggleDenied() {
            $(".making-nav").removeClass("item-active");
            $(".delivering-nav").removeClass("item-active");
            $(".completed-nav").removeClass("item-active");
            $(".denied-nav").addClass("item-active");

            $.ajax({
                url: 'purchase/denied',
                type: 'GET',
                success: function(response) {
                    $('.purchase-list').html(response);
                },
                error: function(xhr) {
                    console.error('Error fetching messages:', xhr.responseText);
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            $('#purchase-nav').addClass('active-nav-user');
            $('#account-nav').removeClass('active-nav-user');
            $('#voucher-nav').removeClass('active-nav-user');
            $('#support-nav').removeClass('active-nav-user');
        });
    </script>
@endsection
