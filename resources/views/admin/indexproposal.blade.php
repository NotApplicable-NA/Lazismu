<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Proposal Admin Front Office</title>
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
    <!-- Sidebar -->
    <aside class="sidebar bg-dark text-white p-3" style="width: 250px;">
        @include('layouts.sidebaradmin')
    </aside>

    <?php
    // Ambil segmen pertama dari URL
    $role = request()->segment(1);

    // Tentukan URL berdasarkan role
    if ($role === 'admin') {
        $detailUrl = "/admin/proposaldetail";
    } elseif ($role === 'bp') {
        $detailUrl = "/bp/bpdetail";
    } else {
        // Default fallback jika role tidak ditemukan
        $detailUrl = "/admin/proposaldetail";
    }
    ?>
    <div class="flex-grow-1" style="margin-left: 250px;">
    <div class="container py-8 px-4">
            <!-- Header -->
                <header class="mb-4 mt-5">
                    <h1 class="fw-bold fs-5">Proposal</h1>
                    <hr class="custom-underline">
                </header>
            <!-- Proposal Table -->
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Proposal <span class="badge bg-primary">{{$allProposals->count()}} Proposal</span></h5>
                </div>
                    <div class="card-body p-3">
        <table class="table table-bordered table-striped text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="table-light align-items-center">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Judul</th>
                    <th scope="col">Anggaran</th>
                    <th scope="col">Kontak</th>
                    <th scope="col">Tanggal Masuk</th>
                    <th scope="col">Kategori</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($proposals as $proposal)
                <tr>
                    <td><input type="checkbox"></td>
                    <td>{{$proposal->judul}}</td>
                    <td>{{$proposal->anggaran_diajukan}}</td>
                    <td>{{$proposal->kontak}}</td>
                    <td>{{$proposal->tgl_masuk}}</td>
                    <td><span class="badge bg-info">{{$proposal->kategori}}</span></td>
                    <td>
                    <div class="inline-flex space-x-4">
                        <!-- read action -->
                        <a href="{{$detailUrl}}/{{$proposal->id}}" class="flex items-center py-2 text-base font-medium text-gray-900 dark:text-white dark:hover:underline">
                            <img src="/img/admin-detail.png" alt="Read action" class="w-5 h-5" />
                        </a>
                    </div>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer d-flex flex-column flex-md-row justify-content-between align-items-center p-3">
        <!-- Info jumlah data -->
        <p class="text-sm text-gray-600">
            Showing <span class="font-semibold">{{ $proposals->firstItem() }}</span> 
            to <span class="font-semibold">{{ $proposals->lastItem() }}</span> 
            of <span class="font-semibold">{{ $proposals->total() }}</span> entries
        </p>

        <!-- Pagination -->
        <nav>
            <ul class="pagination mb-0 flex gap-2">
                {{-- Tombol "Previous" --}}
                @if ($proposals->onFirstPage())
                    <li class="page-item disabled"><span class="page-link text-gray-400 px-3 py-2">Previous</span></li>
                @else
                    <li class="page-item">
                        <a href="{{ $proposals->previousPageUrl() }}" class="page-link bg-white border px-3 py-2 hover:bg-gray-200">Previous</a>
                    </li>
                @endif

                {{-- Halaman --}}
                @foreach ($proposals->getUrlRange(1, $proposals->lastPage()) as $page => $url)
                    @if ($page == $proposals->currentPage())
                        <li class="page-item active">
                            <span class="page-link bg-blue-500 text-white px-3 py-2">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a href="{{ $url }}" class="page-link bg-white border px-3 py-2 hover:bg-gray-200">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach

                {{-- Tombol "Next" --}}
                @if ($proposals->hasMorePages())
                    <li class="page-item">
                        <a href="{{ $proposals->nextPageUrl() }}" class="page-link bg-white border px-3 py-2 hover:bg-gray-200">Next</a>
                    </li>
                @else
                    <li class="page-item disabled"><span class="page-link text-gray-400 px-3 py-2">Next</span></li>
                @endif
            </ul>
        </nav>
    </div>

            </div>
            </div>
        </div>
</body>
<!-- Footer -->
@include('layouts.footer')
</html>
