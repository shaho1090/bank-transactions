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

    public function getCardToCardMinimumAmount()
    {
        return $this->query()->where('key', SettingsEnum::TRANSFER_CARD_MINIMUM_AMOUNT->value)->first()?->value;
    }

    public function getCardToCardMaximumAmount()
    {
        return $this->query()->where('key', SettingsEnum::TRANSFER_CARD_MAXIMUM_AMOUNT->value)->first()?->value;
    }
}
