<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KoorWilayah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_koor_wilayah',
        'kecamatan_id',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
}
