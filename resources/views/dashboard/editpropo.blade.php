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
                <h3 class="card-title text-center mb-4">Edit Data Pengajuan Proposal</h3>
                <p class="text-center">Silahkan edit data Proposal anda dibawah ini</p>
                
                <form action="{{ route('dashboard.updatepropo', $proposal->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')    
                    <!-- Judul Proposal -->
                    <div class="mb-3">
                        <label for="judulProposal" class="form-label">Judul Proposal</label>
                        <!-- <input type="text" class="form-control" id="judulProposal" placeholder="Masukkan judul proposal"> -->
                        <input type="text" class="form-control" id="judulProposal" name="judul" value="{{ $proposal->judul }}">
                    </div>
                    
                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <option selected>{{ $proposal->kategori }}</option>
                            <option value="Individu">Individu</option>
                            <option value="Organisasi">Organisasi</option>
                        </select>
                    </div>

                    <!-- Kontak -->
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <!-- <input type="text" class="form-control" id="kontak" placeholder="Masukkan kontak anda"> -->
                        <input type="text" class="form-control" id="kontak" name="kontak" value="{{ $proposal->kontak }}">
                    </div>
                    
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tgl_masuk" value="{{ $proposal->tgl_masuk }}">
                    </div>
                    
                    <!-- Anggaran -->
                    <div class="mb-3">
                        <label for="anggaran" class="form-label">Anggaran</label>
                        <!-- <input type="text" class="form-control" id="anggaran" placeholder="Masukkan anggaran yang dibutuhkan"> -->
                        <input type="text" class="form-control" id="anggaran" name="anggaran_diajukan" value="{{ $proposal->anggaran_diajukan }}">
                    </div>

                    <!-- File Proposal -->
                    <div class="mb-3">
                        <label for="fileProposal" class="form-label">File Proposal</label>
                        <input type="file" class="form-control" id="fileProposal" name="file">
                        <small class="text-gray-600">Jika tidak ingin mengganti file, biarkan kosong.</small>
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
