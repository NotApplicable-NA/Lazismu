<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LPJ;
use App\Models\Proposal;

class LPJController extends Controller
{
    public function create($id)
    {
        $proposal = Proposal::findOrFail($id);

        return view('dashboard.lpjmitra', compact('proposal'));
    }

    public function show($id)
    {
        $proposal = Proposal::findOrFail($id);
        $lpj = LPJ::where('id_proposal', $id)->first();

        return view('detailpengajuan', compact('proposal', 'lpj'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_proposal' => 'required|exists:proposals,id',
            'judul_lpj' => 'required|max:255',
            // 'tgl_masuk' => 'required|date',
            'nama_instansi' => 'required|max:255',
            'dana_disetujui' => 'required|numeric',
            'total_pengeluaran' => 'required|numeric',
            'file_lpj' => 'nullable|mimes:pdf|max:2048',
            'keterangan_lpj' => 'nullable|string',
            'file_bukti_sisa_dana' => 'nullable|mimes:pdf|max:2048',
        ]);
        

        // Simpan file LPJ
        $fileLpjName = null;
        if ($request->hasFile('file_lpj')) {
            $fileLpjName = time() . '_' . $request->file('file_lpj')->getClientOriginalName();
            $request->file('file_lpj')->storeAs('lpjs', $fileLpjName, 'public');
        }

        // Simpan file Bukti Sisa Dana
        $fileBuktiSisaDanaName = null;
        if ($request->hasFile('file_bukti_sisa_dana')) {
            $fileBuktiSisaDanaName = time() . '_' . $request->file('file_bukti_sisa_dana')->getClientOriginalName();
            $request->file('file_bukti_sisa_dana')->storeAs('lpjs', $fileBuktiSisaDanaName, 'public');
        }

        $tglMasuk = now();

        // Buat record LPJ
        LPJ::create([
            'id_proposal' => $validated['id_proposal'],
            'judul_lpj' => $validated['judul_lpj'],
            'tgl_masuk' => $tglMasuk,
            'nama_instansi' => $validated['nama_instansi'],
            'dana_disetujui' => $validated['dana_disetujui'],
            'total_pengeluaran' => $validated['total_pengeluaran'],
            'file_lpj' => $fileLpjName,
            'keterangan_lpj' => $validated['keterangan_lpj'],
            'file_bukti_sisa_dana' => $fileBuktiSisaDanaName,
            'status' => 'Pending',
        ]);

        return redirect()->route('proposal.index')->with('success', 'LPJ berhasil dibuat.');
    }
}
