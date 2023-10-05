<?php

namespace App\Controller;

use App\Repository\JobOfferRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
        $jobOffers[] = $jobOfferRepository->findBy(
            ['activated' => true],
            
        );
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
    }
}
