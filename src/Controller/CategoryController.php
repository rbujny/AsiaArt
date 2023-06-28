<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/{category}', name: 'app_category_category')]
    public function category(string $category): Response
    {
        $categories = ["mylittlepony", "spongebob", "hellokitty",
                        "winx", "animals"];

        if(in_array($category,$categories))
            return $this->render('category/category.html.twig', [
                'category' => $category
            ]);
        else
            throw $this->createNotFoundException("Category ".$category."is not exist!");
    }

}