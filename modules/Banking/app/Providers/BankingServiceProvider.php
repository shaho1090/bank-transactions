<?php

namespace Banking\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Banking\Services\Validator\Contract\CardNumberValidatorInterface;
use Modules\Banking\Services\Validator\Implementation\CardNumberValidator;

class BankingServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/api.php');

        $this->app->bind(
            CardNumberValidatorInterface::class,
            CardNumberValidator::class
        );
    }
}
