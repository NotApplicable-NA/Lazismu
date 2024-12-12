<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Persetujuan Admin</title>
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
                    <h1 class="fw-bold fs-5">Informasi Proposal Mitra</h1>
                    <hr class="custom-underline">
                </header>

                <div class="container mt-5">
    <div class="card shadow" x-data="{ tab: 'front-office' }">
        <!-- Tabs -->
        <div class="card-header text-white" style="background-color: #FF8D1B;">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <button
                        class="nav-link "
                        :class="{ 'bg-white text-black': tab === 'front-office', 'text-white': tab !== 'front-office' }"
                        @click="tab = 'front-office'"
                    >
                        Front Office
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        class="nav-link"
                        :class="{ 'bg-white text-black': tab === 'manager', 'text-white': tab !== 'manager' }"
                        @click="tab = 'manager'"
                    >
                        Manager
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        class="nav-link"
                        :class="{ 'bg-white text-black': tab === 'program', 'text-white': tab !== 'program' }"
                        @click="tab = 'program'"
                    >
                        Program
                    </button>
                </li>
                <li class="nav-item">
                    <button
                        class="nav-link"
                        :class="{ 'bg-white text-black': tab === 'keuangan', 'text-white': tab !== 'keuangan' }"
                        @click="tab = 'keuangan'"
                    >
                        Keuangan
                    </button>
                </li>
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="card-body">
            <!-- Front Office -->
            <div x-show="tab === 'front-office'">
                <h5 class="fw-bold mb-5 text-center">Front Office</h5>
                <hr>
                <form>
                <div class="mb-3">
                    <label for="judulProposal" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="judulProposal" value="Seminar Nasional IMM FTI UAD" readonly>
                </div>
                <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="kategori" value="Lembaga" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="namaPengirim" class="form-label">Nama Pengirim</label>
                                <input type="text" class="form-control" id="namaPengirim" value="IMM FTI UAD" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="noSurat" class="form-label">No. Surat</label>
                                <input type="text" class="form-control" id="noSurat" value="005/Pan-SemNas/XII/2024" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" value="0823411244123" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="text" class="form-control" id="tanggal" value="25 November 2024" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="anggaran" class="form-label">Anggaran</label>
                                <input type="text" class="form-control" id="anggaran" value="Rp. 1.500.000,00" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="fileProposal" class="form-label">File Proposal</label>
                                <a href="#" class="d-block text-truncate" id="fileProposal">
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
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" rows="3" placeholder="Tulis Keterangan ..."></textarea>
                            </div>

                            <!-- Button Section: Right Aligned -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2 px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Kirim</button>
                                <button type="button" class="btn btn-success px-4 py-2 text-red-500 bg-[rgba(239,68,68,0.2)] border-2 border-red-500 rounded-lg hover:bg-[rgba(239,68,68,0.4)] hover:text-red-700 focus:outline-none focus:ring-2 focus:ring-red-300">Simpan</button>
                            </div>
                </form>
            </div>

            <!-- Manager -->
            <div x-show="tab === 'manager'">
                <h5 class="fw-bold mb-5 text-center">Manager</h5>
                <hr>
                <form>
                <div class="mb-3">
                    <label for="judulProposal" class="form-label">Judul Proposal</label>
                    <input type="text" class="form-control" id="judulProposal" value="Seminar Nasional IMM FTI UAD" readonly>
                </div>
                <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <input type="text" class="form-control" id="kategori" value="Lembaga" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="namaPengirim" class="form-label">Nama Pengirim</label>
                                <input type="text" class="form-control" id="namaPengirim" value="IMM FTI UAD" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="noSurat" class="form-label">No. Surat</label>
                                <input type="text" class="form-control" id="noSurat" value="005/Pan-SemNas/XII/2024" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="kontak" class="form-label">Kontak</label>
                                <input type="text" class="form-control" id="kontak" value="0823411244123" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="text" class="form-control" id="tanggal" value="25 November 2024" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="anggaran" class="form-label">Anggaran</label>
                                <input type="text" class="form-control" id="anggaran" value="Rp. 1.500.000,00" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="fileProposal" class="form-label">File Proposal</label>
                                <a href="#" class="d-block text-truncate" id="fileProposal">
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
                                <label for="catatan" class="form-label">Catatan</label>
                                <textarea class="form-control" id="catatan" rows="3" placeholder="Tulis Keterangan ..."></textarea>
                            </div>
                             <!-- Radio Button Persetujuan -->
                            <div class="mb-4">
                                <label class="form-label fw-bold">Persetujuan Proposal:</label>
                                <div class="d-flex gap-3">
                                    <div>
                                        <input type="radio" id="acc" name="persetujuan" value="acc">
                                        <label for="acc" class="btn btn-outline-success">ACC</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="tolak" name="persetujuan" value="tolak">
                                        <label for="tolak" class="btn btn-outline-danger">Tolak</label>
                                    </div>
                                </div>
                            </div>
                            <!-- Formulir Pengajuan Proposal -->
                            <div id="formulirPengajuan" class="hidden">
                                <h5 class="mb-5 text-center">Formulir Pengajuan Proposal</h5>
                                <!-- Pilar Program -->
                                <div class="mb-4">
                                    <label class="form-label">Pilar Program :</label>
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
                            <label class="form-label">Sasaran Ashnaf :</label>
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
                            <label class="form-label">Tabel Penerima Manfaat :</label>
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
                            <label class="form-label">Sumber Pendanaan :</label>
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

                        <!-- Jumlah Pendanaan -->
                        <div class="mb-4">
                            <label for="jumlahPendanaan" class="form-label">Jumlah Pendanaan :</label>
                            <input type="text" id="jumlahPendanaan" class="form-control" placeholder="Rp.">
                        </div>

                        <!-- Dropdown Persetujuan Proposal -->
                        <div class="mb-4">
                            <label class="form-label fw-bold">Kategori :</label>
                            <select class="form-select" id="kategoriSelect">
                                <option value="konsumtif" class="text-success">Konsumtif</option>
                                <option value="produktif" class="text-warning">Produktif</option>
                            </select>
                        </div>

                        <!-- Simpan Button -->
                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Simpan</button>
                        </div>
                    </div>
                    </div>
                </form>
            

            <!-- Program -->
            <div x-show="tab === 'program'">
    <h5 class="fw-bold text-center">Program</h5>
    <hr>
    <form>                      
        <!-- Dropdown Pemohon -->
        <div class="mb-3 d-flex align-items-center">
            <label for="pemohon" class="form-label me-3">Pemohon :</label>
            <select id="pemohon" class="form-select" style="width: 200px;">
                <option value="" selected>-Pemohon-</option>
                <option value="pemohon1">Arsil</option>
                <option value="pemohon2">Dini</option>
            </select>
        </div>

        <!-- Tabel Kegiatan -->
        <table class="table table-bordered text-center">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Nominal</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nama Kegiatan 1</td>
                    <td>Rp0</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Kegiatan 2</td>
                    <td>Rp0</td>
                </tr>
                <!-- Tambahkan baris jika perlu -->
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="fw-bold">Total</td>
                    <td>Rp0</td>
                </tr>
            </tfoot>
        </table>

        <!-- Detail Pencairan -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="via" class="form-label">Pencairan Dana Via</label>
                <input type="text" id="via" class="form-control" placeholder="Masukkan via pencairan">
            </div>
            <div class="col-md-6 mb-3">
                <label for="tanggal" class="form-label">Tgl Pencairan</label>
                <input type="date" id="tanggal" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="asnaf" class="form-label">Asnaf</label>
                <input type="text" id="asnaf" class="form-control" placeholder="Masukkan asnaf">
            </div>
            <div class="col-md-6 mb-3">
                <label for="pilar" class="form-label">Pilar Program</label>
                <input type="text" id="pilar" class="form-control" placeholder="Masukkan pilar program">
            </div>
        </div>

        <!-- Catatan Program -->
        <div class="mb-3">
            <label for="catatan" class="form-label">Catatan Program</label>
            <textarea id="catatan" class="form-control" rows="3" placeholder="Tulis keterangan ..."></textarea>
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Simpan</button>
    </form>
</div>


            <!-- Keuangan -->
            <div x-show="tab === 'keuangan'">
            <h5 class="fw-bold text-center">Keuangan</h5>
            <hr>
            <form>                      
                <!-- Dropdown Pemohon -->
                <div class="mb-3">
                <div id="output-form" class="mt-3">
                    <label for="output" class="form-label fw-bold">Pemohon :</label>
                    <input type="text" id="output" class="form-control" readonly placeholder="Belum ada pemohon yang dipilih">
                </div>
                </div>

                <!-- Tabel Kegiatan -->
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Kegiatan</th>
                            <th>Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Nama Kegiatan 1</td>
                            <td>Rp0</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Nama Kegiatan 2</td>
                            <td>Rp0</td>
                        </tr>
                        <!-- Tambahkan baris jika perlu -->
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="fw-bold">Total</td>
                            <td>Rp0</td>
                        </tr>
                    </tfoot>
                </table>

                <!-- Detail Pencairan -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="via" class="form-label">Pencairan Dana Via</label>
                        <input type="text" id="via" class="form-control" placeholder="Masukkan via pencairan">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal" class="form-label">Tgl Pencairan</label>
                        <input type="date" id="tanggal" class="form-control">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="asnaf" class="form-label">Asnaf</label>
                        <input type="text" id="asnaf" class="form-control" placeholder="Masukkan asnaf">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="pilar" class="form-label">Pilar Program</label>
                        <input type="text" id="pilar" class="form-control" placeholder="Masukkan pilar program">
                    </div>
                </div>

                <!-- Catatan Program -->
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan Keuangan</label>
                    <textarea id="catatan" class="form-control" rows="3" placeholder="Tulis keterangan ..."></textarea>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Simpan</button>
            </form>
        </div>
            </div>
        </div>
    </div>
</div>
        </div>
        </div>
        <!-- SCRIPT JS MANAGER-->
        <script>
        const accButton = document.getElementById("acc");
        const tolakButton = document.getElementById("tolak");
        const formulirPengajuan = document.getElementById("formulirPengajuan");

        accButton.addEventListener("change", () => {
            if (accButton.checked) {
                formulirPengajuan.classList.remove("hidden");
            }
        });

        tolakButton.addEventListener("change", () => {
            if (tolakButton.checked) {
                formulirPengajuan.classList.add("hidden");
            }
        });

         // Event listener untuk menampilkan output di form lain
        document.getElementById('pemohon').addEventListener('change', function () {
        const selectedPemohon = this.options[this.selectedIndex].text; // Ambil teks dari opsi yang dipilih
        const outputField = document.getElementById('output'); // Ambil input field untuk output
        outputField.value = selectedPemohon !== "-Pemohon-" 
            ? selectedPemohon 
            : "Belum ada pemohon yang dipilih";
        });
    </script>
    </body>
    <div class="footer d-flex justify-content-center">
    lazismudiy.or.id
</div>

</html>
