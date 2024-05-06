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
        Schema::table('kui_instruments', function (Blueprint $table) {
            // $table->dropColumn('nilai');

            $table->string('no')->nullable()->change();
            $table->string('indikator')->nullable()->change();
            $table->string('deskripsi')->nullable()->change();
            $table->string('sebutan')->nullable()->change();
            $table->string('akar_penyebab')->nullable()->change();
            $table->string('akibat')->nullable()->change();
            $table->string('rekomendasi')->nullable()->change();
            $table->string('tanggapan')->nullable()->change();
            $table->string('rencana')->nullable()->change();
            $table->dateTime('jadwal')->nullable()->change();
            $table->string('link')->nullable()->change();
            $table->string('status')->nullable()->change();
            $table->integer('penanggung_jawab')->nullable()->change();
            $table->integer('auditee')->nullable()->change();
            $table->integer('auditor')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
        });
    }
};
