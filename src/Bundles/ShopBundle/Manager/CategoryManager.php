<?php

namespace App\Bundles\ShopBundle\Manager;

use App\Bundles\AccountBundle\Entity\ItemCategory;
use App\Bundles\AccountBundle\Repository\ItemCategoryRepository;

class CategoryManager
{
    protected ItemCategoryRepository $itemCategoryRepository;
    protected ItemManager $itemManager;

    public function __construct(ItemCategoryRepository $itemCategoryRepository, ItemManager $itemManager)
    {
        $this->itemCategoryRepository = $itemCategoryRepository;
        $this->itemManager = $itemManager;
    }

    public function getCategories(): array
    {
        return $this->itemCategoryRepository->findAll();
    }

    public function getCategory(int $id): ?ItemCategory
    {
        return $this->itemCategoryRepository->findOneBy(['id' => $id]);
    }

    public function getCategoriesWithItemCount(): array
    {
        $categories = $this->itemCategoryRepository->findAll();
        $categoriesWithItemCount = [];

        foreach ($categories as $category) {
            $categoriesWithItemCount[] = [
                'id' => $category->getId(),
                'name' => $category->getName(),
                'active' => $category->isActive(),
                'item_count' => count($this->itemManager->getItemsByCategory($category->getId()))
            ];
        }

        return $categoriesWithItemCount;
    }
}