<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Mitra extends Authenticatable
{
    use Notifiable;

    protected $table = 'mitras';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'nama',
        'password',
        'no_hp',
        'email',
        'alamat',
        'status',
        'profile_picture',
    ];

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'id_mitra', 'id');
    }

    // Automatically hash password when setting it
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    // Hidden fields for arrays
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Typecasting for specific fields
    protected $casts = [
        'status' => 'boolean',
        'email_verified_at' => 'datetime',
    ];
}

?>