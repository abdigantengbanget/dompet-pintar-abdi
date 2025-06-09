<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'due_date',
        'monthly_income',
        'installments',
        'frequency',
        'saving_day',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
