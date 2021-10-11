<?php

namespace App\Providers;

use App\Services\Payment\LiqPayPaymentSystem;
use Illuminate\Support\ServiceProvider;
use LiqPay;

class LiqPayPaymentProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * Initialize LiqPay.
     * https://www.liqpay.ua/documentation/en/api/aquiring/checkout/doc
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LiqPayPaymentSystem::class, function ($app) {
            // Creating an environment
            $publicKey = "<<LIQPAY-PUBLIC-KEY>>";
            $privateKey = "<<LIQPAY-PRIVATE-KEY>>";

            $liqpay = new LiqPay($publicKey, $privateKey);

            return new LiqPayPaymentSystem($liqpay);
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
