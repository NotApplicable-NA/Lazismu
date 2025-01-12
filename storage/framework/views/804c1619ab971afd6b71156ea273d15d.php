<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Reset Password</h2>
                
                <!-- Status Message -->
                <?php if(session('status')): ?>
                    <div class="alert alert-success text-center">
                        <?php echo e(session('status')); ?>

                    </div>
                <?php endif; ?>

                <!-- Error Message -->
                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form id="forgot-password-form" action="/forgot-password" method="POST">
                    <?php echo csrf_field(); ?> <!-- Token CSRF -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="email" 
                            class="form-control" 
                            id="email" 
                            name="email" 
                            placeholder="Masukkan email Anda" 
                            value="<?php echo e(old('email')); ?>" 
                            required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Kirim Email Reset</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\Lazismu\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>