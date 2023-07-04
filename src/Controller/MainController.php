<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(CategoryRepository $categoryRepository,
                          ItemRepository $itemRepository): Response
    {
        return $this->render("main/index.html.twig", [
            "categories" => $categoryRepository->getAllCategories(),
            "photos" => $itemRepository->getLastThreePaints()
        ]);
    }

    #[Route('/por/portfolio', name: 'app_main_portfolio')]
    public function portfolio(CategoryRepository $repository): Response
    {
        return $this->render("main/portfolio.html.twig", [
            "categories" => $repository->getAllCategories()
        ]);
    }


}