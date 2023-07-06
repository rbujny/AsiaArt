<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ReviewRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{

    #[Route('/rev/reviews', name: 'app_review_show-reviews')]
    public function showReviews(CategoryRepository $categoryRepository,
                                ReviewRepository $reviewRepository): Response
    {
        return $this->render("review/reviews.html.twig", [
            "categories" => $categoryRepository->getAllCategories(),
            "reviews" => $reviewRepository->getAllReviews()
        ]);
    }

}