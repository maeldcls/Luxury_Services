<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JobOfferController extends AbstractController
{
    #[Route('/job', name: 'app_job_offer')]
    public function index(): Response
    {
        return $this->render('job_offer/home.html.twig', [
            'controller_name' => 'JobOfferController',
        ]);
    }
}
