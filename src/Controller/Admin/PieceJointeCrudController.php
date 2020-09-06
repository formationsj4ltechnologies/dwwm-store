<?php

namespace App\Controller\Admin;

use App\Entity\PieceJointe;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PieceJointeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PieceJointe::class;
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
