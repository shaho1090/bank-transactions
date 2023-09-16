<?php

namespace Banking\Services\DataProviders;

use Banking\Models\BankCard;
use Banking\Models\Setting;

class CardToCardDataProvider
{
    private BankCard $bankCardModel;

    public function __construct(private readonly array $data)
    {
        $this->bankCardModel = new BankCard();
    }

    public static function new(array $data): static
    {
        return new static($data);
    }

    public function handle(): CardToCardDTO
    {
        $DTO = new CardToCardDTO();

        $DTO->setOriginCard($this->findBankCard($this->data['origin_card']))
            ->setDestinationCard($this->findBankCard($this->data['destination_card']))
            ->setAmount($this->data['amount'])
            ->setFee($this->getCardToCardFee());

        $DTO->setTotalAmountToWithdraw(
            $DTO->getAmount() + $DTO->getFee()
        );

        return $DTO;
    }

    private function getCardToCardFee()
    {
        return (new Setting())->getCardToCardFee();
    }

    /**
     * @param string $cardNumber
     * @return BankCard
     */
    private function findBankCard(string $cardNumber): BankCard
    {
        return $this->bankCardModel->findByCardNumber($cardNumber);
    }
}
