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
        Schema::create('kui_instruments', function (Blueprint $table) {
            $table->id();
            $table->string('no_ps');
            $table->string('pernyataan_standar');
            $table->string('no');
            $table->string('indikator');
            $table->string('deskripsi');
            $table->string('nilai');
            $table->string('sebutan');
            $table->string('akar_penyebab');
            $table->string('akibat');
            $table->string('rekomendasi');
            $table->string('tanggapan');
            $table->string('rencana');
            $table->dateTime('jadwal');
            $table->string('penanggung_jawab');
            $table->string('link');
            $table->string('status');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kui_instruments');
    }
};
