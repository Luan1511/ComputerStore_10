@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Edit banner</div>
        <div class="layouts">
            <div class="left-banner">
                <div class="col-12 p-0">
                    <div class="slider-area">
                        <div class="slider-active owl-carousel">
                            @if (!isset($leftBanners) || $leftBanners == null)
                                <div class="single-slide align-center-left animation-style-01 bg-1"
                                    style="background-color: #90e0ef !important; background-image: none;">
                                    <p
                                        style="text-align: center; margin-left: 50px; color: white; font-weight: 500; font-size: 30px">
                                        (Empty)</p>
                                </div>
                            @else
                                @foreach ($leftBanners as $leftBanner)
                                    <div class="single-slide align-center-left animation-style-01 bg-1"
                                        style="background-image: url({{ asset('storage/' . $leftBanner->image) }}) !important">
                                        <div class="slider-progress"></div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table id="left-banner-table">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        @foreach ($leftBanners as $leftBanner)
                            <tr>
                                <td><img src="{{ asset('storage/' . $leftBanner->image) }}" alt=""></td>
                                <td style="width: 25%"><a href="{{ url('admin/banner/delete/' . $leftBanner->id) }}"
                                        class="delete-btn">Delete</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <input type="file" id="left" name="left">
            </div>
            <div class="right-banner">
                <div class="top-banner">
                    <img src="{{ asset('storage/' . $topBanner->image) }}" alt="Top-right banner">
                    <input type="file" id="top" name="top">
                </div>
                <div class="bottom-banner">
                    <img src="{{ asset('storage/' . $bottomBanner->image) }}" alt="Bottom-right banner">
                    <input type="file" id="bottom" name="bottom">
                </div>
            </div>
        </div>

        <div class="btn-banner">
            <a href="" id="bottom-banner-btn" class="brand-btn">Update</a>
        </div>

        <div class="title-content mt-40">Advertiser banner</div>
        <table id="ads-banner-table" class="display">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>

    <script>
        $(".slider-active").owlCarousel({
            loop: true,
            margin: 0,
            nav: true,
            autoplay: true,
            items: 1,
            autoplayTimeout: 10000,
            navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
            dots: true,
            autoHeight: true,
            lazyLoad: true
        });

        $(".brand-btn").click(function(e) {
            e.preventDefault();

            let imageLeft = document.querySelector('#left').files[0];
            let imageTop = document.querySelector('#top').files[0];
            let imageBottom = document.querySelector('#bottom').files[0];

            let formData = new FormData();
            if (imageLeft) formData.append('image_left', imageLeft);
            if (imageTop) formData.append('image_top', imageTop);
            if (imageBottom) formData.append('image_bottom', imageBottom);

            // Gửi request bằng Fetch API
            try {
                fetch("{{ url('admin/banner/update') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                title: "Success!",
                                text: data.message,
                                icon: "success",
                                button: "OK"
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                title: "Error!",
                                text: data.message || "Failed to update",
                                icon: "error",
                                button: "OK"
                            });
                        }
                    });
            } catch (error) {
                console.error("Error:", error);
            }
        });

        // $('#left-banner-btn').hover(
        //     function() {
        //         $('.left-banner > img').css({
        //             'transform': 'scale(1.05)',
        //         });
        //         $('.left-banner').css({
        //             'box-shadow': '0 0 15px rgba(0, 0, 0, 0.2)',
        //         });
        //     },
        //     function() {
        //         $('.left-banner > img').css({
        //             'transform': 'scale(1)',
        //         });
        //         $('.left-banner').css({
        //             'box-shadow': '',
        //         });
        //     }
        // );
        // $('#top-banner-btn').hover(
        //     function() {
        //         $('.top-banner > img').css({
        //             'transform': 'scale(1.05)',
        //         });
        //         $('.top-banner').css({
        //             'box-shadow': '0 0 15px rgba(0, 0, 0, 0.2)',
        //         });
        //     },
        //     function() {
        //         $('.top-banner > img').css({
        //             'transform': 'scale(1)',
        //         });
        //         $('.top-banner').css({
        //             'box-shadow': '',
        //         });
        //     }
        // );
        // $('#bottom-banner-btn').hover(
        //     function() {
        //         $('.bottom-banner > img').css({
        //             'transform': 'scale(1.05)',
        //         });
        //         $('.bottom-banner').css({
        //             'box-shadow': '0 0 15px rgba(0, 0, 0, 0.2)',
        //         });
        //     },
        //     function() {
        //         $('.bottom-banner > img').css({
        //             'transform': 'scale(1)',
        //         });
        //         $('.bottom-banner').css({
        //             'box-shadow': '',
        //         });
        //     }
        // );

        $(document).ready(function() {
            $('#ads-banner-table').DataTable({
                autoWidth: true,
                processing: true,
                serverSide: false,
                paging: false,  
                searching: false, 
                info: false,  
                lengthChange: false,
                ajax: '{{ route('admin-getAdsBanner') }}',
                columns: [{
                        data: 'image',
                        render: function(data, type, row) {
                            return '<img src="{{ asset("storage/") }}/' + data + '" height="80px" width="120px">';
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row) {
                            return '<a class="delete-btn" onclick="return confirm(\'Are you sure?\')" href="' +
                                '{{ url('admin/brand') }}' + '/' + data + '/delete">Delete</a>';
                        }
                    },
                ],
                initComplete: function() {
                    $('.dataTables_info').hide();
                    $('.dataTables_info').hide();
                }
            });
        });
    </script>
@endsection
