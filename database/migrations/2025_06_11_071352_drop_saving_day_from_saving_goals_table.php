<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Ini adalah kerangka class yang hilang
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('saving_goals', function (Blueprint $table) {
            // Menghapus kolom 'saving_day' dari tabel
            $table->dropColumn('saving_day');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('saving_goals', function (Blueprint $table) {
            // Ini akan membuat kolomnya kembali jika Anda melakukan rollback
            // Ini adalah praktik yang baik
            $table->integer('saving_day')->after('frequency'); // sesuaikan 'after' jika perlu
        });
    }
};