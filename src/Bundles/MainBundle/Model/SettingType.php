<?php

namespace App\Bundles\MainBundle\Model;

enum SettingType : string
{
    case DEFAULT_AUTHENTICATION = 'default_authentication';
    case RESET_MAP = 'reset_map';
    case RESET_MAP_X = 'reset_map_x';
    case RESET_MAP_Y = 'reset_map_y';
    case PAYPAL_CLIENT_ID = 'paypal_client_id';
    case PAYPAL_CLIENT_SECRET = 'paypal_client_secret';
    case PAYPAL_EMAIL = 'paypal_email';
    case PAYPAL_ENVIRONMENT = 'paypal_environment';
}
