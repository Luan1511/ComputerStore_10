@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="container py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Laptop Details</h4>
                <div>
                    <a class="btn edit-btn me-2">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <a class="btn delete-btn">
                        <i class="fas fa-trash me-1"></i> Delete
                    </a> 
                </div>
            </div>

            <div class="row">
                <!-- Main Image -->
                <div class="col-md-4 mb-4">
                    <div class="card ">
                        @if ($laptop->img)
                            <img src="{{ asset('storage/' . $laptop->img) }}" alt="Current Image"
                                style="max-width: 100px; margin: 0 auto; margin-top: 10px;">
                        @else
                            <div>(Image is empty)</div>
                        @endif
                    </div>
                </div>

                <!-- Specifications -->
                <div class="col-md-8">
                    <table class="table table-bordered specs-table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>{{$laptop->name}}</td>
                            </tr>
                            <tr>
                                <td>Brand</td>
                                <td>{{$laptop->brand_name}}</td>
                            </tr>
                            <tr>
                                <td>Processor</td>
                                <td>{{$laptop->processor}}</td>
                            </tr>
                            <tr>
                                <td>RAM</td>
                                <td>{{$laptop->ram}}</td>
                            </tr>
                            <tr>
                                <td>ROM</td>
                                <td>{{$laptop->rom}}</td>
                            </tr>
                            <tr>
                                <td>Screen Size</td>
                                <td>{{$laptop->screen_size}}</td>
                            </tr>
                            <tr>
                                <td>Graphics Card</td>
                                <td>{{$laptop->graphics_card}}</td>
                            </tr>
                            <tr>
                                <td>Battery</td>
                                <td>{{$laptop->battery}}</td>
                            </tr>
                            <tr>
                                <td>Operating System</td>
                                <td>{{$laptop->os}}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>$ {{$laptop->price}}</td>
                            </tr>
                            <tr>
                                <td>Stock</td>
                                <td>{{$laptop->stock}}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{$laptop->description}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
