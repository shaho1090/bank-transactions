<?php

namespace Banking\Enums;

use Banking\Models\BankAccount;
use Banking\Models\BankCard;

enum TransferTypeEnum: string
{
    case CARD = BankCard::class;
    case ACCOUNT = BankAccount::class;
}
