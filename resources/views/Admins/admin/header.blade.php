<div class="header-menu pl-20 pr-20 pt-2">
    <div style="display: flex; align-items: center" class="space-x-cus">
        {{-- Logo --}}
        <div class="title-header bg-white text-center d-flex">
            <a>
                <img src="{{ asset('images/LuNi_logo.png') }}" alt="" height="30px"
                    class="ml-auto mr-auto mt-auto mb-auto">
            </a>
        </div>

        <i onclick="toggleMenu()" id="sidebar-toggle-btn" class="fa-solid fa-bars"
            style="display: none; font-size: 18px"></i>
    </div>

    {{-- Items --}}
    <ul class="d-flex space-x-cus">
        <li>
            <i class="fa-solid fa-bell" style="font-size: 25px; cursor: pointer;" onclick="toggleNotify()"></i>
            <span class="number-alert">{{ \App\Models\Admin\AdminNotification::where('is_read', 0)->count() }}</span>
            <div class="notify-panel">
                @foreach (\App\Models\Admin\AdminNotification::all() as $notification)
                    @if ($notification->type == 'New Order')
                        <div class="notify-item" style="background-color: #a9ebf6"
                            data-noti-id="{{ $notification->id }}" onclick="readNoti()">
                            @if ($notification->is_read == 0)
                                <div class="read-item"></div>
                            @endif
                            <div class="notify-icon">
                                <i class="fa-solid fa-trash" onclick="deleteNoti()"
                                    data-noti-id="{{ $notification->id }}"></i>
                                @if (isset($notification->created_at))
                                    <div class="notify-time">{{ $notification->created_at->diffForHumans() }}</div>
                                @endif
                            </div>
                            <div class="notify-content">
                                <a href="">{{ $notification->content }}</a>
                            </div>
                        </div>
                    @elseif ($notification->type == 'Advertiser banner')
                        <div class="notify-item" style="background-color: rgb(247, 247, 121)"
                            data-noti-id="{{ $notification->id }}">
                            @if ($notification->is_read == 0)
                                <div class="read-item"></div>
                            @endif
                            <div class="notify-icon">
                                <i class="fa-solid fa-trash" data-noti-id="{{ $notification->id }}"></i>
                                @if (isset($notification->created_at))
                                    <div class="notify-time">{{ $notification->created_at->diffForHumans() }}</div>
                                @endif
                            </div>
                            <div class="notify-content">
                                <a href="">{{ $notification->content }}</a>
                            </div>
                        </div>
                    @elseif ($notification->type == 'Error report')
                        <div class="notify-item" style="background-color: rgb(253, 137, 137)"
                            data-noti-id="{{ $notification->id }}">
                            @if ($notification->is_read == 0)
                                <div class="read-item"></div>
                            @endif
                            <div class="notify-icon">
                                <i class="fa-solid fa-trash" data-noti-id="{{ $notification->id }}"></i>
                                @if (isset($notification->created_at))
                                    <div class="notify-time">{{ $notification->created_at->diffForHumans() }}</div>
                                @endif
                            </div>
                            <div class="notify-content">
                                <a href="">{{ $notification->content }}</a>
                            </div>
                        </div>
                    @endif
                @endforeach
                {{-- <div class="notify-btn">
                    <a href="">Xem tất cả</a>
                </div> --}}
            </div>
        </li>

        <li>
            <b style="font-size: 18px">Admin: <i style="color:#0363cd; cursor: pointer;"
                    onclick="profile()">{{ Auth::user()->name }}</i></b>
        </li>

        <li>
            @if (Auth::user()->img != null)
                <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="" height="40px" width="40px"
                    onclick="profile()" style="border-radius: 50%; cursor: pointer;">
            @else
                <i class="fa-solid fa-circle-user" style="font-size: 25px; cursor: pointer;" onclick="profile()"></i>
            @endif
        </li>
    </ul>
</div>

<script>
    $(document).ready(function() {
        $('.notify-item').click(function(e) {
            e.preventDefault();

            var notiID = $(this).data('noti-id');

            $.ajax({
                url: 'notify/read/' + notiID,
                type: 'GET',
                success: function(response) {
                    $('.notify-panel').load(location.href + ' .notify-panel > *');
                },
                error: function(xhr) {
                    console.error('Error fetching notifications:', xhr.responseText);
                }
            });
        });

        $('.fa-trash').click(function(e) {
            e.preventDefault();

            var notiID = $(this).data('noti-id');

            $.ajax({
                url: 'notify/delete/' + notiID,
                type: 'GET',
                success: function(response) {
                    $('.notify-panel').load(location.href + ' .notify-panel > *');
                },
                error: function(xhr) {
                    console.error('Error fetching notifications:', xhr.responseText);
                }
            });
        });
    });

    function toggleNotify() {
        $('.notify-panel').toggleClass('display-notify');
    }

    function profile() {
        window.location.href = 'user/profile';
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if (session('status') === 'Deleted')
            Swal.fire({
                icon: 'success',
                title: 'Deletd!',
                text: 'Deleted',
                timer: 1000,
                showConfirmButton: false
            });
        @elseif (session('status') === 'existed')
            Swal.fire({
                icon: 'info',
                title: 'Already Exists!',
                text: 'Laptop is already in your wishlist.',
                timer: 2000,
                showConfirmButton: false
            });
        @endif
    });
</script>
