<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('relawans', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_relawan');
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->foreignId('koor_wilayah_id')->constrained('koor_wilayahs');
            $table->foreignId('id_kecamatan')->constrained('kecamatans');
            $table->string('no_hp');
            $table->foreignId('jabatan_id')->constrained('jabatans');
            $table->foreignId('recommander_id')->constrained('recommanders');
            $table->foreignId('anggota_dewan_id')->constrained('anggota_dewans');
            $table->foreignId('operator_id')->constrained('operators');
            $table->string('tps');
            $table->foreignId('organisasi_id')->constrained('organisasis');
            $table->string('sk');
            $table->enum('status_nik', ['NIK VALID', 'NIK TIDAK VALID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relawans');
    }
};
