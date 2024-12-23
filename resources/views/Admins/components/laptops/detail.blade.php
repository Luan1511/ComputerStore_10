@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="container py-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4>Laptop Details</h4>
                <div>
                    <a class="btn edit-btn me-2" href="{{ url('admin/laptop/' . $laptop->id . '/edit') }}">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                    <a class="btn delete-btn" href="{{ url('admin/laptop/' . $laptop->id . '/delete') }}">
                        <i class="fas fa-trash me-1"></i> Delete
                    </a>
                </div>
            </div>

            <div class="row">
                <!-- Main Image -->
                <div class="col-md-4 mb-4">
                    @foreach ($laptop->images as $image)
                        <div class="card">
                            @if ($image->image_url)
                                <img src="{{ asset('storage/' . $image->image_url) }}" alt="Current Image"
                                    style="max-width: 200px; margin: 0 auto; margin-top: 10px;">
                            @else
                                <div>(Image is empty)</div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Specifications -->
                <div class="col-md-8">
                    <table class="table table-bordered specs-table">
                        <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{ $laptop->name }}</td>
                            </tr>
                            <tr>
                                <th>Brand</th>
                                <td>{{ $laptop->brand_name }}</td>
                            </tr>
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
                                <th>Screen Size</th>
                                <td>{{ $laptop->screen_size }}</td>
                            </tr>
                            <tr>
                                <th>Graphics Card</th>
                                <td>{{ $laptop->graphics_card }}</td>
                            </tr>
                            <tr>
                                <th>Battery</th>
                                <td>{{ $laptop->battery }}</td>
                            </tr>
                            <tr>
                                <th>Operating System</th>
                                <td>{{ $laptop->os }}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>$ {{ $laptop->price }}</td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>{{ $laptop->stock }}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{{ $laptop->description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
