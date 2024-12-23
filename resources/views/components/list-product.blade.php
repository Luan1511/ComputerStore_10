<div class="product-area pt-60 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a id="new_arrival-tab" class="active" data-toggle="tab" href="#li-new-product"
                                onclick="toggleTabLaptop()"><span>New Arrival</span></a></li>
                        <li><a id="best_seller-tab" data-toggle="tab" href="#li-bestseller-product"
                                onclick="toggleTabLaptop()"><span>Bestseller</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($newLaptops as $laptop)
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="{{ url('laptop/' . $laptop->id) }}"
                                            style="height: 180px !important; display: flex; align-items: center">
                                            <img src="{{ asset('storage/' . $laptop->img) }}" alt="Current Image"
                                                style="height: auto; margin: 0 auto; margin-top: 10px;">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a
                                                        href="shop-left-sidebar.html">{{ $laptop->brand->name ?? 'No Brand' }}</a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        @if ($laptop->rating >= 1)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 0 && $laptop->rating < 1)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 2)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 1 && $laptop->rating < 2)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 3)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 2 && $laptop->rating < 3)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 4)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 3 && $laptop->rating < 4)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating == 5)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 4 && $laptop->rating < 5)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a class="product_name"
                                                    href="single-product.html">{{ $laptop->name }}</a>
                                            </h4>
                                            <div class="price-box">
                                                <span class="new-price">${{ $laptop->price }}</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a
                                                        href="{{ url('cart/' . $laptop->id . '/addSingle') }}">Add to
                                                        cart</a></li>
                                                <li><a class="links-details"
                                                        href="{{ url('wishlist/' . $laptop->id . '/add') }}"><i
                                                            class="fa fa-heart-o"></i></a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn"
                                                        data-toggle="modal" data-target="#exampleModalCenter"><i
                                                            class="fa fa-eye"></i></a></li>
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
            <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                <div class="row">
                    <div class="product-active owl-carousel">
                        @foreach ($bestSellerLaptops as $laptop)
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="{{ url('laptop/' . $laptop->id) }}"
                                            style="height: 180px !important; display: flex; align-items: center">
                                            <img src="{{ asset('storage/' . $laptop->img) }}" alt="Current Image"
                                                style="height: auto; margin: 0 auto; margin-top: 10px;">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a
                                                        href="shop-left-sidebar.html">{{ $laptop->brand->name ?? 'No Brand' }}</a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        @if ($laptop->rating >= 1)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 0 && $laptop->rating < 1)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 2)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 1 && $laptop->rating < 2)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 3)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 2 && $laptop->rating < 3)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating >= 4)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 3 && $laptop->rating < 4)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif

                                                        @if ($laptop->rating == 5)
                                                            <li><i class="fa fa-star"></i></li>
                                                        @elseif ($laptop->rating >= 4 && $laptop->rating < 5)
                                                            <li><i class="fa fa-star-half-o"></i></li>
                                                        @endif
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a class="product_name"
                                                    href="single-product.html">{{ $laptop->name }}</a>
                                            </h4>
                                            <div class="price-box">
                                                <span class="new-price">${{ $laptop->price }}</span>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                <li class="add-cart active"><a
                                                        href="{{ url('cart/' . $laptop->id . '/addSingle') }}">Add to
                                                        cart</a></li>
                                                <li><a class="links-details"
                                                        href="{{ url('wishlist/' . $laptop->id . '/add') }}"><i
                                                            class="fa fa-heart-o"></i></a></li>
                                                <li><a href="#" title="quick view" class="quick-view-btn"
                                                        data-toggle="modal" data-target="#exampleModalCenter"><i
                                                            class="fa fa-eye"></i></a></li>
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
        </div>
    </div>
</div>
<!-- Product Area End Here -->

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
            @elseif (session('status') === 'Out stock')
                Swal.fire({
                    icon: 'warning',
                    title: 'Out of stock!',
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>
@endif

<script>
    $(".product-active").owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        autoplay: false,
        autoplayTimeout: 5000,
        navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
        item: 5,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 2
            },
            768: {
                items: 3
            },
            992: {
                items: 4
            },
            1200: {
                items: 5
            }
        }
    });
    // Li's Product Activision
    $(".special-product-active").owlCarousel({
        loop: true,
        nav: false,
        dots: false,
        autoplay: false,
        autoplayTimeout: 5000,
        navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-left"></i>'],
        item: 4,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 4
            }
        }
    });

    // Toggle tab laptops
    function toggleTabLaptop() {
        $("#li-new-product").toggleClass("active show");
        $("#li-bestseller-product").toggleClass("active show");

        $("#new_arrival-tab").toggleClass("active");
        $("#best_seller-tab").toggleClass("active");
    }

</script>
