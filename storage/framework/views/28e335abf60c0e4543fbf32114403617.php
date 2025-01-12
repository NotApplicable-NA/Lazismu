<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mitra</title>
        <!-- favicon -->
        <link rel="icon" type="image/png" href="/img/favicon.jpg">
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Styles / Scripts -->
         <!-- Link CSS Bootstrap dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/app.css">
        <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    </head>
    <body>
    <!-- Sidebar -->
    <aside class="sidebar bg-dark text-white p-3" style="width: 250px;">
        <?php echo $__env->make('layouts.sidebaradmin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow-1" style="margin-left: 250px;">
        <div class="container py-8 px-4">
            <!-- Header -->
                <header class="mb-4 mt-5">
                    <h1 class="fw-bold fs-5">Mitra</h1>
                    <hr class="custom-underline">
                </header>
<!-- Proposal Table -->
<div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Mitra <span class="badge bg-primary"><?php echo e($mitras->count()); ?> users</span></h5>
                </div>
                    <div class="card-body p-3">
        <table class="table table-bordered table-striped text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="table-light align-items-center">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Kontak</th>
                    <th scope="col">Email</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $mitras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mitra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class= "bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td><input type="checkbox"></td>
                    <td><?php echo e($mitra->nama); ?></td>
                    <td><span class="badge <?php echo e($mitra->status ? 'bg-green-500' : 'bg-red-500'); ?> text-white py-1 px-2 rounded"><?php echo e($mitra->status ? 'Aktif' : 'Nonaktif'); ?></span></td>
                    <td><?php echo e($mitra->no_hp); ?></td>
                    <td><?php echo e($mitra->email); ?></td>
                    <td>
                    <div class="inline-flex space-x-4">
                        <!-- edit action -->
                        <a href="#" class="flex items-center py-2 text-base font-medium text-gray-900 dark:text-white dark:hover:underline">
                            <img src="/img/admin-edit.png" alt="Edit action" class="w-5 h-5" />
                        </a>
                        <!-- delete action -->
                        <a href="#" class="flex items-center py-2 text-base font-medium text-gray-900 dark:text-white dark:hover:underline">
                            <img src="/img/admin-trash.png" alt="Delete action" class="w-5 h-5" />
                        </a>
                    </div>
                </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>Showing 1 to 10 of 100 entries</span>
                    <nav>
                        <ul class="pagination mb-0">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>       
        </div>
    </div>
</body>
<!-- Footer -->
<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</html>
<?php /**PATH D:\laragon\www\Lazismu\resources\views/admin/mlodashboard.blade.php ENDPATH**/ ?>