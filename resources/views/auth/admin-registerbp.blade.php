<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Daftar Akun Lazismu</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
         <!-- Link CSS Bootstrap dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
        @vite('resources/css/app.css')
    </head>
  
    <!-- navbar -->
    @include('layouts.navbar')
    <body>
    <div class="card-login">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
              <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">DAFTAR</h1>
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

        <form class="space-y-6" action="/adminregisterbp" method="POST">
        @csrf
        <div>
            <label for="username" class="block text-sm/6 font-medium text-gray-900">Username</label>
            <div class="mt-2">
            <input type="text" id="username" name="username" class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
        </div>
        </div>

        <div>
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Alamat Email</label>
            <div class="mt-2">
            <input type="email" id="email" name="email" autocomplete="email" class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
        </div>
        </div>

        <div>
            <label for="nama" class="block text-sm/6 font-medium text-gray-900">Nama</label>
            <div class="mt-2">
            <input type="text" id="nama" name="nama" class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
        </div>
        </div>

        <div>
            <label for="role" class="block text-sm/6 font-medium text-gray-900">Role</label>
            <div class="mt-2">
                <select id="role" name="role" class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                    <option value=""disabled selected>Pilih Role</option>
                    <option value="Badan Pengurus"disabled selected>Badan Pengurus</option>
                    <option value="Manager">Manager</option>
                </select>
            </div>
        </div>     

        <div>
            <div class="flex items-center justify-between">
                <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
            </div>
            <div class="mt-2">
                <input id="password" name="password" type="password" required class="form-control ">
            </div>
            </div>

            <div class="mt-4">
            <label for="confirm-password" class="block text-sm/6 font-medium text-gray-900">Konfirmasi Password</label>
            <div class="mt-2">
                <input name="password_confirmation" id="password_confirmation" type="password" required class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
            </div>
            </div>


      <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Daftar</button>
      </div>
    </form>

    <p class="mt-10 text-center text-sm/6 text-gray-500">
      Sudah Punya Akun?
      <a href="/login" class="font-semibold text-indigo-600 hover:text-indigo-500">Masuk</a>
    </p>
  </div>
</div>
</div>
    </body>
    <!-- navbar -->
    @include('layouts.footer')
</html>
