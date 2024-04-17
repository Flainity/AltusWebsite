<?php

namespace App\Bundles;

use App\Bundles\AccountBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\User\UserInterface;

abstract class AbstractApiController extends AbstractController
{
    protected function apiResponse(string $message, array $data = [], int $status = 200): JsonResponse
    {
        $body = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ];

        return new JsonResponse($body, $status);
    }

    /**
     * @return User|null
     */
    protected function getUser(): ?UserInterface
    {
        return parent::getUser();
    }
}