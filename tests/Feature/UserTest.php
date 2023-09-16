<?php

namespace Tests\Feature;

use App\Models\User;
use Banking\Models\BankAccount;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_have_a_mobile_number(): void
    {
        $user = User::factory()->make();

        $this->assertNotNull($user->mobile);
    }
}
