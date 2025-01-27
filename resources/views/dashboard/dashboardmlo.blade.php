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

        <style>
            /* Optional: Styling tambahan untuk menjaga tampilan tetap rapi */
            table {
                table-layout: fixed; /* Semua kolom memiliki lebar tetap */
                width: 100%; /* Lebar tabel penuh */
            }

            th, td {
                overflow: hidden; /* Sembunyikan teks yang terlalu panjang */
                text-overflow: ellipsis; /* Tambahkan ellipsis (...) untuk teks yang dipotong */
                white-space: nowrap; /* Jangan bungkus teks ke baris baru */
            }
        </style>
    </head>
    <!-- navbar -->
    @include('layouts.navbarMLO')
    <body>
    
    <!-- Card -->
<div class="flex justify-center py-4 space-x-4"> <!-- Memposisikan card di tengah dan memberikan padding atas-bawah -->
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

<div class="flex justify-center py-6 space-x-4"> <!-- Memposisikan dua card di tengah dan memberikan jarak antara card -->
    <!-- Card Pertama -->
    <div class="max-w-4xl p-6 bg-white border border-gray-200 rounded-lg shadow-lg flex items-start space-x-4">
        <!-- Gradien oranye dan gambar di sebelah kiri card -->
        <div class="w-16 h-16 flex items-center justify-center rounded-l-lg">
            <img src="/img/orang.png" alt="Icon" class="w-12 h-12">
        </div>
        
        <!-- Konten card -->
        <div class="flex flex-col">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-800">Status Pengguna</h5>
            <h2 class="text-orange-500 text-4xl">
                @if (Auth::user()->status == 1)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </h2>
        </div>
    </div>

    <!-- Card Kedua -->
    <div class="max-w-4xl p-6 bg-white border border-gray-200 rounded-lg shadow-lg flex items-start space-x-4">
        <!-- Gradien oranye dan gambar di sebelah kiri card -->
        <div class="w-16 h-16 flex items-center justify-center rounded-l-lg">
            <img src="/img/graph.png" alt="Icon" class="w-12 h-12">
        </div>
        
        <!-- Konten card -->
        <div class="flex flex-col">
            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-800">Anggaran Digunakan</h5>
            <h2 class="text-orange-500 text-4xl">2.000.000</h2>
        </div>
    </div>
</div>

<div class="flex justify-center items-center p-8 min-h-screen">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-gray-800 p-6">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400" style="table-layout: fixed;">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-2 py-3" style="width: 3%;">No</th>
                    <th scope="col" class="px-6 py-3" style="width: 27%;">Judul</th>
                    <th scope="col" class="px-6 py-3" style="width: 15%;">Anggaran Diajukan</th>
                    <th scope="col" class="px-6 py-3" style="width: 15%;">Anggaran Disetujui</th>
                    <th scope="col" class="px-6 py-3" style="width: 12%;">Kontak</th>
                    <th scope="col" class="px-6 py-3" style="width: 15%;">Status</th>
                    <th scope="col" class="px-6 py-3" style="width: 13%;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proposals as $proposal)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="px-2 py-4">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-black truncate dark:text-black">
                            {{ $proposal->judul }}
                        </td>
                        <td class="px-6 py-4">{{ number_format($proposal->anggaran_diajukan, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ number_format($proposal->anggaran_disetujui, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">{{ $proposal->mitra->no_hp ?? 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-4 py-2 rounded-lg text-sm font-medium
                                @if ($proposal->status === 'Masuk') text-blue-600 bg-blue-100
                                @elseif ($proposal->status === 'Diterima') text-green-600 bg-green-100
                                @elseif ($proposal->status === 'Proses') text-yellow-600 bg-yellow-100
                                @elseif ($proposal->status === 'Ditolak') text-red-600 bg-red-100
                                @else text-gray-600 bg-gray-100 @endif">
                                {{ ucfirst($proposal->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="inline-flex space-x-4">
                                <a href="#" class="flex items-center py-2 text-base font-medium text-gray-900 hover:underline">
                                    <img src="/img/read_action.png" alt="Read action" class="w-5 h-5" />
                                </a>
                                @if($proposal->status === 'Masuk')
                                    <a href="{{ route('dashboard.editpropo', $proposal->id) }}" class="flex items-center py-2 text-base font-medium text-gray-900 hover:underline">
                                        <img src="/img/edit_action.png" alt="Edit action" class="w-5 h-5" />
                                    </a>
                                @else
                                    <a href="#" onclick="alert('Halaman tidak bisa dibuka karena status sudah di \"{{ $proposal->status }}\".')" class="flex items-center py-2 text-base font-medium text-gray-500">
                                        <img src="/img/edit_action.png" alt="Edit action" class="w-5 h-5 opacity-50" />
                                    </a>
                                @endif
                                <a href="#" class="flex items-center py-2 text-base font-medium text-gray-900 hover:underline">
                                    <img src="/img/trash_action.png" alt="Delete action" class="w-5 h-5" />
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $proposals->links('vendor.pagination.tailwind') }}
    </div>
    <!-- <nav aria-label="Page navigation example" class="mt-4">
        <ul class="inline-flex -space-x-px text-sm justify-center w-full">
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-black">1</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-black">2</a>
            </li>
            <li>
                <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-black">3</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-black">4</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-black">5</a>
            </li>
            <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-black">Next</a>
            </li>
        </ul>
    </nav> -->
</div>
</div>

    </body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <!-- navbar -->
    @include('layouts.footer')
</html>
