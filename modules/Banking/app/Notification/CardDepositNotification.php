<?php

namespace Banking\Notification;


use App\Notification\AbstractSMSNotification;
use App\Notification\SMSNotificationInterface;
use App\Services\SMS\SMSChannel;
use App\Services\SMS\SMSMessage;
use Banking\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CardDepositNotification extends AbstractSMSNotification
{

    public function setSMSMessage(): void
    {
        $this->message = (new SMSMessage(
            (new Setting())->getCardDepositNotifText()
        ));
    }
}
