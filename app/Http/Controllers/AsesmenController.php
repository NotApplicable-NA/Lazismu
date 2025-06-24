<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asesmen;
use App\Models\Catatan;

class AsesmenController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_proposal' => 'required|integer|exists:proposals,id',
            'nama_asesmen' => 'required|string|max:255',
            'tanggal_asesmen' => 'required|date',
            'nominal' => 'required|numeric|min:0',
            'file' => 'required|file|mimes:pdf,jpg,png|max:2048', // Maksimal 2MB
        ]);


        // Simpan file jika ada
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('assessments', 'public');
            $validated['file'] = $filePath;
        }

        // Simpan data ke database
        Asesmen::create($validated);

        // Cek apakah catatan balasan dari Program ke Manager sudah ada
        $existingCatatan = Catatan::where('id_proposal', $request->id_proposal)
        ->where('role_pengirim', 'Program')
        ->where('role_dituju', 'Manager')
        ->first();

        if (!$existingCatatan) {
        Catatan::create([
            'id_proposal'   => $request->id_proposal,
            'isi_catatan'   => 'Asesmen telah dikirim oleh Program.',
            'role_pengirim' => 'Program',
            'role_dituju'   => 'Manager',
            'status'        => true,
        ]);
        }


        return redirect()->back()->with('success', 'Assessment berhasil disimpan!');
    }
}

