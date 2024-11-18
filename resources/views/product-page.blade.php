@extends('layouts.app')

@section('content')
    @vite(['resources/css/product.css'])
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Contact</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-1 order-lg-2">
                    <!-- Begin Li's Banner Area -->
                    <div class="single-banner shop-page-banner">
                        <a href="#">
                            <img src="{{ asset('images/about-us/about_img.jpg') }}" height="250px" alt="Li's Static Banner"
                                style="border: solid 1px rgb(175, 175, 175)">
                        </a>
                    </div>
                    <!-- Li's Banner Area End Here -->
                    <!-- shop-top-bar start -->
                    <div class="shop-top-bar mt-30">
                        <div class="shop-bar-inner">
                            <div class="toolbar-amount">
                                <span>Showing 1 to 9 of 15</span>
                            </div>
                        </div>
                        <!-- product-select-box start -->
                        <div class="product-select-box">
                            <div class="product-short">
                                <p>Sort By:</p>
                                <select class="nice-select">
                                    <option value="trending">Relevance</option>
                                    <option value="sales">Name (A - Z)</option>
                                    <option value="sales">Name (Z - A)</option>
                                    <option value="rating">Price (Low &gt; High)</option>
                                    <option value="date">Rating (Lowest)</option>
                                    <option value="price-asc">Model (A - Z)</option>
                                    <option value="price-asc">Model (Z - A)</option>
                                </select>
                            </div>
                        </div>
                        <!-- product-select-box end -->
                    </div>
                    <!-- shop-top-bar end -->
                    <!-- shop-products-wrapper start -->
                    <div class="shop-products-wrapper">
                        <div class="tab-content">
                            <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                <div class="product-area shop-product-area">
                                    <div class="row" id="laptop-list">
                                        @include('components.laptop-list-page')
                                    </div>
                                </div>
                            </div>
                            <div class="paginatoin-area">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 pt-xs-15">
                                        <p>Showing 1-12 of 13 item(s)</p>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul class="pagination-box pt-xs-20 pb-xs-15">
                                            <li><a href="#" class="Previous"><i class="fa fa-chevron-left"></i>
                                                    Previous</a>
                                            </li>
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                            <li>
                                                <a href="#" class="Next"> Next <i
                                                        class="fa fa-chevron-right"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- shop-products-wrapper end -->
                </div>
                <div class="col-lg-3 order-2 order-lg-1">
                    <!--sidebar-categores-box start  -->
                    <div class="sidebar-categores-box">
                        <div class="sidebar-title">
                            <h2>Filter By</h2>
                        </div>
                        <!-- btn-clear-all start -->
                        <button class="btn-clear-all mb-sm-30 mb-xs-30" id="reset-search">Clear all</button>
                        <!-- btn-clear-all end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area">
                            <h5 class="filter-sub-titel">Brand</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        @foreach ($brands as $brand)
                                            <li><input id="search-input-brand" type="checkbox" name="product-brand"
                                                    value="{{ $brand->id }}" id="{{ $brand->id . '_brand-filter' }}"><a
                                                    href="#">{{ $brand->name }} </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Price</h5>
                            <div class="categori-checkbox">
                                <form action="#">
                                    <ul>
                                        <li><input id="search-input-price-sort" type="checkbox" name="product-price-sort"
                                                value="decrea">Decreasing</li>
                                        <li><input id="search-input-price-sort" type="checkbox" name="product-price-sort"
                                                value="increa">Increasing</li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Screen size</h5>
                            <div class="categori-checkbox">
                                <form action="#" class="screen_size">
                                    <ul>
                                        <li><input id="search-input-screen_size" type="checkbox" name="screen_size"
                                                id="ss_15-filter" value="15">15</li>
                                        <li><input id="search-input-screen_size" type="checkbox" name="screen_size"
                                                id="ss_156-filter" value="15.6">15.6</li>
                                        <li><input id="search-input-screen_size" type="checkbox" name="screen_size"
                                                id="ss_17-filter" value="17">17</li>
                                        <li><input id="search-input-screen_size" type="checkbox" name="screen_size"
                                                id="ss_18-filter" value="18">18</li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <!-- filter-sub-area start -->
                        <div class="filter-sub-area pt-sm-10 pt-xs-10">
                            <h5 class="filter-sub-titel">Stock</h5>
                            <div class="categori-checkbox">
                                <form action="#" class="stock">
                                    <ul>
                                        <li><input id="search-input-stock" type="checkbox" name="product-stock"
                                                id="in_stock-filter" value="in">in</li>
                                        <li><input id="search-input-stock" type="checkbox" name="product-stock"
                                                id="out_stock-filter" value="out">out</li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                        <!-- filter-sub-area end -->
                        <a class="search-btn" id="search-btn" style="cursor: pointer; ">Search</a>
                    </div>
                    <!--sidebar-categores-box end  -->
                    <!-- category-sub-menu start -->
                    <div class="sidebar-categores-box mb-sm-0 mb-xs-0">
                        <div class="sidebar-title">
                            <h2>Operating system</h2>
                        </div>
                        <div class="category-tags">
                            <ul>
                                <li><a href="#" id="all_brand-filter" href="{{ route('search-page') }}">All</a>
                                </li>
                                <li><a href="# " id="window_9-filter"
                                        href="{{ route('search-page', ['search' => 'windows 9']) }}">windows 9</a></li>
                                <li><a href="# " id="window_10-filter"
                                        href="{{ route('search-page', ['search' => 'windows 10']) }}">windows 10</a></li>
                                <li><a href="# " id="window_11-filter"
                                        href="{{ route('search-page', ['search' => 'windows 11']) }}">windows 11</a></li>
                                <li><a href="# " id="ubuntu-filter"
                                        href="{{ route('search-page', ['search' => 'ubuntu']) }}">Ubuntu</a></li>
                                <li><a href="# " id="masOS-filter"
                                        href="{{ route('search-page', ['search' => 'masOS']) }}">masOS</a></li>
                                <li><a href="# " id="chromeOS-filter"
                                        href="{{ route('search-page', ['search' => 'ChromeOS']) }}">ChromeOS</a></li>
                                <li><a href="# " id="linus-filter"
                                        href="{{ route('search-page', ['search' => 'linus']) }}">linus</a></li>
                            </ul>
                        </div>
                        <!-- category-sub-menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Wraper Area End Here -->

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        // Search click
        $('#search-btn').click(function() {
            const search_brand = [];
            $('input[name="product-brand"]:checked').each(function() {
                search_brand.push($(this).val());
            });

            const search_screen_size = [];
            $('input[name="screen_size"]:checked').each(function() {
                search_screen_size.push($(this).val());
            });

            const search_price_sort = [];
            $('input[name="product-price-sort"]:checked').each(function() {
                search_price_sort.push($(this).val());
            });

            const search_stock = [];
            $('input[name="product-stock"]:checked').each(function() {
                search_stock.push($(this).val());
            });

            searchLaptops(search_brand, search_price_sort, search_screen_size, search_stock);
        });

        // Search 
        function searchLaptops(search_brand, search_price_sort, search_screen_size, search_stock) {
            $.ajax({
                url: '/product-page/search',
                method: 'GET',
                data: {
                    search_brand: search_brand,
                    search_price_sort: search_price_sort,
                    search_screen_size: search_screen_size,
                    search_stock: search_stock,
                },
                success: function(response) {
                    $('#laptop-list').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }

        // Cancel search
        $('#reset-search').click(function() {
            $('input[name="product-brand"], input[name="product-price-sort"], input[name="screen_size"], input[name="product-stock"]').val('');
            $('input:checkbox, input:radio').prop('checked', false);

            searchLaptops(null, null, null, null);
        });
    </script>
@endsection
