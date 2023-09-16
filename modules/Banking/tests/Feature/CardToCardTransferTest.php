<?php

namespace Banking\Tests\Feature;

use App\Models\User;
use Banking\Models\Setting;
use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Banking\tests\AdvancedFactories\BankCardFactory;
use Tests\TestCase;

class CardToCardTransferTest extends TestCase
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

        $this->postJson(route('transfer.card.store'), $request)->assertStatus(200);

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

    public function test_a_user_can_not_transfer_amount_of_money_more_than_its_balance()
    {
        $this->withoutExceptionHandling();

        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $balance = 10000;
        $originCard = BankCardFactory::new()->forUser($sender)->hasBalance($balance)->create();
        $destinationCard = BankCardFactory::new()->forUser($receiver)->hasBalance(0)->create();

        $request = [
            'origin_card' => $originCard->card_number,
            'destination_card' => $destinationCard->card_number,
            'amount' => $balance - 1
        ];

        $this->postJson(route('transfer.card.store'), $request)->assertStatus(422);
    }

    public function test_a_user_can_not_transfer_amount_of_money_less_than_minimum_amount_in_setting()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $originCard = BankCardFactory::new()->forUser($sender)->hasBalance(100000000)->create();
        $destinationCard = BankCardFactory::new()->forUser($receiver)->hasBalance(0)->create();

        $request = [
            'origin_card' => $originCard->card_number,
            'destination_card' => $destinationCard->card_number,
            'amount' => (new Setting())->getCardToCardMinimumAmount() - 1
        ];

        $this->postJson(route('transfer.card.store'), $request)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');;
    }

    public function test_a_user_can_not_transfer_amount_of_money_more_than_maximum_amount_in_setting()
    {
        $sender = User::factory()->create();
        $receiver = User::factory()->create();

        $originCard = BankCardFactory::new()->forUser($sender)->hasBalance(100000)->create();
        $destinationCard = BankCardFactory::new()->forUser($receiver)->hasBalance(0)->create();

        $request = [
            'origin_card' => $originCard->card_number,
            'destination_card' => $destinationCard->card_number,
            'amount' => (new Setting())->getCardToCardMaximumAmount() + 1
        ];

        $this->postJson(route('transfer.card.store'), $request)
            ->assertStatus(422)
            ->assertJsonValidationErrorFor('amount');
    }
}
