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
        Schema::create('kalkulasi', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->unsignedBigInteger('id_admin');  // ← ubah dari unsignedInteger
            $table->string('kode_prs', 10);
            $table->decimal('skor_akhir', 5, 4);
            $table->integer('ranking')->nullable();
            $table->timestamp('tanggal_hitung')->useCurrent();
            
            $table->unique(['id_admin', 'kode_prs']);
            $table->foreign('id_admin')
                  ->references('id_admin')
                  ->on('admin')
                  ->onDelete('cascade');
            $table->foreign('kode_prs')
                  ->references('kode_prs')
                  ->on('perusahaan')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kalkulasi');
    }
};
