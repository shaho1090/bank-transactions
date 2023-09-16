<?php

namespace Banking\Tests\Feature;

use App\Models\User;
use Banking\Seeders\BankReferenceSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Banking\tests\AdvancedFactories\BankCardFactory;
use Modules\Banking\tests\AdvancedFactories\BankCardNumberGenerator;
use Tests\TestCase;

class TransferTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(BankReferenceSeeder::class);
    }

    public function test_a_user_can_transfer_amount_of_money_via_bank_card()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $originCard = BankCardFactory::new()->forUser($sender)->hasBalance(10000)->create();
        $destinationCard = BankCardFactory::new()->forUser($receiver)->hasBalance(0)->create();


    }
}
