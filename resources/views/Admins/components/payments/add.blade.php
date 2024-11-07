@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Add payment method</div>

        <form action="addPaymentHandle" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
            </div>
            <div class="row d-flex" style="justify-content: center;">
                <button type="submit" class="col-5 col-md-3 btn btn-primary w-100 mt-10"
                    style="font-weight: 500; box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.126);">Add Payment<br>method</button>
            </div>
        </form>
    </div>
@endsection
