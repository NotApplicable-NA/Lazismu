<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/register', function () {
    return view('register');
});

Route::get('/dashboard/dashboardmlo', function () {
    return view('dashboard.dashboardmlo');
});

Route::get('/dashboard/proposal', function () {
    return view('dashboard.proposal');
});

Route::get('/dashboard/pengajuan', function () {
    return view('dashboard.pengajuan');
});

Route::get('/dashboard/detailpengajuan', function () {
    return view('dashboard.detailpengajuan');
});

Route::get('/dashboard/profilemlo', function () {
    return view('dashboard.profilemlo');
});

Route::get('/dashboard/editpropo', function () {
    return view('dashboard.editpropo');
});

Route::get('/dashboard/lpjmitra', function () {
    return view('dashboard.lpjmitra');
});

Route::get('/admin/adminlogin', function () {
    return view('admin.adminlogin');
});

Route::get('/admin/dashboardadmin', function () {
    return view('admin.dashboardadmin');
});

Route::get('/admin/mlodashboard', function () {
    return view('admin.mlodashboard');
});

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
