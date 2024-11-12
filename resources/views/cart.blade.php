@extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <table id="cart-table" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
            </table>


            <div class="row">
                <div class="col-12">
                    <form action="#">
                        {{-- <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value=""
                                            placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        {{-- <li>Subtotal <span>$130.00</span></li> --}}
                                        <li>Total <span>$130.00</span></li>
                                    </ul>
                                    <a href="#">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Shopping Cart Area End-->

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#cart-table').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route('getCart') }}',
                    type: 'GET',
                    error: function(xhr, status, error) {
                        if (xhr.status === 500) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Unidentified Error',
                                text: 'You are not authorized to access this website',
                                confirmButtonText: 'Return to home',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('home-page') }}";
                                }
                            });
                        } else if (xhr.status === 401) {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Unauthorized',
                                text: 'You are not authorized to access this website',
                                confirmButtonText: 'Return to home',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('home-page') }}";
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Có lỗi xảy ra: ' + (xhr.responseJSON?.message ||
                                    'Không xác định'),
                                confirmButtonText: 'Return to home',
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = "{{ route('home-page') }}";
                                }
                            });
                        }
                    }
                },
                columns: [{
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="detail-btn" href="' + '{{ url('laptop') }}' + '/' +
                                data + '">' + data + '</a>';
                        }
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'img',
                        render: function(data, type, row) {
                            if (data && data.trim() !== '') {
                                return '<img src="{{ asset('') }}' + 'storage/' + data +
                                    '" alt="account image" width="100" height="100">';
                            } else {
                                return '<div>(Empty)</div>';
                            }
                        }
                    },
                    {
                        data: 'price',
                        render: function(data, type, row) {
                            return '<span>$</span><span class="unit_price">' + parseFloat(data)
                                .toFixed(2) + '</span>';
                        }
                    },
                    {
                        data: '2',
                        render: function(data, type, row) {
                            return '<div class="cart-plus-minus">' +
                                '<input class="cart-plus-minus-box" value="' + 2 +
                                '" type="text">' +
                                '<div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>' +
                                '<div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>' +
                                '</div>';
                        }
                    },
                    {
                        data: 'price',
                        render: function(data, type, row) {
                            var quantity= row.quantity ? row.quantity : 2;
                            var totalPrice = (quantity * parseFloat(data)).toFixed(2);
                            return '<span style="font-size: 16px !important">$</span><span class="total_price">' +
                                totalPrice + '</span>';
                        }
                    }
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                    $('label').hide();
                    initPlusMinus();
                },
                drawCallback: function() {
                    initPlusMinus();
                }
            });

            function initPlusMinus() {
                $(".qtybutton").off('click').on("click", function() {
                    var $button = $(this);
                    var $row = $button.closest('tr'); // Lấy hàng hiện tại
                    var oldValue = $row.find(".cart-plus-minus-box").val();

                    // Tăng hoặc giảm giá trị
                    var newVal = $button.hasClass('inc') ? parseInt(oldValue) + 1 : Math.max(0, parseInt(
                        oldValue) - 1);
                    $row.find(".cart-plus-minus-box").val(newVal);

                    // Lấy giá trị `unit_price` cho hàng hiện tại
                    var unitPriceText = $row.find(".unit_price").text();
                    var unitPrice = parseFloat(unitPriceText);

                    // Tính lại `total_price` cho hàng hiện tại
                    var totalAfter = newVal * unitPrice;
                    $row.find(".total_price").text(totalAfter.toFixed(2));
                });
            }
        });
    </script>
@endsection
