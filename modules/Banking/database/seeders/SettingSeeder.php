<?php

namespace Banking\Seeders;

use Banking\Enums\SettingsEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'key' => SettingsEnum::BANK_CARD_WITHDRAWAL_NOTIFICATION->value,
                'value' => 'Your Bank Card has been withdrawn!'
            ],[
                'key' => SettingsEnum::BANK_CARD_DEPOSIT_NOTIFICATION->value,
                'value' => 'Your Bank Card has been deposited!'
            ],[
                'key' => SettingsEnum::TRANSFER_CARD_FEE_AMOUNT->value,
                'value' => 500
            ],
        ]);
    }
}
