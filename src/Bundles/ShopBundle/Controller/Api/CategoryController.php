<?php

namespace App\Bundles\ShopBundle\Controller\Api;

use App\Bundles\AbstractApiController;
use App\Bundles\ShopBundle\Manager\CategoryManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/category')]
class CategoryController extends AbstractApiController
{
    #[Route('/list', name: 'category_list')]
    public function list(CategoryManager $categoryManager): Response
    {
        return $this->apiResponse('Success', $categoryManager->getCategoriesWithItemCount());
    }
}