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
Route::post('/adminregister', [AdminAuthController::class, 'register']);
Route::post('/adminlogout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Hanya untuk admin yang login
Route::middleware('auth:admin')->group(function () {
    Route::get('/admin/admindashboard', function () {
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

Route::get('/admindashboard', function () {
    return view('admin.admindashboard');
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
