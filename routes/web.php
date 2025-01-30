<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LPJController;
use App\Mail\resetpass;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Mail\Mailable;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\DashboardController;
use App\Models\Mitra;
use App\Http\Controllers\AdminAuthController;

Route::middleware('web')->group(function () {
    Route::post('/login', [MitraController::class, 'login'])->name('mitra.login');
    Route::post('/register', [MitraController::class, 'store'])->name('register.store');
    // Tambahkan route lain di sini
});

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [MitraController::class, 'showLoginForm'])->name('login');

Route::post('/logout', function () {
    if (Auth::guard('mitra')->check()) {
        Auth::guard('mitra')->logout();
        session()->forget('mitra_auth');
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    } else {
        return redirect()->back()->with('error', 'Anda bukan pengguna mitra.');
    }
})->name('logout');

Route::get('/register', function () {
    return view('register');
});

Route::middleware(['auth:mitra'])->group(function () {
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

require base_path('routes/new_admin.php');
