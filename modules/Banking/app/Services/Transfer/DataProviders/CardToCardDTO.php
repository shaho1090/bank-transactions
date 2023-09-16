<?php

namespace Banking\Services\Transfer\DataProviders;

use Banking\Models\BankCard;

class CardToCardDTO
{
    private BankCard $originCard;
    private BankCard $destinationCard;
    private int $amount;
    private int $fee;
    private int $totalAmountToWithdraw;

    public function getTotalAmountToWithdraw(): int
    {
        return $this->totalAmountToWithdraw;
    }

    public function setTotalAmountToWithdraw(int $totalAmountToWithdraw): CardToCardDTO
    {
        $this->totalAmountToWithdraw = $totalAmountToWithdraw;
        return $this;
    }

    public function getOriginCard(): BankCard
    {
        return $this->originCard;
    }

    public function setOriginCard(BankCard $originCard): CardToCardDTO
    {
        $this->originCard = $originCard;
        return $this;
    }

    public function getDestinationCard(): BankCard
    {
        return $this->destinationCard;
    }

    public function setDestinationCard(BankCard $destinationCard): CardToCardDTO
    {
        $this->destinationCard = $destinationCard;
        return $this;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function setAmount(int $amount): CardToCardDTO
    {
        $this->amount = $amount;
        return $this;
    }

    public function getFee(): int
    {
        return $this->fee;
    }

    public function setFee(int $fee): CardToCardDTO
    {
        $this->fee = $fee;
        return $this;
    }
}
