<?php

namespace App\Controller;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\CategoryRepository;
use App\Repository\ItemRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    #[Route('/reviews', name: 'app_review_reviews')]
    public function showReviews(CategoryRepository $categoryRepository,
                                Request $request,
                                ReviewRepository $reviewRepository,
                                PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $reviewRepository->getAllReviews(),
            $request->query->getInt('page', 1),
            10
        );

        return $this->render("review/reviews.html.twig", [
            "categories" => $categoryRepository->getAllCategories(),
            "pagination" => $pagination
        ]);
    }

    #[Route('/reviews/new', name: 'app_review_new', methods: ['GET', 'POST'])]
    public function new(Request $request,
                        CategoryRepository $categoryRepository,
                        ItemRepository $itemRepository,
                        ReviewRepository $reviewRepository): Response
    {
        $this->denyAccessUnlessGranted("IS_AUTHENTICATED_FULLY");

        $user = $this->getUser();
        $items = $itemRepository->findBy(["Customer" => $user]);
        $formItems = [];
        foreach ($items as $item)
        {
            if ($item->getReview() === null)
            $formItems[ucfirst(strtolower($item->getName()))] = $item;
        }
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->add('item', ChoiceType::class, [
            'choices'  => $formItems
        ]);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $review->setUser($user);
            $reviewRepository->save($review, true);
            return $this->redirectToRoute('app_review_reviews', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('review/new.html.twig', [
            'review' => $review,
            "items" => $formItems,
            "categories" => $categoryRepository->getAllCategories(),
            'form' => $form->createView(),
        ]);
    }
}
