<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'telepon',
        'alamat',
        'email',
        'diskon',
        'tipe_diskon',
        'foto_ktp',
    ];
}
