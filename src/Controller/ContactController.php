<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request,MailerInterface $mailer): Response
    {
       
        $form = $this->createFormBuilder()
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add('email', EmailType::class)
            ->add('tel', TextType::class)
            ->add('message', TextareaType::class,[
                'attr' => [
                    'id' => 'description',
                    'class' => 'materialize-textarea',
                    'name' => 'description',
                    'cols' => '50',
                    'row' => '10'
                    ],
            ])
            //->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $email = (new Email())
            ->from($data['email'])
            ->to('contact@luxury_services.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Hello There')
            //->text('Sending emails is fun again!')
            ->html('
            <h2>Message from :'. $data['firstname'].' '. $data['lastname']. ' </h2>
            <p>Mail :'.$data['email'] .'</p>
            <p>Tel :'.$data['tel'] .'</p>
            <p>Message :'.$data['message'] .'</p>');

            $mailer->send($email);
            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }
        
      
        return $this->render('contact/home.html.twig', [
            'formContact' => $form

        ]);
    }
}
