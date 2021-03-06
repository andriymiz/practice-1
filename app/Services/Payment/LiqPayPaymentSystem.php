<?php

namespace App\Services\Payment;

use App\Interfaces\PaymentSystemInterface;
use App\Models\Order;
use LiqPay;

class LiqPayPaymentSystem implements PaymentSystemInterface
{
    /**
     * For chose payment system type
     *
     * @return void
     */
    public function __construct(
        private LiqPay $client
    ) {}

    /**
     * From example https://www.liqpay.ua/documentation/en/api/aquiring/checkout/doc
     *
     * @param Order $order
     *
     * @return Checkout
     */
    public function createCheckout(Order $order)
    {
        return $this->client->cnb_form([
            'action' => 'pay',
            'amount' => '1',
            'currency' => 'USD',
            'description' => 'description text',
            'order_id' => 'order_id_1',
            'version' => '3',
        ]);
    }
}
