<?php

namespace Modules\Banking\Services\Validator\Implementation;

use Modules\Banking\Services\Validator\Contract\CardNumberValidatorInterface;

class CardNumberValidator implements CardNumberValidatorInterface
{
    private int $expectedControllerDigit;
    private bool $validated = false;

    public function validate(string $cardNumber): bool
    {
        $result = [];

        $stringArray = str_split($cardNumber);

        $array = array_map(function ($item) {
            return (int)$item;
        }, $stringArray);

        for ($i = 0; $i < 15; $i += 2) {
            $number = $array[$i] * 2;
            if ($number >= 10) {
                $number = $number - 9;
            }

            $result[$i] = $number;
        }

        for ($i = 1; $i < 15; $i += 2) {
            $result[$i] = $array[$i] * 1;
        }

        ksort($result);

        $this->expectedControllerDigit = (10 - (array_sum($result) % 10));

        $this->validated = true;

        return $array[15] === $this->expectedControllerDigit;
    }


    public function getExpectedControllerDigit(string $cardNumber): int
    {
        if (!$this->validated) {
            $this->validate($cardNumber);
        }

        return $this->expectedControllerDigit;
    }
}
