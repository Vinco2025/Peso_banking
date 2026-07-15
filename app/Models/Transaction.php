<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'from_account_id',
        'to_account_id',
        'type',
        'amount',
        'description',
    ];

    // Transactions belongs to a source account
    public function fromAccount()
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    // Transactions belongs to a destination account
    public function toAccount()
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }
}
