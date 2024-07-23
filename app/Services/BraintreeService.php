<?php

namespace App\Services;

use Braintree\Gateway;

class BraintreeService
{
    protected $gateway;

    public function __construct()
    {
        $this->gateway = new Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchant_id'),
            'publicKey' => config('services.braintree.public_key'),
            'privateKey' => config('services.braintree.private_key'),
        ]);
    }

    public function gateway()
    {
        return $this->gateway;
    }

    public function generateClientToken()
    {
        return $this->gateway->clientToken()->generate();
    }
}
