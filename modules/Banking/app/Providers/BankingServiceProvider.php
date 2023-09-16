<?php

namespace Banking\Providers;

use Banking\Events\CardToCardEvent;
use Banking\Listeners\CardToCardListener;
use Banking\Services\Validator\Contract\CardNumberValidatorInterface;
use Banking\Services\Validator\Implementation\CardNumberValidator;
use Illuminate\Support\ServiceProvider;

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
