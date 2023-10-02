<?php

namespace App\Controller;

use App\Entity\Candidat;
use App\Form\CandidatType;
use App\Repository\CandidatRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/candidat')]
class CandidatController extends AbstractController
{


    #[Route('/profile', name: 'app_profile', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager): Response
    {
        $candidat = $this->getUser()->getCandidat();

        $form = $this->createForm(CandidatType::class, $candidat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //processing profile pic
            $directory ="./assets/profilePic/";
            $file = $form['profilePicture']->getData();
            if($file){
                $extension = $file->guessExtension();

            if (!$extension) {
                $extension = 'bin';
            }
            $name = rand(1, 99999) .'.' . $extension;
            $file->move($directory, $name);
            $candidat->setProfilePicture($directory.$name);
            }
            

            //processing passport
            $directory ="./assets/passport/";
            $file = $form['passportFile']->getData();

            if($file){
                $extension = $file->guessExtension();

                if (!$extension) {
                    $extension = 'bin';
                }
                $name = rand(1, 99999) .'.' . $extension;
                $file->move($directory, $name);
                $candidat->setPassportFile($directory.$name);
            }
            

            //processing cv
            $directory ="./assets/cv/";
            $file = $form['CV']->getData();
            if($file){
                $extension = $file->guessExtension();

                if (!$extension) {
                    $extension = 'bin';
                }
                $name = rand(1, 99999) .'.' . $extension;
                $file->move($directory, $name);
                $candidat->setCV($directory.$name);
            }
           

            if($candidat->getUploadedAt() == null){
                $candidat->setUploadedAt(new DateTimeImmutable());
            }
            $candidat->setUpdatedAt(new DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('candidat/index.html.twig', [
            'candidat' => $candidat,
            'formProfile' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_candidat_delete', methods: ['POST'])]
    public function delete(Request $request, Candidat $candidat, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$candidat->getId(), $request->request->get('_token'))) {
            $entityManager->remove($candidat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_candidat_index', [], Response::HTTP_SEE_OTHER);
    }
}
