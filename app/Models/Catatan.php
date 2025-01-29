<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan extends Model
{
    use HasFactory;

    protected $table = 'catatan'; // Nama tabel di database

    protected $fillable = [
        'id_proposal',
        'isi_catatan',
        'role_pengirim',
        'role_dituju',
        'status'
    ];

    // Relasi: Catatan belongsTo Proposal
    public function proposal()
    {
        return $this->belongsTo(Proposal::class, 'id_proposal', 'id');
    }
}
