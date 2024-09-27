<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    public $table = 'kelas';
    public $timestamps = false;
    protected $fillable = [
        'nama',
        'tingkat'
    ];

    public function kbm()
    {
        return $this->hasMany(Kbm::class);
    }
}
