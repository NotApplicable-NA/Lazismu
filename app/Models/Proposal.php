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
        'kategori_pengajuan',
        'pilar_program',
        'sasaran_ashnaf',
        'jumlah_laki',
        'jumlah_perempuan',
        'sumber_pendanaan',
        'jumlah_pendanaan',
        'pencairan_dana',
        'catatan_manager',
        'produktif_or_konsumtif', // Tambahkan kolom baru
        'program_pemohon', // Tambahkan kolom ini
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
