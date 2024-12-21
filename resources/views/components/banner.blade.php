<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Slider Area -->
            <div class="col-lg-8 col-md-8">
                <div class="slider-area">
                    <div class="slider-active owl-carousel">
                        @if (isset($leftBanners))
                            @foreach ($leftBanners as $leftBanner)
                                <!-- Begin Single Slide Area -->
                                <div class="single-slide align-center-left animation-style-01 bg-1"
                                    style="background-image: url({{ asset('storage/' . $leftBanner->image) }}) !important">
                                    <div class="slider-progress"></div>
                                </div>
                                <!-- Single Slide Area End Here -->
                            @endforeach
                        @else
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left  animation-style-01 bg-1">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                    <h2>Chamcham Galaxy S9 | S9+</h2>
                                    <h3>Starting at <span>$1209.00</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-02 bg-2">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Sale Offer <span>Black Friday</span> This Week</h5>
                                    <h2>Work Desk Surface Studio 2018</h2>
                                    <h3>Starting at <span>$824.00</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-01 bg-3">
                                <div class="slider-progress"></div>
                                <div class="slider-content">
                                    <h5>Sale Offer <span>-10% Off</span> This Week</h5>
                                    <h2>Phantom 4 Pro+ Obsidian</h2>
                                    <h3>Starting at <span>$1849.00</span></h3>
                                    <div class="default-btn slide-btn">
                                        <a class="links" href="shop-left-sidebar.html">Shopping Now</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Slide Area End Here -->
                        @endif
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
            <!-- Begin Li Banner Area -->
            <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                <div class="li-banner">
                    <a href="#">
                        <img src="{{ asset('storage/' . $topBanner->image) }}" alt="">
                    </a>
                </div>
                <div class="li-banner mt-15 mt-sm-30 mt-xs-30">
                    <a href="#">
                        <img src="{{ asset('storage/' . $bottomBanner->image) }}" alt="">
                    </a>
                </div>
            </div>
            <!-- Li Banner Area End Here -->
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
</script>
