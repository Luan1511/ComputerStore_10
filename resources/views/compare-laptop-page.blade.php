@extends('layouts.app')

@section('content')
    @vite(['resources/css/compare.css'])
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="{{ route('home-page') }}">Home</a></li>
                    <li class="active">Compare Laptop</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->

    <?php
    $mainLaptop = $laptops[0];
    $pre = $laptops[0];
    $pos = $laptops[1];
    ?>

    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <table id="compare-table" class="mr-auto ml-auto">
                <tr>
                    <td
                        style="border-top: solid 1px white !important; border-left: solid 1px white !important; border-bottom: solid 1px white !important">
                        <a class="white-btn" onclick="displayComparePanel()">Compare with another one</a>
                    </td>
                    @foreach ($laptops as $laptop)
                        <td>
                            <img src="{{ asset($laptop->img_url) }}" alt="" width="220px" height="200px"> <br>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <td style="border-top: solid 1px white !important; border-left: solid 1px white !important"></td>
                    @foreach ($laptops as $laptop)
                        <td class="text-center">
                            <a class="brand-btn">Buy</a>
                            <a class="white-btn">Add to wishlist</a>
                        </td>
                    @endforeach
                </tr>
                <tr>
                    <th>Name</th>
                    @foreach ($laptops as $laptop)
                        <td>{{ $laptop->name }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Brand</th>
                    @foreach ($laptops as $laptop)
                        <td>{{ $laptop->brand->name }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Processor</th>
                    @if (count($laptops) == 2)
                        <?php
                        $laptop1 = $laptops[0];
                        $laptop2 = $laptops[1];
                        
                        $cpuTiers = [
                            'Intel Core i3' => 1,
                            'Intel Core i5' => 2,
                            'Intel Core i7' => 3,
                            'Intel Core i9' => 4,
                            'AMD Ryzen 3' => 1,
                            'AMD Ryzen 5' => 2,
                            'AMD Ryzen 7' => 3,
                            'AMD Ryzen 9' => 4,
                        ];
                        
                        $tier1 = $cpuTiers[$laptop1->processor] ?? 0;
                        $tier2 = $cpuTiers[$laptop2->processor] ?? 0;
                        
                        if ($tier1 == $tier2) {
                            $classLaptop1 = 'equal';
                            $classLaptop2 = 'equal';
                        } elseif ($tier1 < $tier2) {
                            $classLaptop1 = 'smaller';
                            $classLaptop2 = 'larger';
                        } else {
                            $classLaptop1 = 'larger';
                            $classLaptop2 = 'smaller';
                        }
                        ?>
                        <td class="{{ $classLaptop1 }}">{{ $laptop1->processor }}</td>
                        <td class="{{ $classLaptop2 }}">{{ $laptop2->processor }}</td>
                    @endif
                </tr>

                <tr>
                    <th>RAM</th>
                    <?php
                    $laptop1 = $laptops[0]->ram;
                    $laptop2 = $laptops[1]->ram;
                    
                    if ($laptop1 == $laptop2) {
                        $classLaptop1 = 'equal';
                        $classLaptop2 = 'equal';
                    } elseif ($laptop1 < $laptop2) {
                        $classLaptop1 = 'smaller';
                        $classLaptop2 = 'larger';
                    } else {
                        $classLaptop1 = 'larger';
                        $classLaptop2 = 'smaller';
                    }
                    ?>
                    <td class="{{ $classLaptop1 }}">{{ $laptop1 }}</td>
                    <td class="{{ $classLaptop2 }}">{{ $laptop2 }}</td>
                </tr>
                <tr>
                    <th>ROM</th>
                    <?php
                    $laptop1 = $laptops[0]->rom;
                    $laptop2 = $laptops[1]->rom;
                    
                    if ($laptop1 == $laptop2) {
                        $classLaptop1 = 'equal';
                        $classLaptop2 = 'equal';
                    } elseif ($laptop1 < $laptop2) {
                        $classLaptop1 = 'smaller';
                        $classLaptop2 = 'larger';
                    } else {
                        $classLaptop1 = 'larger';
                        $classLaptop2 = 'smaller';
                    }
                    ?>
                    <td class="{{ $classLaptop1 }}">{{ $laptop1 }}</td>
                    <td class="{{ $classLaptop2 }}">{{ $laptop2 }}</td>
                </tr>
                <tr>
                    <th>Screen size</th>
                    <?php
                    $laptop1 = $laptops[0]->screen_size;
                    $laptop2 = $laptops[1]->screen_size;
                    
                    if ($laptop1 == $laptop2) {
                        $classLaptop1 = 'equal';
                        $classLaptop2 = 'equal';
                    } elseif ($laptop1 < $laptop2) {
                        $classLaptop1 = 'smaller';
                        $classLaptop2 = 'larger';
                    } else {
                        $classLaptop1 = 'larger';
                        $classLaptop2 = 'smaller';
                    }
                    ?>
                    <td class="{{ $classLaptop1 }}">{{ $laptop1 }}</td>
                    <td class="{{ $classLaptop2 }}">{{ $laptop2 }}</td>
                </tr>
                <tr>
                    <th>Graphics card</th>
                    @foreach ($laptops as $laptop)
                        <td>{{ $laptop->graphics_card }}</td>
                    @endforeach
                </tr>
                <tr>
                    <th>Battery</th>
                    <?php
                    $laptop1 = $laptops[0]->battery;
                    $laptop2 = $laptops[1]->battery;
                    
                    if ($laptop1 == $laptop2) {
                        $classLaptop1 = 'equal';
                        $classLaptop2 = 'equal';
                    } elseif ($laptop1 < $laptop2) {
                        $classLaptop1 = 'smaller';
                        $classLaptop2 = 'larger';
                    } else {
                        $classLaptop1 = 'larger';
                        $classLaptop2 = 'smaller';
                    }
                    ?>
                    <td class="{{ $classLaptop1 }}">{{ $laptop1 }}</td>
                    <td class="{{ $classLaptop2 }}">{{ $laptop2 }}</td>
                </tr>
                <tr>
                    <th>Operating system</th>
                    @if (count($laptops) == 2)
                        <?php
                        $laptop1 = $laptops[0];
                        $laptop2 = $laptops[1];
                        
                        $osTiers = [
                            'Windows 10' => 2,
                            'Windows 11' => 3,
                            'macOS Monterey' => 3,
                            'macOS Ventura' => 4,
                            'Ubuntu 20.04' => 2,
                            'Ubuntu 22.04' => 3,
                            'Fedora 37' => 3,
                            'Debian 11' => 2,
                        ];
                        
                        $tier1 = $osTiers[$laptop1->os] ?? 0;
                        $tier2 = $osTiers[$laptop2->os] ?? 0;
                        
                        if ($tier1 == $tier2) {
                            $classLaptop1 = 'equal';
                            $classLaptop2 = 'equal';
                        } elseif ($tier1 < $tier2) {
                            $classLaptop1 = 'smaller';
                            $classLaptop2 = 'larger';
                        } else {
                            $classLaptop1 = 'larger';
                            $classLaptop2 = 'smaller';
                        }
                        ?>
                        <td class="{{ $classLaptop1 }}">{{ $laptop1->os }}</td>
                        <td class="{{ $classLaptop2 }}">{{ $laptop2->os }}</td>
                    @endif
                </tr>
            </table>
        </div>
    </div>

    {{-- Compare --}}
    <div class="compare-panel">
        <a><i class="fa fa-times-circle" aria-hidden="true" onclick="displayComparePanel()"></i></a>
        <div class="laptop-list-container row" id="laptop-list-compare">
            @include('components.render-laptop')
        </div>
    </div>

    <script>
        let baseUrl = window.location.origin + '/laptop/';

        // Display compare panel
        function displayComparePanel() {
            $('.compare-panel').toggleClass('display-compare');
            fetchLaptop();
        }

        // List compare
        function fetchLaptop() {
            $.ajax({
                url: baseUrl + 'fetch/compare/' + {{ $mainLaptop->id }},
                method: 'GET',
                success: function(response) {
                    $('#laptop-list-compare').html(response);
                },
                error: function(xhr) {
                    console.error('Error:', xhr);
                }
            });
        }

        // Choose compare
        $(document).on('click', '#choose-laptop-btn', function() {
            var laptop_chosen = $(this).data('chosen-laptop-id');

            window.location.href = baseUrl + 'compare/' + {{ $mainLaptop->id }} + '/' + laptop_chosen;

        });
    </script>
@endsection
