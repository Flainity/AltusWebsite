<?php

namespace App\Bundles\MainBundle\PayPal\Api;

enum Endpoints : string
{
    case TOKEN = '/v1/oauth2/token';
    case ORDERS = '/v2/checkout/orders';
}
