<?php

namespace Modules\Banking\database\factories;

use Banking\Models\BankAccount;
use Banking\Models\BankCard;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\Banking\Models\BankCard>
 */
class BankCardFactory extends Factory
{
    protected $model = BankCard::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_account_id' => BankAccount::factory()->create()->id,
            'card_number' => (string)rand(1000000000000000, 99999999999999999),
            'balance' => 0
        ];
    }
}
