<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MitraController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user(); // Data user yang login.
            return redirect()->intended('/dashboard/dashboardmlo'); // Ganti dengan URL dashboard Anda
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Method to fetch all Mitra records
    public function index()
    {
        $mitras = Mitra::all();
        return view('admin.mlodashboard', compact('mitras'));
    }

    // Method to show a specific Mitra record
    public function show($id)
    {
        $mitra = Mitra::findOrFail($id);
        return view('admin.mlodashboard.show', compact('mitra'));
    }

    // Method to store a new Mitra record
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:mitras',
            'password' => 'required|string|min:8|confirmed',
            'no_hp' => 'required|string|max:15',
        ]);
        // Simpan data ke database
        $mitra = new Mitra();
        $mitra->nama = $request->input('nama');
        $mitra->email = $request->input('email');
        $mitra->password = $request->input('password');
        $mitra->no_hp = $request->input('no_hp');
        $mitra->alamat = 'Silahkan Isi Alamat Anda';
        $mitra->status = 1;
        $mitra->save();

        return redirect()->route('mitra.login')->with('success', 'Registrasi berhasil!');
    }

    // Method to update an existing Mitra record
    public function update(Request $request, $id)
    {
        // Ambil mitra berdasarkan id
        $mitra = Mitra::findOrFail($id);
    
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'no_hp' => 'nullable|string|max:15',
            'alamat' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'nama.string' => 'Nama harus berupa teks.',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter.',
            'no_hp.string' => 'Nomor telepon harus berupa teks.',
            'no_hp.max' => 'Nomor telepon tidak boleh lebih dari 15 karakter.',
            'alamat.string' => 'Alamat harus berupa teks.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'profile_picture.image' => 'File harus berupa gambar.',
            'profile_picture.mimes' => 'Gambar harus bertipe: jpeg, png, jpg.',
            'profile_picture.max' => 'Ukuran gambar maksimal 2MB.',
        ]);
    
        // Ambil semua input
        $data = $request->only(['nama', 'email', 'no_hp', 'alamat']);
    
        // Jika password diubah, hash password
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }
    
        // Hapus gambar lama dan simpan gambar baru jika ada
        if ($request->hasFile('profile_picture')) {
            if ($mitra->profile_picture && file_exists(public_path('uploads/profile_pictures/' . $mitra->profile_picture))) {
                unlink(public_path('uploads/profile_pictures/' . $mitra->profile_picture));
            }
    
            $file = $request->file('profile_picture');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/profile_pictures'), $filename);
            $data['profile_picture'] = $filename;
        }
    
        // Update data mitra
        $mitra->update($data);
    
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
    public function resetPassword(Request $request, $id)
        {
            $request->validate([
                'password' => 'required|min:8|confirmed',
            ]);

            $mitra = Mitra::findOrFail($id);
            $mitra->password = $request->password;
            $mitra->save();

            return redirect()->route('mitra.login')->with('status', 'Password berhasil direset.');
        }

    
    public function showResetForm($id)
    {
        $mitra = Mitra::findOrFail($id); // Ambil data mitra berdasarkan ID
        return view('auth.reset-password', compact('mitra')); // Kirim data mitra ke view
    }
    
    // Method to delete a Mitra record
    public function destroy($id)
    {
        $mitra = Mitra::findOrFail($id);
        $mitra->delete();

        return redirect()->route('admin.mlodashboard.index')->with('success', 'Mitra deleted successfully.');
    }
}

?>