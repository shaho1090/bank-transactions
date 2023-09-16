<?php

namespace Banking\Factories;

use App\Models\User;
use Banking\Models\Bank;
use Banking\Models\BankAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BankAccount>
 */
class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_id' => Bank::factory()->create()->id,
            'user_id' => User::factory()->create()->id,
            'account_number' => (string) rand(10000000000,99999999999)
        ];
    }
}
