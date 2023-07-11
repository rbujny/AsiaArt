<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Item;
use App\Entity\Review;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Asia's Art")
            ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-dashboard');
        yield MenuItem::linkToCrud("Categories", "fa fa-list-alt", Category::class);
        yield MenuItem::linkToCrud("Items", "fa fa-file-photo-o", Item::class);
        yield MenuItem::linkToCrud("Reviews", "fa fa-star", Review::class);
        yield MenuItem::linkToCrud("Users", "fa fa-user", User::class);
    }
}
