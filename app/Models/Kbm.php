<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kbm extends Model
{
    use HasFactory;

    public $table = 'kbm';

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
    public function jp()
    {
        return $this->belongsTo(Jp::class);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kls', 'id');
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'id_status', 'id');
    }

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class, 'id_lokasi', 'id');
    }
}
