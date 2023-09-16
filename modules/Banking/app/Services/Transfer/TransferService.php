<?php

namespace Banking\Services\Transfer;

use Banking\Models\Transfer;
use Banking\Services\Transfer\DataProviders\CardToCardDataProvider;
use Illuminate\Database\Eloquent\Model;

class TransferService
{
    public function cardToCard($data): Model|Transfer
    {
        return CardToCard::new(
            CardToCardDataProvider::new($data)->handle()
        )->transfer();
    }
}
