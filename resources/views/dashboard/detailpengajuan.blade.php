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
                    <div class="col-8">: {{ $proposal->judul }}</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Nama Instansi / Individu</div>
                    <div class="col-8">: {{ $proposal->mitra->nama }}</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Kategori</div>
                    <div class="col-8">: {{ $proposal->kategori }}</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Lokasi</div>
                    <div class="col-8">: {{ $proposal->mitra->alamat }}</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Tanggal</div>
                    <div class="col-8">: {{ $proposal->tgl_masuk }}</div>
                </div>
                <div class="row py-2">
                    <div class="col-4">Status</div>
                    <div class="col-8">
                        : <span class="badge-yellow-orange">{{$proposal->status}}</span>
                    </div>
                </div>
                <div class="row py-2">
                    <div class="col-4">File Proposal</div>
                    <div class="col-8">
                        : @if($proposal->file)
                        <a href="{{ asset('storage/proposals/' . $proposal->file) }}" target="_blank" 
                        class="text-blue-500 hover:underline">
                            Buka File Proposal
                        </a>
                        @else
                            <p class="text-gray-500">Tidak ada file proposal yang tersedia.</p>
                        @endif
                    </div>
                </div>
                <div class="row py-2">
                <div class="col-4">LPJ</div>
                <div class="col-8">
                    @if ($proposal->status === 'Diterima' && !is_null($proposal->anggaran_disetujui))
                        @if (!empty($lpj->status) && in_array($lpj->status, ['Pending', 'Diterima']))
                            <div class="d-flex flex-column align-items-start">
                                <div>:
                                {{-- Status LPJ --}}
                                <span class="badge-red text-decoration-none" style="opacity: 0.6; cursor: not-allowed; margin-bottom: 8px;">
                                    {{ ucfirst($lpj->status) }}
                                </span>
                                </div>
                                {{-- Tautan ke File PDF --}}
                                @if (!empty($lpj->file_lpj)) {{-- Periksa apakah file LPJ tersedia --}}
                                    <a href="{{ asset('storage/lpjs/' . $lpj->file_lpj) }}" target="_blank" class="badge-green text-decoration-none">
                                        Buka File LPJ
                                    </a>
                                @else
                                    <span class="badge-grey text-decoration-none" style="opacity: 0.6; cursor: not-allowed;">
                                        File LPJ Tidak Tersedia
                                    </span>
                                @endif
                            </div>
                        @else
                            <a href="{{ route('lpj.create', $proposal->id) }}" class="badge-red text-decoration-none">Belum LPJ</a>
                        @endif
                    @else
                        <span class="badge-red text-decoration-none" style="opacity: 0.6; cursor: not-allowed;">
                            Belum dapat upload LPJ
                        </span>
                    @endif
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
