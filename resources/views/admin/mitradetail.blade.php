<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard Admin</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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
        @include('layouts.sidebaradmin')
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container py-8 px-4">
            <!-- Header -->
                <header class="mb-4 mt-5">
                    <h1 class="fw-bold fs-5">Detail Mitra</h1>
                    <hr class="custom-underline">
                </header>

                <!-- Data Proposal -->
                <div class="container mt-5 mb-5">
                    <div class="card shadow-sm">
                        <div class="card-body p-5">
                            <h3 class="card-title text-center mb-2">Data Mitra</h3>
                            <p class="text-center mb-4">Informasi Terkait Mitra</p>

                            <!-- Set padding pada setiap row -->
                            @if(isset($mitra))
                            <div class="row py-2">
                                <div class="col-4">Nama Mitra</div>
                                <div class="col-8">: {{ $mitra->nama }}</div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Kontak Mitra</div>
                                <div class="col-8">: {{ $mitra->no_hp }}</div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Email Mitra</div>
                                <div class="col-8">: {{ $mitra->email }}</div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Status</div>
                                <div class="col-8">
                                    <span class="{{ $mitra->status ? 'bg-green-500' : 'bg-red-500' }} text-white py-1 px-2 rounded">
                                        {{ $mitra->status ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </div>                            
                            </div>
                            @else
                                <p>Data mitra tidak ditemukan.</p>
                            @endif
                        </div>
                    </div>
                </div>

        </div>
    </div>
</body>
<!-- Footer -->
@include('layouts.footer')
</html>
