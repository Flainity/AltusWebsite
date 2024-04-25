<?php

namespace App\Bundles\MainBundle\Manager;

use App\Bundles\MainBundle\Exception\SettingNotFoundException;
use App\Bundles\MainBundle\Model\SettingType;
use App\Bundles\MainBundle\PayPal\Api\Authentication;
use Symfony\Contracts\HttpClient\HttpClientInterface;

readonly class PaypalManager
{
    private string $clientId;
    private string $clientSecret;
    private string $email;
    private string $environment;
    private string $baseUrl;
    private HttpClientInterface $client;
    private SettingManager $settingManager;

    /**
     * @throws SettingNotFoundException
     */
    public function __construct(SettingManager $settingManager, HttpClientInterface $client)
    {
        $this->settingManager = $settingManager;
        $this->client = $client;

        try {
            $this->clientId = $settingManager->getSettingValue(SettingType::PAYPAL_CLIENT_ID->value);
            $this->clientSecret = $settingManager->getSettingValue(SettingType::PAYPAL_CLIENT_SECRET->value);
            $this->email = $settingManager->getSettingValue(SettingType::PAYPAL_EMAIL->value);
            $this->environment = $settingManager->getSettingValue(SettingType::PAYPAL_ENVIRONMENT->value);

            if ($this->environment === 'sandbox') {
                $this->baseUrl = 'https://api-m.sandbox.paypal.com';
            } else {
                $this->baseUrl = 'https://api-m.paypal.com';
            }
        } catch (SettingNotFoundException $e) {
            throw new SettingNotFoundException('Paypal settings not found');
        }
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function getClient(): HttpClientInterface
    {
        return $this->client;
    }

    public function getSettingManager(): SettingManager
    {
        return $this->settingManager;
    }

    public function createAuthentication(): Authentication
    {
        return new Authentication($this);
    }
}