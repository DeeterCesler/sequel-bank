<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'number',
        'type',
        'balance',
        'status'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2'
        ];
    }

    /**
     * Get the users associated with this account.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
