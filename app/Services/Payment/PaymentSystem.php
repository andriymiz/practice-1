<?php

namespace App\Services\Payment;

use App\Models\Order;

interface PaymentSystem
{
    /**
     * @param Order $order
     *
     * @return Checkout
     */
    public function createCheckout(Order $order);
}
