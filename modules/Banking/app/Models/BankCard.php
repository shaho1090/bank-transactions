<?php

namespace Banking\Models;

use Banking\Enums\TransferTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    public function findByCardNumber($cardNumber): ?BankCard
    {
        /** @var ?BankCard */
        return $this->query()->where('card_number', $cardNumber)->first();
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class,'bank_account_id');
    }
}
