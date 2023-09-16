<?php

namespace App\Services\SMS\Providers;

use App\Services\SMS\SMSMessage;
use Ghasedak\Laravel\GhasedakFacade;

class Ghasedak extends SMSProvider
{

    public function send(SMSMessage $message)
    {
        info('Message has been sent.');

        return GhasedakFacade::SendSimple($message->getReceptor(), $message->getContent(), $this->getLineNumber());
    }

    public function setLineNumber()
    {
        $this->lineNumber = '300002525' ;
    }
}
