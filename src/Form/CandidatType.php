<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('gender', ChoiceType::class, [
            'choices'  => [
                'Male' => "male",
                'Female' => "female"
            ],
            'attr' => [
                'class' => 'active',
                
            ]

        ])
        ->add('firstName')
        ->add('lastName')
        ->add('currentLocation')
        
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('passport')
            ->add('passportFile')
            ->add('CV')
            ->add('profilePicture')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('availibility')
            ->add('jobCategory')
            ->add('experience', ChoiceType::class, [
                'choices'  => [
                    '3m' => "0 - 6 month",
                    '6m' => "6 month - 1 year"
                ],
                'attr' => [
                    'class' => 'active',
                    
                ]
    
            ])
            ->add('shortDescription')
            ->add('notes')
            ->add('deletedAt')
            ->add('files')
            //->add('user')
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
