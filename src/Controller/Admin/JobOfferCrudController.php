<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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
            TextField::new('reference')->hideOnIndex() ,
            TextField::new('description')->hideOnIndex() ,
            TextField::new('notes')->hideOnIndex() ,
            TextField::new('jobTitle')->setSortable(true),
            AssociationField::new('client')->autocomplete(),
            TextField::new('job_type')->hideOnIndex() ,
            TextField::new('location')->hideOnIndex() ,
            TextField::new('job_category')->hideOnIndex() ,
            BooleanField::new('activated'), 
            DateField::new('creationDate')->setSortable(true),
            DateField::new('closingDate')->setSortable(true),
            IntegerField::new('salary')->hideOnIndex() ,
                
        ];
    }
    
}
