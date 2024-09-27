<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JurnalTendik extends Model
{
    use HasFactory;

    public $table = 'jurnaltendik';
    public $timestamps = false;
    protected $fillable = [
        'id_tendik',
        'tanggal',
        'kegiatan',
        'awal',
        'akhir',
        'lokasi',
        'foto'
    ];
}
