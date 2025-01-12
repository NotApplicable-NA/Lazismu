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
    <link rel="stylesheet" href="<?php echo e(mix('css/app.css')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    
</head>
<body>
    <!-- Navbar -->
    <?php echo $__env->make('layouts.navbarMLO', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

 <!-- Form Pengajuan Proposal -->
 <div class="container mt-5 mb-5">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">Edit Data Pengajuan Proposal</h3>
                <p class="text-center">Silahkan edit data Proposal anda dibawah ini</p>
                
                <form>
                    <!-- Judul Proposal -->
                    <div class="mb-3">
                        <label for="judulProposal" class="form-label">Judul Proposal</label>
                        <input type="text" class="form-control" id="judulProposal" placeholder="Masukkan judul proposal">
                    </div>
                    
                    <!-- Kategori -->
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori">
                            <option selected>-Pilih Kategori-</option>
                            <option value="Individu">Individu</option>
                            <option value="Organisasi">Organisasi</option>
                        </select>
                    </div>

                    <!-- Kontak -->
                    <div class="mb-3">
                        <label for="kontak" class="form-label">Kontak</label>
                        <input type="text" class="form-control" id="kontak" placeholder="Masukkan kontak anda">
                    </div>
                    
                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal">
                    </div>
                    
                    <!-- Anggaran -->
                    <div class="mb-3">
                        <label for="anggaran" class="form-label">Anggaran</label>
                        <input type="text" class="form-control" id="anggaran" placeholder="Masukkan anggaran yang dibutuhkan">
                    </div>

                    <!-- File Proposal -->
                    <div class="mb-3">
                        <label for="fileProposal" class="form-label">File Proposal</label>
                        <input type="file" class="form-control" id="fileProposal">
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
    <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
<?php /**PATH D:\laragon\www\Lazismu\resources\views/dashboard/editpropo.blade.php ENDPATH**/ ?>