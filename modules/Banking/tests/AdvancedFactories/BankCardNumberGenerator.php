<?php

namespace Modules\Banking\tests\AdvancedFactories;

use Banking\Models\BankReference;
use Modules\Banking\Services\Validator\Contract\CardNumberValidatorInterface;

class BankCardNumberGenerator
{
    private ?string $cardNumber = null;
    private ?string $cardPrefix = null;
    private CardNumberValidatorInterface $cardNumberValidator;
    private BankReference $bankReference;

    /**
     * all numbers in odd place multiply with 2 if the result greater than 10 it minus with 9
     * all numbers in even place multiply with 1
     * and then all results must be summed and final result must be a multiple of ten / the remaining of division by ten
     * must be zero;
     */
    public function __construct()
    {
        $this->cardNumberValidator = app(CardNumberValidatorInterface::class);
        $this->bankReference = new BankReference();
    }

    public static function new(): static
    {
        return new static();
    }

    public function useCardPrefix(string $cardPrefix): BankCardNumberGenerator
    {
        $this->cardPrefix = $cardPrefix;
        return $this;
    }

    public function generate(): string
    {
        if (is_null($this->cardPrefix)) {
            $this->setCardPrefix();
        } else {
            $this->validateCardPrefix($this->cardPrefix);
        }

        $array = str_split($this->cardPrefix);

        $newArray = array_map(function ($item) {
            return (int)$item;
        }, $array);

        for ($i = 6; $i < 16; $i++) {
            $newArray[$i] = rand(0, 9);
        }

        $newArray[15] = $this->cardNumberValidator->getExpectedControllerDigit(implode($newArray));

        $this->cardNumber = implode($newArray);

        return $this->cardNumber;
    }

    private function setCardPrefix(): void
    {
        $this->ensureBankReferenceIsNotEmpty();

        $bankReference = BankReference::all()->random();

        $this->cardPrefix = $bankReference->card_prefix;
    }

    private function validateCardPrefix($cardPrefix): void
    {
        $this->ensureBankReferenceIsNotEmpty();

        if($this->bankReference->query()->where('card_prefix', $cardPrefix)->exists()){
            return;
        }

        abort(422, 'This card prefix is not defined.');
    }

    private function ensureBankReferenceIsNotEmpty(): void
    {
        if($this->bankReference->count()){
           return;
        }

        abort(422, 'There is no record in Bank Reference table!');
    }
}
