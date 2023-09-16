<?php

namespace App\Notification;


use App\Services\SMS\SMSChannel;
use App\Services\SMS\SMSMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class AbstractSMSNotification extends Notification implements SMSNotificationInterface
{
    use Queueable;

    protected SMSMessage $message;

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable): array
    {
        return [
            SMSChannel::class,
        ];
    }

    public function toMobile(): SMSMessage
    {
        return $this->message;
    }

    abstract public function setSMSMessage();
}
