<?php

namespace App\Bundles\AccountBundle\Controller\Frontend;

use App\Bundles\AccountBundle\Entity\Item;
use App\Bundles\CharacterBundle\Manager\CharacterManager;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/cpanel', name: 'controlpanel.')]
class ControlPanelController extends AbstractController
{
    #[Route(path: '/', name: 'index')]
    public function index(CharacterManager $characterManager): Response
    {
        $user = $this->getUser();
        $characters = $characterManager->getCharactersByUserId($user->getId());

        return $this->render('pages/cpanel/index.html.twig', [
            'characters' => $characters,
        ]);
    }

    #[Route(path: '/test', name: 'test')]
    public function test(ManagerRegistry $registry): Response
    {
        $items = $registry->getRepository(Item::class)->findAll();
        dd($items);
        return $this->render('pages/cpanel/test.html.twig');
    }
}