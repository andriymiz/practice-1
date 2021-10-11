<?php

namespace App\Providers;

use App\Services\Payment\PayPalPaymentSystem;
use Illuminate\Support\ServiceProvider;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PayPalPaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * Initialize PayPal.
     * https://github.com/paypal/Checkout-PHP-SDK
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PayPalPaymentSystem::class, function ($app) {
            // Creating an environment
            $clientId = "<<PAYPAL-CLIENT-ID>>";
            $clientSecret = "<<PAYPAL-CLIENT-SECRET>>";

            $environment = new SandboxEnvironment($clientId, $clientSecret);
            $client = new PayPalHttpClient($environment);

            return new PayPalPaymentSystem($client);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
