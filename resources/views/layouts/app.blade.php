<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/LuNi_icon.png')}}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/app.js') }}"></script>
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
    <script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/6e70409343.js" crossorigin="anonymous"></script>
</head>

<body>
    {{-- Include Header --}}
    @include('components.header')

    {{-- Main Content --}}
    @yield('content')

    {{-- Footer --}}
    @include('components.footer')

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> --}}
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script>
        $.scrollUp({
            scrollText: '<i class="fa fa-angle-double-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900
        });
    </script>
</body>

</html>
