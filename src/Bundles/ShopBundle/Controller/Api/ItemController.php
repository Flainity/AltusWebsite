<?php

namespace App\Bundles\ShopBundle\Controller\Api;

use App\Bundles\AbstractApiController;
use App\Bundles\AccountBundle\Repository\UserRepository;
use App\Bundles\ShopBundle\Manager\ItemManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/item')]
class ItemController extends AbstractApiController
{
    #[Route('/category/{categoryId}', name: 'item_list_by_category')]
    public function listByCategory(int $categoryId, ItemManager $itemManager): Response
    {
        return $this->apiResponse('Success', $itemManager->getItemsByCategory($categoryId));
    }

    #[Route('/buy', name: 'item_buy', methods: ['POST'])]
    public function buy(Request $request, ItemManager $itemManager, UserRepository $userRepository): Response
    {
        $parameters = json_decode($request->getContent(), true);

        if (!isset($parameters['itemId'])) {
            return $this->apiResponse('Item ID is required', [], Response::HTTP_BAD_REQUEST);
        }

        $item = $itemManager->getItem($parameters['itemId']);

        if ($item === null) {
            return $this->apiResponse('Item not found', [], Response::HTTP_NOT_FOUND);
        }

        if ($item->isSaleOff() && $item->getStock() < 1) {
            return $this->apiResponse('Item is out of stock', [], Response::HTTP_ACCEPTED);
        }

        if ($itemManager->isItemDiscounted($item)) {
            if ($this->getUser()->getCoins() < $item->getDiscountedPrice()) {
                return $this->apiResponse('You don\'t have enough coins to buy this item', [], Response::HTTP_ACCEPTED);
            }

            $this->getUser()->setCoins($this->getUser()->getCoins() - $item->getDiscountedPrice());
        } else {
            if ($this->getUser()->getCoins() < $item->getPrice()) {
                return $this->apiResponse('You don\'t have enough coins to buy this item', [], Response::HTTP_ACCEPTED);
            }

            $this->getUser()->setCoins($this->getUser()->getCoins() - $item->getPrice());
        }

        // TODO: Implement the logic to add the item to the user's inventory
        $userRepository->save($this->getUser());
        $responseMessage = $item->getName() . ' has been sent to your inventory.';

        return $this->apiResponse($responseMessage, [], Response::HTTP_OK);
    }
}