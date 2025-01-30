<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Proposal Mitra</title>
    <link rel="icon" type="image/png" href="/img/favicon.jpg">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Bootstrap (Hanya panggil sekali) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- CSS App -->
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
                                <p>{{ $proposal->judul }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Kategori:</strong>
                                <p>{{ $proposal->kategori }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Nama Pengirim:</strong>
                                <p>{{ $proposal->mitra->nama }}</p>
                            </div>

                            <!-- <div class="mb-3">
                                        <strong>No. Surat:</strong>
                                        <p>005/Pan-SemNas/XII/2024</p>
                                    </div> -->

                            <div class="mb-3">
                                <strong>Kontak:</strong>
                                <p>{{ $proposal->kontak }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Tanggal:</strong>
                                <p>{{ $proposal->tgl_masuk }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>Anggaran:</strong>
                                <p>{{ $proposal->anggaran_diajukan }}</p>
                            </div>

                            <div class="mb-3">
                                <strong>File Proposal:</strong>
                                @if ($proposal->file)
                                    <a href="{{ asset('storage/proposals/' . $proposal->file) }}" target="_blank"
                                        class="text-blue-500 hover:underline">
                                        Buka File Proposal
                                    </a>
                                @else
                                    <p class="text-gray-500">Tidak ada file proposal yang tersedia.</p>
                                @endif
                            </div>

                            <form action="{{ route('proposal.storeCatatanFO', ['id' => $proposal->id]) }}"
                                method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="kategoriPengajuan" class="form-label">Kategori Pengajuan</label>
                                    <select class="form-select" id="kategoriPengajuan" name="kategoriPengajuan">
                                        <?php
                                        $kategoriPengajuan = $proposal->kategori_pengajuan ?? ''; // Ambil kategori dari database
                                        $opsiKategori = ['Pengajuan Bantuan UMKM', 'Pengajuan Beasiswa Pendidikan', 'Pengajuan Bantuan Kesehatan/Pengobatan', 'Pengajuan Bantuan Musafir', 'Pengajuan Bantuan (MUALLAF)', 'Pengajuan Bantuan Hutang (GHORIB)'];
                                        ?>
                                        @foreach ($opsiKategori as $opsi)
                                            <option value="{{ $opsi }}" {!! $kategoriPengajuan === $opsi ? 'selected' : '' !!}>
                                                {{ $opsi }}
                                            </option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan</label>
                                    @php
                                        // Ambil catatan dari FO ke Manager terlebih dahulu
                                        $catatanManager = $proposal->catatan
                                            ->where('role_dituju', 'Manager')
                                            ->where('role_pengirim', 'Frontoffice')
                                            ->sortByDesc('created_at')
                                            ->first();

                                        // Jika tidak ada catatan dari FO ke Manager, ambil dari FO ke Mitra
                                        $catatanMitra = $proposal->catatan
                                            ->where('role_dituju', 'Mitra')
                                            ->where('role_pengirim', 'Frontoffice')
                                            ->sortByDesc('created_at')
                                            ->first();

                                        // Tentukan isi catatan yang akan ditampilkan
                                        $isiCatatan = $catatanManager->isi_catatan ?? ($catatanMitra->isi_catatan ?? '');
                                    @endphp

                                    <textarea class="form-control" id="catatan" name="isi_catatan" rows="3" placeholder="Tulis Keterangan ...">{{ trim($isiCatatan) }}</textarea>


                                </div>
                                <input type="hidden" value="{{ $proposal->id }}" name="id_proposal">

                                <!-- Button Section: Right Aligned -->
                                <div class="d-flex justify-content-end">
                                    <!-- Tombol Revisi (Merah) -->
                                    <button type="submit" name="action" value="kirim"
                                    class="btn btn-primary me-2 px-4 py-2 text-red-500 bg-[rgba(239,68,68,0.2)] border-2 border-red-500 rounded-lg hover:bg-[rgba(239,68,68,0.4)] hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">
                                    Revisi
                                    </button>

                                    <!-- Tombol Acc (Hijau) -->
                                    <button type="submit" name="action" value="simpan"
                                    class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">
                                    Ke Manager
                                    </button>
                                </div>

                        </div>
                        </form>
                    </div> <!-- Penutup container -->
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    @include('layouts.footer')
</body>

</html>
