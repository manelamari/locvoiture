<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\User;
use App\Entity\Voiture;
use App\Entity\Booking;
use App\Repository\BookingRepository;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use App\Repository\VoitureRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    protected  $userRepository;
    protected  $voitureRepository;
    protected  $categoryRepository;
    protected  $bookingRepository;
    public function __construct(UserRepository $userRepository,VoitureRepository $voitureRepository,CategoryRepository $categoryRepository,BookingRepository $bookingRepository){
        $this->userRepository=$userRepository;
        $this->voitureRepository=$voitureRepository;
        $this->categoryRepository=$categoryRepository;
        $this->bookingRepository=$bookingRepository;
    }


    /**
     * @Route("/admin", name="admin")
     * @package  App\controller\Admin
     */
    public function index(): Response
    {
        return $this->render('bundles/EasyAdminBundle/welcome.html.twig',[
            'countuser'=>$this->userRepository->countuser(),
            'countvoiture'=>$this->voitureRepository->countvoiture(),
            'countcategory'=>$this->categoryRepository->countcategory(),
            'countbooking'=>$this->bookingRepository->countbooking(),
        ]);
       // return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Eurocar');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Contact', 'fa fa-envelope', Contact::class);
        yield MenuItem::linkToCrud('Category', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Voitures', 'fa fa-automobile', Voiture::class);
        yield MenuItem::linkToCrud('Client', '	fa fa-address-book-o', User::class);
        yield MenuItem::linkToCrud('Réservation', 'fa fa-book fa-fw',Booking::class);
    }
}
