<?php

namespace App\Bundles\MainBundle\PayPal\Api;

use App\Bundles\MainBundle\Manager\PaypalManager;
use App\Bundles\MainBundle\Manager\SettingManager;
use App\Bundles\MainBundle\Model\SettingType;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Authentication extends AbstractEndpoint
{
    private PaypalManager $paypalManager;

    public function __construct(PaypalManager $paypalManager)
    {
        parent::__construct($paypalManager->getBaseUrl() . Endpoints::TOKEN->value);
        $this->paypalManager = $paypalManager;
    }

    public function getAccessToken(): string
    {
        $clientId = $this->paypalManager->getSettingManager()->getSettingValue(SettingType::PAYPAL_CLIENT_ID->value);
        $clientSecret = $this->paypalManager->getSettingManager()->getSettingValue(SettingType::PAYPAL_CLIENT_SECRET->value);

        $response = $this->paypalManager->getClient()->request('POST', $this->getUrl(), [
            'headers' => [
                'Authorization' => 'Basic ' . base64_encode($clientId . ':' . $clientSecret),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'body' => 'grant_type=client_credentials',
        ]);

        $content = $response->getContent();
        dd($content, json_decode($content, true));

        return $data['access_token'];
    }
}