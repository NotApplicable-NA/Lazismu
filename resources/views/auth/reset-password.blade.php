<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Reset Password Akun Lazismu</title>
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
  
    <!-- navbar -->
    @include('layouts.navbar')
    <body>
    <div class="card-login">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <div class="sm:mx-auto sm:w-full sm:max-w-sm">
              <h1 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">UBAH PASSWORD</h1>
              <!-- Status Message -->
              @if (session('status'))
              <div class="alert alert-success text-center">
                  {{ session('status') }}
              </div>
          @endif

          <!-- Error Message -->
          @if ($errors->any())
              <div class="alert alert-danger">
                  <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <!-- Input Email -->
            <div>
                <label for="email" class="block text-sm/6 font-medium text-gray-900">Alamat Email</label>
                <div class="mt-2">
                    <input type="email" id="email" name="email" autocomplete="email" value="{{ old('email') }}" class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6" required>
                </div>
            </div>
        
            <!-- Input Password -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-sm/6 font-medium text-gray-900">Password</label>
                </div>
                <div class="mt-2">
                    <input id="password" name="password" type="password" required class="form-control">
                </div>
            </div>
        
            <!-- Input Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900">Konfirmasi Password</label>
                <div class="mt-2">
                    <input name="password_confirmation" id="password_confirmation" type="password" required class="form-control block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6">
                </div>
        
            </div>
        
            <div>
                <button type="submit" class="flex w-full justify-center rounded-md bg-black px-3 py-1.5 text-sm/6 font-semibold text-white shadow-sm hover:bg-gray-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black">Submit</button>
            </div>
        </form>

</div>
</div>
    </body>
    <!-- navbar -->
    @include('layouts.footer')
</html>
