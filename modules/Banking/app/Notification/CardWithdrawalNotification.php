<?php

namespace Banking\Notification;


use App\Notification\AbstractSMSNotification;
use App\Services\SMS\SMSChannel;
use App\Services\SMS\SMSMessage;
use Banking\Models\Setting;
use Illuminate\Bus\Queueable;


class CardWithdrawalNotification extends AbstractSMSNotification
{
    public function setSMSMessage(): void
    {
        $this->message = (new SMSMessage(
            (new Setting())->getCardWithdrawalNotifText()
        ));
    }
}
