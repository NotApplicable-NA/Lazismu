<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asesmen;

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

        return redirect()->back()->with('success', 'Assessment berhasil disimpan!');
    }
}

