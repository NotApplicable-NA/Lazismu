<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard Lazismu</title>
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
    @include('layouts.navbarMLO')
    <body>
    <div class="flex justify-center py-6"> <!-- Memposisikan card di tengah dan memberikan padding atas-bawah -->
    <div class="max-w-2xl p-6 bg-white border border-gray-200 rounded-lg shadow-lg flex items-start space-x-4">
        <!-- Gradien oranye di sebelah kanan card -->
        <div class="w-1 h-full bg-gradient-to-r from-orange-500 to-orange-200 rounded-l-lg"></div>
        
        <!-- Konten card -->
        <div class="flex flex-col">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-800">Selamat Datang</h5>
            <p class="text-gray-700">Hai {{ Auth::user()->nama ?? 'Guest' }}, Selamat datang di sistem Pelayanan lazismu daerah istimewa yogyakarta.</p>
        </div>
    </div>
</div>
<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 w-50">
        <div class="card-body p-4">
            <!-- Centered Profile Picture -->
            <div class="d-flex flex-column align-items-center text-center mb-4">
                <img src="{{ Auth::user()->profile_picture ? asset('uploads/profile_pictures/' . Auth::user()->profile_picture) : asset('uploads/default-profile.png') }}" 
                alt="Profile Picture" 
                class="rounded-circle shadow" 
                style="width: 150px; height: 150px; object-fit: cover;">
                <h5 class="mt-3">{{ Auth::user()->nama ?? 'Guest' }}</h5>
            </div>

            <!-- Profile Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" id="nama" value="{{ old('nama', Auth::user()->nama) }}">
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{ Auth::user()->email ?? 'guest@example.com' }}">
                    @error('email')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no-telp" class="form-label">No Telp</label>
                    <input type="text" name="no_hp" class="form-control" id="no_telp"
                    value="{{ substr(Auth::user()->no_hp ?? '', 0, 1) === '0' ? Auth::user()->no_hp : '0' . (Auth::user()->no_hp ?? '') }}">
                    @error('no_hp')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="alamat" class="form-control" id="address" value="{{ Auth::user()->alamat ?? 'Yogyakarta' }}">
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password">
                    @error('password')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profile_picture" class="form-label">Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                    @error('profile_picture')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-danger w-100">Save</button>
            </form>
        </div>
    </div>
</div>

    </body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <!-- navbar -->
    @include('layouts.footer')
</html>
