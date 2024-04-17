<?php

namespace App\Bundles;

use App\Bundles\AccountBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AbstractFiestaController extends AbstractController
{
    /**
     * @return User|null
     */
    protected function getUser(): ?UserInterface
    {
        return parent::getUser();
    }
}