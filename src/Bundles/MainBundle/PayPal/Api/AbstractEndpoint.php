<?php

namespace App\Bundles\MainBundle\PayPal\Api;

abstract class AbstractEndpoint
{
    private string $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }
}