<div class="header-menu pl-20 pr-20 pt-2">
    <div style="display: flex; align-items: center" class="space-x-cus">
        {{-- Logo --}}
        <div class="title-header bg-white text-center d-flex">
            <a>
                <img src="{{ asset('images/LuNi_logo.png')}}" alt="" height="30px" class="ml-auto mr-auto mt-auto mb-auto">
            </a>
        </div>

        <i onclick="toggleMenu()" id="sidebar-toggle-btn" class="fa-solid fa-bars" style="display: none; font-size: 18px"></i>
    </div>

    {{-- Items --}}
    <ul class="d-flex space-x-cus">
        <li class="d-flex">
            <input type="search" id="search-input">
            <a href=""><i class="fa-solid fa-magnifying-glass"></i></a>
        </li>

        <li>
            <i class="fa-solid fa-bell"></i>
            <span class="number-alert">1</span>
        </li>

        <li>
            <i class="fa-solid fa-circle-user" style="font-size: 25px"></i>
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
