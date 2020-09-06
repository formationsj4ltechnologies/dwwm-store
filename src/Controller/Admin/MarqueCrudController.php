<?php

namespace App\Controller\Admin;

use App\Entity\Marque;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MarqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Marque::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $nom = TextField::new('nom', "Enseigne");
        $slug = TextField::new('slug', "Slug");
        $createdAt = DateTimeField::new('createdAt', "Date de création");
        $updatedAt = DateTimeField::new('updatedAt', "Date de modification");
        $informationCategorie = FormField::addPanel("INFORMATIONS MARQUE");

//        $informationParent = FormField::addPanel("INFORMATIONS PARENT");
//        $parent = AssociationField::new("parent", "Parent");

        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $champs = [$informationCategorie, $nom, $slug, $createdAt, $updatedAt];
        } else {
            $champs = [$informationCategorie, $nom];
        }

        return $champs;
    }

}
