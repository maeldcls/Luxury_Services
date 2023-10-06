<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CandidatCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidat::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            
            TextField::new('firstName')->setSortable(true),
            TextField::new('lastName')->setSortable(true),
            AssociationField::new('user')->autocomplete()->setLabel('mail'),
            TextField::new('gender')->hideOnIndex(),
            TextField::new('adress')->hideOnIndex(),
            TextField::new('country')->hideOnIndex(),
            TextField::new('nationality')->hideOnIndex(),
            TextField::new('passport_file')->hideOnIndex(),
            TextField::new('cv')->hideOnIndex(),
            TextField::new('profilePicture')->hideOnIndex(),
            TextField::new('currentLocation')->setSortable(true),
            DateField::new('birth_date')->hideOnIndex(),
            TextField::new('birthPlace')->hideOnIndex(),
            BooleanField::new('availibility')->hideOnIndex(),
            TextField::new('jobCategory')->setSortable(true),
            TextField::new('experience')->hideOnIndex(),
            TextField::new('shortDescription')->hideOnIndex(),
            TextField::new('notes')->hideOnIndex(),
            DateField::new('uploadedAt')->setSortable(true),
            DateField::new('updatedAt')->hideOnIndex(),
            DateField::new('deletedAt')->hideOnIndex(),
            TextField::new('files')->hideOnIndex(),
            TextareaField::new('notes')->hideOnIndex(),
            

        ];
    }
    
}
