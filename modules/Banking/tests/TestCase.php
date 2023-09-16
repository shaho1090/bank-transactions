<?php


use Banking\Providers\BankingServiceProvider;
use Tests\TestCase as OriginTestCase;

abstract class TestCase extends OriginTestCase
{
    protected function getPackageProviders($app): array
    {
        return [BankingServiceProvider::class];
    }
}
