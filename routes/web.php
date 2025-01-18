<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LPJController;

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

    Route::get('/dashboard/dashboardmlo', [ProposalController::class, 'index'])->name('dashboardmlo.index');

    Route::get('/dashboard/proposal', [ProposalController::class, 'index'])->name('proposal.index');

    Route::get('/dashboard/pengajuan', function () {
        return view('dashboard.pengajuan');
    });

    Route::get('/dashboard/profilemlo', function () {
        return view('dashboard.profilemlo');
    });

    Route::get('dashboard/detailpengajuan/{id}', [ProposalController::class, 'show'])->name('dashboard.detailpengajuan');

    Route::get('dashboard/editpropo/{id}', [ProposalController::class, 'edit'])->name('dashboard.editpropo');
    Route::put('dashboard/editpropo/{id}', [ProposalController::class, 'update'])->name('dashboard.updatepropo');
    
    Route::delete('/dashboard/proposal/{id}', [ProposalController::class, 'destroy'])->name('proposal.destroy');
    
    Route::get('/dashboard/lpjmitra', function () {
        return view('dashboard.lpjmitra');
    });

    Route::put('/dashboard/profilemlo', [MitraController::class, 'update'])->name('profile.update');
    // Tambahkan route lain yang butuh proteksi auth

    Route::post('/proposal/store', [ProposalController::class, 'store'])->name('proposal.store');

    Route::get('/dashboard/lpj/create/{id}', [LPJController::class, 'create'])->name('lpj.create');
    Route::post('/dashboard/lpj/store', [LPJController::class, 'store'])->name('lpj.store');

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
