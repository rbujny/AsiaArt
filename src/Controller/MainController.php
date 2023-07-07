<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(CategoryRepository $categoryRepository,
                          ItemRepository $itemRepository,
    UserRepository $userRepository): Response
    {
        return $this->render("main/index.html.twig", [
            "categories" => $categoryRepository->getAllCategories(),
            "photos" => $itemRepository->getLastThreePaints()
        ]);
    }

    #[Route('/portfolio', name: 'app_main_portfolio')]
    public function portfolio(CategoryRepository $categoryRepository,
                              Request $request,
                              ItemRepository $itemRepository,
                              PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
          $itemRepository->findAll(),
          $request->query->getInt('page', 1),
          12
        );

        return $this->render("main/portfolio.html.twig", [
            "categories" => $categoryRepository->getAllCategories(),
            "pagination" => $pagination
        ]);
    }
}