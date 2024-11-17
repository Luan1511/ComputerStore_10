@extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Check out</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!--Checkout Area Strat-->
    <div class="checkout-area pt-60 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-accordion">
                        <!--Accordion Start-->
                        {{-- <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                        <div id="checkout-login" class="coupon-content">
                            <div class="coupon-info">
                                <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est
                                    sit amet ipsum luctus.</p>
                                <form action="#">
                                    <p class="form-row-first">
                                        <label>Username or email <span class="required">*</span></label>
                                        <input type="text">
                                    </p>
                                    <p class="form-row-last">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="text">
                                    </p>
                                    <p class="form-row">
                                        <input value="Login" type="submit">
                                        <label>
                                            <input type="checkbox">
                                            Remember me
                                        </label>
                                    </p>
                                    <p class="lost-password"><a href="#">Lost your password?</a></p>
                                </form>
                            </div>
                        </div> --}}
                        <!--Accordion End-->
                        <!--Accordion Start-->
                        {{-- <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                        <div id="checkout_coupon" class="coupon-checkout-content">
                            <div class="coupon-info">
                                <form action="#">
                                    <p class="checkout-coupon">
                                        <input placeholder="Coupon code" type="text">
                                        <input value="Apply Coupon" type="submit">
                                    </p>
                                </form>
                            </div>
                        </div> --}}
                        <!--Accordion End-->
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-12">
                    <form action="#">
                        <div class="checkbox-form">
                            <h3>Billing Details</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Name <span class="required">*</span></label>
                                        <input placeholder="Name" type="text">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="checkout-form-list">
                                        <label>Address <span class="required">*</span></label>
                                        <input placeholder="Your address" type="text">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Email Address <span class="required">*</span></label>
                                        <input placeholder="" type="email" value="{{ Auth::user()->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout-form-list">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="number" value="{{ Auth::user()->phone }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="your-order">
                        <h3>Your order</h3>
                        <div class="your-order-table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="cart-product-name">Product</th>
                                        <th class="cart-product-total">Total</th>
                                    </tr>
                                <tbody>
                                    @foreach ($cart->data as $cartItem)
                                        <tr class="cart_item">
                                            <td class="cart-product-name">{{ $cartItem->name }} <strong
                                                    class="product-quantity"> × {{ $cartItem->quantity }} </strong></td>
                                            <td class="cart-product-total"><span
                                                    class="amount">${{ $cartItem->price * $cartItem->quantity }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                </thead>
                                <tbody>
                                    <tr class="cart_item">
                                        <td class="cart-product-name">Vourcher</td>
                                        <td class="cart-product-total"><span class="amount">$</span><span>0</span></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr class="cart-subtotal">
                                        <th>Cart Subtotal</th>
                                        <td><span class="amount">$</span><span
                                                class="cart-subtotal">{{ $cart->total_price }}</span></td>
                                    </tr>
                                    <tr class="order-total">
                                        <th>Order Total</th>
                                        <td><strong><span
                                                    class="amount">$</span><span>{{ $cart->total_price }}</span></strong>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div id="accordion">
                                    <div style="font-size: 20px; font-weight: 500; margin-bottom: 10px;">Payment method
                                    </div>
                                    @foreach ($payments as $payment)
                                        <div class="card">
                                            <div class="card-header" id="#payment-1">
                                                <h5 class="panel-title d-flex" style="align-items: center">
                                                    <input id="{{$payment->id}}" type="checkbox"
                                                        style="width: 20px; margin-right: 10px">
                                                    <a class="" data-toggle="collapse" data-target="#collapseOne"
                                                        aria-expanded="true" aria-controls="collapseOne">
                                                        {{ $payment->name }}
                                                    </a>
                                                </h5>
                                            </div>
                                            {{-- <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                            <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order
                                                    ID as the payment reference. Your order won’t be shipped until the funds
                                                    have cleared in our account.</p>
                                            </div>
                                        </div> --}}
                                        </div>
                                    @endforeach
                                </div>
                                <div class="order-button-payment">
                                    <input value="Place order" type="button" onclick="placeOrder()">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Checkout Area End-->

    <script>
        // showlogin toggle
        $('#showlogin').on('click', function() {
            $('#checkout-login').slideToggle(900);
        });
        // showlogin toggle
        $('#showcoupon').on('click', function() {
            $('#checkout_coupon').slideToggle(900);
        });
        // showlogin toggle
        $('#cbox').on('click', function() {
            $('#cbox-info').slideToggle(900);
        });

        // showlogin toggle
        $('#ship-box').on('click', function() {
            $('#ship-box-info').slideToggle(1000);
        });

        // Payment Method
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('admin-getPayment') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data.data, function(index, brand) {
                        $('#payment').append($('<option>', {
                            value: brand.id,
                            text: brand.name
                        }));
                    });
                },
                error: function() {}
            });
        });

        // Order
        function placeOrder() {
            const name = document.querySelector('input[placeholder="Name"]').value;
            const address = document.querySelector('input[placeholder="Your address"]').value;
            const email = document.querySelector('input[type="email"]').value;
            const phone = document.querySelector('input[type="number"]').value;

            if (!name || !address || !email || !phone) {
                // alert('Please fill in all required fields');
                alert(name + ' ' + address + ' ' + email + ' ' + phone);
                return;
            }

            const cartData = @json($cart->data);
            const paymentMethod = document.querySelector('input[type="checkbox"]:checked');
            const paymentMethodId = paymentMethod ? paymentMethod.id : null;

            if (!paymentMethodId) {
                alert('Please select a payment method');
                return;
            }

            fetch("{{ url('checkout/place-order') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name,
                        address, 
                        email,
                        phone,
                        cart: cartData,
                        payment_method_id: paymentMethodId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Order placed successfully!');
                        window.location.href = "{{ url('cart') }}/" + {{Auth::user()->id}};
                    } else {
                        alert('Failed to place order');
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
@endsection
