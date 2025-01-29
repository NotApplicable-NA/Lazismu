<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $table = 'proposals'; // Nama tabel di database

    // Kolom-kolom yang diizinkan untuk mass assignment
    protected $fillable = [
        'id_mitra',
        'judul',
        'kategori',
        'anggaran_diajukan',
        'anggaran_disetujui',
        'tgl_masuk',
        'tgl_acc',
        'tgl_ambil_dana',
        'status',
        'kontak',
        'file',
    ];

    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }
    
    public function catatan()
    {
        return $this->hasMany(Catatan::class, 'id_proposal', 'id');
    }
}
