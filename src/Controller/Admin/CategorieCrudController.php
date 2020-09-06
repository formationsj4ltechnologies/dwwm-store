<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categorie::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $nom = TextField::new('nom', "Nom de la catégorie");
        $slug = TextField::new('slug', "Slug");
        $createdAt = DateTimeField::new('createdAt', "Date de création");
        $updatedAt = DateTimeField::new('updatedAt', "Date de modification");
        $informationCategorie = FormField::addPanel("INFORMATIONS CATEGORIE");
        $informationParent = FormField::addPanel("INFORMATIONS PARENT");
        $parent = AssociationField::new("parent", "Parent");


        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $champs = [$informationCategorie, $nom, $slug, $createdAt, $updatedAt, $informationParent, $parent];
        } else {
            $champs = [$informationCategorie, $nom, $informationParent, $parent];
        }

        return $champs;
    }

}
