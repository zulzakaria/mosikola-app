<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    public $table = 'periode';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'awal',
        'akhir',
        'aktif'
    ];
}
