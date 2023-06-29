<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(CategoryRepository $repository): Response
    {
        $items = [
            "My Little Pony" => ["PINKY PONY", "HEART PONY", "TREE CUTE PONIES",
                "PURPLE PONY", "ORANGE PONY WITH FANCY HAIR"],
            "Spongebob" => ["HAPPY SPONGE", "LOVELY SPONGE", "CUTE SPONGE", "PATRICK STAR"],
            "Hello Kitty" => ["FIRST PRETTY KITTY", "SECOND PRETTY KITTY", "THIRD PRETTY KITTY",
                "FOURTH PRETTY KITTY", "FIFTH PRETTY KITTY", "SIXTH PRETTY KITTY"],
            "Winx" => ["NICE ONE", "EVEN BETTER", "SEXY CHICK", "CUTE GIRL","NOT BAD CHICK",
                "SAD CHICK"],
            "Animals" => ["BIRD IS A WORD", "DEFINITELY NOT ASIA'S DOGGY", "SHEEP MAKE MEEEEEEEE"],
        ];

        return $this->render("main/index.html.twig", [
            "categories" => $repository->getAllCategories()
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