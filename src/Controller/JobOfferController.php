<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Entity\User;
use App\Form\JobOfferType;
use App\Repository\CandidatureRepository;
use App\Repository\JobOfferRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/job/offer')]
class JobOfferController extends AbstractController
{
    #[Route('/', name: 'app_job_offer', methods: ['GET'])]
    public function index(JobOfferRepository $jobOfferRepository): Response
    {
       
        return $this->render('job_offer/home.html.twig', [
            'job_offers' => $jobOfferRepository->findAll(),
        ]);
       
    }

    #[Route('/new', name: 'app_job_offer_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        
        $jobOffer = new JobOffer();
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jobOffer);
            $entityManager->flush();

            return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_offer/new.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_job_offer_show', methods: ['GET'])]
    public function show(Request $request,JobOfferRepository $jobOfferRepository, CandidatureRepository $candidatureRepository, JobOffer $jobOffer): Response
    {
        $jobOffers = $jobOfferRepository->findBy(
            ['activated' => true],
            
        );

        if($this->getUser()){
            /**
             * @var User $user
             */
            $user = $this->getUser();
            $candidat = $user->getCandidat();
            $candidature = new Candidature();
            
            $candidature = $candidatureRepository->findOneBy([
                'candidat' => $candidat,
                'jobOffer' => $jobOffer
            ]);  
            return $this->render('job_offer/show.html.twig', [
                'job_offer' => $jobOffer,
                'candidature' => $candidature,
            ]);
        }
        return $this->render('job_offer/show.html.twig', [

            'job_offer' => $jobOffer,
        ]);
    }
    #[Route('/show/next/{id}', name: 'app_job_offer_show_next', methods: ['GET'])]
    public function showNext(Request $request,JobOfferRepository $jobOfferRepository, CandidatureRepository $candidatureRepository, JobOffer $jobOffer): Response
    {
        $id=0;
        $nextId = 0;
        $jobOffers = $jobOfferRepository->findBy(
            ['activated' => true],
            
        );

        foreach($jobOffers as $job){
            if($job === $jobOffer){
                $nextId = $id+1;
            }
            $id++;
        }
        if($nextId>= count($jobOffers)){
            $nextId = 0;
        }
        
        $jobz = $jobOffers[$nextId]; 
        
        return $this->redirectToRoute('app_job_offer_show',['id' => $jobz->getId()], Response::HTTP_SEE_OTHER);
    }
    #[Route('/show/previous/{id}', name: 'app_job_offer_show_previous', methods: ['GET'])]
    public function showPrevious(Request $request,JobOfferRepository $jobOfferRepository, CandidatureRepository $candidatureRepository, JobOffer $jobOffer): Response
    {
         $jobOffers = $jobOfferRepository->findBy(
            ['activated' => true],
            
        );
        $id=0;

        foreach($jobOffers as $job){
            if($job === $jobOffer){
                $previousId = $id-1;
            }
            $id++;
        }
        if($previousId<0){
            $previousId = count($jobOffers)-1;
        }
        
        $jobz = $jobOffers[$previousId]; 
        
        return $this->redirectToRoute('app_job_offer_show',['id' => $jobz->getId()], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/edit', name: 'app_job_offer_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(JobOfferType::class, $jobOffer);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('job_offer/edit.html.twig', [
            'job_offer' => $jobOffer,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_job_offer_delete', methods: ['POST'])]
    public function delete(Request $request, JobOffer $jobOffer, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$jobOffer->getId(), $request->request->get('_token'))) {
            $entityManager->remove($jobOffer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_job_offer_index', [], Response::HTTP_SEE_OTHER);
    }
}
