<?php

namespace Banking\Models;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Banking\database\factories\BankCardFactory;

class BankCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_account_id',
        'card_number',
        'balance'
    ];

    protected static function newFactory(): BankCardFactory|Factory
    {
        return BankCardFactory::new();
    }
}
