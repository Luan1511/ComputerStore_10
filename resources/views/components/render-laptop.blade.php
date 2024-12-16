@foreach ($laptops as $laptop)
    <div class="col-lg-2 col-md-3 col-sm-4 mt-40 laptop-item">
        <!-- single-product-wrap start -->
        <div class="single-product-wrap">
            <div class="product-image">
                <a href="{{ url('laptop/' . $laptop->id) }}">
                    <img src="{{ asset('storage/' . $laptop->img) }}" alt="Li's Product Image">
                </a>
                <span class="sticker">New</span>
            </div>
            <div class="product_desc">
                <div class="product_desc_info">
                    <div class="product-review">
                        <h5 class="manufacturer">
                            <a>{{ $laptop->brand_name }}</a>
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
                    <h4><a class="product_name" href="{{ url('laptop/' . $laptop->id) }}">{{ $laptop->name }}
                        </a></h4>
                    <div class="price-box">
                        <span class="new-price">${{ $laptop->price }} </span>
                    </div>
                </div>
                <div class="add-actions">
                    <ul class="add-actions-link">
                        <li class="add-cart active"><a id="choose-laptop-btn" data-chosen-laptop-id="{{ $laptop->id }}"
                                style="cursor: pointer;">Choose</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- single-product-wrap end -->
    </div>
@endforeach
