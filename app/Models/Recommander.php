<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recommander extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_recommander',
        'anggota_dewan_id',
    ];

    public function anggotaDewan()
    {
        return $this->belongsTo(AnggotaDewan::class);
    }
}
