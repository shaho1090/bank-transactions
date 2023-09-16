<?php

namespace App\Services\SMS;


use App\Notification\SMSNotificationInterface;
use Banking\Models\Setting;

class SMSChannel
{
    /**
     * @param object $notifiable
     * @param SMSNotificationInterface $notification
     * @return void
     * @throws \Exception
     */
    public function send(object $notifiable, SMSNotificationInterface $notification): void
    {
        $message = $notification->toMobile();

        if (empty($message->getReceptor())) {
            $message->setReceptor(
                $notifiable->routeNotificationFor('sms', $notification)
            );
        }

        $providerClass = $this->getDefaultSMSProvider();
        $provider = new $providerClass();
        $provider->send($message);
    }

    /**
     * @throws \Exception
     */
    private function getDefaultSMSProvider()
    {
        $defaultProvider = (new Setting())->getDefaultSMSProvider();
        $registeredSMSProviders = require __DIR__ . '/Providers/providers.php';

        if (!is_null($defaultProvider) && (in_array($defaultProvider, $registeredSMSProviders))) {
            return $defaultProvider;
        }

        abort(400, 'The default SMS provider is not set!');
    }
}
