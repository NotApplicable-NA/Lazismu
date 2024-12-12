<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile Admin</title>
    <!-- favicon -->
    <link rel="icon" type="image/png" href="/img/favicon.jpg">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles / Scripts -->
    <!-- Link CSS Bootstrap dari CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/main.css') }}">
    @vite('resources/css/app.css')
</head>
<!-- navbar -->
@include('layouts.sidebaradmin')
<body>
    <!-- Tambahkan padding top untuk body agar konten tidak nabrak navbar -->
    <div class="flex-grow-1" style="padding-top: 80px;">
            <div class="d-flex justify-content-center align-items-center min-vh-100">
                <div class="card shadow-lg border-0 w-50">
                    <div class="card-body p-4">
                        <!-- Centered Profile Picture -->
                        <div class="d-flex flex-column align-items-center text-center mb-4">
                            <img src="https://via.placeholder.com/150" alt="Profile Picture" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover;">
                            <h5 class="mt-3">Budiono Siregar - Program</h5>
                        </div>
                        <!-- Profile Form -->
                        <form>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" value="Budiono Siregar">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email *</label>
                                <input type="email" class="form-control" id="email" value="BudionoSiregar@gmail.com">
                            </div>
                            <div class="mb-3">
                                <label for="no-telp" class="form-label">No Telp</label>
                                <input type="text" class="form-control" id="no-telp" value="0264622310">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" value="Yogyakarta">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" value="********">
                            </div>
                            <button type="submit" class="btn btn-danger w-100">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</body>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<!-- navbar -->
@include('layouts.footer')
</html>
