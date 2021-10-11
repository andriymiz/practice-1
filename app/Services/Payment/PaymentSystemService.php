<?php

namespace App\Services\Payment;

use App\Interfaces\PaymentSystemInterface;

class PaymentSystemService
{
    private PaymentSystemInterface $paymentSystem;

    /**
     * For chose payment system type
     *
     * @return void
     */
    public function __construct()
    {
        // Get payment type from config or request
        $paymentSystemType = 'paypal';

        switch ($paymentSystemType) {
            case 'paypal':
                $this->paymentSystem = $this->app->make(PayPalPaymentSystem::class);
                break;

            case 'liqpay':
                $this->paymentSystem = $this->app->make(LiqPayPaymentSystem::class);
                break;
        }
    }

    /**
     * Getter
     *
     * @return PaymentSystemInterface
     */
    public function getPaymentSystem(): PaymentSystemInterface
    {
        return $this->paymentSystem;
    }
}
