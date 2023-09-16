<?php

namespace App\Services\SMS\Providers;

use App\Services\SMS\SMSMessage;
use Kavenegar\Laravel\Facade as KavenegarProvider;

class Kavenegar extends SMSProvider
{

    public function send(SMSMessage $message)
    {
        info('message has been sent.');

        return KavenegarProvider::Send($this->getLineNumber(), $message->getReceptor(), $message->getContent());
    }

    public function setLineNumber(): void
    {
        $this->lineNumber = '10008663';
    }
}
