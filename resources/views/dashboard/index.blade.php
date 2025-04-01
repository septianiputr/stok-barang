@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="h3 mb-4 text-gray-800 mt-4">Dashboard</h1>
    <div class="row">
        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Grafik Stok Bahan Baku & Stok Barang Jadi
                        <span>{{\Carbon\Carbon::now()->translatedFormat('Y')}}</span>
                    </h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                            aria-labelledby="dropdownMenuLink">
                            <div class="dropdown-header">Dropdown Header:</div>
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="stokChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script>
        const labels = @json($labels); // Label bulan (Januari - Desember)
        const dataBahanBaku = @json($dataBahanBaku); // Data stok bahan baku
        const dataBarangJadi = @json($dataBarangJadi); // Data stok barang jadi

        const ctx = document.getElementById('stokChart').getContext('2d');
        const stokChart = new Chart(ctx, {
            type: 'line', // Jenis chart (line, bar, dll)
            data: {
                labels: labels,
                datasets: [{
                        label: 'Stok Bahan Baku',
                        data: dataBahanBaku,
                        borderColor: 'rgba(78, 115, 223, 1)',
                        backgroundColor: 'rgba(78, 115, 223, 0.05)',
                        borderWidth: 2,
                        fill: true
                    },
                    {
                        label: 'Stok Barang Jadi',
                        data: dataBarangJadi,
                        borderColor: 'rgba(28, 200, 138, 1)',
                        backgroundColor: 'rgba(28, 200, 138, 0.05)',
                        borderWidth: 2,
                        fill: true
                    }
                ]
            },
            options: {
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
    @endsection