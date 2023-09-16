<?php

namespace Banking\Enums;

use Banking\Models\BankAccount;
use Banking\Models\BankCard;

enum SettingsEnum: string
{
    case BANK_CARD_WITHDRAWAL_NOTIFICATION = 'bank_card_withdrawal_notification';
    case BANK_CARD_DEPOSIT_NOTIFICATION = 'bank_card_deposit_notification';
    case TRANSFER_CARD_FEE_AMOUNT = 'transfer_card_fee_amount';
    case TRANSFER_CARD_MINIMUM_AMOUNT = 'transfer_card_minimum_amount';
    case TRANSFER_CARD_MAXIMUM_AMOUNT = 'transfer_card_maximum_amount';
}
