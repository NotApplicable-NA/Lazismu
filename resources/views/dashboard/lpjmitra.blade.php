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
                
                <form action="{{ route('lpj.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_proposal" value="{{ $proposal->id }}">
                    <input type="hidden" name="judul_lpj" value="{{ $proposal->judul }}">
                    <input type="hidden" name="nama_instansi" value="{{ $proposal->mitra->nama }}">
                    <input type="hidden" name="dana_disetujui" value="{{ $proposal->anggaran_disetujui }}">

                    <div class="row mb-2 align-items-center">
                        <label class="col-3 form-label">Judul Proposal</label>
                        <div class="col-9 ps-0">
                            <p class="form-control-plaintext mb-0">{{ $proposal->judul }}</p>
                        </div>
                    </div>

                    <div class="row mb-2 align-items-center">
                        <label class="col-3 form-label">Nama Instansi / Individu</label>
                        <div class="col-9 ps-0">
                            <p class="form-control-plaintext mb-0">{{ $proposal->mitra->nama }}</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            PEMASUKAN
                        </div>
                    </div>

                    <div class="row mb-4 align-items-center">
                        <label class="col-3 form-label">Dana Disetujui</label>
                        <div class="col-9 ps-0">
                            <p class="form-control-plaintext mb-0">{{ $proposal->anggaran_disetujui }}</p>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-12">
                            PENGELUARAN
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="total_pengeluaran" class="col-3 form-label">Total Pengeluaran</label>
                        <div class="col-9 ps-0">
                            <input type="number" class="form-control" name="total_pengeluaran" id="total_pengeluaran">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="file_lpj" class="col-3 form-label">File LPJ</label>
                        <div class="col-9 ps-0">
                            <input type="file" class="form-control" name="file_lpj" id="file_lpj" accept="application/pdf">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <div class="col-12 ps-0">
                            <textarea class="form-control" name="keterangan_lpj" id="keterangan_lpj" rows="3" placeholder="Tulis Keterangan File LPJ (Opsional)"></textarea>
                        </div>
                    </div>

                    <div class="row mb-5 align-items-center">
                        <label for="file_bukti_sisa_dana" class="col-3 form-label">Bukti Sisa Dana</label>
                        <div class="col-9 ps-0">
                            <input type="file" class="form-control" name="file_bukti_sisa_dana" id="file_bukti_sisa_dana" accept="application/pdf">
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success">Simpan LPJ</button>
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
