<?php

namespace App\Controller\Admin;

use App\Entity\Annonceur;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnnonceurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonceur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            EmailField::new('email'),
            TextField::new('plainPassword')->onlyOnForms(),
            TextField::new('city'),
            TextField::new('phone'),
            TextField::new('zipCode'),
            TextField::new('username'),
        ];
    }
    
}
