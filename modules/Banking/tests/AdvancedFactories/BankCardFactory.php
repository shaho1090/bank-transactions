<?php

namespace Modules\Banking\tests\AdvancedFactories;

use App\Models\User;
use Banking\Models\Bank;
use Banking\Models\BankAccount;
use Banking\Models\BankCard;

class BankCardFactory
{
    private ?BankAccount $bankAccount=null;
    private ?User $user = null;
    private ?Bank $bank = null;
    private ?string $cardNumber = null;
    private int $balance = 0;

    public static function new(): static
    {
        return new static();
    }

    public function useBank(Bank $bank): BankCardFactory
    {
        $this->bank = $bank;
        return $this;
    }

    public function useBankAccount(BankAccount $bankAccount): BankCardFactory
    {
        $this->bankAccount = $bankAccount;
        return $this;
    }

    public function useCardNumber(string $cardNumber): BankCardFactory
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function hasBalance(int $balance): BankCardFactory
    {
        $this->balance = $balance;
        return $this;
    }

    public function forUser(User $user = null): BankCardFactory
    {
        $this->user = $user;
        return $this;
    }

    private function setBank(): void
    {
        $this->bank = Bank::factory()->create();
    }

    private function setBankAccount(): void
    {
        $this->bankAccount = BankAccount::factory()->create([
            'bank_id' => $this->getBank()->id,
            'user_id' => $this->getUser()->id
        ]);
    }

    private function setUser(): void
    {
        $this->user = User::factory()->create();
    }

    public function create()
    {
        return BankCard::factory()->create([
            'bank_account_id' => $this->getBankAccount(),
            'card_number' => $this->getCardNumber(),
            'balance' => $this->getBalance(),
        ]);
    }

    private function getBankAccount(): BankAccount
    {
        if (is_null($this->bankAccount)) {
            $this->setBankAccount();
        }

        return $this->bankAccount;
    }

    private function getCardNumber(): ?string
    {
        if(is_null($this->cardNumber)){
            $this->cardNumber = BankCardNumberGenerator::new()->generate();
        }

        return $this->cardNumber;
    }

    private function getBalance(): int
    {
        if($this->balance === 0){
            $this->balance = rand(10000 , 99999);
        }

        return $this->balance;
    }

    private function getBank(): Bank
    {
        if (is_null($this->bank)) {
            $this->setBank();
        }

        return $this->bank;
    }

    private function getUser(): User
    {
        if (is_null($this->user)) {
            $this->setUser();
        }

        return $this->user;
    }
}
