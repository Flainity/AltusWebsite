<?php

namespace App\Bundles\CharacterBundle\Controller\Api;

use App\Bundles\AbstractApiController;
use App\Bundles\CharacterBundle\Manager\CharacterManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CharacterController extends AbstractApiController
{
    #[Route('/list', name: 'character_list')]
    public function getCharacters(CharacterManager $characterManager): Response
    {
        $characters = $characterManager->getCharactersByUserId($this->getUser()->getId());

        return $this->apiResponse('Success', $characters);
    }

    #[Route('/fix-position', name: 'character_fix_position', methods: ['POST'])]
    public function fixPosition(Request $request, CharacterManager $characterManager): Response
    {
        $characterId = $request->get('characterId');
        $result = $characterManager->fixCharacterPosition($characterId);

        if ($result === false) {
            return $this->apiResponse('Character not found', [], Response::HTTP_BAD_REQUEST);
        }

        return $this->apiResponse('Character position has been fixed', [], Response::HTTP_OK);
    }
}