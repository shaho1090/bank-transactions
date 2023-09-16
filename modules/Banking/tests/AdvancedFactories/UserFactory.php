<?php

namespace Banking\tests\AdvancedFactories;

use App\Models\User;

class UserFactory
{
    private int $balance = 0;
    private ?User $user;
    private ?string $cardNumber;

    public function __construct(User $user=null)
    {
        $this->user = $user;
    }

    public static function new(User $user=null): static
    {
        return new static($user);
    }

    public function hasBalance(int $balance): UserFactory
    {
        $this->balance = $balance;
        return $this;
    }

    public function useCardNumber(string $cardNumber): UserFactory
    {
        $this->cardNumber = $cardNumber;
        return $this;
    }

    public function create()
    {
        if(is_null($this->user)){
            $this->setUser();
        }

        if(is_null($this->cardNumber)){
//            $this->setCarNumber();
        }

    }

    private function setUser(): void
    {
        $this->user = User::factory()->create();
    }

//    private function setCarNumber()
//    {
//        $this->cardNumber =
//    }
}
