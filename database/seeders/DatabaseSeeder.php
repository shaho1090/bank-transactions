<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Banking\Seeders\BankReferenceSeeder;
use Banking\Seeders\SettingSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        app(BankReferenceSeeder::class)->run();
        app(SettingSeeder::class)->run();
    }
}
