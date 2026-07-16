<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
        'user_id',
        'account_number',
        'balance',
        'type',
    ];

    protected $casts = [
        'balance' => 'decimal:2'
    ];

    //Shows if the account belongs to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // The account has many transactions
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'from_account_id')
                    ->orWhere('to_account_id', $this->id)
                    ->latest();
    }
}
