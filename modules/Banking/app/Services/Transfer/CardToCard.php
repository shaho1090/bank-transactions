<?php

namespace Banking\Services\Transfer;

use Banking\Enums\TransferTypeEnum;
use Banking\Models\Transfer;
use Banking\Services\Transfer\DataProviders\CardToCardDTO;
use Illuminate\Database\Eloquent\Model;

class CardToCard
{
    public function __construct(private readonly CardToCardDTO $DTO)
    {
    }

    public static function new(CardToCardDTO $DTO): static
    {
        return new static($DTO);
    }

    public function transfer(): Model|Transfer
    {
        $this->withdrawTotalAmountFromOriginCard();
        $this->depositAmountToDestinationCard();
        $transfer = $this->storeTransfer();
        $this->storeTransferFee($transfer);

        return $transfer;
    }

    private function ensureOriginHasEnoughBalance(): void
    {
        if ($this->DTO->getOriginCard()->balance < $this->DTO->getTotalAmountToWithdraw()) {
            abort(422, 'Not enough balance to transfer');
        }
    }

    private function withdrawTotalAmountFromOriginCard(): void
    {
        $this->ensureOriginHasEnoughBalance();

        $this->DTO->getOriginCard()->update([
            'balance' => (
                $this->DTO->getOriginCard()->balance -
                $this->DTO->getTotalAmountToWithdraw()
            )
        ]);
    }

    private function depositAmountToDestinationCard(): void
    {
        $this->DTO->getDestinationCard()->update([
            'balance' => (
                $this->DTO->getDestinationCard()->balance +
                $this->DTO->getAmount())
        ]);
    }

    private function storeTransfer(): Transfer|Model
    {
        return Transfer::query()->create([
            'type' => TransferTypeEnum::CARD->value,
            'from_id' => $this->DTO->getOriginCard()->id,
            'to_id' => $this->DTO->getDestinationCard()->id,
            'amount' => $this->DTO->getAmount(),
        ]);
    }

    private function storeTransferFee(Transfer $transfer): void
    {
        $transfer->fee()->create([
            'amount' => $this->DTO->getFee()
        ]);
    }
}
