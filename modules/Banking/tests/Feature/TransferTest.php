<?php

namespace Banking\Tests\Feature;

use App\Models\User;
use Banking\Models\Setting;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Banking\tests\AdvancedFactories\BankCardFactory;
use Tests\TestCase;

class TransferTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed(DatabaseSeeder::class);
    }

    public function test_a_user_can_transfer_amount_of_money_via_bank_card()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $originCard = BankCardFactory::new()->forUser($sender)->hasBalance(10000)->create();
        $destinationCard = BankCardFactory::new()->forUser($receiver)->hasBalance(0)->create();
        $cardToCardFee = (new Setting())->getCardToCardFee();

        $request = [
            'origin_card' => $originCard->card_number,
            'destination_card' => $destinationCard->card_number,
            'amount' => 5000
        ];

        $originCardFistBalance = $originCard->balance;
        $destinationCardFistBalance = $destinationCard->balance;

        $this->postJson(route('transfer.card.store'), $request)->dump();

        $this->assertEquals(
            ($originCardFistBalance - ($request['amount'] + $cardToCardFee)),
            $originCard->refresh()->balance);

        $this->assertEquals(
            ($destinationCardFistBalance + $request['amount']),
            $destinationCard->refresh()->balance);

        $this->assertDatabaseHas('transfers', [
            'from_id' => $originCard->id,
            'to_id' => $destinationCard->id,
            'amount' => $request['amount']
        ]);

        $this->assertDatabaseHas('transfer_fees', [
            'amount' => (new Setting())->getCardToCardFee()
        ]);
    }
}
