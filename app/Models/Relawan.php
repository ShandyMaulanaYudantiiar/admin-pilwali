<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relawan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_relawan',
        'nik',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'rt',
        'rw',
        'koor_wilayah_id',
        'id_kecamatan',
        'no_hp',
        'jabatan_id',
        'recommander_id',
        'anggota_dewan_id',
        'operator_id',
        'tps',
        'organisasi_id',
        'sk',
        'status_nik',
    ];

    public function koorWilayah()
    {
        return $this->belongsTo(KoorWilayah::class);
    }

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan');
    }

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class);
    }

    public function recommander()
    {
        return $this->belongsTo(Recommander::class);
    }

    public function anggotaDewan()
    {
        return $this->belongsTo(AnggotaDewan::class);
    }

    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }
}
