<?php

namespace App\Services\SMS\Providers;

use App\Services\SMS\SMSMessage;

interface ProviderInterface
{
    public function send(SMSMessage $message);

    public function setLineNumber();
}
