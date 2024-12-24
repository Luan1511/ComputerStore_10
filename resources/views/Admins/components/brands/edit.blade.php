@extends('Admins.admin.layout-admin')

@section('content')
    <div class="form-container mb-20">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="title-content">Edit brand</div>

        <form action="{{ url('admin/brand/' . $brand->id . '/edit') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $brand->name }}" style="height: 45px;">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image" style="height: 45px;">
                </div>
            </div>
            <div class="row mt-20 mb-20" style="justify-content: center">
                <img src="{{asset('storage/' . $brand->image)}}" alt="" height="100px">
            </div>
            <div class="row d-flex" style="justify-content: center;">
                <button type="submit" class="col-5 col-md-3 btn btn-primary w-100 mt-10"
                    style="font-weight: 500; box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.126);">Update</button>
            </div>
        </form>
    </div>
@endsection
