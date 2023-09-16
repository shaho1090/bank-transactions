<?php

namespace Banking\Enums;

use Banking\Models\BankAccount;
use Banking\Models\BankCard;

enum SettingsEnum: string
{
    case CARD_WITHDRAWAL_NOTIF_TEXT = 'card_withdrawal_notif_text';
    case CARD_DEPOSIT_NOTIF_TEXT = 'card_deposit_notif_text';
    case TRANSFER_CARD_FEE_AMOUNT = 'transfer_card_fee_amount';
    case TRANSFER_CARD_MINIMUM_AMOUNT = 'transfer_card_minimum_amount';
    case TRANSFER_CARD_MAXIMUM_AMOUNT = 'transfer_card_maximum_amount';
    case DEFAULT_SMS_PROVIDER = 'default_sms_provider';
}
