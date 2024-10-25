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
        Schema::create('recommanders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nama_recommander');
            $table->foreignId('anggota_dewan_id');
            $table->foreign('anggota_dewan_id')->references('id')->on('anggota_dewans')->onDelete('cascade');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recommanders');
    }
};
