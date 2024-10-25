<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaDewan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_anggota_dewan',
    ];

    public function recommanders()
    {
        return $this->hasMany(Recommander::class);
    }
}
