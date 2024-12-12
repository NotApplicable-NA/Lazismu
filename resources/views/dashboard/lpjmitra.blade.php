<!DOCTYPE html>
<html lang="en" class="h-full bg-white">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Proposal Lazismu</title>
     <!-- favicon -->
     <link rel="icon" type="image/png" href="/img/favicon.jpg">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Styles / Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @vite('resources/css/app.css')
    
</head>
<body>
    <!-- Navbar -->
    @include('layouts.navbarMLO')

<!-- Form Pengajuan Proposal -->
<div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">Laporan Pertanggung Jawaban</h3>
                <p class="text-center">Silahkan isi Laporan Pertanggun Jawaban anda dibawah ini</p>
                
                <form>
                    <!-- Judul Proposal -->
                    <div class="mb-3">
                        <label for="judulProposal" class="form-label">Judul Proposal</label>
                        <input type="text" class="form-control" id="judulProposal" value="Musyawarah Komisariat">
                    </div>
                    
                    <!-- Nama Proposal -->
                    <div class="mb-3">
                        <label for="judulProposal" class="form-label">Nama Instansi</label>
                        <input type="text" class="form-control" id="namaProposal" value="PT. Mitra Jaya Indonesia">
                    </div>

                    <!-- PEMASUKAN -->
                    <div class="mb-3">
                        <label for="kontak" class="form-label fw-bold">PEMASUKAN</label>
                    </div>
                    
                    <!-- DANA DISETUJUI -->
                    <div class="mb-3">
                        <label for="danadisetujui" class="form-label">Dana Disetujui</label>
                        <input type="int" class="form-control" id="danadisetujui" value="10.000.000" readonly>
                    </div>
                    
                    <!-- TOTAL PENGELUARAN -->
                    <div class="mb-3">
                        <label for="totalpengeluaran" class="form-label">Total Pengeluaran</label>
                        <input type="text" class="form-control" id="totalpengeluaran">
                    </div>

                    <!-- File LPJ -->
                    <div class="mb-3">
                        <label for="fileLPJ" class="form-label">File LPJ</label>
                        <input type="file" class="form-control" id="fileLPJ">
                    </div>

                    <div class="mb-3">
                        <label for="catatanLPJ" class="form-label">Catatan LPJ</label>
                        <textarea class="form-control" id="catatanLPJ" rows="3" placeholder="Tulis Keterangan File LPJ"></textarea>
                    </div>

                    <!-- File Bukti sisa dana -->
                    <div class="mb-3">
                        <label for="sisadana" class="form-label">Bukti Sisa Dana</label>
                        <input type="file" class="form-control" id="sisadana">
                    </div>

                    <!-- Button Kirim (Posisi Kanan) -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
