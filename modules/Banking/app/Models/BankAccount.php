<?php

namespace Banking\Models;

use Banking\Factories\BankAccountFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BankAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_id',
        'user_id',
        'account_number'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function cards(): HasMany
    {
        return $this->hasMany(BankCard::class, 'bank_account_id');
    }

    protected static function newFactory(): Factory|BankAccountFactory
    {
        return BankAccountFactory::new();
    }
}
