<?php

namespace App\Services\Payment;

use App\Interfaces\PaymentSystemInterface;
use App\Models\Order;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PayPalPaymentSystem implements PaymentSystemInterface
{
    /**
     * For chose payment system type
     *
     * @return void
     */
    public function __construct(
        private PayPalHttpClient $client
    ) {}

    /**
     * From example https://github.com/paypal/Checkout-PHP-SDK#creating-an-order
     *
     * @param Order $order
     *
     * @return Checkout
     */
    public function createCheckout(Order $order)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = [
            "intent" => "CAPTURE",
            "purchase_units" => [[
                "reference_id" => "test_ref_id1",
                "amount" => [
                    "value" => "100.00",
                    "currency_code" => "USD"
                ]
            ]],
            "application_context" => [
                "cancel_url" => "https://example.com/cancel",
                "return_url" => "https://example.com/return"
            ]
        ];

        try {
            // Call API with your client and get a response for your call
            $response = $this->client->execute($request);

            // If call returns body in response, you can get the deserialized
            // version from the result attribute of the response
            return $response;
        } catch (HttpException $ex) {
            echo $ex->statusCode;
            return $ex->getMessage();
        }
    }
}
