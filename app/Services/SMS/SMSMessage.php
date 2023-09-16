<?php

namespace App\Services\SMS;

class SMSMessage
{
    private string $content;
    private ?string $receptor = null;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setReceptor(string $receptor): static
    {
        $this->receptor = $receptor;

        return $this;
    }

    public function getReceptor(): string
    {
        return $this->receptor;
    }
}
