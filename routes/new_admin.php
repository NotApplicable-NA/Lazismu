<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\LPJController;
use App\Http\Controllers\AdminController;
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
use App\Http\Middleware\CheckSession;

Route::get('/adminlogin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/adminlogin', [AdminAuthController::class, 'login']);

Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboardadmin'])
        ->name('admin.dashboard')
        ->where(['admin' => 'manager|admin|bp|superadmin', 'dashboard' => 'dashboard']);
    
    Route::post('/adminlogout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/get-chart-data', [DashboardController::class, 'getChartData']);

    //Mitra Manager
    
    Route::get('/admin/mitra', [AdminController::class, 'indexmitra'])->name('admin.indexmitra'); // Untuk list mitra
    Route::get('/admin/detailmitra/{id}', [AdminController::class, 'showmitra'])->name('admin.showmitra'); // Untuk melihat detail mitra

    Route::get('/{admin}/proposal', [AdminController::class, 'indexproposal'])->name('admin.indexproposal'); // Untuk list mitra
    Route::get('/admin/proposaldetail/{id}', [AdminController::class, 'showproposal'])->name('admin.showproposal'); // Untuk melihat detail mitra

    Route::get('/admin/lpj', [AdminController::class, 'indexlpj'])->name('admin.indexlpj'); // Untuk list mitra
    Route::get('/admin/lpj/{id}', [AdminController::class, 'showlpj'])->name('admin.showlpj'); // Untuk melihat detail mitra


    //BP (Route Detail proposal harus dipisah karena halaman detail proposalnya beda dengan admin lain)
    Route::get('/bp/bpdetail/{id}', [AdminController::class, 'proposalbp'])->name('admin.proposalbp');
    Route::post('/proposal/{id}/store-catatan-bp', [AdminController::class, 'storeCatatanBP'])->name('proposal.storeCatatanBP');

    Route::get('/bp/managementuserbp', [AdminController::class, 'indexadmins'])->name('admin.indexadmins');
    Route::get('/adminregisterbp', [AdminAuthController::class, 'showRegisterFormBP'])->name('admin.register');
    Route::post('/adminregisterbp', [AdminAuthController::class, 'register'])->name('admin.register.bp');
    Route::delete('/admin/{id}/delete', [AdminAuthController::class, 'destroy'])->name('admin.delete');



});