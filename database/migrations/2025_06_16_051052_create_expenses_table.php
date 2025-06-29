<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_xx_xx_xxxxxx_create_expenses_table.php
public function up(): void
{
    Schema::create('expenses', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Milik user siapa
        $table->string('name'); // Nama pengeluaran, cth: "Sewa Kost", "Langganan Netflix"
        $table->decimal('amount', 15, 2); // Jumlah pengeluaran
        $table->timestamps();
    });
}
};