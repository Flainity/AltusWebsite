<?php

namespace App\Bundles\ShopBundle\Manager;

use App\Bundles\AccountBundle\Entity\Item;
use App\Bundles\AccountBundle\Repository\ItemRepository;

class ItemManager
{
    protected ItemRepository $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function getItems(): array
    {
        return $this->itemRepository->findAll();
    }

    public function getItem(int $itemId): ?Item
    {
        return $this->itemRepository->findOneBy(['id' => $itemId]);
    }

    public function getItemsByCategory(int $categoryId): array
    {
        return $this->itemRepository->findBy(['category' => $categoryId]);
    }

    public function isItemDiscounted(Item $item): bool
    {
        $today = new \DateTime();

        if ($item->getDiscountStartAt() === null || $item->getDiscountEndAt() === null) {
            return false;
        }

        return $today >= $item->getDiscountStartAt() && $today <= $item->getDiscountEndAt();
    }
}