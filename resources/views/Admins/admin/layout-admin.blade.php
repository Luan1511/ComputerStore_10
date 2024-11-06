<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/LuNi_icon.png')}}">
    @vite(['resources/css/app.css'])
    @vite(['resources/css/admin.css'])
    <script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('js/jquery.meanmenu.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/scrollUp.min.js') }}"></script>
    <script src="{{ asset('js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6e70409343.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body style="width: 100vw;">
    {{-- Header --}}
    @include('Admins.admin.header')

    <div class="body-container">
        {{-- Menu side --}}
        @include('Admins.admin.side-menu')

        {{-- Content --}}
        <div class="content-container">
            @yield('content')
        </div>
    </div>


    <script>
        // Toggle sidebar
        function toggleMenu() {
        const menu = document.getElementById("sidebar-menu");
        const menu_btn = document.getElementById("sidebar-toggle-btn");

        if (menu.style.display === "none" || menu.style.display === "") {
            menu.style.display = "block"; 
            menu_btn.style.display = "none";
        } else {
            menu.style.display = "none"; 
            menu_btn.style.display = "block";
        } 
    }
    </script>
</body>

</html>
