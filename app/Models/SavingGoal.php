<?php
// app/Models/SavingGoal.php (Diperbaiki)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavingGoal extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'amount',
        'due_date',
        'frequency',
        'installments',
        'current_amount', // <--- INI ADALAH PERBAIKANNYA
    ];

    /**
     * Mendefinisikan relasi "belongs-to": SavingGoal ini dimiliki oleh seorang User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}