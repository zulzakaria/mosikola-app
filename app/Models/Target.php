<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Guru;

class Target extends Model
{
    use HasFactory;

    public $table = 'target';
    public $timestamps = false;
    protected $fillable = [
        'id_guru',
        'target',
        'id_periode'
    ];

    function guru() {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
}
