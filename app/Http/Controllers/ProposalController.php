<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\LPJ;
use App\Models\Catatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProposalController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data proposal dengan pagination (10 data per halaman)
        $proposals = Proposal::with('mitra')
        ->orderBy('id', 'desc')
        ->paginate(10);

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
        $proposal = Proposal::findOrFail($id);
        $lpj = LPJ::where('id_proposal', $proposal->id)->first();

        $catatanFOtoMitra = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Frontoffice')
            ->where('role_dituju', 'Mitra')
            ->latest()
            ->first();

        $catatanFOtoManager = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Frontoffice')
            ->where('role_dituju', 'Manager')
            ->exists();

        $adaRevisiDariFO = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Frontoffice')
            ->where('role_dituju', 'Mitra')
            ->exists();
        
        $mitraSudahUpload = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'Mitra')
            ->where('role_dituju', 'Frontoffice')
            ->exists();
        
        // Form hanya ditampilkan jika FO sudah revisi dan mitra belum respon
        if ($catatanFOtoMitra && !$catatanFOtoManager) {
            $filePath = storage_path('app/public/proposals/' . $proposal->file);

            if (file_exists($filePath)) {
                $fileTimestamp = filemtime($filePath);
                $catatanTimestamp = strtotime($catatanFOtoMitra->created_at);

                // Jika catatan revisi FO ke mitra lebih baru dari file yang ada → tampilkan form
                $showUploadForm = $catatanTimestamp > $fileTimestamp;
            } else {
                // file tidak ada → tampilkan form
                $showUploadForm = true;
            }
        }

        return view('dashboard.detailpengajuan', compact(
            'proposal', 'lpj', 'catatanFOtoMitra', 'catatanFOtoManager'
        ));
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

    public function updateFileOnly(Request $request, $id)
    {
        $proposal = Proposal::findOrFail($id);

        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        // Definisi path penyimpanan (relatif terhadap disk 'public')
        $mainDir = 'proposals/';
        $backupDir = 'proposals/backup/';

        // Pastikan file lama ada
        if ($proposal->file && Storage::disk('public')->exists($mainDir . $proposal->file)) {
            // Buat folder backup jika belum ada
            if (!Storage::disk('public')->exists($backupDir)) {
                Storage::disk('public')->makeDirectory($backupDir);
            }

            // Format nama file backup
            $backupFileName = $proposal->id_mitra . '_' . $proposal->id . '_' . now()->format('YmdHis') . '.pdf';

            // Pindahkan file lama ke folder backup
            Storage::disk('public')->move($mainDir . $proposal->file, $backupDir . $backupFileName);
        }

        // Simpan file baru
        $newFileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs($mainDir, $newFileName, 'public');

        // Update nama file baru di DB
        $proposal->update([
            'file' => $newFileName,
        ]);

        // Tambahkan catatan dari Mitra ke FO
        $existing = Catatan::where('id_proposal', $proposal->id)
            ->where('role_pengirim', 'mitra')
            ->where('role_dituju', 'FO')
            ->first();

        if (!$existing) {
            Catatan::create([
                'id_proposal' => $proposal->id,
                'isi_catatan' => 'Mitra telah mengunggah revisi proposal.',
                'role_pengirim' => 'mitra',
                'role_dituju' => 'FO',
            ]);
        }


        return redirect()->back()->with('success', 'File revisi proposal berhasil diperbarui.');
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

