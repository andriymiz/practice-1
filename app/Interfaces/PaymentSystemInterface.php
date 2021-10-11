<?php

namespace App\Interfaces;

use App\Models\Order;

interface PaymentSystemInterface
{
    /**
     * @param Order $order
     *
     * @return Checkout
     */
    public function createCheckout(Order $order);
}
