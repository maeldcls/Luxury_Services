<?php

namespace App\Form;

use App\Entity\Candidat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('gender')
            ->add('firstName')
            ->add('lastName')
            ->add('adress')
            ->add('country')
            ->add('nationality')
            ->add('passport')
            ->add('passportFile')
            ->add('CV')
            ->add('profilePicture')
            ->add('currentLocation')
            ->add('birthDate')
            ->add('birthPlace')
            ->add('availibility')
            ->add('jobCategory')
            ->add('experience')
            ->add('shortDescription')
            ->add('notes')
            ->add('uploadedAt')
            ->add('updatedAt')
            ->add('deletedAt')
            ->add('files')
            ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidat::class,
        ]);
    }
}
