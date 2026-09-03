<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kalkulasi', function (Blueprint $table) {
            $table->unsignedBigInteger('id_admin')->after('id_hasil');
            $table->unique(['id_admin', 'kode_prs']);
            $table->foreign('id_admin')
                ->references('id_admin')
                ->on('admin')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('kalkulasi', function (Blueprint $table) {
            $table->dropForeign(['id_admin']);
            $table->dropUnique(['id_admin', 'kode_prs']);
            $table->dropColumn('id_admin');
        });
    }
};
