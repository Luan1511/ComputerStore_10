@extends('layouts.app')

@section('content')

    <head>
        <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    </head>

    {{-- Banner --}}
    @include('components.banner')

    {{-- List product --}}
    @include('components.list-product')

    {{-- List product --}}
    <div class="product-area pt-20 pb-50">
        <div class="container">
            <h4 class="tab-pane active show">With famous brands</h4>
            <div class="brand-list row mt-40">
                @foreach ($brands as $brand)
                    <div class="brand-head">
                        <a href="{{ route('search-filter', ['search' => $brand->name]) }}">
                            <img src="{{ asset('storage/' . $brand->image) }}" alt="" height="100px"
                                style="width: 100%">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Chatbox --}}
        <i class="fa fa-comments" id="chatbox-btn" aria-hidden="true"></i>
        <div class="parent-chatbox">
            <div class="chatbox-container">
                <div class="messages">
                    @include('chattings.receive', ['message' => 'Hi, can I help u?'])
                </div>

                <div class="bottom-fld">
                    <form id="form-chat">
                        <input type="text" id="message" name="message" placeholder="Enter message..."
                            autocomplete="off">
                        @auth
                            @if (auth()->user()->authority == 1)
                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            @else
                                <button type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                            @endif
                        @endauth
                        {{-- <i class="fa fa-paper-plane" aria-hidden="true"></i> --}}
                    </form>
                </div>
            </div>
        </div>
        @auth
            @if (auth()->user()->authority == 1)
                <div class="tab-users">
                    @foreach ($users as $user)
                        <div class="user-item d-flex" data-user-id="{{ $user->id }}">
                            <img src="{{ asset('storage/' . $user->img) }}" style="margin: 3px" alt="" height="20px"
                                width="20px">
                            {{ $user->name }}
                        </div>
                    @endforeach
                </div>
            @endif
        @endauth

        <div id="ad-banner" class="banner hidden">
            <div class="banner-content">
                <img id="banner-image" src="image1.jpg" alt="Ad" />
                <button id="close-banner">×</button>
            </div>
        </div>
    </div>

    <script>
        $(".slider-active").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            autoplay: true,
            items: 1,
            autoplayTimeout: 10000,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: true,
            autoHeight: true,
            lazyLoad: true
        });

        // Chat processing
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'ap1'
        });
        const channel = pusher.subscribe('public');
        console.log('Pusher connection state: ', pusher.connection.state);

        //Receive messages
        channel.bind('chat', function(data) {
            console.log('Message received:', data.message);
            var userId = $('.user-item.user-active').data('user-id');
            $.post("/chatting/receive", {
                    _token: '{{ csrf_token() }}',
                    message: data.message,
                    user_id: userId,
                })
                .done(function(res) {
                    $(".messages > .message").last().after(res);
                    $('.chatbox-container').scrollTop($('.chatbox-container').prop('scrollHeight'));
                });
        });

        //Broadcast messages
        $("#form-chat").submit(function(event) {
            event.preventDefault();

            console.log('Message sent:', $("#form-chat #message").val());
            var userId = $('.user-item.user-active').data('user-id');
            $.ajax({
                url: "/chatting/broadcast",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    message: $("#form-chat #message").val(),
                    user_id: userId,
                }
            }).done(function(res) {
                $(".messages > .message").last().after(res);
                $("#form-chat #message").val('');
                $('.chatbox-container').scrollTop($('.chatbox-container').prop('scrollHeight'));
            });
        });

        $(document).ready(function() {
            $('#chatbox-btn').click(function(e) {
                e.preventDefault();
                console.log('chat click')

                $.ajax({
                    url: 'chatting/messages',
                    type: 'GET',
                    // dataType: 'json', 
                    success: function(response) {
                        $('.messages').html(response);
                        $('.chatbox-container').scrollTop($('.chatbox-container').prop(
                            'scrollHeight'));
                    },
                    error: function(xhr) {
                        console.error('Error fetching messages:', xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('.user-item').removeClass('user-active');
            $('.user-item').click(function(e) {
                e.preventDefault();

                $('.user-item').removeClass('user-active');
                $(this).addClass('user-active');

                var userId = $(this).data('user-id');
                $.ajax({
                    url: 'chatting/messages/' + userId,
                    type: 'GET',
                    // dataType: 'json', 
                    success: function(response) {
                        $('.messages').html(response);
                        $('.chatbox-container').scrollTop($('.chatbox-container').prop(
                            'scrollHeight'));
                    },
                    error: function(xhr) {
                        console.error('Error fetching messages:', xhr.responseText);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#chatbox-btn').click(function() {
                $('.parent-chatbox').toggleClass('display-chatbox');
                $('.tab-users').toggleClass('display-tab-users');
            });

            //         Swal.fire({
            //             title: 'Welcome!',
            //             text: 'This is a notification with an image and a link.',
            //             imageUrl: 'https://img.freepik.com/free-vector/merry-christmas-wallpaper-design_79603-2129.jpg',
            //             imageWidth: 350,
            //             imageHeight: 300,
            //             html: `
        //     <p>Click <a href="https://example.com" target="_blank" style="color: blue; text-decoration: underline;">here</a> to visit the page.</p>
        // `,
            //             showConfirmButton: true,
            //             confirmButtonText: 'Close'
            //         });
        });

        function showLoginAlert() {
            Swal.fire({
                icon: 'warning',
                title: 'You must login',
                text: 'Please login to open the cart',
                confirmButtonText: 'Login',
                showCancelButton: true,
                cancelButtonText: 'Later',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('login-page') }}";
                }
            });
        }

        // Ads banners
        document.addEventListener("DOMContentLoaded", function() {
            const banner = document.getElementById("ad-banner");
            const closeBannerButton = document.getElementById("close-banner");

            const showBanner = () => {
                banner.classList.remove("hidden");
            };

            const hideBanner = () => {
                banner.classList.add("hidden");
            };

            showBanner();

            closeBannerButton.addEventListener("click", hideBanner);

            setInterval(showBanner, 5 * 60 * 1000);
        });

        document.addEventListener("DOMContentLoaded", function() {
            const banner = document.getElementById("ad-banner");
            const closeBannerButton = document.getElementById("close-banner");
            const bannerImage = document.getElementById("banner-image");

            const images = @json($adsBanners);

            let currentImageIndex = 0;

            const showBanner = () => {
                banner.classList.remove("hidden");
            };

            const hideBanner = () => {
                banner.classList.add("hidden");
            };

            const switchImage = () => {
                currentImageIndex = (currentImageIndex + 1) % images.length;
                bannerImage.src = 'storage/' + images[currentImageIndex];
            };
            showBanner();

            setInterval(switchImage, 3000);

            closeBannerButton.addEventListener("click", hideBanner);

            setInterval(showBanner, 3 * 60 * 1000);
        });
    </script>
@endsection
