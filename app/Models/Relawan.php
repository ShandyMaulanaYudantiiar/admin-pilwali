<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;

    protected $table = 'relawans';

    protected $fillable = [
        'nik',
        'no_hp',
        'recommander',
        'anggota_dewan',
        'operator',
        'organisasi',
        'jabatan',
        'status_nik',
        'sk'
    ];

    public function dpt()
    {
        return $this->belongsTo(DPT::class, 'nik', 'nik');
    }
}
