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
        @include('layouts.sidebarmanager')
    </aside>

    
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
                                    <select class="form-select" id="kategoriPengajuan">
                                        <option selected>Pengajuan Bantuan UMKM</option>
                                        <option selected>Pengajuan Beasiswa Pendidikan</option>
                                        <option selected>Pengajuan Bantuan Kesehatan/Pengobatan</option>
                                        <option selected>Pengajuan Bantuan Musafir</option>
                                        <option selected>Pengajuan Bantuan (MUALLAF)</option>
                                        <option selected>Pengajuan Bantuan Hutang (GHORIB)</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan dari Front Office</label>
                                    <textarea class="form-control" id="catatan" rows="3" placeholder="kurang ini itu" readonly></textarea>
                                </div>

                                <div class="mb-3">
                                    <hr class="mb-3">
                                    <label for="persetujuanProposal" class="form-label">Persetujuan Proposal:</label>
                                    <div>
                                        <button class="btn btn-success custom-hover me-2" id="btn-acc">ACC</button>
                                        <button class="btn btn-danger custom-hover me-2" id="btn-tolak">Tolak</button>
                                        <button class="btn btn-warning custom-hover" id="btn-disposisi">Disposisi</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                            
                            </div>
                    </div>
                </div>
                
<!-- Card Disposisi -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="card-disposisi" class="card shadow p-3 mb-3" style="display: none; max-width: 100%; margin: 0;">
                <div class="card-body">
                    <h5 class="card-title">Disposisi</h5>
                    <div class="mb-3">
                        <label for="disposisi-ke" class="form-label">Disposisi Ke:</label>
                        <select id="disposisi-ke" class="form-select">
                            <option value="" selected>- Disposisi Ke -</option>
                            <option id="program" value="Program">Program</option>
                            <option id="bp" value="BP">Badan Pengurus</option>
                        </select>
                    </div>

                    <!-- Message Section -->
                    <div class="mb-3" id="message-section" style="display: none;">
                        <label for="catatan-manager" class="form-label">Catatan Manager:</label>
                        <textarea id="catatan-manager" class="form-control" rows="3" placeholder="Tulis catatan ..."></textarea>
                    </div>

                    <!-- File Upload Section for BP -->
                    <div class="mb-3" id="file-section" style="display: none;">
                        <label for="file-assessment" class="form-label">Unggah File:</label>
                        <input type="file" id="file-assessment" class="form-control">
                    </div>

                    <button id="btn-kirim" class="btn btn-primary">Kirim</button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- TESTING BUTTON KIRIM DI PAGE PROGRAM DAN BP -->

<!-- Tombol untuk menerima catatan dari Program -->
{{-- <button id="btn-terima-program" class="btn btn-primary">Terima Catatan dari Program</button> --}}

<!-- Tombol untuk menerima catatan dari BP -->
{{-- <button id="btn-terima-bp" class="btn btn-primary">Terima Catatan dari BP</button> --}}

<!-- Tempat untuk menampilkan catatan -->
<div class="container mt-4" id="catatan-container"></div>

<!-- FORMULIR PENGAJUAN -->
<!-- Formulir Pengajuan -->
                           <!-- Formulir Pengajuan Proposal -->
<div id="formulirPengajuan" style="display: none;">
    <div class="card p-4 shadow-lg">
        <h5 class="mb-5 text-center">Formulir Pengajuan Proposal</h5>
        
        <!-- Pilar Program -->
        <div class="mb-4">
            <label class="form-label fw-bold">Pilar Program :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" id="pendidikan"><label for="pendidikan" class="ms-2"> Pendidikan</label>
                </div>
                <div>
                    <input type="checkbox" id="kemanusiaan"><label for="kemanusiaan" class="ms-2"> Kemanusiaan</label>
                </div>
                <div>
                    <input type="checkbox" id="dakwah"><label for="dakwah" class="ms-2"> Dakwah Sosial</label>
                </div>
                <div>
                    <input type="checkbox" id="ekonomi"><label for="ekonomi" class="ms-2"> Ekonomi</label>
                </div>
                <div>
                    <input type="checkbox" id="kesehatan"><label for="kesehatan" class="ms-2"> Kesehatan</label>
                </div>
                <div>
                    <input type="checkbox" id="lingkungan"><label for="lingkungan" class="ms-2"> Lingkungan</label>
                </div>
                <div>
                    <input type="checkbox" id="lainnya"><label for="lainnya" class="ms-2"> Lainnya...</label>
                </div>
            </div>
        </div>

        <!-- Sasaran Ashnaf -->
        <div class="mb-4">
            <label class="form-label fw-bold">Sasaran Ashnaf :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" id="faqir"><label for="faqir" class="ms-2"> Faqir</label>
                </div>
                <div>
                    <input type="checkbox" id="miskin"><label for="miskin" class="ms-2"> Miskin</label>
                </div>
                <div>
                    <input type="checkbox" id="ibnusabil"><label for="ibnusabil" class="ms-2"> Ibnu Sabil</label>
                </div>
                <div>
                    <input type="checkbox" id="riqob"><label for="riqob" class="ms-2"> Riqob</label>
                </div>
                <div>
                    <input type="checkbox" id="gharim"><label for="gharim" class="ms-2"> Gharim</label>
                </div>
                <div>
                    <input type="checkbox" id="mualaf"><label for="mualaf" class="ms-2"> Mualaf</label>
                </div>
                <div>
                    <input type="checkbox" id="fisabilillah"><label for="fisabilillah" class="ms-2"> Fii Sabilillah</label>
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
                        <td><input type="number" class="form-control" placeholder="0"></td>
                        <td><input type="number" class="form-control" placeholder="0"></td>
                        <td><input type="number" class="form-control" placeholder="0"></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sumber Pendanaan -->
        <div class="mb-4">
            <label class="form-label fw-bold">Sumber Pendanaan :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" id="zakatmal"><label for="zakatmal" class="ms-2"> Zakat Maal/Profesi</label>
                </div>
                <div>
                    <input type="checkbox" id="zakatfitrah"><label for="zakatfitrah" class="ms-2"> Zakat Fitrah</label>
                </div>
                <div>
                    <input type="checkbox" id="infaqterikat"><label for="infaqterikat" class="ms-2"> Infaq Terikat</label>
                </div>
                <div>
                    <input type="checkbox" id="infaq"><label for="infaq" class="ms-2"> Infaq/Shadaqah</label>
                </div>
                <div>
                    <input type="checkbox" id="kebencanaan"><label for="kebencanaan" class="ms-2"> Kebencanaan</label>
                </div>
                <div>
                    <input type="checkbox" id="lainnya"><label for="lainnya" class="ms-2"> Lainnya</label>
                </div>
            </div>
        </div>

        <!-- Dropdown Persetujuan Proposal -->
        <div class="mb-4">
            <label class="form-label fw-bold">Kategori :</label>
            <select class="form-select" id="kategoriSelect">
                <option value="konsumtif" class="text-success">Konsumtif</option>
                <option value="produktif" class="text-warning">Produktif</option>
            </select>
        </div>

        <!-- Jumlah Pendanaan -->
        <div class="mb-4">
            <label for="jumlahPendanaan" class="form-label fw-bold">Jumlah Pendanaan :</label>
            <input type="text" id="jumlahPendanaan" class="form-control" placeholder="Rp.">
        </div>

        <!-- Sasaran Ashnaf -->
        <div class="mb-4">
            <label class="form-label fw-bold">Pencairan Via :</label>
            <div class="d-flex flex-wrap gap-3">
                <div>
                    <input type="checkbox" id="cash"><label for="faqir" class="ms-2"> Cash</label>
                </div>
                <div>
                    <input type="checkbox" id="tf"><label for="miskin" class="ms-2"> TF</label>
                </div>
            </div>
        </div>

        <!-- Message Section -->
        <div class="mb-3" id="message-section">
            <label for="catatan-manager" class="form-label fw-bold">Catatan Manager:</label>
            <textarea id="catatan-manager" class="form-control" rows="3" placeholder="Tulis catatan ..."></textarea>
        </div>

        <!-- Simpan Button -->
        <div class="text-end">
            <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Simpan</button>
        </div>
    </div>
</div>


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

<!-- Footer -->
@include('layouts.footer')
</html>
