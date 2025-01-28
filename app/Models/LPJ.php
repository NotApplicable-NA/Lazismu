<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LPJ extends Model
{
    use HasFactory;
    
    protected $table = 'lpjs'; // Nama tabel di database

    protected $fillable = [
        'id_proposal',
        'judul_lpj',
        'tgl_masuk',
        'tgl_acc',
        'status',
        'nama_instansi',
        'dana_disetujui',
        'total_pengeluaran',
        'file_lpj',
        'keterangan_lpj',
        'file_bukti_sisa_dana',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id');
    }
}
