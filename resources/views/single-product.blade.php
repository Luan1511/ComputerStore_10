@extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Single product</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            @foreach ($laptop->images_url as $image)
                                <div class="lg-image">
                                    <a class="popup-img venobox vbox-item" href="{{ asset('storage/' . $image) }}"
                                        data-gall="myGallery">
                                        <img src="{{ asset('storage/' . $image) }}" alt="product image">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">
                            @foreach ($laptop->images_url as $image)
                                <div class="sm-image"><img src="{{ asset('storage/' . $image) }}" alt="product image thumb">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h2>{{ $laptop->name }}</h2>
                            <span class="product-details-ref">Brand: {{ $laptop->brand->name }}</span>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $laptop->rating)
                                            <li><i class="fa fa-star"></i></li>
                                        @else
                                            <li class="no-star"><i class="fa fa-star"></i></li>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                            <div class="price-box pt-20">
                                <span class="new-price new-price-2">${{ $laptop->price }}</span>
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span class="li-blog-blockquote">
                                        <blockquote>
                                            {{ $laptop->description }}
                                        </blockquote>
                                    </span>
                                </p>
                            </div>
                            <div class="single-add-to-cart">
                                <form action="#" class="cart-quantity">
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="cart-plus-minus">
                                            <input class="cart-plus-minus-box" value="1" type="text">
                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                        </div>
                                    </div>
                                    <a class="add-to-cart" onclick="addToCart()">Add to cart</a>
                                </form>
                            </div>
                            <div class="product-additional-info pt-25">
                                <a class="wishlist-btn wishlist-detail single-action-btn" href="{{ url('wishlist/' . $laptop->id . '/add') }}"><i
                                        class="fa fa-heart-o"></i>Add to
                                    wishlist</a>
                                <a class="wishlist-btn wishlist-detail single-action-btn" style="cursor: pointer"
                                    onclick="displayComparePanel()"><i class="fa fa-compress"
                                        aria-hidden="true"></i>Compare</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" onclick="displayDetail()"><span>Product
                                        Details</span></a>
                            </li>
                            <li><a data-toggle="tab" onclick="displayReview()"><span>Reviews</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="detail-laptop" class="tab-pane active show" role="tabpanel">
                    <div class="product-description" style="overflow: auto">
                        <table class="detail-laptop-table cart-table" style="width: 100%">
                            <tbody>
                                <tr>
                                    <th>Processor</th>
                                    <td>{{ $laptop->processor }}</td>
                                </tr>
                                <tr>
                                    <th>RAM</th>
                                    <td>{{ $laptop->ram }}</td>
                                </tr>
                                <tr>
                                    <th>ROM</th>
                                    <td>{{ $laptop->rom }}</td>
                                </tr>
                                <tr>
                                    <th>Screen size</th>
                                    <td>{{ $laptop->screen_size }}</td>
                                </tr>
                                <tr>
                                    <th>Graphics card</th>
                                    <td>{{ $laptop->graphics_card }}</td>
                                </tr>
                                <tr>
                                    <th>Battery</th>
                                    <td>{{ $laptop->battery }}</td>
                                </tr>
                                <tr>
                                    <th>Operation system</th>
                                    <td>{{ $laptop->os }}</td>
                                </tr>
                                <tr>
                                    <th>Stock</th>
                                    <td>{{ $laptop->stock }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="review-laptop" class="tab-pane" role="tabpanel">
                    @php
                        $ratingCount = [];
                        for ($i = 1; $i <= 5; $i++) {
                            $ratingCount[$i] = $laptop->comment()->where('rating', $i)->count();
                        }
                    @endphp
                    <div class="component_rating" style="margin-bottom: 20px">
                        <div class="componet_rating_content"
                            style="display: flex;align-items: center;border-radius: 5px;border:1px solid #dedede ">
                            <div class="rating_item" style="width: 20%; position: relative;">
                                <span class="fa fa-star"
                                    style="font-size: 100px;display: block;color: #ff9705; margin: 0 auto; text-align: center;">
                                </span><b
                                    style="position: absolute; top: 40%; left: 45%; transform: translateX(-50) translateY(-50);color: white; font-size: 20px">{{ $laptop->rating }}</b>
                            </div>
                            <input type="hidden" id="rating-val">
                            <div class="list_rating" style="width: 60%; padding: 20px">
                                @for ($i = 1; $i <= 5; $i++)
                                    @php
                                        if ($laptop->comment()->count() != 0) {
                                            $percent = ($ratingCount[$i] * 100) / $laptop->comment()->count();
                                        } else {
                                            $percent = 0;
                                        }
                                    @endphp
                                    <div class="item_rating" style="display: flex; align-items: center">

                                        <div style="width: 10%; font-size: 14px ">
                                            {{ $i }}<span class="fa fa-star"></span>
                                        </div>
                                        <div style="width: 70%; margin: 0 20px">
                                            <span
                                                style="width: 100%;height: 8px;display: block;border: 1px solid #dedede;border-radius:5px; background-color: #dedede ">
                                                <b
                                                    style="width: {{ $percent }}%; background-color:#f25800; display: block;border-radius:5px; height: 100%;"></b>
                                            </span>
                                        </div style="width: 20%">
                                        <div>
                                            <a href="">{{ $ratingCount[$i] }} comments</a>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                            <div style="width: 20%">
                                @if (Auth::user()->comment()->where('laptop_id', $laptop->id)->count() < 1 &&
                                        Auth::user()->license()->where('laptop_id', $laptop->id)->count() === 1)
                                    <a href="#" class="js_rating_action"
                                        style="width: 200px; background: #288ad6;padding: 10px;color: white; border-radius: 5px">Create
                                        your
                                        review</a>
                                @elseif (Auth::user()->comment()->where('laptop_id', $laptop->id)->count() > 0)
                                    <a href="#" class="js_rating_action"
                                        style="width: 200px; background: #288ad6;padding: 10px;color: white; border-radius: 5px; opacity: 70% !important; pointer-events: none !important; cursor: not-allowed;">You
                                        already commented</a>
                                @elseif (Auth::user()->license()->where('laptop_id', $laptop->id)->count() < 1)
                                    <a href="#" class="js_rating_action"
                                        style="width: 200px; background: #288ad6;padding: 10px;color: white; border-radius: 5px; opacity: 70% !important; pointer-events: none !important; cursor: not-allowed;">You
                                        have to buy first</a>
                                @endif
                            </div>
                        </div>
                        <?php
                        $listRatingText = [
                            1 => 'Very Bad',
                            2 => 'Bad',
                            3 => 'Okay',
                            4 => 'Good',
                            5 => 'Excellent',
                        ];
                        ?>

                        <div class="form_rating hide">
                            <div style="display: flex; margin-top: 15px; font-size: 15px">
                                <p style="margin-bottom:0 ">Choose your review</p>
                                <span style="margin: 0 15px" class="list_start">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star" data-key="{{ $i }}"></i>
                                    @endfor
                                </span>
                                <span class="list_text"></span>
                            </div>
                            <div style="margin-top: 15px">
                                <textarea name="" class="form-control" id="content-review" cols="30" rows="3"></textarea>
                            </div>

                            <div style="margin-top: 15px">
                                <a class="js_rating_product"
                                    style="width: 200px; background: #288ad6;padding: 10px ;color: white; border-radius: 5px;">Submit
                                    your
                                    review</a>
                            </div>
                        </div>

                        <div class="list-review">
                            @include('components.render-comment-laptop')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>Other laptop in the same brand:</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach ($laptops as $laptopB)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap laptop_relative">
                                        <div class="product-image">
                                            <a href="single-product.html">
                                                <img src="{{ asset('storage/' . $laptopB->img) }}"
                                                    alt="Li's Product Image">
                                            </a>
                                            <span class="sticker">New</span>
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    <h5 class="manufacturer">
                                                        <a href="product-details.html">{{ $laptopB->brand->name }}</a>
                                                    </h5>
                                                    <div class="rating-box">
                                                        <ul class="rating">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $laptopB->rating)
                                                                    <li><i class="fa fa-star"></i></li>
                                                                @else
                                                                    <li class="no-star"><i class="fa fa-star"></i></li>
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h4><a class="product_name"
                                                        href="single-product.html">{{ $laptopB->name }}</a></h4>
                                                <div class="price-box">
                                                    <span class="new-price">${{ $laptopB->price }}</span>
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    <li class="add-cart active"><a
                                                            href="{{ url('cart/' . $laptopB->id . '/addSingle') }}">Add to
                                                            cart</a></li>
                                                    <li><a href="#" title="quick view" class="quick-view-btn"
                                                            data-toggle="modal" data-target="#exampleModalCenter"><i
                                                                class="fa fa-eye"></i></a></li>
                                                    <li><a class="links-details"
                                                            href="{{ url('wishlist/' . $laptopB->id . '/add') }}"><i
                                                                class="fa fa-heart-o"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>

        {{-- Compare --}}
        <div class="compare-panel">
            <a><i class="fa fa-times-circle" aria-hidden="true" onclick="displayComparePanel()"></i></a>
            <div class="laptop-list-container row" id="laptop-list-compare">
                @include('components.render-laptop')
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->

    @if (session('status'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('status') === 'added')
                    Swal.fire({
                        icon: 'success',
                        title: 'Added!',
                        text: 'Laptop has been added to your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @elseif (session('status') === 'existed')
                    Swal.fire({
                        icon: 'info',
                        title: 'Already Exists!',
                        text: 'Laptop is already in your wishlist.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @elseif (session('status') === 'addedCart')
                    Swal.fire({
                        icon: 'success',
                        title: 'Added!',
                        text: 'Laptop has been added to your cart.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @elseif (session('status') === 'plused')
                    Swal.fire({
                        icon: 'success',
                        title: 'Plus!',
                        text: 'Laptop has been plused to your Laptop quantity.',
                        timer: 2000,
                        showConfirmButton: false
                    });
                @endif
            });
        </script>
    @endif

    <script>
        $('.product-details-images').each(function() {
            var $this = $(this);
            var $thumb = $this.siblings('.product-details-thumbs, .tab-style-left');
            $this.slick({
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                dots: false,
                infinite: true,
                centerMode: false,
                centerPadding: 0,
                asNavFor: $thumb,
            });
        });
        $('.product-details-thumbs').each(function() {
            var $this = $(this);
            var $details = $this.siblings('.product-details-images');
            $this.slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                dots: false,
                infinite: true,
                focusOnSelect: true,
                centerMode: true,
                centerPadding: 0,
                prevArrow: '<span class="slick-prev"><i class="fa fa-angle-left"></i></span>',
                nextArrow: '<span class="slick-next"><i class="fa fa-angle-right"></i></span>',
                asNavFor: $details,
            });
        });
        $('.tab-style-left, .tab-style-right').each(function() {
            var $this = $(this);
            var $details = $this.siblings('.product-details-images');
            $this.slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 5000,
                dots: false,
                infinite: true,
                focusOnSelect: true,
                vertical: true,
                centerPadding: 0,
                prevArrow: '<span class="slick-prev"><i class="fa fa-angle-down"></i></span>',
                nextArrow: '<span class="slick-next"><i class="fa fa-angle-up"></i></span>',
                asNavFor: $details,
            });
        });

        // cart
        $(".cart-plus-minus").append(
            '<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div><div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>'
        );
        $(".qtybutton").on("click", function() {
            var $button = $(this);
            var oldValue = $button.parent().find("input").val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                if (oldValue > 1) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 1;
                }
            }
            $button.parent().find("input").val(newVal);
        });

        // Add to cart
        function addToCart() {
            var $laptopId = {{ $laptop->id }};
            var $quantity = $(".cart-plus-minus-box").val();
            window.location.href = "{{ url('cart/add') }}/" + $laptopId + "/" + parseInt($quantity);
        }

        // Display compare panel
        function displayComparePanel() {
            $('.compare-panel').toggleClass('display-compare');
            fetchLaptop();
        }

        // List compare
        function fetchLaptop() {
            $.ajax({
                url: 'fetch/compare/' + {{ $laptop->id }},
                method: 'GET',
                success: function(response) {
                    $('#laptop-list-compare').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }

        // Choose compare
        $(document).on('click', '#choose-laptop-btn', function() {
            var laptop_chosen = $(this).data('chosen-laptop-id');

            window.location.href = 'compare/' + {{ $laptop->id }} + '/' + laptop_chosen;

        });

        function displayReview() {
            $("#review-laptop").addClass('active');
            $("#detail-laptop").removeClass('active');

            $.ajax({
                url: {{ $laptop->id }} + 'comment/fetch',
                type: 'GET',
                success: function(response) {
                    $('.list-review').html(response);
                },
                error: function(xhr) {
                    console.error('Error fetching messages:', xhr.responseText);
                }
            });
        }

        function displayDetail() {
            $("#review-laptop").removeClass('active');
            $("#detail-laptop").addClass('active');
        }

        $(function() {
            let listStart = $(".list_start .fa");
            $listRatingText = {
                1: 'Very Bad',
                2: 'Bad',
                3: 'Okay',
                4: 'Good',
                5: 'Excellent',
            }
            listStart.mouseover(function() {
                let $this = $(this);
                let number = $this.attr('data-key');
                listStart.removeClass('rating_active');

                $(".number_rating").val(number);
                $.each(listStart, function(key, value) {
                    if (key + 1 <= number) {
                        $(this).addClass('rating_active')
                    }
                });

                $(".list_text").text('').text($listRatingText[$this.attr('data-key')]).show();
                $("#rating-val").val($this.attr('data-key'));
                console.log($this.attr('data-key'))
            });

            $(".js_rating_action").click(function(event) {
                event.preventDefault();
                console.log("click star");
                if ($(".form_rating").hasClass('hide')) {
                    $(".form_rating").addClass('active').removeClass('hide')
                } else {
                    $(".form_rating").addClass('hide').removeClass('active')
                }
            })

            $(".js_rating_product").click(function(e) {
                event.preventDefault();
                let content = document.querySelector('#content-review').value;
                let rating = parseInt($("#rating-val").val());

                console.log(content, $("#rating-val").val());

                try {
                    fetch("{{ url('comment/post') }}", {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                laptop_id: {{ $laptop->id }},
                                content,
                                rating
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    title: "Success!",
                                    text: data.message,
                                    icon: "success",
                                    button: "OK"
                                });
                                location.reload();
                            } else {
                                alert('Failed to post comment');
                            }
                        })
                } catch (SyntaxError) {

                }
            });
        });
    </script>
@endsection
