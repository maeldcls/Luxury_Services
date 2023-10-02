<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Entity\Candidature;
use App\Entity\JobOffer;
use App\Form\CandidatureType;
use App\Repository\CandidatRepository;
use App\Repository\CandidatureRepository;
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
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security, JobOffer $jobOffer): Response
    {
         /**
         * @var User $user
         */
        $user = $this->getUser();

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
            'job_offer' => $jobOffer,
            'candidature'=>$candidature
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_show', methods: ['GET'])]
    public function show(Candidature $candidature): Response
    {
        return $this->render('candidature/show.html.twig', [
            'candidature' => $candidature,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_candidature_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Candidature $candidature, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CandidatureType::class, $candidature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidature/edit.html.twig', [
            'candidature' => $candidature,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidature_delete', methods: ['POST'])]
    public function delete(Request $request, Candidature $candidature, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidature->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidature_index', [], Response::HTTP_SEE_OTHER);
    }
}
