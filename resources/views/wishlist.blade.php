@extends('layouts.app')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Wish list</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <!--Wishlist Area start-->
    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <div class="text-dark">*Click id to see detail</div>
            <table id="wishlist-table" class="display">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- End wishlist --}}

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#wishlist-table').DataTable({
                autoWidth: false,
                processing: true,
                serverSide: false,
                ajax: '{{ route('getWishlist') }}',
                columns: [{
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="detail-btn" href="' + '{{ url('wishlist') }}' +
                                '/' + data + '/detail">' + data + '</a>';
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
                            return '<div>$' + data + '</div>';
                        }
                    },
                    {
                        data: 'stock'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="delete-btn" onclick="return confirm(\'Are you sure?\')" href="' +
                                '{{ url('admin/account') }}' + '/' + data + '/delete">Delete</a>';
                        }


                    }
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                    $('.dataTables_info').hide();
                    $('label').hide();
                }
            });
        });
    </script>
@endsection
