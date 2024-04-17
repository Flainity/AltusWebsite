<?php

namespace App\Bundles\MainBundle\Manager;

use App\Bundles\MainBundle\Entity\Setting;
use App\Bundles\MainBundle\Exception\SettingNotFoundException;
use Doctrine\Persistence\ManagerRegistry;

class SettingManager
{
    protected ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * @throws SettingNotFoundException
     */
    public function getValueByKey(string $key): string
    {
        $setting = $this->doctrine->getRepository(Setting::class)->findOneBy(['identifier' => $key]);

        if (!$setting instanceof Setting) {
            throw new SettingNotFoundException();
        }

        return $setting->getValue();
    }
}