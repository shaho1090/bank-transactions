<?php

namespace Modules\Banking\Services\Validator\Contract;

interface CardNumberValidatorInterface
{
    public function validate(string $cardNumber): bool;
    public function getExpectedControllerDigit(string $cardNumber): int;
}
