<?php

namespace Banking\Tests\Feature;

use App\Models\User;
use Banking\Models\BankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_many_account_numbers()
    {
        $user = User::factory()->create();

        BankAccount::factory(3)->create([
            'user_id' => $user->id
        ]);

        $this->assertEquals(3, $user->bankAccounts()->count());
    }
}
