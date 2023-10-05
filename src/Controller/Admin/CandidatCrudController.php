<?php

namespace App\Controller\Admin;

use App\Entity\Candidat;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
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
            
            TextField::new('first_name'),
            TextField::new('last_name'),
            AssociationField::new('user')->autocomplete(),
            TextField::new('gender')->onlyOnForms(),
            TextField::new('adress')->onlyOnForms(),
            TextField::new('country')->onlyOnForms(),
            TextField::new('nationality')->onlyOnForms(),
            TextField::new('passport_file')->onlyOnForms(),
            TextField::new('cv')->onlyOnForms(),
            TextField::new('profile_picture')->onlyOnForms(),
            TextField::new('current_location'),
            DateField::new('birth_date')->onlyOnForms(),
            TextField::new('birth_place')->onlyOnForms(),
            IntegerField::new('availibility'),
            TextField::new('job_category'),
            TextField::new('experience')->onlyOnForms(),
            TextField::new('short_description')->onlyOnForms(),
            TextField::new('notes')->onlyOnForms(),
            DateField::new('uploaded_at'),
            DateField::new('updated_at')->onlyOnForms(),
            DateField::new('deleted_at')->onlyOnForms(),
            TextField::new('files')->onlyOnForms(),
            

        ];
    }
    
}
