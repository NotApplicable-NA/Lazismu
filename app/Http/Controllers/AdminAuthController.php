<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
   // Register
   public function register(Request $request)
   {
       $request->validate([
           'nama' => 'required|string|max:255',
           'username' => 'required|string|max:255|unique:admins',
           'email' => 'required|string|email|max:255|unique:admins',
           'password' => 'required|string|min:8|confirmed',
       ]);
   
       Admin::create([
           'nama' => $request->nama,
           'username' => $request->username,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'role' => 'admin', // Default role
       ]);   
    
    // Tambahkan log untuk memeriksa apakah data berhasil tersimpan
    logger()->info('Admin registered with username: ' . $request->username);

       return redirect()->route('admin.login')->with('success', 'Admin registered successfully.');
   }
// Menampilkan halaman login
public function showLoginForm()
{
    return view('auth.admin-login'); // Pastikan file ini ada di resources/views/admin/login.blade.php
}

public function showRegisterForm()
{
    return view('auth.admin-register'); // Pastikan file ini ada di resources/views/admin/login.blade.php
}

   // Login
   public function login(Request $request)
   {
       $credentials = $request->validate([
           'username' => 'required|string',
           'password' => 'required|string',
       ]);

       if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        logger()->info('Admin berhasil login', ['username' => $request->username]);
        return redirect()->route('admin.admindashboard')->with('success', 'Login successful.');
    } else {
        logger()->error('Login gagal', ['username' => $request->username]);
    }
    
    

       return back()->withErrors([
           'username' => 'The provided credentials do not match our records.',
       ]);
   }

   // Logout
   public function logout(Request $request)
   {
       Auth::guard('admin')->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect()->route('admin.login');
   }
}
