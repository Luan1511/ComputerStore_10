@extends('Admins.admin.layout-admin')

@section('content')
    <div class="form-container">
        <div class="title-content">Add laptop</div>

        <form action="addHandle" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <select class="form-select" id="brand" name="brand" required>
                        <option value="">Select a brand</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="processor" class="form-label">Processor</label>
                    <select class="form-select" id="processor" name="processor" required>
                        <option value="">Select a processor</option>
                        <option value="Intel Core i3">Intel Core i3</option>
                        <option value="Intel Core i5">Intel Core i5</option>
                        <option value="Intel Core i7">Intel Core i7</option>
                        <option value="AMD Ryzen 5">AMD Ryzen 5</option>
                        <option value="AMD Ryzen 7">AMD Ryzen 7</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="ram" class="form-label">Ram</label>
                    <input type="text" class="form-control" id="ram" name="ram" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="rom" class="form-label">Rom</label>
                    <input type="text" class="form-control" id="rom" name="rom" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="screen_size" class="form-label">Screen Size</label>
                    <input type="text" class="form-control" id="screen_size" name="screen_size" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="graphics_card" class="form-label">Graphics Card</label>
                    <input type="text" class="form-control" id="graphics_card" name="graphics_card" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="battery" class="form-label">Battery</label>
                    <input type="text" class="form-control" id="battery" name="battery" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="os" class="form-label">Operating System</label>
                    <select class="form-select" id="os" name="os" required>
                        <option value="">Select an operating system</option>
                        <option value="Windows 10">Windows 10</option>
                        <option value="Windows 11">Windows 11</option>
                        <option value="macOS">macOS</option>
                        <option value="Ubuntu">Ubuntu</option>
                        <option value="ChromeOS">ChromeOS</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" class="form-control" id="price" name="price" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" id="stock" name="stock" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Main image</label>
                    <input type="file" class="form-control" id="image" name="images[]" style="height: 61px">
                </div>
                <div class="col-md-4 mb-3">
                    <label for="image" class="form-label">Sub images</label>
                    <div class="row">
                        <div class="col-md-4">
                            <input type="file" class="form-control" id="image_1" name="images[]" style="height: 61px; padding: 6px; font-size: 7px">
                        </div>
                        <div class="col-md-4">
                            <input type="file" class="form-control" id="image_2" name="images[]" style="height: 61px; padding: 6px; font-size: 7px">
                        </div>
                        <div class="col-md-4">
                            <input type="file" class="form-control" id="image_3" name="images[]" style="height: 61px; padding: 6px; font-size: 7px">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex" style="justify-content: center;">
                <button type="submit" class="col-5 col-md-3 btn btn-primary w-100 mt-10"
                    style="font-weight: 500; box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.126);">Add Laptop</button>
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
