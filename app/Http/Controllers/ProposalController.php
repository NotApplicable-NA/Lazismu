<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\LPJ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data proposal dengan pagination (10 data per halaman)
        $proposals = Proposal::with('mitra')->paginate(10);

        // Logika untuk mengembalikan view yang sesuai
        if ($request->routeIs('dashboardmlo.index')) {
            return view('dashboard.dashboardmlo', compact('proposals'));
        } elseif ($request->routeIs('proposal.index')) {
            return view('dashboard.proposal', compact('proposals'));
        }

        // Default view jika route tidak dikenali (opsional)
        return abort(404, 'View not found');
    }

    public function show($id)
    {
        // Ambil data proposal berdasarkan ID
        $proposal = Proposal::findOrFail($id);

        // Ambil data LPJ berdasarkan id_proposal
        $lpj = LPJ::where('id_proposal', $proposal->id)->first();

        // Kirim data proposal dan lpj ke view
        return view('dashboard.detailpengajuan', compact('proposal', 'lpj'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:255',
            'kontak' => 'required|max:255',
            'anggaran_diajukan' => 'required|integer',
            'tgl_masuk' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:2048', // Hanya file PDF dengan ukuran maksimum 2MB
        ]);
        

        // Proses upload file jika ada
        $fileName = null;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama file unik dengan timestamp
            $file->storeAs('proposals', $fileName, 'public'); // Simpan di storage/app/public/proposals
        }
        
        

        // Simpan data ke database
        Proposal::create([
            'id_mitra' => auth()->user()->id, // Pastikan user sudah login
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'kontak' => $validated['kontak'],
            'anggaran_diajukan' => $validated['anggaran_diajukan'],
            'tgl_masuk' => $validated['tgl_masuk'],
            'file' => $fileName,
            'status' => 'Masuk', // Nilai default untuk kolom status
        ]);

        // Redirect ke halaman dengan pesan sukses
        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diajukan.');
    }

    public function edit($id)
    {
        $proposal = Proposal::findOrFail($id);

        // Cek apakah status "Masuk"
        if ($proposal->status !== 'Masuk') {
            return redirect()->route('proposal.index')->with('error', 'Halaman tidak bisa dibuka karena status sedang "' . $proposal->status . '".');
        }

        // Jika status "Masuk", arahkan ke halaman edit
        return view('dashboard.editpropo', compact('proposal'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'judul' => 'required|max:255',
            'kategori' => 'required|max:255',
            'kontak' => 'required|max:255',
            'anggaran_diajukan' => 'required|integer',
            'tgl_masuk' => 'required|date',
            'file' => 'nullable|mimes:pdf|max:2048',
        ]);

        $proposal = Proposal::findOrFail($id);

        // Update data
        $proposal->update([
            'judul' => $validated['judul'],
            'kategori' => $validated['kategori'],
            'kontak' => $validated['kontak'],
            'anggaran_diajukan' => $validated['anggaran_diajukan'],
            'tgl_masuk' => $validated['tgl_masuk'],
        ]);

        // Update file jika ada
        if ($request->hasFile('file')) {
            if ($proposal->file && Storage::disk('public')->exists('proposals/' . $proposal->file)) {
                Storage::disk('public')->delete('proposals/' . $proposal->file);
            }
            $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
            $request->file('file')->storeAs('proposals', $fileName, 'public');
            $proposal->file = $fileName;
        }

        $proposal->save();

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $proposal = Proposal::findOrFail($id);

        // Hapus file jika ada
        if ($proposal->file && Storage::disk('public')->exists('proposals/' . $proposal->file)) {
            Storage::disk('public')->delete('proposals/' . $proposal->file);
        }

        // Hapus data dari database
        $proposal->delete();

        return redirect()->route('proposal.index')->with('success', 'Proposal berhasil dihapus.');
    }


}

