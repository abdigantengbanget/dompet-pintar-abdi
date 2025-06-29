<?php

// app/Models/Expense.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Izinkan kolom ini untuk diisi secara massal
    protected $fillable = [
        'user_id',
        'name',
        'amount',
    ];
}