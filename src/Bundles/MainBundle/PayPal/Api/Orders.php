<?php

namespace App\Bundles\MainBundle\PayPal\Api;

use App\Bundles\MainBundle\Manager\PaypalManager;
use Symfony\Component\HttpFoundation\Request;

class Orders extends AbstractEndpoint
{
    private PaypalManager $paypalManager;

    public function __construct(PaypalManager $paypalManager)
    {
        $this->paypalManager = $paypalManager;
        parent::__construct($paypalManager->getBaseUrl() . Endpoints::ORDERS->value);
    }

    public function createOrder(array $data): array
    {
        $response = $this->paypalManager->getClient()->request(Request::METHOD_POST, $this->getUrl(), [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->paypalManager->createAuthentication()->getAccessToken()
            ],
            'body' => $data
        ]);
    }
}