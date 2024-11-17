@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-1"></div>

            <!-- Sidebar menu -->
            <div class="col-md-2">
                <div class="list-group shadow-sm rounded-3 p-2">
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-card-list"></i> Purchase History
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Your account
                    </a>

                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-telephone"></i> Support
                        <span class="badge bg-danger text-white">NEW</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <i class="bi bi-box-arrow-right"></i> Log out of account
                    </a>
                </div>
            </div>

            <div class="col-md-6">
                <div class="shadow-sm rounded-3 p-4">
                    <h3 class="mb-4 text-center">MY ACCOUNT</h3>
                    <div class="avatar-container">
                        <img src="/images/user/admin.jpg" alt="Admin Avatar" class="img-fluid admin-avatar">
                        <button type="button" class="btn update-avatar-btn">
                            <i class="bi bi-camera"></i> Update image
                        </button>
                    </div>

                    <form>
                        <div class="mb-12 row">
                            <div class="col-md-11">
                                @if (Auth::check())
                                    <input type="text" class="form-control bang" id="name"
                                        value="{{ Auth::user()->name }}">
                                @else
                                    <input type="text" class="form-control bang" id="name" placeholder="Fullname">
                                @endif
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-11">
                                @if (Auth::check())
                                    <input type="text" class="form-control bang" id="email"
                                        value="{{ Auth::user()->email }}">
                                @else
                                    <input type="text" class="form-control border-bottom-only" id="email"
                                        placeholder="Email">
                                @endif
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-11">
                                <select class="form-select border-bottom-only" id="gender">
                                    <option selected>Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Others</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-11">
                                <input type="tel" class="form-control border-bottom-only" id="phone"
                                    placeholder="Phone">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-11">
                                <input type="text" class="form-control border-bottom-only" id="phone"
                                    placeholder="Address">
                            </div>
                        </div>
                        <div class="mb-2 row">
                            <div class="col-md-11">
                                <input type="date" class="form-control border-bottom-only" id="birthdate">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" style="background: #90e0ef">Update</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css?v=1.0">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    .form-control {
        border: none !important;
        border-bottom: 1px solid #dee2e6 !important;
        border-radius: 0 !important;
        box-shadow: none !important;
    }

    .avatar-container {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 200px;
    }

    .admin-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #dee2e6;
        /* Viền mỏng quanh ảnh */
    }

    .update-avatar-btn {
        margin-top: 8px;
        font-size: 12px;
        padding: 5px 10px;
        background-color: #e9d790;
        color: white;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        transition: background-color 0.3s ease;
    }

    .update-avatar-btn i {
        margin-right: 5px;
        /* Khoảng cách giữa icon và chữ */
        font-size: 14px;
        /* Kích thước icon */
    }

    .update-avatar-btn:hover {
        background-color: #efecdd;
        /* Màu khi rê chuột */
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
