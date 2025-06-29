<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'type',
        'transaction_date',
    ];
    
    // Memberitahu Laravel untuk memperlakukan kolom ini sebagai tipe data tertentu
    protected $casts = [
        'transaction_date' => 'date',
    ];
}