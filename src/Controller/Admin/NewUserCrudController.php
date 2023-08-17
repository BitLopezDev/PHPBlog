<?php

namespace App\Controller\Admin;

use App\Entity\NewUser;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NewUserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewUser::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
