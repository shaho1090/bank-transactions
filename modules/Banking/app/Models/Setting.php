<?php

namespace Banking\Models;

use Banking\Enums\SettingsEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value'
    ];

    public function getCardToCardFee()
    {
        return $this->query()->where('key', SettingsEnum::TRANSFER_CARD_FEE_AMOUNT->value)->first()?->value;
    }
}
