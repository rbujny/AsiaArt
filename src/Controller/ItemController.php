<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ItemController extends AbstractController
{

    #[Route('painting/{id}', name: 'app_item_item')]
    public function item(int $id,
                         CategoryRepository $repository,
                         ItemRepository $itemRepository): Response
    {

        $repoItem = $itemRepository->findOneBy(["id" => $id]);


        if($repoItem != null)
            return $this->render('item/item.html.twig', [
                "item" => $repoItem,
                "categories" => $repository->getAllCategories()
            ]);
        else
            throw $this->createNotFoundException("Item with id ".$id." is not exist!");

    }

}