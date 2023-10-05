<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
       
            TextField::new('reference')->onlyOnForms() ,
            TextField::new('description')->onlyOnForms() ,
            TextField::new('notes')->onlyOnForms() ,
            TextField::new('job_title'),
            AssociationField::new('client')->autocomplete(),
            TextField::new('job_type')->onlyOnForms() ,
            TextField::new('location')->onlyOnForms() ,
            TextField::new('job_category')->onlyOnForms() ,
            IntegerField::new('activated'), 
            DateField::new('creation_date') ,
            DateField::new('closing_date'),
            IntegerField::new('salary')->onlyOnForms() ,
                
        ];
    }
    
}
