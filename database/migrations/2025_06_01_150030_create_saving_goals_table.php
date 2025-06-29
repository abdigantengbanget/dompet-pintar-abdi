<?php
// File: database/migrations/2025_06_01_150030_create_saving_goals_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // HANYA ADA KODE UNTUK MEMBUAT TABEL 'saving_goals'
        Schema::create('saving_goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Ini menunjuk ke tabel users
            $table->string('name');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('current_amount')->default(0);
            $table->unsignedBigInteger('installments')->default(0);
            $table->date('due_date');
            $table->enum('frequency', ['weekly', 'monthly'])->default('monthly');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('saving_goals');
    }
};