<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mitra Program</title>
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
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container py-8 px-4">

            <!-- Form yang akan muncul setelah tombol diklik -->
<div id="form-container" class="container mt-5 mb-5">
    <div class="card shadow-sm">
        <div class="card-body p-5">
            <h3 class="card-title text-center mb-2">Permohonan Pencairan Dana</h3>
<!-- Dropdown Persetujuan Proposal -->
<div class="mb-4">
    <label class="form-label fw-bold">Pemohon :</label>
    <select class="form-select" id="kategoriSelect" disabled>
        <option value="konsumtif" class="text-success">Dina</option>
        <option value="produktif" class="text-warning">Arsil</option>
    </select>
</div>
            <h3 class="card-title text-center mb-2">Informasi Proposal Mitra</h3>
            
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

                <!-- Message Section -->
                <div class="mb-3" id="message-section">
                    <label for="catatan-manager" class="form-label fw-bold">Catatan Revisi :</label>
                    <textarea id="catatan-manager" class="form-control" rows="3" placeholder="aman sentosa" readonly></textarea>
                </div>

                <div style="border-top: 2px solid #000; width: 100%; margin-top: 30px; margin-bottom: 30px;"></div>

                    <h5 class="mb-5 text-center">Formulir Pengajuan Proposal</h5>
                    
                    <!-- Pilar Program -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Pilar Program :</label>
                    <div class="d-flex flex-wrap gap-3">
                        <div>
                            <input type="checkbox" id="pendidikan" checked disabled><label for="pendidikan" class="ms-2"> Pendidikan</label>
                        </div>
                        <div>
                            <input type="checkbox" id="kemanusiaan" disabled><label for="kemanusiaan" class="ms-2"> Kemanusiaan</label>
                        </div>
                        <div>
                            <input type="checkbox" id="dakwah" disabled><label for="dakwah" class="ms-2"> Dakwah Sosial</label>
                        </div>
                        <div>
                            <input type="checkbox" id="ekonomi" disabled><label for="ekonomi" class="ms-2"> Ekonomi</label>
                        </div>
                        <div>
                            <input type="checkbox" id="kesehatan" disabled><label for="kesehatan" class="ms-2"> Kesehatan</label>
                        </div>
                        <div>
                            <input type="checkbox" id="lingkungan" disabled><label for="lingkungan" class="ms-2"> Lingkungan</label>
                        </div>
                        <div>
                            <input type="checkbox" id="lainnya" disabled><label for="lainnya" class="ms-2"> Lainnya...</label>
                        </div>
                    </div>
                </div>

                    <!-- Sasaran Ashnaf -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sasaran Ashnaf :</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <input type="checkbox" id="faqir" checked disabled><label for="faqir" class="ms-2"> Faqir</label>
                            </div>
                            <div>
                                <input type="checkbox" id="miskin" disabled><label for="miskin" class="ms-2"> Miskin</label>
                            </div>
                            <div>
                                <input type="checkbox" id="ibnusabil" disabled><label for="ibnusabil" class="ms-2"> Ibnu Sabil</label>
                            </div>
                            <div>
                                <input type="checkbox" id="riqob" disabled><label for="riqob" class="ms-2"> Riqob</label>
                            </div>
                            <div>
                                <input type="checkbox" id="gharim" disabled><label for="gharim" class="ms-2"> Gharim</label>
                            </div>
                            <div>
                                <input type="checkbox" id="mualaf" disabled><label for="mualaf" class="ms-2"> Mualaf</label>
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
                                    <td><input type="number" class="form-control" placeholder="1" disabled></td>
                                    <td><input type="number" class="form-control" placeholder="0" disabled></td>
                                    <td><input type="number" class="form-control" placeholder="0" disabled></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            
                    <!-- Sumber Pendanaan -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Sumber Pendanaan :</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <input type="checkbox" id="zakatmal" checked disabled><label for="zakatmal" class="ms-2" checked disabled> Zakat Maal/Profesi</label>
                            </div>
                            <div>
                                <input type="checkbox" id="zakatfitrah" disabled><label for="zakatfitrah" class="ms-2" disabled> Zakat Fitrah</label>
                            </div>
                            <div>
                                <input type="checkbox" id="infaqterikat" disabled><label for="infaqterikat" class="ms-2" disabled> Infaq Terikat</label>
                            </div>
                            <div>
                                <input type="checkbox" id="infaq" disabled><label for="infaq" class="ms-2" disabled> Infaq/Shadaqah</label>
                            </div>
                            <div>
                                <input type="checkbox" id="kebencanaan" disabled><label for="kebencanaan" class="ms-2" disabled> Kebencanaan</label>
                            </div>
                            <div>
                                <input type="checkbox" id="lainnya" disabled><label for="lainnya" class="ms-2" disabled> Lainnya</label>
                            </div>
                        </div>
                    </div>
            
                    <!-- Dropdown Persetujuan Proposal -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Kategori :</label>
                        <select class="form-select" id="kategoriSelect">
                            <option value="konsumtif" class="text-success" disabled>Konsumtif</option>
                            <option value="produktif" class="text-warning">Produktif</option>
                        </select>
                    </div>
            
                    <!-- Jumlah Pendanaan -->
                    <div class="mb-4">
                        <label for="jumlahPendanaan" class="form-label fw-bold">Jumlah Pendanaan :</label>
                        <input type="text" id="jumlahPendanaan" class="form-control" value="Rp. 1.500.000" readonly>
                    </div>
            
                    <!-- Sasaran Ashnaf -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">Pencairan Via :</label>
                        <div class="d-flex flex-wrap gap-3">
                            <div>
                                <input type="checkbox" id="cash" checked disabled><label for="cash" class="ms-2"> Cash</label>
                            </div>
                            <div>
                                <input type="checkbox" id="tf" disabled><label for="tf" class="ms-2"> TF</label>
                            </div>
                        </div>
                    </div>
            
                    <!-- Message Section -->
                    <div class="mb-3" id="message-section">
                        <label for="catatan-manager" class="form-label fw-bold">Catatan Manager :</label>
                        <textarea id="catatan-manager" class="form-control" rows="3" placeholder="Catatan dari Manager ke Program" readonly></textarea>
                    </div>
            
                    <!-- Date Section -->
                    <div class="mb-3">
                        <label for="date-cair" class="form-label">Tanggal Dicairkan :</label>
                        <input type="date" id="date-cair" class="form-control" />
                    </div>

                    <!-- TTD Section -->
                    <div class="mb-3">
                        <label for="ttd" class="form-label">Tanda Tangan :</label>
                        <input type="file" id="ttd" class="form-control" />
                    </div>

                    <!-- Simpan Button -->
                    <div class="text-end">
                        <button type="submit" class="btn btn-success px-4 py-2 text-green-500 bg-[rgba(34,197,94,0.2)] border-2 border-green-500 rounded-lg hover:bg-[rgba(34,197,94,0.4)] hover:text-green-700 focus:outline-none focus:ring-2 focus:ring-green-300">Kirim</button>
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
