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
        Schema::create('klasifikasi', function (Blueprint $table) {
            $table->string('kode_klasifikasi', 10)->primary();
            $table->string('kode_kriteria', 10);
            $table->string('nama_klasifikasi', 100);
            $table->integer('nilai');
            $table->timestamps();
            
            $table->foreign('kode_kriteria')
                  ->references('kode_kriteria')
                  ->on('kriteria')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('klasifikasi');
    }
};
