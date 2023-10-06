<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use App\Entity\Candidature;
use App\Entity\Client;
use App\Entity\JobOffer;
use App\Repository\CandidatRepository;
use App\Repository\CandidatureRepository;
use App\Repository\ClientRepository;
use App\Repository\JobOfferRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function __construct(CandidatRepository $candidatRepository, JobOfferRepository $jobOfferRepository, 
    CandidatureRepository $candidatureRepository, ClientRepository $clientRepository)
    {
        $this->candidatRepository = $candidatRepository;
        $this->jobOfferRepository = $jobOfferRepository;
        $this->candidatureRepository = $candidatureRepository;
        $this->clientRepository = $clientRepository;
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
         //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
         //return $this->redirect($adminUrlGenerator->setController(JobOfferCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        $numberCandidat = $this->candidatRepository->countCandidat();
        $numberJobOffer = $this->jobOfferRepository->countJobOffer();
        $numberCandidature = $this->candidatureRepository->countCandidature();
        $numberClient = $this->clientRepository->countClient();
        return $this->render('admin/dashboard.html.twig', [
            'numberCandidat' => $numberCandidat,
            'numberJobOffer' => $numberJobOffer,
            'numberCandidature'=> $numberCandidature,
            'numberClient'=> $numberClient
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Luxury Services');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('JobOffers', 'fa-solid fa-envelope', JobOffer::class);
        yield MenuItem::linkToCrud('Clients', 'fa-solid fa-building', Client::class);
        yield MenuItem::linkToCrud('Candidats', 'fa-solid fa-user', Candidat::class);
        yield MenuItem::linkToCrud('Candidatures', 'fa-solid fa-file', Candidature::class);
    }
}
