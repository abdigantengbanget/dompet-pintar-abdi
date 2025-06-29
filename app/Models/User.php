<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import class HasMany untuk relasi
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * Atribut yang boleh diisi secara massal.
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',      // <-- DIPERBAIKI: Menambahkan google_id
        'job',            // <-- Sudah benar
        'monthly_income', // <-- Sudah benar
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * Atribut yang disembunyikan saat model diubah menjadi array atau JSON.
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'google_token',           // Sebaiknya disembunyikan untuk keamanan
        'google_refresh_token',   // Sebaiknya disembunyikan untuk keamanan
    ];

    /**
     * Get the attributes that should be cast.
     *
     * Mendapatkan tipe data kustom untuk atribut.
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed', // <-- DIPERBAIKI: Cara casting password yang benar
        ];
    }


    // ==========================================================
    // == RELASI DATABASE ==
    // ==========================================================

    /**
     * Mendefinisikan relasi "one-to-many": Seorang User memiliki banyak Saving Goals.
     */
    public function savingGoals(): HasMany
    {
        return $this->hasMany(SavingGoal::class);
    }

    /**
     * Mendefinisikan relasi "one-to-many": Seorang User memiliki banyak Expenses.
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    /**
     * Mendefinisikan relasi "one-to-many": Seorang User memiliki banyak Transactions.
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}