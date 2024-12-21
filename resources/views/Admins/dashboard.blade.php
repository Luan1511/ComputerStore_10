@extends('Admins.admin.layout-admin')

@section('content')
    <div class="table-container">
        <div class="title-content">Dashboard</div>
        <div class="">
            <div class="row" style="justify-content: center">
                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(99, 205, 99);">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>${{$monthlyRevenue}}</h4>
                        </div>
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(67, 197, 150);">
                        <div>
                            <div style="color: rgb(67, 197, 150)">Annual revenue</div>
                            <h4>${{$annualRevenue}}</h4>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(0, 149, 255);">
                        <div>
                            <div style="color: rgb(0, 149, 255);">Customer</div>
                            <h4>{{ $userCount }}</h4>
                        </div>
                        <i class="fa-solid fa-user"></i>
                    </div>
                </div>

                {{-- <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-sack-dollar"></i>
                    </div>
                </div> --}}
            </div>

            <div class="row" style="justify-content: center">
                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(227, 163, 36);">
                        <div>
                            <div style="color: rgb(227, 163, 36);">Laptop</div>
                            <h4>{{ $laptopCount }}</h4>
                        </div>
                        <i class="fa-solid fa-laptop"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(0, 149, 255);">
                        <div>
                            <div style="color: rgb(0, 149, 255);">Brand</div>
                            <h4>{{ $brandCount }}</h4>
                        </div>
                        <i class="fa-solid fa-list"></i>
                    </div>
                </div>

                <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter" style="border-bottom: 5px solid rgb(54, 222, 255);">
                        <div>
                            <div style="color: rgb(54, 222, 255);">Orders</div>
                            <h4>{{ $orderCount }}</h4>
                        </div>
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div>

                {{-- <div class="counter-container col-10 col-md-6 col-lg-3">
                    <div class="counter">
                        <div>
                            <div class="text-success">Monthly revenue</div>
                            <h4>$0</h4>
                        </div>
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                </div> --}}
            </div>
        </div>

        <div class="charts-container">
            <div class="line-chart">
                <canvas id="myChart"></canvas>
            </div>
            <div class="polarArea-chart">
                <canvas id="polarAreaChart"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
                datasets: [{
                    label: 'Revenue ($)',
                    data: @json($dailyRevenue),
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Revenue of this week',
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    }
                }
            }
        });

        const pct = document.getElementById('polarAreaChart');

        new Chart(pct, {
            type: 'polarArea',
            data: {
                datasets: [{
                    data: @json($sellCounts)
                }],
                labels: @json($sellNames)
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Best seller',
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    }
                }
            }
        });
    </script>
@endsection
