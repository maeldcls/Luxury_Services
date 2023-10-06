<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ClientCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Client::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('company_name'),
            TextField::new('activity_type')->hideOnIndex(),
            TextField::new('contact_name'),
            TextField::new('position')->hideOnIndex(),
            TextField::new('contact_number'),
            TextField::new('contact_mail'),
            TextareaField::new('notes')->hideOnIndex(),
       
        ];
    }
    
}
