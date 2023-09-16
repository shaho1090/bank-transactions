<?php

namespace Banking\Models;

use Banking\Enums\TransferTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_id',
        'to_id',
        'amount',
        'type'
    ];

    public function originCard(): BelongsTo
    {
        return $this->belongsTo(BankCard::class,'from_id')
            ->where('type',TransferTypeEnum::CARD);
    }

    public function destinationCard(): BelongsTo
    {
        return $this->belongsTo(BankCard::class,'to_id')
            ->where('type',TransferTypeEnum::CARD);
    }

    public function fee(): HasOne
    {
        return $this->hasOne(TransferFee::class,'transfer_id');
    }
}
