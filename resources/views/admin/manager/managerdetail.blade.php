<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Manager</title>
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
    @php
        $anggaranDiajukan = $proposal->anggaran_diajukan ?? 0;
        $perluCatatan = $anggaranDiajukan > 5000000; // True jika anggaran > 5 juta
        $adaCatatan = !empty($catatanBPtoManager) || !empty($catatanProgramToManager); // True jika salah satu catatan ada
    @endphp

    
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container py-8 px-4">
                <!-- Header -->
                    <header class="mb-4 mt-5">
                        <h1 class="fw-bold fs-5">Manager</h1>
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
                            
                                {{-- <div class="mb-3">
                                    <strong>No. Surat:</strong>
                                    <p>005/Pan-SemNas/XII/2024</p>
                                </div> --}}
                            
                                <div class="mb-3">
                                    <strong>Kontak:</strong>
                                    <p>{{$proposal->kontak}}</p>
                                </div>
                            
                                <div class="mb-3">
                                    <strong>Tanggal:</strong>
                                    <p>{{$proposal->tgl_masuk}}</p>
                                </div>
                            
                                <div class="mb-3">
                                    <strong>Anggaran:</strong>
                                    <p>{{$proposal->anggaran_diajukan}}</p>
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

                                <div class="mb-3">
                                    <label for="kategoriPengajuan" class="form-label">Kategori Pengajuan</label>
                                    <select class="form-select" id="kategoriPengajuan" disabled>
                                        <option selected>{{ $proposal->kategori_pengajuan ?? 'Pilih Kategori' }}</option>
                                    </select>
                                </div>                                

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan dari Front Office</label>
                                    <textarea class="form-control" id="catatan" rows="3" placeholder="kurang ini itu" readonly>{{$catatanFOtoManager->isi_catatan}}</textarea>
                                </div>

                                @if(!empty($catatanBPtoManager))
                                    <div class="mb-3">
                                        <label for="catatan" class="form-label">Catatan dari BP</label>
                                        <textarea class="form-control" id="catatan" rows="3" placeholder="kurang ini itu" readonly>{{ $catatanBPtoManager->isi_catatan }}</textarea>
                                    </div>
                                @endif

                                @if($proposal->status == "Diterima")
                                    <div class="container mt-4">
                                        <div class="card shadow-sm">
                                            <div class="card-body p-4">
                                                <h3 class="card-title text-center mb-3">Detail Pengajuan Proposal</h3>
                                                
                                                <div class="mb-3">
                                                    <strong>Pilar Program:</strong>
                                                    <p>{{ $proposal->pilar }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Sasaran Ashnaf:</strong>
                                                    <p>{{ $proposal->sasaran_ashnaf }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Penerima Laki-laki:</strong>
                                                    <p>{{ $proposal->penerima_laki }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Penerima Perempuan:</strong>
                                                    <p>{{ $proposal->penerima_perempuan }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Total Penerima:</strong>
                                                    <p>{{ $proposal->penerima_total }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Sumber Pendanaan:</strong>
                                                    <p>{{ $proposal->sumber_pendanaan }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Kategori:</strong>
                                                    <p>{{ ucfirst($proposal->produktif_or_konsumtif) }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Jumlah Pendanaan:</strong>
                                                    <p>Rp. {{ number_format($proposal->jumlah_pendanaan, 0, ',', '.') }}</p>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <strong>Pencairan Via:</strong>
                                                    <p>{{ $proposal->pencairan_via }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Hilangkan Tombol ACC dan Tolak -->
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function() {
                                            document.getElementById("btn-acc").style.display = "none";
                                            document.getElementById("btn-tolak").style.display = "none";
                                            document.getElementById("btn-disposisi").style.display = "none";
                                            document.getElementById("persetujuan_proposal_header").style.display = "none";
                                        });
                                    </script>
                                @endif



                                <div class="mb-3">
                                    <hr class="mb-3 mt-3">
                                    <label for="persetujuanProposal" class="form-label" id="persetujuan_proposal_header">Persetujuan Proposal:</label>
                                    <div>
                                        <button class="btn btn-success custom-hover me-2" id="btn-acc" @if($perluCatatan && !$adaCatatan) 
                                                                                                            disabled 
                                                                                                        @endif>
                                            ACC</button>
                                        <button class="btn btn-danger custom-hover me-2" id="btn-tolak" @if($perluCatatan && !$adaCatatan) 
                                                                                                            disabled 
                                                                                                        @endif>
                                    Tolak</button>
                                        <button class="btn btn-warning custom-hover" id="btn-disposisi">Disposisi</button>
                                    </div>
                                </div>

                            </div>
                            
                            
                            </div>
                    </div>
                </div>
                
<!-- Card Disposisi -->
<form id="form-disposisi" action="{{ route('proposal.storeDisposisi') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id_proposal" value="{{ $proposal->id }}"> <!-- Kirim ID Proposal -->
    <!-- Card Disposisi -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="card-disposisi" class="card shadow p-3 mb-3" style="display: none; max-width: 100%; margin: 0;">
                    <div class="card-body">
                        <h5 class="card-title">Disposisi</h5>
                        <div class="mb-3">
                            <label for="disposisi-ke" class="form-label">Disposisi Ke:</label>
                            <select id="disposisi-ke" name="role_dituju" class="form-select" required>
                                <option value="" selected>- Pilih Tujuan -</option>
                                <option value="Program">Program</option>
                                <option value="BP">Badan Pengurus</option>
                            </select>
                        </div>

                        <!-- Message Section -->
                        <div class="mb-3">
                            <label for="catatan-disposisi" class="form-label">Catatan Disposisi:</label>
                            <textarea id="catatan-disposisi" name="catatan" class="form-control" rows="3" placeholder="Tulis catatan ..." required>
                                {{ old('catatan') }}
                            </textarea>
                        </div>
                  

                        <!-- File Upload Section for BP -->
                        <div class="mb-3" id="file-section" style="display: none;">
                            <label for="file-assessment" class="form-label">Unggah File:</label>
                            <input type="file" id="file-assessment" class="form-control">
                        </div>

                        <button type="submit" id="btn-kirim" class="btn btn-primary">Kirim</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="card shadow p-3 mb-3">
        <div class="card-body">
            <h5 class="card-title">Disposisi</h5>

            <div class="mb-3">
                <label for="disposisi-ke" class="form-label">Disposisi Ke:</label>
                <select id="disposisi-ke" name="role_dituju" class="form-select" required>
                    <option value="" selected>- Pilih Tujuan -</option>
                    <option value="Program">Program</option>
                    <option value="BP">Badan Pengurus</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="catatan-disposisi" class="form-label">Catatan Disposisi:</label>
                <textarea id="catatan-disposisi" name="catatan" class="form-control" rows="3" placeholder="Tulis catatan ..." required></textarea>
            </div>

            <!-- File Upload Section for BP -->
            <div class="mb-3" id="file-section" style="display: none;">
                <label for="file-assessment" class="form-label">Unggah File:</label>
                <input type="file" id="file-assessment" name="file_assessment" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Kirim Disposisi</button>
        </div>
    </div> --}}
</form>




<!-- TESTING BUTTON KIRIM DI PAGE PROGRAM DAN BP -->

<!-- Tombol untuk menerima catatan dari Program -->
{{-- <button id="btn-terima-program" class="btn btn-primary">Terima Catatan dari Program</button> --}}

<!-- Tombol untuk menerima catatan dari BP -->
{{-- <button id="btn-terima-bp" class="btn btn-primary">Terima Catatan dari BP</button> --}}

<!-- Tempat untuk menampilkan catatan -->
{{-- <div class="container mt-4" id="catatan-container"></div> --}}

<!-- FORMULIR PENGAJUAN -->
<!-- Formulir Pengajuan -->
<!-- Formulir Pengajuan Proposal -->

<form id="form-pengajuan" action="{{ route('proposal.storePengajuanManager') }}" method="POST" enctype="multipart/form-data">
@csrf
<div id="formulirPengajuan" style="display: none;">
    <div class="card p-4 shadow-lg">
        <h5 class="mb-5 text-center">Formulir Pengajuan Proposal</h5>
        <input type="hidden" name="id_proposal" value="{{ $proposal->id }}"> <!-- Kirim ID Proposal -->
        <!-- Pilar Program -->
        <div class="mb-4">
            <label class="form-label fw-bold">Pilar Program :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" name="pilar_program" id="pendidikan" class="pilar-checkbox" value="Pendidikan">
                    <label for="pendidikan" class="ms-2"> Pendidikan</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="kemanusiaan" class="pilar-checkbox" value="Kemanusiaan">
                    <label for="kemanusiaan" class="ms-2"> Kemanusiaan</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="dakwah" class="pilar-checkbox" value="Dakwah Sosial">
                    <label for="dakwah" class="ms-2"> Dakwah Sosial</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="ekonomi" class="pilar-checkbox" value="Ekonomi">
                    <label for="ekonomi" class="ms-2"> Ekonomi</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="kesehatan" class="pilar-checkbox" value="Kesehatan">
                    <label for="kesehatan" class="ms-2"> Kesehatan</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="lingkungan" class="pilar-checkbox" value="Lingkungan">
                    <label for="lingkungan" class="ms-2"> Lingkungan</label>
                </div>
                <div>
                    <input type="checkbox" name="pilar_program" id="lainnya" class="pilar-checkbox" value="Lainnya">
                    <label for="lainnya" class="ms-2"> Lainnya...</label>
                </div>
            </div>
        </div>


        <!-- Sasaran Ashnaf -->
        <div class="mb-4">
            <label class="form-label fw-bold">Sasaran Ashnaf :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="faqir" class="ashnaf-checkbox" value="Faqir">
                    <label for="faqir" class="ms-2"> Faqir</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="miskin" class="ashnaf-checkbox" value="Miskin">
                    <label for="miskin" class="ms-2"> Miskin</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="ibnusabil" class="ashnaf-checkbox" value="Ibnu Sabil">
                    <label for="ibnusabil" class="ms-2"> Ibnu Sabil</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="riqob" class="ashnaf-checkbox" value="Riqob">
                    <label for="riqob" class="ms-2"> Riqob</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="gharim" class="ashnaf-checkbox" value="Gharim">
                    <label for="gharim" class="ms-2"> Gharim</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="mualaf" class="ashnaf-checkbox" value="Mualaf">
                    <label for="mualaf" class="ms-2"> Mualaf</label>
                </div>
                <div>
                    <input type="checkbox" name="sasaran_ashnaf" id="fisabilillah" class="ashnaf-checkbox" value="Fii Sabilillah">
                    <label for="fisabilillah" class="ms-2"> Fii Sabilillah</label>
                </div>
            </div>
        </div>


        <!-- Tabel Penerima Manfaat -->
        <div class="mb-4">
            <label class="form-label fw-bold">Tabel Penerima Manfaat :</label>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Laki-Laki</th>
                        <th>Perempuan</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="number" class="form-control" placeholder="0" name="jumlah_laki"></td>
                        <td><input type="number" class="form-control" placeholder="0" name="jumlah_perempuan"></td>
                        <td><input type="number" class="form-control" placeholder="0" name="jumlah_total"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sumber Pendanaan -->
        <div class="mb-4">
            <label class="form-label fw-bold">Sumber Pendanaan :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="zakatmal" class="pendanaan-checkbox" value="Zakat Maal/Profesi">
                    <label for="zakatmal" class="ms-2"> Zakat Maal/Profesi</label>
                </div>
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="zakatfitrah" class="pendanaan-checkbox" value="Zakat Fitrah">
                    <label for="zakatfitrah" class="ms-2"> Zakat Fitrah</label>
                </div>
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="infaqterikat" class="pendanaan-checkbox" value="Infaq Terikat">
                    <label for="infaqterikat" class="ms-2"> Infaq Terikat</label>
                </div>
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="infaq" class="pendanaan-checkbox" value="Infaq/Shadaqah">
                    <label for="infaq" class="ms-2"> Infaq/Shadaqah</label>
                </div>
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="kebencanaan" class="pendanaan-checkbox" value="Kebencanaan">
                    <label for="kebencanaan" class="ms-2"> Kebencanaan</label>
                </div>
                <div>
                    <input type="checkbox" name="sumber_pendanaan" id="lainnya" class="pendanaan-checkbox" value="Lainnya">
                    <label for="lainnya" class="ms-2"> Lainnya</label>
                </div>
            </div>
        </div>


        <!-- Dropdown Persetujuan Proposal -->
        <div class="mb-4">
            <label class="form-label fw-bold">Kategori :</label>
            <select class="form-select" id="kategoriSelect" name="produktif_or_konsumtif">
                <option value="konsumtif" class="text-success">Konsumtif</option>
                <option value="produktif" class="text-warning">Produktif</option>
            </select>
        </div>

        <!-- Jumlah Pendanaan -->
        <div class="mb-4">
            <label for="jumlahPendanaan" class="form-label fw-bold">Jumlah Pendanaan :</label>
            <input type="text" id="jumlahPendanaan" class="form-control" placeholder="Rp." name="jumlah_pendanaan">
        </div>

        <!-- Pencairan Dana -->
        <div class="mb-4">
            <label class="form-label fw-bold">Pencairan Via :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" name="pencairan_dana" id="cash" class="pencairan-checkbox" value="Cash">
                    <label for="cash" class="ms-2"> Cash</label>
                </div>
                <div>
                    <input type="checkbox" name="pencairan_dana" id="tf" class="pencairan-checkbox" value="TF">
                    <label for="tf" class="ms-2"> TF</label>
                </div>
            </div>
        </div>


        <!-- Message Section -->
        <div class="mb-3" id="message-section">
            <label for="catatan-manager" class="form-label fw-bold">Catatan Manager:</label>
            <textarea id="catatan-manager" class="form-control" rows="3" placeholder="Tulis catatan ..." name="catatan_manager"></textarea>
        </div>

        <!-- Simpan Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Simpan</button>
        </div>
    </div>
</div>
</form>


            </div>
                </div>
            </div>
</body>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const cardDisposisi = document.getElementById("card-disposisi");
    const formPengajuan = document.getElementById("formulirPengajuan"); // Formulir Pengajuan
    const btnAcc = document.getElementById("btn-acc"); // Tombol ACC
    const btnTolak = document.getElementById("btn-tolak"); // Tombol Tolak
    const btnDisposisi = document.getElementById("btn-disposisi"); // Tombol Disposisi

    // Event Listener Tombol Disposisi
    btnDisposisi.addEventListener("click", () => {
        cardDisposisi.style.display = "block"; // Tampilkan Card Disposisi
    });

    // Event Listener Tombol ACC
    btnAcc.addEventListener("click", () => {
        formPengajuan.style.display = "block"; // Tampilkan Formulir Pengajuan
        cardDisposisi.style.display = "none"; // Sembunyikan Card Disposisi jika ada
    });

    // Event Listener Tombol Tolak
    btnTolak.addEventListener("click", () => {
        alert("Proposal Ditolak"); // Menampilkan alert jika ditolak
        cardDisposisi.style.display = "none"; // Sembunyikan Card Disposisi jika ada
    });

    // Element references for the form
    const disposisiKe = document.getElementById("disposisi-ke");
    const messageSection = document.getElementById("message-section");
    const btnKirim = document.getElementById("btn-kirim");

    // Event listener for disposisi-ke dropdown
    disposisiKe.addEventListener("change", (event) => {
        const selectedOption = event.target.value;

        // Reset visibility
        messageSection.style.display = "none";

        // Show sections based on the selected option
        if (selectedOption === "Program") {
            messageSection.style.display = "block"; // Show message section for Program
        } else if (selectedOption === "BP") {
            messageSection.style.display = "block"; // Show message section
        }
    });

    // Event Listener Tombol Kirim
    btnKirim.addEventListener("click", () => {
        const disposisiKeValue = disposisiKe.value;
        const catatanManager = document.getElementById("catatan-manager").value;

        if (!disposisiKeValue) {
            alert("Harap pilih tujuan disposisi.");
            return;
        }

        if (!catatanManager) {
            alert("Harap isi catatan manager.");
            return;
        }

        // Logika pengiriman data berdasarkan tujuan
        if (disposisiKeValue === "Program") {
            // Kirim data ke Program
            console.log("Kirim ke Program:", {
                catatanManager,
            });
        } else if (disposisiKeValue === "BP") {
            // Kirim data ke BP (termasuk file)
            console.log("Kirim ke BP:", {
                catatanManager,
            });
        }

        // Sembunyikan Card setelah submit
        cardDisposisi.style.display = "none";
        alert("Disposisi berhasil dikirim!");
    });
});


document.addEventListener("DOMContentLoaded", () => {
    const catatanContainer = document.getElementById("catatan-container");
    const formulirPengajuan = document.getElementById("formulirPengajuan");

    function tampilkanCatatanDanFile(jenis, catatan, file = null) {
        const catatanId = Date.now();
        const catatanElement = document.createElement("div");
        catatanElement.classList.add("card", "mb-3");

        let fileContent = "";
        if (file) {
            const fileExtension = file.name.split(".").pop().toLowerCase();
            if (["jpg", "jpeg", "png"].includes(fileExtension)) {
                fileContent = `<img src="${URL.createObjectURL(file)}" class="img-fluid" alt="File Gambar" />`;
            } else if (fileExtension === "pdf") {
                fileContent = `<embed src="${URL.createObjectURL(file)}" width="100%" height="400px" type="application/pdf" />`;
            } else {
                fileContent = `<a href="${URL.createObjectURL(file)}" download="${file.name}" class="btn btn-secondary">Unduh ${file.name}</a>`;
            }
        }

        catatanElement.innerHTML = `
            <div class="card-body">
                <h5 class="card-title">Catatan dari: ${jenis}</h5>
                <p>${catatan}</p>
                ${fileContent}
                <div class="mt-3">
                    <button class="btn btn-success btn-acc" data-id="${catatanId}" data-jenis="${jenis}">Acc</button>
                    <button class="btn btn-danger btn-tolak" data-id="${catatanId}" data-jenis="${jenis}">Tolak</button>
                </div>
            </div>
        `;

        catatanContainer.appendChild(catatanElement);

        // Tombol Acc
        catatanElement.querySelector(".btn-acc").addEventListener("click", (e) => {
            const id = e.target.getAttribute("data-id");
            const jenis = e.target.getAttribute("data-jenis");

            // Tampilkan formulir pengajuan
            formulirPengajuan.classList.remove("hidden");
            // Menampilkan bagian Message Section
            document.getElementById('message-section').style.display = 'block';
            alert(`Formulir pengajuan akan digunakan untuk tindak lanjut catatan ID ${id} dari ${jenis}.`);
        });

        // Tombol Tolak
        catatanElement.querySelector(".btn-tolak").addEventListener("click", (e) => {
            const id = e.target.getAttribute("data-id");
            alert(`Catatan ID ${id} telah ditolak dan langsung terkirim ke FO.`);
        });
    }

    // Tombol Terima Catatan Program
    document.getElementById("btn-terima-program").addEventListener("click", () => {
        const catatanProgram = "Catatan tentang pekerjaan yang harus dilakukan.";
        const fileProgram = new File(["dummy content"], "program-sample.pdf", { type: "application/pdf" });
        tampilkanCatatanDanFile("Program", catatanProgram, fileProgram);
    });

    // Tombol Terima Catatan BP
    document.getElementById("btn-terima-bp").addEventListener("click", () => {
        const catatanBP = "Catatan tentang laporan yang perlu diperbaiki.";
        tampilkanCatatanDanFile("BP", catatanBP);
    });
});

</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Fungsi untuk membatasi pilihan hanya satu checkbox dalam setiap kategori
        function limitCheckboxSelection(checkboxClass) {
            const checkboxes = document.querySelectorAll("." + checkboxClass);
    
            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", function() {
                    if (this.checked) {
                        checkboxes.forEach(cb => {
                            if (cb !== this) {
                                cb.checked = false; // Matikan checkbox lainnya
                            }
                        });
                    }
                });
            });
        }
    
        // Batasi hanya satu pilihan untuk Pilar Program
        limitCheckboxSelection("pilar-checkbox");
    
        // Batasi hanya satu pilihan untuk Sasaran Ashnaf
        limitCheckboxSelection("ashnaf-checkbox");
    
        // Batasi hanya satu pilihan untuk Sumber Pendanaan
        limitCheckboxSelection("pendanaan-checkbox");

        // Batasi hanya satu pilihan untuk Pencairan Dana
        limitCheckboxSelection("pencairan-checkbox");
    });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const disposisiKe = document.getElementById("disposisi-ke");
        const catatanDisposisi = document.getElementById("catatan-disposisi");

        // Nilai default dari server-side
        const catatanManagerToBP = @json($catatanManagerToBP->isi_catatan ?? '');
        const catatanManagerToProgram = @json($catatanManagerToProgram->isi_catatan ?? '');

        disposisiKe.addEventListener("change", function() {
            if (this.value === "BP") {
                catatanDisposisi.value = catatanManagerToBP; // Tampilkan catatan ke BP
            } else if (this.value === "Program") {
                catatanDisposisi.value = catatanManagerToProgram; // Tampilkan catatan ke Program
            } else {
                catatanDisposisi.value = ''; // Kosongkan jika tidak ada pilihan
            }
        });

        // Menampilkan nilai saat halaman pertama kali dimuat (jika ada old value)
        if (disposisiKe.value === "BP") {
            catatanDisposisi.value = catatanManagerToBP;
        } else if (disposisiKe.value === "Program") {
            catatanDisposisi.value = catatanManagerToProgram;
        }
    });

    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const formPengajuan = document.getElementById("form-pengajuan");

            formPengajuan.addEventListener("submit", function(event) {
                event.preventDefault(); // Mencegah submit form secara langsung

                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Pastikan semua data yang diisi sudah benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, kirim!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        formPengajuan.submit(); // Kirim form jika user yakin
                    }
                });
            });
        });
    </script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    
         
<!-- Footer -->
@include('layouts.footer')
</html>
