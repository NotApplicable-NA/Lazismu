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
use App\Http\Controllers\AsesmenController;

Route::get('/adminlogin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/adminlogin', [AdminAuthController::class, 'login']);

Route::middleware(['auth.admin'])->group(function () {

    //Admin Side Dashboard

    Route::get('/admin/dashboard', [AdminController::class, 'dashboardadmin'])
        ->name('admin.dashboard')
        ->where(['admin' => 'manager|admin|bp|superadmin', 'dashboard' => 'dashboard']);
    
    Route::post('/adminlogout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/get-chart-data', [DashboardController::class, 'getChartData']);

    //Admin Side Proposal, Mitra, LPJ (Tampil indeks dan detail)
    
    Route::get('/admin/mitra', [AdminController::class, 'indexmitra'])->name('admin.indexmitra');
    Route::get('/admin/detailmitra/{id}', [AdminController::class, 'showmitra'])->name('admin.showmitra');

    Route::get('/{admin}/proposal', [AdminController::class, 'indexproposal'])->name('admin.indexproposal');
    Route::get('/admin/proposaldetail/{id}', [AdminController::class, 'showproposal'])->name('admin.showproposal');

    Route::get('/admin/lpj', [AdminController::class, 'indexlpj'])->name('admin.indexlpj');
    Route::get('/admin/lpj/{id}', [AdminController::class, 'showlpj'])->name('admin.showlpj');


    //BP (Route Detail proposal harus dipisah karena halaman detail proposalnya beda dengan admin lain)
    Route::get('/bp/bpdetail/{id}', [AdminController::class, 'proposalbp'])->name('admin.proposalbp');
    Route::post('/proposal/{id}/store-catatan-bp', [AdminController::class, 'storeCatatanBP'])->name('proposal.storeCatatanBP');

    Route::get('/bp/managementuserbp', [AdminController::class, 'indexadmins'])->name('admin.indexadmins');
    Route::get('/adminregisterbp', [AdminAuthController::class, 'showRegisterFormBP'])->name('admin.register');
    Route::post('/adminregisterbp', [AdminAuthController::class, 'register'])->name('admin.register.bp');
    Route::delete('/admin/{id}/delete', [AdminAuthController::class, 'destroy'])->name('admin.delete');

    Route::get('/frontoffice/frontofficedetail/{id}', [AdminController::class, 'proposalfo'])->name('admin.proposalfo');
    Route::post('/proposal/{id}/store-catatan-fo', [AdminController::class, 'storeCatatanFO'])->name('proposal.storeCatatanFO');

    //Keuangan (ROUTE PROPOSAL DAN DETAIL PROPOSAL)

    Route::get('/keuangan/keuangan', function () {
        return view('admin.keuangan.keuangan');
    });

    Route::get('/keuangan/keuangandetail', function () {
        return view('admin.keuangan.keuangandetail');
    });

    //Manager (ROUTE PROPOSAL DAN DETAIL PROPOSAL UNTUK TINDAK LANJUT)

    Route::get('/manager/managerdetail/{id}', [AdminController::class, 'proposalmanager'])->name('admin.proposalmanager');
    Route::post('/proposal/disposisi', [AdminController::class, 'storeDisposisi'])->name('proposal.storeDisposisi');
    Route::post('/proposal/storePengajuanManager', [AdminController::class, 'storePengajuanManager'])->name('proposal.storePengajuanManager');

    //PROGRAM (ROUTE UNTUK PROPOSAL DAN DETAIL PROPOSAL PROGRAM)

    Route::get('/program/programdetail/{id}', [AdminController::class, 'proposalprogram'])->name('admin.proposalprogram');

    Route::post('/asesmen/store', [AsesmenController::class, 'store'])->name('asesmen.store');
    Route::post('/proposal/storePemohon', [AdminController::class, 'storePemohon'])->name('proposal.storePemohon');

    Route::get('/program/programdetail', function () {
        return view('admin.program.programdetail');
    });
});