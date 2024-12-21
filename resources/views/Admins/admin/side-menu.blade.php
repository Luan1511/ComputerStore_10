<div class="sidebar" id="sidebar-menu" style="display: block;">
    <ul class="container">
        {{-- Menu item --}}
        <li class="menu-item pt-40 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{route('admin-dashboard-page')}}">
                <i class="fa-solid fa-chart-line mr-4"></i><span class="label-item">Dashboard</span>
            </a>
        </li>

        {{-- Account --}}
        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showAccount')}}">
                <i class="fa-solid fa-users mr-4"></i><span class="label-item">Accounts</span>
            </a>
        </li>

        {{-- Brands --}}
        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showBrand')}}">
                <i class="fa-solid fa-list mr-4"></i><span class="label-item">Brands</span>
            </a>
        </li>

        {{-- Laptops --}}
        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showLaptop')}}">
                <i class="fa-solid fa-laptop mr-4"></i><span class="label-item">Laptops</span>
            </a>
        </li>

        {{-- Orders --}}
        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showOrder')}}">
                <i class="fa-solid fa-box-open mr-4"></i><span class="label-item">Orders</span>
            </a>
        </li>

        {{-- Payments --}}
        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showPayment')}}">
                <i class="fa-regular fa-credit-card mr-4"></i><span class="label-item">Payments</span>
            </a>
        </li>

        <li class="menu-item pt-20 pb-20 ml-auto mr-auto mt-auto mb-auto">
            <a href="{{ route('admin-showBanner')}}">
                <i class="fa-solid fa-screwdriver-wrench mr-4"></i><span class="label-item">Banners</span>
            </a>
        </li>
    </ul>

    <div class="text-center mt-40">
        <a href="{{ route('home-page') }}" class="text-center ml-auto mr-auto"
            style="width: 100%; font-size: 30px; background-color: rgba(255, 255, 255, 0.472); border-radius: 100%; padding: 15px; color: black">
            <i class="fa-solid fa-house"></i>
        </a>
        <div class="mt-30"></div>
        <a class="text-center ml-auto mr-auto" onclick="toggleMenu()"
            style="width: 100%; font-size: 30px; background-color: rgba(255, 255, 255, 0.472); border-radius: 50%; padding: 15px; color: black">
            <i class="fa-solid fa-circle-left"></i>
        </a>
    </div>
</div>
