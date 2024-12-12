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

    <!-- Data Proposal -->
    <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-2">Data Proposal</h3>
                <p class="text-center mb-4">Informasi Terkait Proposal</p>

                <!-- Set padding pada setiap row -->
                <div class="row py-2">
                    <div class="col-4">Judul Proposal</div>
                    <div class="col-8">: Proposal pengajuan dana UMKM</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Nama Instansi / Individu</div>
                    <div class="col-8">: Alex Setiawan</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Kategori</div>
                    <div class="col-8">: Sosial</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Lokasi</div>
                    <div class="col-8">: Bantul</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Tanggal</div>
                    <div class="col-8">: 23 Desember 2024</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Status</div>
                    <div class="col-8">
                        : <span class="badge-yellow-orange">Isi Persyaratan</span>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-4">File Proposal</div>
                    <div class="col-8">
                        : <a href="#" class="badge-blue">file.pdf</a>
                    </div>
                </div>
                <div class="row py-2">
                <div class="col-4">LPJ</div>
                <div class="col-8">
                    : <a href="/dashboard/lpjmitra" class="badge-red text-decoration-none">Belum LPJ</a>
                </div>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Revisi</label>
                    <textarea class="form-control" id="catatan" rows="3" placeholder="Kurang ini itu" readonly></textarea>
                </div>
                <!-- File Proposal -->
                <div class="mb-3">
                    <label for="editfileProposal" class="form-label">Upload Revisi Proposal</label>
                    <input type="file" class="form-control" id="editfileProposal">
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
