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
        Schema::create('evaluasi', function (Blueprint $table) {
            $table->id('id_evaluasi');
            $table->string('kode_prs', 10);
            $table->string('kode_kriteria', 10);
            $table->decimal('nilai', 10, 2);
            $table->timestamps();
            
            $table->unique(['kode_prs', 'kode_kriteria']);
            $table->foreign('kode_prs')
                  ->references('kode_prs')
                  ->on('perusahaan')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('evaluasi');
    }
};
