<?php

namespace App\Bundles\MainBundle\Model;

enum SettingType : string
{
    case DEFAULT_AUTHENTICATION = 'default_authentication';
    case RESET_MAP = 'reset_map';
    case RESET_MAP_X = 'reset_map_x';
    case RESET_MAP_Y = 'reset_map_y';
}
