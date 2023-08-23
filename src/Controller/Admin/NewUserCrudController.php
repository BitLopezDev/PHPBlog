<?php

namespace App\Controller\Admin;

use App\Entity\NewUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
class NewUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewUser::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('username'),
            // add more fields as needed
        ];
    }
    
    
}
