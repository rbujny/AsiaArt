<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main_index')]
    public function index(): Response
    {
        return $this->render("main/index.html.twig");
    }

    #[Route('/por/portfolio', name: 'app_main_portfolio')]
    public function portfolio(): Response
    {
        return $this->render("main/portfolio.html.twig");
    }


}