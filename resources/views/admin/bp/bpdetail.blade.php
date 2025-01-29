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
            @include('layouts.sidebaradmin')
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
                                        <p>{{$proposal->judul}}</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Kategori:</strong>
                                        <p>{{$proposal->kategori}}</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Nama Pengirim:</strong>
                                        <p>{{$proposal->mitra->nama}}</p>
                                    </div>
                                
                                    <!-- <div class="mb-3">
                                        <strong>No. Surat:</strong>
                                        <p>005/Pan-SemNas/XII/2024</p>
                                    </div> -->
                                
                                    <div class="mb-3">
                                        <strong>Kontak:</strong>
                                        <p>{{$proposal->kontak}}</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Tanggal Masuk:</strong>
                                        <p>{{$proposal->tgl_masuk}}</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>Anggaran Diajukan:</strong>
                                        <p>{{$proposal->anggaran_diajukan}}</p>
                                    </div>
                                
                                    <div class="mb-3">
                                        <strong>File Proposal:</strong>
                                        @if($proposal->file)
                                        <a href="{{ asset('storage/proposals/' . $proposal->file) }}" target="_blank" 
                                        class="text-blue-500 hover:underline">
                                            Buka File Proposal
                                        </a>
                                        @else
                                            <p class="text-gray-500">Tidak ada file proposal yang tersedia.</p>
                                        @endif
                                    </div>
                                
                                    <div class="mb-3">
                                        <label for="kategoriPengajuan" class="form-label">Kategori Pengajuan</label>
                                        <select class="form-select" id="kategoriPengajuan" disabled>
                                        <option value="" @selected(empty($proposal->kategori_pengajuan))>-- Pilih Kategori --</option>
                                            <option value="Pengajuan Bantuan UMKM" @selected($proposal->kategori_pengajuan === 'Pengajuan Bantuan UMKM')>
                                                Pengajuan Bantuan UMKM
                                            </option>
                                            <option value="Pengajuan Beasiswa Pendidikan" @selected($proposal->kategori_pengajuan === 'Pengajuan Beasiswa Pendidikan')>
                                                Pengajuan Beasiswa Pendidikan
                                            </option>
                                            <option value="Pengajuan Bantuan Kesehatan/Pengobatan" @selected($proposal->kategori_pengajuan === 'Pengajuan Bantuan Kesehatan/Pengobatan')>
                                                Pengajuan Bantuan Kesehatan/Pengobatan
                                            </option>
                                            <option value="Pengajuan Bantuan Musafir" @selected($proposal->kategori_pengajuan === 'Pengajuan Bantuan Musafir')>
                                                Pengajuan Bantuan Musafir
                                            </option>
                                            <option value="Pengajuan Bantuan (MUALLAF)" @selected($proposal->kategori_pengajuan === 'Pengajuan Bantuan (MUALLAF)')>
                                                Pengajuan Bantuan (MUALLAF)
                                            </option>
                                            <option value="Pengajuan Bantuan Hutang (GHORIB)" @selected($proposal->kategori_pengajuan === 'Pengajuan Bantuan Hutang (GHORIB)')>
                                                Pengajuan Bantuan Hutang (GHORIB)
                                            </option>
                                        </select>
                                    </div>
        
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan</label>
                                        <textarea class="form-control" id="catatan" rows="3" placeholder="{{ $catatanFOtoMitra->isi_catatan ?? 'Tidak ada catatan tersedia' }}" readonly></textarea>
                                    </div>

                                    <div style="border-top: 2px solid #000; width: 100%; margin-top: 30px; margin-bottom: 30px;"></div>
                                     <!-- Card Disposisi -->
                                    
                                        <div class="card-body">
                                            <h5 class="card-title text-center">Disposisi</h5>
                                            <div class="mb-3">
                                                <label for="disposisi-ke" class="form-label">Disposisi Ke :</label>
                                                <input type="text" id="disposisi-ke" class="form-control fw-bold" value="{{ $catatanManagerToBP->role_dituju ?? 'Tidak ada catatan tersedia' }}" disabled />
                                            </div>
                                            <div class="mb-3">
                                                <label for="catatan-manager" class="form-label">Catatan Manager:</label>
                                                <textarea id="catatan-manager" class="form-control" rows="3" placeholder="{{ $catatanManagerToBP->isi_catatan ?? 'Tidak ada catatan tersedia' }}" disabled></textarea>
                                            </div>
                                            <form action="{{ route('proposal.storeCatatanBP', ['id' => $proposal->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_proposal" value="{{ $proposal->id }}">
                                                <div class="mb-3">
                                                    <label for="catatan-bp" class="form-label">Catatan BP ke Manager</label>
                                                    <textarea id="catatan-bp" name="isi_catatan" class="form-control" rows="3" placeholder="Tulis catatan di sini">{{ old('isi_catatan', $catatanBPtoManager->isi_catatan ?? '') }}</textarea>
                                                    </div>
                                                <button type="submit" class="btn btn-success w-100">Kirim</button>
                                            </form>
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
