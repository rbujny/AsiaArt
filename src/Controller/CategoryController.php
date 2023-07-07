<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/categories/{category}', name: 'app_category_category')]
    public function category(string $category,
                             Request $request,
                             PaginatorInterface $paginator,
                             CategoryRepository $categoryRepository,
                             ItemRepository $itemRepository
    ): Response
    {
        $repoCategory = $categoryRepository->findOneBySlug($category);
        if($repoCategory != null)
        {
            $pagination = $paginator->paginate(
                $itemRepository->getAllItemsByCategory($repoCategory),
                $request->query->getInt('page', 1),
                12
            );

            return $this->render('category/category.html.twig', [
                'category' => $repoCategory,
                "categories" => $categoryRepository->getAllCategories(),
                "pagination" => $pagination
            ]);
        }
        else
            throw $this->createNotFoundException("Category ".$category." is not exist!");
    }

}