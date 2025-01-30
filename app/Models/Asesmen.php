<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asesmen extends Model
{
    use HasFactory;

    protected $table = 'asesmen'; // Nama tabel di database

    protected $fillable = [
        'id_proposal',
        'nama_asesmen',
        'tanggal_asesmen',
        'nominal',
        'file',
    ];
}

