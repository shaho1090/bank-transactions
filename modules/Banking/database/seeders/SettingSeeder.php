<?php

namespace Banking\Seeders;

use App\Services\SMS\Providers\Kavenegar;
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
                'key' => SettingsEnum::CARD_WITHDRAWAL_NOTIF_TEXT->value,
                'value' => 'Your Bank Card has been withdrawn!'
            ],[
                'key' => SettingsEnum::CARD_DEPOSIT_NOTIF_TEXT->value,
                'value' => 'Your Bank Card has been deposited!'
            ],[
                'key' => SettingsEnum::TRANSFER_CARD_FEE_AMOUNT->value,
                'value' => 500
            ],[
                'key' => SettingsEnum::TRANSFER_CARD_MINIMUM_AMOUNT->value,
                'value' => 1000
            ],[
                'key' => SettingsEnum::TRANSFER_CARD_MAXIMUM_AMOUNT->value,
                'value' => 50000000
            ],[
                'key' => SettingsEnum::DEFAULT_SMS_PROVIDER->value,
                'value' => Kavenegar::class
            ],
        ]);
    }
}
