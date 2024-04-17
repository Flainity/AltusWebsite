<?php

namespace App\Bundles\AccountBundle\Controller\Api;

use App\Bundles\AbstractApiController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
class UserController extends AbstractApiController
{
    #[Route('/', name: 'user_get')]
    public function index(): Response
    {
        return $this->apiResponse('Success', json_decode(json_encode($this->getUser()), true));
    }

    #[Route('/coin-balance', name: 'user_coin_balance')]
    public function coinBalance(): Response
    {
        return $this->apiResponse('Success', ['coin_balance' => $this->getUser()->getCoins()]);
    }
}