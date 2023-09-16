<?php

namespace App\Services\SMS\Providers;

use App\Services\SMS\SMSMessage;

abstract class SMSProvider
{
    protected string $lineNumber;

    public function __construct()
    {
        $this->setLineNumber();
    }

    abstract public function send(SMSMessage $message);

    abstract public function setLineNumber();

    public function getLineNumber(): string
    {
        return $this->lineNumber;
    }
}
