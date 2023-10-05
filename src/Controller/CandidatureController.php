<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Form\CandidatureType;
use App\Repository\CandidatRepository;
use App\Repository\CandidatureRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidature')]
class CandidatureController extends AbstractController
{
    #[Route('/', name: 'app_candidature_index', methods: ['GET'])]
    public function index(CandidatureRepository $candidatureRepository): Response
    {
        return $this->render('candidature/index.html.twig', [
            'candidatures' => $candidatureRepository->findAll(),
        ]);
    }

    #[Route('/new{id}', name: 'app_candidature_new', methods: ['GET', 'POST'])]
    public function new(Request $request,JobOfferRepository $jobOfferRepository, CandidatureRepository $candidatureRepository, EntityManagerInterface $entityManager, Security $security, JobOffer $jobOffer): Response
    {
        /**
        * @var User $user
        */
        $user = $this->getUser();
        $candidat = $user->getCandidat();
        $candidature = $candidatureRepository->findOneBy([
            'candidat' => $candidat,
            'jobOffer' => $jobOffer,
        ]);
        
        if($candidature == null){

            $candidat = $user->getCandidat();
            $candidature = new Candidature();

            //remplissage entity candidature
            $candidature->setJobOffer($jobOffer);
            $candidature->setCandidat($candidat);

            //remplissage table candidature
            $form = $this->createForm(CandidatureType::class, $candidature);
            $form->handleRequest($request);
            $entityManager->persist($candidature);
            $entityManager->flush();
        
            return $this->render('job_offer/show.html.twig', [
                'candidat'=> $candidat,
                'job_offer' => $jobOffer,
                'candidature'=>$candidature
            ]);
        }else{
            return $this->render('home/home.html.twig', [
                'job_offers' => $jobOfferRepository->findAll(),
            ]);
        }

        
    }
}
