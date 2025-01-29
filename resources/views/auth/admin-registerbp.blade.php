<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Lazismu</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/img/favicon.jpg">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
    @vite('resources/css/app.css')
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <div class="card-login">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                    DAFTAR
                </h1>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Registrasi -->
                <form class="space-y-6" action="{{ route('admin.register.bp') }}" method="POST">
                    @csrf

                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-900">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username') }}" 
                               class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                               required>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-900">Alamat Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                               required>
                    </div>

                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-900">Nama</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" 
                               class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                               required>
                    </div>

                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-900">Role</label>
                        <select id="role" name="role" 
                                class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                                required>
                            <option value="BP" selected>Badan Pengurus</option>
                            <option value="Manager">Manager</option>
                        </select>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                        <input id="password" name="password" type="password" 
                               class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                               required>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Konfirmasi Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" 
                               class="form-control block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-600 focus:border-indigo-600" 
                               required>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" 
                                class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-white shadow-sm hover:bg-gray-800 focus:ring focus:ring-indigo-500">
                            Daftar
                        </button>
                    </div>
                </form>

                <!-- Link ke Login -->
                <p class="mt-10 text-center text-sm text-gray-500">
                    Sudah Punya Akun?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html>
