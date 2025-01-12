@extends('layouts.admin')

@section('admin-content')
    <h2 class="text-custom-primary">Admin Dashboard</h2>
    <div class="row g-4">
        <!-- Statistic Cards -->
        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm" style="min-height: 100%">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-users"></i> Users</h4>
                    <p class="fs-2 fw-bold">{{ $number_of_users }}</p>
                    <small>Total Registered Users</small>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm" style="min-height: 100%">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-car mb-4"></i> Vehicles: {{ $total_vehicles }}</h4>

                    <div class="mb-2 mt-2">
                        <span class="badge bg-success me-2 fs-5">Available: {{ $available_vehicles }}</span>
                        <span class="badge bg-warning me-2 fs-5">Leased: {{ $leased_vehicles }}</span>
                        <span class="badge bg-danger fs-5">Maintenance: {{ $vehicles_under_maintenance }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm" style="min-height: 100%">
                <div class="card-body text-center">
                    <h4><i class="fa-solid fa-coins"></i> Revenue</h4>
                    <p class="fs-2 fw-bold">$78,910</p>
                    <small>This Month</small>
                </div>
            </div>
        </div>
    </div>


    <div class="row mt-5">
        <!-- Chart 1 -->
        <div class="col-md-6">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chart-pie"></i> Vehicle Status Distribution</h5>
                    <canvas id="vehicleStatusChart" style="max-height: 400px; overflow: hidden;"></canvas>
                </div>
            </div>
        </div>
        <!-- Chart 2 -->
        <div class="col-md-6">
            <div class="card bg-custom-secondary text-custom-primary shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-chart-line"></i> Vehicle Rentals</h5>
                    <canvas id="rentalChart" style="max-height: 400px; overflow: hidden;"></canvas>
                </div>
            </div>
        </div>
    </div>

 {{-- TODO: move scripts to it's own peacful place --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('vehicleStatusChart').getContext('2d');
        var vehicleStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Available', 'Leased', 'Maintenance'],
                datasets: [{
                    label: 'Vehicle Status Distribution',
                    data: [{{ $available_vehicles }}, {{ $leased_vehicles }},
                        {{ $vehicles_under_maintenance }}
                    ],
                    backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderColor: ['#28a745', '#ffc107', '#dc3545'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    },
                    beforeDraw: function(chart) {
                        var ctx = chart.ctx;
                        var width = chart.width;
                        var height = chart.height;
                        var total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);

                        chart.data.datasets.forEach(function(dataset) {
                            dataset.data.forEach(function(dataPoint, index) {
                                var model = chart.getDatasetMeta(0).data[index]._model;
                                var x = model.x;
                                var y = model.y;
                                ctx.fillStyle = '#fff';
                                ctx.font = 'bold 16px Arial';
                                ctx.textAlign = 'center';
                                ctx.textBaseline = 'middle';
                                var percentage = (dataPoint / total * 100).toFixed(1);
                                ctx.fillText(percentage + '%', x, y - 10);
                            });
                        });
                    }
                }
            }
        });
    </script>

    <script>
        var leasedVehiclesByMonth = @json($leased_vehicles_by_month); // Use json_encode to pass data
        var ctx = document.getElementById('rentalChart').getContext('2d');
        var rentalChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Leased Vehicles by Month',
                    data: Object.values(leasedVehiclesByMonth),
                    borderColor: '#007bff',
                    borderWidth: 2,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        enabled: true
                    }
                },
                scales: {
                    y: {
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    </script>
@endsection
