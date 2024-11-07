@extends('Admins.admin.layout-admin')

@section('content')
    <div class="form-container">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="title-content">Edit laptop</div>

        <form action="{{ url('admin/laptop/' . $laptop->id . '/edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $laptop->name }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="form-select" id="brand" name="brand">
                        <option value="">Select a brand</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="processor" class="form-label">Processor</label>
                    <select class="form-select" id="processor" name="processor" required>
                        <option value="">Select a processor</option>
                        <option value="Intel Core i3" {{ $laptop->processor == 'Intel Core i3' ? 'selected' : '' }}>Intel
                            Core i3</option>
                        <option value="Intel Core i5" {{ $laptop->processor == 'Intel Core i5' ? 'selected' : '' }}>Intel
                            Core i5</option>
                        <option value="Intel Core i7" {{ $laptop->processor == 'Intel Core i7' ? 'selected' : '' }}>Intel
                            Core i7</option>
                        <option value="AMD Ryzen 5" {{ $laptop->processor == 'AMD Ryzen 5' ? 'selected' : '' }}>AMD Ryzen 5
                        </option>
                        <option value="AMD Ryzen 7" {{ $laptop->processor == 'AMD Ryzen 7' ? 'selected' : '' }}>AMD Ryzen 7
                        </option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="ram" class="form-label">Ram</label>
                    <input type="text" class="form-control" id="ram" name="ram" value="{{ $laptop->ram }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rom" class="form-label">Rom</label>
                    <input type="text" class="form-control" id="rom" name="rom" value="{{ $laptop->rom }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="screen_size" class="form-label">Screen Size</label>
                    <input type="text" class="form-control" id="screen_size" name="screen_size"
                        value="{{ $laptop->screen_size }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="graphics_card" class="form-label">Graphics Card</label>
                    <input type="text" class="form-control" id="graphics_card" name="graphics_card"
                        value="{{ $laptop->graphics_card }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="battery" class="form-label">Battery</label>
                    <input type="text" class="form-control" id="battery" name="battery"
                        value="{{ $laptop->battery }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="os" class="form-label">Operating System</label>
                    <select class="form-select" id="os" name="os" required>
                        <option value="">Select an operating system</option>
                        <option value="Windows 10" {{ $laptop->os == 'Windows 10' ? 'selected' : '' }}>Windows 10</option>
                        <option value="Windows 11" {{ $laptop->os == 'Windows 11' ? 'selected' : '' }}>Windows 11</option>
                        <option value="macOS" {{ $laptop->os == 'macOS' ? 'selected' : '' }}>macOS</option>
                        <option value="Ubuntu" {{ $laptop->os == 'Ubuntu' ? 'selected' : '' }}>Ubuntu</option>
                        <option value="ChromeOS" {{ $laptop->os == 'ChromeOS' ? 'selected' : '' }}>ChromeOS</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $laptop->price }}">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock"
                        value="{{ $laptop->stock }}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $laptop->description }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" style="height: 61px">
                </div>
            </div>
            <div class="row d-flex" style="justify-content: center">
                @if ($laptop->img)
                    <img src="{{ asset('storage/' . $laptop->img) }}" alt="Current Image"
                        style="max-width: 100px; margin-top: 10px;">
                @else
                    <div>(Image is empty)</div>
                @endif
            </div>
            <div class="row d-flex" style="justify-content: center;">
                <button type="submit" class="col-5 col-md-3 btn btn-primary w-100 mt-10"
                    style="font-weight: 500; box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.126);">Update</button>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: '{{ route('admin-getBrand') }}',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.each(data.data, function(index, brand) {
                        $('#brand').append($('<option>', {
                            value: brand.id,
                            text: brand.name
                        }));
                    });
                    $('#brand').val('{{ $laptop->brand_id }}');
                },
                error: function() {}
            });
        });

        // $('#brand').on('change', function() {
        //     var selectedBrandId = $(this).val();
        //     console.log("Selected Brand ID:", selectedBrandId);
        // });
    </script>
@endsection
