<?php

namespace Banking\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = require __DIR__ . '/data_files/bank_account_card_prefix.php';

        $attributes = [];

        foreach ($data as $bankName => $cardPrefix) {
            $attributes[] = [
                'bank_name' => $bankName,
                'card_prefix' => $cardPrefix,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('bank_references')->insert($attributes);
    }
}
