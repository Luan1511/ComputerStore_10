@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="container py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Order Details</h4>
                <div>
                    @if ($order->status == 1)
                        <a class="btn edit-btn me-2">
                            <i class="fas fa-edit me-1"></i> Approve
                        </a>
                        <a class="btn delete-btn">
                            <i class="fas fa-trash me-1"></i> Deny
                        </a>
                    @elseif ($order->status == 2)
                        <div>(Delivering)</div>
                    @elseif ($order->status == 3)
                        <a class="btn delete-btn">
                            <i class="fas fa-trash me-1"></i> Delete
                        </a>
                    @elseif ($order->status == 4)
                        <a class="btn delete-btn">
                            <i class="fas fa-trash me-1"></i> Delete
                        </a>
                    @endif
                </div>
            </div>

            <div class="row">
                <!-- Specifications -->
                <div class="col-md-8">
                    <table class="table table-bordered specs-table">
                        <tbody>
                            <tr>
                                <th>Customer</th>
                                <td>{{ $order->name }}</td>
                            </tr>
                            <tr>
                                <th>Phone</th>
                                <td>{{ $order->phone }}</td>
                            </tr>
                            <tr>
                                <th>Address</td>
                                <td>{{ $order->address }}</td>
                            </tr>
                            <tr>
                                <th>Order date</th>
                                <td>{{ $order->created_at }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                @if ($order->status == 1)
                                    <td>Not approved yet</td>
                                @elseif ($order->status == 2)
                                    <td>Delivering</td>
                                @elseif ($order->status == 3)
                                    <td>Denied</td>
                                @elseif ($order->status == 4)
                                    <td>Delivered</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Detail --}}
            <h4 class="mt-40">Laptops:</h4>
            <table id="laptops-order-table" class="display" style="width: 100%">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Unit price</th>
                        <th>Quantity</th>
                        <th>Total price</th>
                    </tr>
                    @foreach ($order->subOrder as $subOrder)
                        <tr>
                            <td><img src="{{ asset('storage/' . $subOrder->laptop->img) }}" alt=""></td>
                            <td>{{ $subOrder->laptop->name }}</td>
                            <td>${{ $subOrder->laptop->price }}</td>
                            <td>{{ $subOrder->quantity }}</td>
                            <td>${{ $subOrder->total_laptop_price }}</td>
                        </tr>
                    @endforeach
                </thead>
            </table>


        </div>
    </div>
@endsection
