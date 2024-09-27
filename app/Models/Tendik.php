<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tendik extends Model
{
    use HasFactory;

    public $table = 'tendik';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'nip',
        'password',
        'foto',
        'aktif'
    ];
}
