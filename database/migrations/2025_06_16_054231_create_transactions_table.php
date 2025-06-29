<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_xxxxxx_create_transactions_table.php
public function up(): void
{
    Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Nama transaksi, cth: "Beli Kopi", "Gaji Bulanan"
        $table->decimal('amount', 15, 2); // Jumlah uang
        $table->enum('type', ['pemasukan', 'pengeluaran']); // Jenis transaksi
        $table->date('transaction_date'); // Tanggal transaksi terjadi
        $table->timestamps();
    });
}
};