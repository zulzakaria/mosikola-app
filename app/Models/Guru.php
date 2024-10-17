<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    public $table = 'guru';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'nip',
        'password',
        'foto',
        'aktif'
    ];

    function target() {
        return $this->hasOne(Target::class, 'id_guru','id');
    }
}
