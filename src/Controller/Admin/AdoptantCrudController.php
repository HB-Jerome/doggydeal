<?php

namespace App\Controller\Admin;

use App\Entity\Adoptant;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AdoptantCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adoptant::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('plainPassword')->onlyOnForms(),
            TextField::new('city'),
            TextField::new('phone'),
            TextField::new('zipCode'),
            TextField::new('username'),
        ];
    }
    
}
