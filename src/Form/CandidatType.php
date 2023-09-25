<?php

namespace App\Form;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('birthDate')
            ->add('birthPlace')
            ->add('experience', ChoiceType::class, [
                'choices'  => [
                    '3m' => "0 - 6 month",
                    '6m' => "6 month - 1 year",
                    '1y' => "1- 2 years",
                    '2y' => '2+ years',
                    '5y' => '5+ years',
                    '10y' => '10+ years'
                ],
                'attr' => [
                    'class' => 'active',
                    
                ]
            ])
            ->add('jobCategory', ChoiceType::class, [
                'choices'  => [
                    'sector1' => "job sector",
                    'sector2' => "job sector 2",

                ]
            ])
            ->add('shortDescription', TextareaType::class, [
                'attr' => [
                'id' => 'description',
                'class' => 'materialize-textarea',
                'name' => 'description',
                'cols' => '50',
                'row' => '10'
                ],
                'label' => 'Short description for your profile, as well as more personnal informations (e.g. your hobbies/interests ). You can also paste any link you want.'
            ])
            ->add('profilePicture',FileType::class,[
                'mapped' => false,
                'required' => false,
                'label'=>''
            ])
            ->add('availibility', CheckboxType::class, [
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
