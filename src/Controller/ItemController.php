<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    #[Route('painting/{id}', name: 'app_item_item')]
    public function item(int $id, CategoryRepository $repository): Response
    {
        $items = ["", "Sexy Chick", "Cute Sponge", "Definitely not Asia's dog",
            "Orange Pony with fancy hair"
        ];

        if($id <= count($items))
            return $this->render('item/item.html.twig', [
                'item'=> $items[$id],
                "categories" => $repository->getAllCategories()
            ]);
        else
            throw $this->createNotFoundException("Item with id ".$id." is not exist!");

    }

}