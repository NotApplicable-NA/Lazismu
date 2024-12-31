<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;

Route::middleware('web')->group(function () {
    Route::post('/login', [MitraController::class, 'login'])->name('mitra.login');
    Route::post('/register', [MitraController::class, 'store'])->name('register.store');
    // Tambahkan route lain di sini
});

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
})->name('logout');

Route::get('/register', function () {
    return view('register');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/dashboardmlo', function () {
        return view('dashboard.dashboardmlo');
    });

    Route::get('/dashboard/proposal', function () {
        return view('dashboard.proposal');
    });

    Route::get('/dashboard/pengajuan', function () {
        return view('dashboard.pengajuan');
    });

    Route::get('/dashboard/profilemlo', function () {
        return view('dashboard.profilemlo');
    });

    Route::get('/dashboard/detailpengajuan', function () {
        return view('dashboard.detailpengajuan');
    });
    
    Route::get('/dashboard/editpropo', function () {
        return view('dashboard.editpropo');
    });
    
    Route::get('/dashboard/lpjmitra', function () {
        return view('dashboard.lpjmitra');
    });

    Route::put('/dashboard/profilemlo', [MitraController::class, 'update'])->name('profile.update');
    // Tambahkan route lain yang butuh proteksi auth
});

Route::get('/admin', function () {
    return view('admin.adminlogin');
});

Route::get('/admin/adminlogin', function () {
    return view('admin.adminlogin');
});

Route::get('/admin/dashboardadmin', function () {
    return view('admin.dashboardadmin');
});

// Route::get('/admin/mlodashboard', function () {
//     return view('admin.mlodashboard');
// });

Route::get('/admin/mlodashboard', [MitraController::class, 'index'])->name('mlos.index');
Route::post('/admin/mlodashboard', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/mlodashboard/{id}', [MitraController::class, 'show'])->name('mlos.show');


Route::get('/admin/proposaldashboard', function () {
    return view('admin.proposaldashboard');
});

Route::get('/admin/admindetail', function () {
    return view('admin.admindetail');
});

Route::get('/admin/profileadmin', function () {
    return view('admin.profileadmin');
});

Route::get('/admin/lpj', function () {
    return view('admin.lpj');
});
