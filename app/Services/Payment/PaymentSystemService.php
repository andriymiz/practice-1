<?php

namespace App\Services\Payment;

use LiqPay;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

class PaymentSystemService
{
    private PaymentSystem $paymentSystem;

    /**
     * For chose payment system type
     *
     * @return void
     */
    public function __construct()
    {
        // Get payment type from config
        $paymentSystemType = 'paypal';

        switch ($paymentSystemType) {
            case 'paypal':
                $this->paymentSystem = $this->initPayPalSystem();
                break;

            case 'liqpay':
                $this->paymentSystem = $this->initLiqPaySystem();
                break;
        }
    }

    /**
     * Getter
     *
     * @return PaymentSystem
     */
    public function getPaymentSystem(): PaymentSystem
    {
        return $this->paymentSystem;
    }

    /**
     * Initialize PayPal.
     * https://github.com/paypal/Checkout-PHP-SDK
     *
     * @return PayPalPaymentSystem
     */
    private function initPayPalSystem(): PayPalPaymentSystem
    {
        // Creating an environment
        $clientId = "<<PAYPAL-CLIENT-ID>>";
        $clientSecret = "<<PAYPAL-CLIENT-SECRET>>";

        $environment = new SandboxEnvironment($clientId, $clientSecret);
        $client = new PayPalHttpClient($environment);

        return new PayPalPaymentSystem($client);
    }

    /**
     * Initialize LiqPay.
     * https://www.liqpay.ua/documentation/en/api/aquiring/checkout/doc
     *
     * @return LiqPayPaymentSystem
     */
    private function initLiqPaySystem(): LiqPayPaymentSystem
    {
        // Creating an environment
        $publicKey = "<<LIQPAY-PUBLIC-KEY>>";
        $privateKey = "<<LIQPAY-PRIVATE-KEY>>";

        $liqpay = new LiqPay($publicKey, $privateKey);

        return new LiqPayPaymentSystem($liqpay);
    }
}
