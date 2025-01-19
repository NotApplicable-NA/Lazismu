<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard Badan Pengurus</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <!-- Styles / Scripts -->
         <!-- Link CSS Bootstrap dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
        @vite('resources/css/app.css')
    </head>
    <body>
        @csrf
    <!-- Sidebar -->
    <aside class="sidebar bg-dark text-white p-3" style="width: 250px;">
        @include('layouts.sidebarbp')
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container py-8 px-4">
            <!-- Header -->
                <header class="mb-4 mt-5">
                    <h1 class="fw-bold fs-5">Badan Pengurus Dashboard</h1>
                    <hr class="custom-underline">
                </header>

          <!-- Stats Cards -->
<div class="row mb-3 justify-center py-6">
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-center align-items-center">
                <!-- Gambar dengan padding lebih besar di sebelah kiri -->
                <img src="/img/orang.png" alt="MLO" class="me-5" style="width: 40px; height: 40px;">
                <!-- Gradien oranye di sebelah kanan gambar dan sebelum teks -->
                <div class="w-1 h-100 bg-gradient-to-r from-orange-500 to-orange-200 rounded-l-lg mx-3"></div>
                <div class="text-center">
                    <h5 class="card-title">Mitra</h5>
                    <p class="card-text fs-4 fw-bold">{{ $mitras->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card shadow-sm border-0">
            <div class="card-body d-flex justify-content-center align-items-center">
                <!-- Gambar dengan padding lebih besar di sebelah kiri -->
                <img src="/img/docs.png" alt="Proposal" class="me-4" style="width: 40px; height: 40px;">
                <!-- Gradien oranye di sebelah kanan gambar dan sebelum teks -->
                <div class="w-1 h-100 bg-gradient-to-r from-orange-500 to-orange-200 rounded-l-lg mx-3"></div>
                <div class="text-center">
                    <h5 class="card-title">Proposal</h5>
                    <p class="card-text fs-4 fw-bold">60,000</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Grafik -->
<div class="container py-4">
    <div class="row">
        <!-- Proposal Bulanan -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm" style="min-height: 382px;">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title text-center mb-4">Proposal Bulanan</h5>
                        <canvas id="proposalChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pilar -->
        <div class="col-md-6 mb-4" >
            <div class="card shadow-sm" style="min-height: 370px;">
                <div class="card-body">
                    <h5 class="card-title text-center">Pilar</h5>
                    <canvas id="pillarChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Anggaran Disetujui -->
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title text-center">Anggaran Disetujui</h5>
                    <canvas id="budgetChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
    </div>
</body>

<script>
    // Ambil data dari backend
    fetch('/get-chart-data')
        .then(response => response.json())
        .then(data => {
            // Proposal Bulanan Chart
            const proposalCtx = document.getElementById('proposalChart').getContext('2d');
            new Chart(proposalCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                    datasets: [{
                        label: '2022',
                        data: data.monthlyProposals,
                        backgroundColor: 'rgba(99, 102, 241, 0.5)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Pilar Chart
            const pillarCtx = document.getElementById('pillarChart').getContext('2d');
            new Chart(pillarCtx, {
                type: 'pie',
                data: {
                    labels: data.pillarData.labels,
                    datasets: [{
                        data: data.pillarData.values,
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF', '#FF9F40'
                        ]
                    }]
                },
                options: {
                    responsive: true
                }
            });

            // Anggaran Disetujui Chart
            const budgetCtx = document.getElementById('budgetChart').getContext('2d');
            new Chart(budgetCtx, {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                    datasets: [{
                        label: '2022',
                        data: data.approvedBudgets,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
</script>

<!-- Footer -->
@include('layouts.footer')
</html>
