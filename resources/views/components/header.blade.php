<header>
    <!-- Header Top Area Start Here -->
    <div class="header-top">
        <div class="container">

            <div class="row">
                <!-- Begin Header Top Left Area -->
                <div class="col-lg-3 col-md-4">
                    <div class="header-top-left">
                        <ul class="phone-wrap">
                            @auth
                                <li><span style="font-size: 15px;">{{ __('messages.welcome') }} </span><a
                                        href="{{ url('/profile/' . Auth::user()->id) }}"
                                        style="font-weight: 500; font-size: 18px; color: #0363CD">{{ Auth::user()->name }}</a>
                                </li>
                            @else
                                <li><span style="font-size: 15px;">Welcome Guest</span></li>
                            @endauth
                        </ul>
                    </div>
                </div>
                <!-- Header Top Left Area End Here -->
                <!-- Begin Header Top Right Area -->
                <div class="col-lg-9 col-md-8">
                    <div class="header-top-right">
                        <ul class="ht-menu">
                            <!-- Begin Option Area -->
                            <li>
                                <div class="ht-setting-trigger"><span>Option</span></div>
                                <div class="setting ht-setting">
                                    <ul class="ht-setting-list">
                                        @auth
                                            <li><a href="{{ url('/profile/' . Auth::user()->id) }}">My Account</a></li>
                                        @else
                                            <li><a href="{{ route('login-page') }}">Sign In</a></li>
                                            <li><a href="{{ route('register-page') }}">Resgister</a></li>
                                        @endauth
                                        <li><a href="checkout.html">Checkout</a></li>
                                        <li><a href="{{ route('admin-dashboard-page') }}">Admin</a></li>
                                        @auth
                                            <li><a href="{{ route('logout') }}">Logout</a></li>
                                        @endauth
                                    </ul>
                                </div>
                            </li>
                            <!-- Option Area End Here -->
                            <!-- Begin Language Area -->
                            <li>
                                <span class="language-selector-wrapper">Language :</span>
                                <div class="ht-language-trigger"><span>{{ session('locale', 'English') }}</span></div>
                                <div class="language ht-language">
                                    <ul class="ht-setting-list">
                                        <li class="lang_choice_en {{ session('locale') === 'en' ? 'active' : '' }}">
                                            <a href="{{ url('lang/en') }}">
                                                <img src="{{ asset('images/menu/flag-icon/1.jpg') }}" alt="">
                                                English
                                            </a>
                                        </li>
                                        <li class="lang_choice_vi {{ session('locale') === 'vi' ? 'active' : '' }}">
                                            <a href="{{ url('lang/vi') }}">
                                                <img src="{{ asset('images/menu/flag-icon/2.png') }}" alt="">
                                                VietNam
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <!-- Language Area End Here -->
                        </ul>
                    </div>
                </div>
                <!-- Header Top Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Top Area End Here -->

    <!-- Begin Header Middle Area -->
    <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
        <div class="container">
            <div class="row">
                <!-- Begin Header Logo Area -->
                <div class="col-lg-3">
                    <div class="logo pb-sm-30 pb-xs-30">
                        <a href="index.html">
                            <img src="{{ asset('images/LuNi_logo.png') }}" alt="">
                        </a>
                    </div>
                </div>
                <!-- Header Logo Area End Here -->
                <!-- Begin Header Middle Right Area -->
                <div class="header-middle-container col-md-12 col-lg-9 pl-0 ml-sm-15 ml-xs-15 space-x-cus">
                    <!-- Begin Header Middle Searchbox Area -->
                    <form action="#" class="hm-searchbox header-search-box">
                        <select class="nice-select select-search-category">
                            <option value="0">All</option>
                            <option value="10">Laptops</option>
                            <option value="17">- - Prime Video</option>
                            <option value="20">- - - - All Videos</option>
                            <option value="21">- - - - Blouses</option>
                            <option value="12">Smartphone</option>
                            <option value="66">- - Camera Accessories</option>
                            <option value="71">- - - - 7.0 Screen</option>
                            <option value="72">- - - - 9.0 Screen</option>
                            <option value="13">Cameras</option>
                            <option value="14">headphone</option>
                            <option value="15">Smartwatch</option>
                            <option value="16">Accessories</option>
                        </select>
                        <input type="text" id="search-input" placeholder="Enter your search key ..."
                            autocomplete="off">
                        <div id="search-results"></div>
                        <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <!-- Header Middle Searchbox Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="header-middle-right">
                        <ul class="hm-menu">
                            <!-- Begin Header Middle Wishlist Area -->
                            @auth
                                <li class="hm-wishlist">
                                    <a href="{{ url('wishlist/' . Auth::user()->id) }}">
                                        <span
                                            class="cart-item-count wishlist-item-count">{{ Auth::user()->wishlist->count() }}</span>
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </li>
                            @endauth
                            <!-- Header Middle Wishlist Area End Here -->
                            <!-- Begin Header Mini Cart Area -->
                            <li class="hm-minicart">
                                <div class="hm-minicart-trigger">
                                    <span class="item-icon"></span>
                                    @auth
                                        @php
                                            $cartItems = Auth::user()->cart;
                                            $totalPrice = $cartItems->sum(function ($item) {
                                                return $item->quantity * $item->laptop->price;
                                            });
                                            $itemCount = $cartItems->count();
                                        @endphp
                                        <span class="item-text">${{ number_format($totalPrice, 2) }}
                                            <span class="cart-item-count">{{ $itemCount }}</span>
                                        </span>
                                    @else
                                        <span class="item-text">$0
                                            <span class="cart-item-count">0</span>
                                        </span>
                                    @endauth
                                </div>
                                <span></span>
                                <div class="minicart">
                                    <p class="minicart-total">SUBTOTAL:
                                        @auth
                                            <span>
                                                ${{ number_format($totalPrice, 2) }}
                                            </span>
                                        @else
                                            <span>
                                                $0
                                            </span>
                                        @endauth
                                    </p>
                                    <div class="minicart-button">

                                        @auth
                                            <a href="{{ route('cart-page') }}"
                                                class="li-button li-button-fullwidth li-button-dark">
                                                <span>View Full Cart</span>
                                            </a>
                                        @else
                                            <a onclick="showLoginAlert()"
                                                class="li-button li-button-fullwidth li-button-dark text-light">
                                                <span>View Full Cart</span>
                                            </a>
                                        @endauth

                                    </div>
                                </div>
                            </li>
                            <!-- Header Mini Cart Area End Here -->
                        </ul>
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
                <!-- Header Middle Right Area End Here -->
            </div>
        </div>
    </div>
    <!-- Header Middle Area End Here -->
    <!-- Begin Header Bottom Area -->
    <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Begin Header Bottom Menu Area -->
                    <div class="hb-menu">
                        <nav>
                            <ul>
                                <li><a href="{{ route('home-page') }}">Home</a></li>
                                <li class="megamenu-holder"><a href="">Shop</a></li>
                                <li class="megamenu-static-holder"><a href="">Pages</a>
                                    <ul class="megamenu hb-megamenu">
                                        <li><a href="blog-left-sidebar.html">Blog Layouts</a>
                                            <ul>
                                                <li><a href="blog-2-column.html">Blog 2 Column</a></li>
                                                <li><a href="blog-3-column.html">Blog 3 Column</a></li>
                                                <li><a href="blog-left-sidebar.html">Grid Left Sidebar</a></li>
                                                <li><a href="blog-right-sidebar.html">Grid Right Sidebar</a></li>
                                                <li><a href="blog-list.html">Blog List</a></li>
                                                <li><a href="blog-list-left-sidebar.html">List Left Sidebar</a></li>
                                                <li><a href="blog-list-right-sidebar.html">List Right Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog-details-left-sidebar.html">Blog Details Pages</a>
                                            <ul>
                                                <li><a href="blog-details-left-sidebar.html">Left Sidebar</a></li>
                                                <li><a href="blog-details-right-sidebar.html">Right Sidebar</a></li>
                                                <li><a href="blog-audio-format.html">Blog Audio Format</a></li>
                                                <li><a href="blog-video-format.html">Blog Video Format</a></li>
                                                <li><a href="blog-gallery-format.html">Blog Gallery Format</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="index.html">Other Pages</a>
                                            <ul>
                                                <li><a href={{ route('register-page') }}>Checkout</a></li>
                                                <li><a href="compare.html">Compare</a></li>
                                                <li><a href="wishlist.html">Wishlist</a></li>
                                                <li><a href="shopping-cart.html">Shopping Cart</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="index.html">Other Pages 2</a>
                                            <ul>
                                                <li><a href="contact.html">Contact</a></li>
                                                <li><a href="{{ route('about-page') }}">About Us</a></li>
                                                <li><a href="faq.html">FAQ</a></li>
                                                <li><a href="404.html">404 Error</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('about-page') }}">About Us</a></li>
                                <li><a href="{{ route('contact-page') }}">Contact</a></li>
                                {{-- <li><a href="shop-left-sidebar.html">Accessories</a></li> --}}
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Bottom Menu Area End Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- Header Bottom Area End Here -->
    <!-- Begin Mobile Menu Area -->
    <div class="mobile-menu-area d-lg-none d-xl-none col-12">
        <div class="container">
            <div class="row">
                <div class="mobile-menu">
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu Area End Here -->
</header>

<script>
    // meanmenu
    jQuery('.hb-menu nav').meanmenu({
        meanMenuContainer: '.mobile-menu',
        meanScreenWidth: "991"
    })

    // header dropdown
    $('.ht-setting-trigger, .ht-currency-trigger, .ht-language-trigger, .hm-minicart-trigger, .cw-sub-menu').on('click',
        function(e) {
            e.preventDefault();
            $(this).toggleClass('is-active');
            $(this).siblings('.ht-setting, .ht-currency, .ht-language, .minicart, .cw-sub-menu li').slideToggle();
        });
    $('.ht-setting-trigger.is-active').siblings('.catmenu-body').slideDown();

    // li's Sticky Menu Activation
    $(window).on('scroll', function() {
        if ($(this).scrollTop() > 300) {
            $('.header-sticky').addClass("sticky");
        } else {
            $('.header-sticky').removeClass("sticky");
        }
    });

    // Nice select
    $(document).ready(function() {
        $('.nice-select').niceSelect();
    });

    // Login
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

    // Logout
    function showLogoutAlert() {
        Swal.fire({
            icon: 'info ',
            title: 'Logout successfully',
            text: 'Redirect to Home',
            confirmButtonText: 'OK',
            showCancelButton: false,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('logout') }}";
            }
        });
    }

    // Search
    $('#search-input').on('keyup', function() {
        var query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "{{ route('search') }}",
                method: 'GET',
                data: {
                    search: query
                },
                success: function(response) {
                    var results = '';
                    if (response.length > 0) {
                        $.each(response, function(index, item) {
                            results += '<div class="search-item">' + item.name + '</div>';
                        });
                    } else {
                        results = '<div class="search-item">No results found</div>';
                    }
                    $('#search-results').html(results).show();
                }
            });
        } else {
            $('#search-results').html('');
        }
    });

    // Search out
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#search-wrapper').length) {
            $('#search-results').hide();
        }
    });

    // Choose result
    $(document).on('click', '.search-item', function() {
        $('#search-input').val($(this).text());
        $('#search-results').hide();
        window.location.href = "{{ url('laptop/search') }}/" + $(this).text();
    });
</script>
<style>
    #search-input {
        position: relative;
    }

    #search-results {
        border: 1px solid #ddd;
        max-height: 200px;
        overflow-y: auto;
        margin-top: 5px;
        background-color: #fff;
        position: absolute;
        top: 92%;
        border-radius: 5px;
        z-index: 999;
        width: 100%;
        padding: 2px;
        display: none
    }

    .search-item {
        padding: 8px;
        cursor: pointer;
    }

    .search-item:hover {
        background-color: #90e0ef;
    }
</style>
