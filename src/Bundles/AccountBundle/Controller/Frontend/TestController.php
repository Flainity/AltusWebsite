<?php

namespace App\Bundles\AccountBundle\Controller\Frontend;

use App\Bundles\AccountBundle\Entity\Authentication;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function test(ManagerRegistry $doctrine): Response
    {
        $admins = $doctrine->getRepository(Authentication::class)->findOneBy(['name' => 'ADMIN']);
        dd($admins->getUsers()->toArray());
    }
}