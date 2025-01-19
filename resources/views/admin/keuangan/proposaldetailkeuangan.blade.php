<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Detail Proposal Mitra</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Styles / Scripts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
        <!-- CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- JavaScript Bootstrap (termasuk Popper.js) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
        <style>
            .hidden {
                display: none;
            }
        </style>
        @vite('resources/css/app.css')
    </head>
    <body>
        <!-- Sidebar -->
        <aside class="sidebar bg-dark text-white p-3" style="width: 250px;">
            @include('layouts.sidebarkeuangan')
        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1" style="margin-left: 250px;">
            <div class="container py-8 px-4">
                <!-- Header -->
                <header class="mb-4 mt-5">
                    <h1 class="fw-bold fs-5">Detail Proposal Mitra</h1>
                    <hr class="custom-underline">
                </header>
                    <!-- Data Proposal -->
                    <div class="container mt-5 mb-5">
                        <div class="card shadow-sm">
                            <div class="card-body p-5">
                                <h3 class="card-title text-center mb-2">Informasi Proposal Mitra</h3>

                                <!-- Set padding pada setiap row -->
                                <div class="container">
                                    <div class="mb-3">
                                        <strong>Judul Proposal:</strong>
                                        <p>Seminar Nasional IMM FTI UAD</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Kategori:</strong>
                                        <p>Lembaga</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Nama Pengirim:</strong>
                                        <p>IMM FTI UAD</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>No. Surat:</strong>
                                        <p>005/Pan-SemNas/XII/2024</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Kontak:</strong>
                                        <p>0823411244123</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Tanggal:</strong>
                                        <p>25 November 2024</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Anggaran:</strong>
                                        <p>Rp. 1.500.000,00</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>File Proposal:</strong>
                                        <a href="#" class="d-block text-truncate">
                                            Proposal Seminar Nasional IMM FTI UAD.pdf
                                        </a>
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="kategoriPengajuan" class="form-label">Kategori Pengajuan</label>
                                        <select class="form-select" id="kategoriPengajuan" disabled>
                                            <option selected>Pengajuan Bantuan UMKM</option>
                                            <option selected>Pengajuan Beasiswa Pendidikan</option>
                                            <option selected>Pengajuan Bantuan Kesehatan/Pengobatan</option>
                                            <option selected>Pengajuan Bantuan Musafir</option>
                                            <option selected>Pengajuan Bantuan (MUALLAF)</option>
                                            <option selected>Pengajuan Bantuan Hutang (GHORIB)</option>
                                        </select>
                                    </div>
        
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="catatan" rows="3" placeholder="Tulis Keterangan ..." readonly></textarea>
                                    </div>
                                
                                    
                                </div>
                                
                                </div>
                        </div>
                    </div>
            </div>
        </div>
    </body>
    <!-- Footer -->
@include('layouts.footer')

</html>
