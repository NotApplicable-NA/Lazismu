<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
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

Route::get('/login', function () {
    return view('login');
})->name('login'); 

Route::get('/adminlogin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/adminlogin', [AdminAuthController::class, 'login']);
Route::get('/adminregister', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('/adminregisterbp', [AdminAuthController::class, 'register']);
Route::get('/adminregisterbp', [AdminAuthController::class, 'showRegisterFormBP'])->name('admin.register');
Route::post('/adminregister', [AdminAuthController::class, 'register']);
Route::post('/adminlogout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Hanya untuk admin yang login
logger()->info('Route admin.admindashboard is being registered');
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/admindashboard', function () {
        logger()->info('Route admin.admindashboard accessed');
        return view('admin.admindashboard');
    })->name('admin.admindashboard');
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

Route::get('/detailpengajuan', function () {
    return view('dashboard.detailpengajuan');
});

Route::get('/editpengajuan', function () {
    return view('dashboard.editpropo');
});

// Route::get('/admindashboard', function () {
//     return view('admin.admindashboard');
// });

Route::get('/admin/admindashboard', [MitraController::class, 'index'])->name('mlos.indexcount');
Route::post('/admin/admindashboard', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/admindashboard/{id}', [MitraController::class, 'show'])->name('mlos.showcount');

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

// Route::get('/admin/dashboardadmin', function () {
//     return view('admin.dashboardadmin');
// });

// Route::get('/admin/mlodashboard', function () {
//     return view('admin.mlodashboard');
// });

Route::get('/admin/mlodashboard', [MitraController::class, 'index'])->name('mlos.index');
Route::post('/admin/mlodashboard', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/mlodashboard/{id}', [MitraController::class, 'show'])->name('mlos.show');

//INI ROUTE BAGIAN FRONT OFFICE
Route::get('/frontoffice/frontoffice', function () {
    return view('admin.frontoffice.frontoffice');
});

Route::get('/frontoffice/dashboardfo', function () {
    return view('admin.frontoffice.dashboardfo');
});

Route::get('/frontoffice/mitrafo', function () {
    return view('admin.frontoffice.mitrafo');
});

Route::get('/frontoffice/proposalfo', function () {
    return view('admin.frontoffice.proposalfo');
});

Route::get('/frontoffice/proposaldetailfo', function () {
    return view('admin.frontoffice.proposaldetailfo');
});

Route::get('/frontoffice/lpjfo', function () {
    return view('admin.frontoffice.lpjfo');
});

Route::get('/frontoffice/lpjdetailfo', function () {
    return view('admin.frontoffice.lpjdetailfo');
});

Route::get('/frontoffice/settingfo', function () {
    return view('admin.frontoffice.settingfo');
});

Route::get('/frontoffice/dashboardfo', [MitraController::class, 'indexfo'])->name('mlos.indexfo');
Route::post('/frontoffice/dashboardfo', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/dashboardfo/{id}', [MitraController::class, 'showfo'])->name('mlos.showfo');

Route::get('/frontoffice/frontofficedetail', function () {
    return view('admin.frontoffice.frontofficedetail');
});

Route::get('/frontoffice/mitradetailfo', function () {
    return view('admin.frontoffice.mitradetailfo');
});

Route::get('/frontoffice/mitrafo', [MitraController::class, 'indexmlofo'])->name('mlos.indexmlofo'); // Untuk list mitra
Route::post('/frontoffice/mitrafo', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mitrafo/{id}', [MitraController::class, 'showmlofo'])->name('mlos.showmlofo'); // Untuk melihat detail mitra

//INI ROUTE BAGIAN MANAGER
Route::get('/manager/manager', function () {
    return view('admin.manager.manager');
});

Route::get('/manager/managerdetail', function () {
    return view('admin.manager.managerdetail');
});

Route::get('/manager/dashboardmanager', function () {
    return view('admin.manager.dashboardmanager');
});

Route::get('/manager/dashboardmanager', [MitraController::class, 'indexmanager'])->name('mlos.indexmanager');
Route::post('/manager/dashboardmanager', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/dashboardmanager/{id}', [MitraController::class, 'showmanager'])->name('mlos.showmanager');

Route::get('/manager/mitramanager', function () {
    return view('admin.manager.mitramanager');
});

Route::get('/manager/mitramanager', [MitraController::class, 'indexmlomanager'])->name('mlos.indexmlomanager'); // Untuk list mitra
Route::post('/manager/mitramanager', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mitramanager/{id}', [MitraController::class, 'showmlomanager'])->name('mlos.showmlomanager'); // Untuk melihat detail mitra

Route::get('/manager/lpjmanager', function () {
    return view('admin.manager.lpjmanager');
});

Route::get('/manager/lpjdetailmanager', function () {
    return view('admin.manager.lpjdetailmanager');
});

Route::get('/manager/proposalmanager', function () {
    return view('admin.manager.proposalmanager');
});

Route::get('/manager/proposaldetailmanager', function () {
    return view('admin.manager.proposaldetailmanager');
});

Route::get('/manager/settingmanager', function () {
    return view('admin.manager.settingmanager');
});

Route::get('/manager/managementusermanager', function () {
    return view('admin.manager.managementusermanager');
});

Route::get('/manager/managementusermanager', [MitraController::class, 'indexadmin'])->name('admins.indexadmin');
Route::post('/manager/managementusermanager', [MitraController::class, 'storeadmin'])->name('admins.storeadmin');
Route::get('/managementusermanager/{id}', [MitraController::class, 'showadmin'])->name('admins.showadmin');


//INI ROUTE BAGIAN PROGRAM
Route::get('/program/dashboardprogram', function () {
    return view('admin.program.dashboardprogram');
});

Route::get('/program/dashboardprogram', [MitraController::class, 'indexcountprogram'])->name('admins.indexcountprogram');
Route::post('/program/dashboardprogram', [MitraController::class, 'storeadmin'])->name('admins.storeadmin');
Route::get('/dashboardprogram/{id}', [MitraController::class, 'showcountprogram'])->name('admins.showcountprogram');

Route::get('/program/mitraprogram', function () {
    return view('admin.program.mitraprogram');
});

Route::get('/program/programdetail', function () {
    return view('admin.program.programdetail');
});

Route::get('/program/mitraprogram', [MitraController::class, 'indexmloprogram'])->name('mlos.indexmloprogram'); // Untuk list mitra
Route::post('/program/mitraprogram', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mitraprogram/{id}', [MitraController::class, 'showmloprogram'])->name('mlos.showmloprogram'); // Untuk melihat detail mitra

Route::get('/program/proposalprogram', function () {
    return view('admin.program.proposalprogram');
});

Route::get('/program/proposaldetailprogram', function () {
    return view('admin.program.proposaldetailprogram');
});

Route::get('/program/lpjprogram', function () {
    return view('admin.program.lpjprogram');
});

Route::get('/program/lpjdetailprogram', function () {
    return view('admin.program.lpjdetailprogram');
});

Route::get('/program/program', function () {
    return view('admin.program.program');
});

Route::get('/program/settingprogram', function () {
    return view('admin.program.settingprogram');
});

//ROUTE BADAN PENGURUS (BP)
Route::get('/bp/dashboardbp', function () {
    return view('admin.bp.dashboardbp');
});

Route::get('/bp/dashboardbp', [MitraController::class, 'indexbp'])->name('mlos.indexbp');
Route::post('/bp/dashboardbp', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/dashboardbp/{id}', [MitraController::class, 'showbp'])->name('mlos.showbp');

Route::get('/bp/mitrabp', function () {
    return view('admin.bp.mitrabp');
});

Route::get('/bp/mitrabp', [MitraController::class, 'indexmlobp'])->name('mlos.indexmlobp'); // Untuk list mitra
Route::post('/bp/mitrabp', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mitrabp/{id}', [MitraController::class, 'showmlobp'])->name('mlos.showmlobp'); // Untuk melihat detail mitra

Route::get('/bp/proposalbp', function () {
    return view('admin.bp.proposalbp');
});

Route::get('/bp/proposaldetailbp', function () {
    return view('admin.bp.proposaldetailbp');
});

Route::get('/bp/lpjbp', function () {
    return view('admin.bp.lpjbp');
});

Route::get('/bp/lpjdetailbp', function () {
    return view('admin.bp.lpjdetailbp');
});

Route::get('/bp/bp', function () {
    return view('admin.bp.bp');
});

Route::get('/bp/bpdetail', function () {
    return view('admin.bp.bpdetail');
});

Route::get('/bp/managementuserbp', function () {
    return view('admin.bp.managementuserbp');
});

Route::get('/bp/managementuserbp', [MitraController::class, 'indexadminbp'])->name('admins.indexadminbp');
Route::post('/bp/managementuserbp', [MitraController::class, 'storeadmin'])->name('admins.storeadmin');
Route::get('/managementuserbp/{id}', [MitraController::class, 'showadminbp'])->name('admins.showadminbp');


Route::get('/bp/settingbp', function () {
    return view('admin.bp.settingbp');
});

//INI ROUTE BUAT KEUANGAN
Route::get('/keuangan/dashboardkeuangan', function () {
    return view('admin.keuangan.dashboardkeuangan');
});

Route::get('/keuangan/dashboardkeuangan', [MitraController::class, 'indexkeuangan'])->name('mlos.indexkeuangana');
Route::post('/keuangan/dashboardkeuangan', [MitraController::class, 'store'])->name('mlos.store');
Route::get('/dashboardkeuangan/{id}', [MitraController::class, 'showkeuangan'])->name('mlos.showkeuangan');

Route::get('/keuangan/mitrakeuangan', function () {
    return view('admin.keuangan.mitrakeuangan');
});
Route::get('/keuangan/mitrakeuangan', [MitraController::class, 'indexmlokeuangan'])->name('mlos.indexmlokeuangan'); // Untuk list mitra
Route::post('/keuangan/mitrakeuangan', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mitrakeuangan/{id}', [MitraController::class, 'showmlokeuangan'])->name('mlos.showmlokeuangan'); // Untuk melihat detail mitra

Route::get('/keuangan/proposalkeuangan', function () {
    return view('admin.keuangan.proposalkeuangan');
});

Route::get('/keuangan/proposaldetailkeuangan', function () {
    return view('admin.keuangan.proposaldetailkeuangan');
});

Route::get('/keuangan/lpjkeuangan', function () {
    return view('admin.keuangan.lpjkeuangan');
});

Route::get('/keuangan/lpjdetailkeuangan', function () {
    return view('admin.keuangan.lpjdetailkeuangan');
});

Route::get('/keuangan/keuangan', function () {
    return view('admin.keuangan.keuangan');
});

Route::get('/keuangan/keuangandetail', function () {
    return view('admin.keuangan.keuangandetail');
});

Route::get('/keuangan/settingkeuangan', function () {
    return view('admin.keuangan.settingkeuangan');
});

Route::get('/get-chart-data', [DashboardController::class, 'getChartData']);

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

Route::get('/admin/mlodetail', [MitraController::class, 'indexmlo'])->name('mlos.indexmlo'); // Untuk list mitra
Route::post('/admin/mlodetail', [MitraController::class, 'store'])->name('mlos.store'); // Untuk menyimpan data mitra
Route::get('/mlodetail/{id}', [MitraController::class, 'showmlo'])->name('mlos.showmlo'); // Untuk melihat detail mitra

//forgot and reset password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::broker('mitras')->sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    // Validasi input dari form reset password
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Tambahkan log untuk melacak email dan token yang diterima
    Log::info('Email yang diterima: ' . $request->email);
    Log::info('Token yang diterima: ' . $request->token);

    // Proses reset password
    $status = Password::broker('mitras')->reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (Mitra $mitra, string $password) use ($request) {
            // Cek apakah token yang diterima valid untuk email yang diberikan
            if ($mitra->email !== $request->email) {
                Log::error('Email tidak ditemukan: ' . $request->email);
                return back()->withErrors(['email' => 'Email tidak ditemukan atau tidak cocok dengan token.']);
            }

            // Mengubah password mitra yang sudah terverifikasi tokennya
            $mitra->forceFill([
                'password' => Hash::make($password),  // Hash password baru
            ])->setRememberToken(Str::random(60));  // Set remember token yang baru

            $mitra->save();  // Simpan perubahan ke database

            // Event untuk notifikasi password reset
            event(new PasswordReset($mitra));
        }
    );

    // Cek status reset dan tampilkan pesan yang sesuai
    if ($status === Password::PASSWORD_RESET) {
        Log::info('Password berhasil direset untuk email: ' . $request->email);
        return redirect()->route('mitra.login')->with('status', __($status));
    } else {
        Log::error('Gagal reset password untuk email: ' . $request->email);
        return back()->withErrors(['email' => [__($status)]]);
    }
})->middleware('guest')->name('password.update');

Route::post('reset-password/{id}', [MitraController::class, 'resetPassword'])->name('mitra.reset-password');
