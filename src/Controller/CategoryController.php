<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/{category}', name: 'app_category_category')]
    public function category(string $category,
                             CategoryRepository $categoryRepository,
                             ItemRepository $itemRepository
    ): Response
    {
        $repoCategory = $categoryRepository->findOneBySlug($category);


        if($repoCategory != null)
        {
            $items = $itemRepository->getAllItemsByCategory($repoCategory);
            $counter = (count($items)%3==0) ? count($items)/3 : count($items)/3 + 1;

            return $this->render('category/category.html.twig', [
                'category' => $repoCategory,
                "categories" => $categoryRepository->getAllCategories(),
                "items" => $items,
                "counter" => $counter,
                "length" => count($items)
            ]);
        }
        else
            throw $this->createNotFoundException("Category ".$category." is not exist!");
    }

}