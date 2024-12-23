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
        <li class="d-flex">
            <input type="search" id="search-input">
            <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
        </li>

        <li>
            <i class="fa-solid fa-bell"></i>
            <span class="number-alert">{{ \App\Models\Admin\AdminNotification::count() }}</span>
            <div class="notify-panel">
                @foreach (\App\Models\Admin\AdminNotification::all() as $notification)
                    @if ($notification->type == 'New Order')
                        <div class="notify-item" style="background-color: #a9ebf6">
                            @if ($notification->is_read == 0)
                                <div class="read-item"></div>
                            @endif
                            <div class="notify-icon">
                                <i class="fa-solid fa-bell" style="background-color: rgb(55, 102, 231);"></i>
                                <i class="fa-solid fa-trash"></i>
                                @if (isset($notification->created_at))
                                    <div class="notify-time">{{ $notification->created_at->diffForHumans() }}</div>
                                @endif
                            </div>
                            <div class="notify-content">
                                <a href="">{{ $notification->content }}</a>
                            </div>
                        </div>
                    @elseif ($notification->type == 'Advertiser banner')
                        <div class="notify-item" style="background-color: rgb(247, 247, 121)">
                            @if ($notification->is_read == 0)
                                <div class="read-item"></div>
                            @endif
                            <div class="notify-icon">
                                <i class="fa-solid fa-bell" style="background-color: rgb(55, 102, 231);"></i>
                                <i class="fa-solid fa-trash"></i>
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
            @if (Auth::user()->img != null)
                <img src="{{ asset('storage/' . Auth::user()->img) }}" alt="" height="25px" width="25px"
                    style="border-radius: 50%">
            @else
                <i class="fa-solid fa-circle-user" style="font-size: 25px"></i>
            @endif
        </li>
    </ul>
</div>

<script>
    // $(function() {
    //     var availableTags = [
    //         "Hà Nội",
    //         "Hồ Chí Minh",
    //         "Đà Nẵng",
    //         "Cần Thơ"
    //     ];
    //     $("#search-input").autocomplete({
    //         source: availableTags
    //     });
    // });
</script>
