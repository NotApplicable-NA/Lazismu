<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />

        <title>Proposal Lazismu</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Styles / Scripts -->
         <!-- Link CSS Bootstrap dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
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

 <!-- Outer container to center both cards -->
 <div class="flex flex-col items-center space-y-4 py-6">

<!-- Card 1 -->
<div class="w-full max-w-2xl p-6 bg-white border border-gray-200 rounded-lg shadow-lg flex items-center space-x-4">
    <!-- Orange gradient on the left side of the card -->
    <div class="w-1 h-full bg-gradient-to-r from-orange-500 to-orange-200 rounded-l-lg"></div>
    
    <!-- Content of the card with space between title and amount -->
    <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
            <h5 class="text-xl font-bold tracking-tight text-gray-800">Anggaran Digunakan</h5>
            <h2 class="text-orange-500 text-4xl">2.000.000</h2>
        </div>
    </div>
    
    <!-- Orange gradient on the right side of the card -->
    <div class="w-1 h-full bg-gradient-to-r from-orange-500 to-orange-200 rounded-r-lg"></div>
</div>

<!-- Card 2 -->
<div class="w-full max-w-2xl p-6 bg-teal-100 border border-gray-200 rounded-lg shadow-lg flex items-center space-x-4">
    <!-- Orange gradient on the left side of the card -->
    <div class="w-1 h-full bg-gradient-to-r from-orange-500 to-orange-200 rounded-l-lg"></div>
    
    <!-- Content of the card with title and description -->
    <div class="flex flex-col w-full">
        <div class="flex justify-between items-center">
            <h5 class="text-xl font-bold tracking-tight text-gray-800">Petunjuk</h5>
        </div>
        <ul class="text-gray-700 list-disc pl-5 mt-2">
            <li>Silahkan ikuti Alur pengajuan proposal</li>
            <li>Ada perbedaan persyaratan pada proposal individu dan lembaga</li>
        </ul>
    </div>

    <!-- Orange gradient on the right side of the card -->
    <div class="w-1 h-full bg-gradient-to-r from-orange-500 to-orange-200 rounded-r-lg"></div>
</div>

</div>

<div class="flex justify-center items-center p-8 min-h-screen">
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white dark:bg-gray-800 p-6">
        <!-- search dan ajukan proposal -->
         <!-- search dan ajukan proposal -->
        <div class="flex justify-between items-center mb-4">
            <!-- Input Search -->
            <input type="text" id="search" placeholder="Cari proposal..." class="p-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            
            <!-- Button Ajukan Proposal -->
            <button class="px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500" onclick="window.location.href='/dashboard/pengajuan';">
                + Ajukan Proposal
            </button>
        </div>
        @if(session('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

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
                                <a href="{{ route('dashboard.detailpengajuan', $proposal->id) }}" class="flex items-center py-2 text-base font-medium text-gray-900 hover:underline">
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
                                <!-- Delete -->
                                <form action="{{ route('proposal.destroy', $proposal->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus proposal ini?')" class="flex items-center">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center py-2 text-base font-medium text-gray-900 hover:underline">
                                        <img src="/img/trash_action.png" alt="Delete action" class="w-5 h-5" />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    <div class="d-flex justify-content-center mt-4">
        {{ $proposals->links('vendor.pagination.tailwind') }}
    </div>
</div>
</div>

    </body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <!-- navbar -->
    @include('layouts.footer')
</html>
