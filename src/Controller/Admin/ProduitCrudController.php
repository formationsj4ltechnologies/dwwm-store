<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use App\Form\PieceJointeType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $panelProduit = FormField::addPanel("INFORMATIONS PRODUIT");
        $nom = TextField::new('nom', "Nom du produit");
        $prix = NumberField::new('prix', "Prix du produit")->addCssClass('text-right');
        $dispo = BooleanField::new('dispo', "Disponible ?");
        $description = TextEditorField::new('description', "Description");

        $panelTags = FormField::addPanel("Gestion des tags");
        $tags = ArrayField::new('tags', "Tags");

        $panelFonctions = FormField::addPanel("Gestion des fonctionnalités");
        $fonctions = ArrayField::new('fonctions', "Fonctionnalités");

        $imageFile = ImageField::new("imageFile", "Photo")->setFormType(VichImageType::class);
        $imageName = ImageField::new("imageName","Image")->setBasePath("/assets/img/produits");

        $slug = TextField::new('slug', "Slug");
        $createdAt = DateTimeField::new('createdAt', "Date de création");
        $updatedAt = DateTimeField::new('updatedAt', "Date de modification");

        $panelCategorie = FormField::addPanel("INFORMATIONS CATEGORIE");
        $categorie = AssociationField::new("categorie", "Catégorie");
        $sousCategorie = AssociationField::new("sousCategorie", "Sous Catégorie");
        $marque = AssociationField::new("marque", "Fabriquant");

        $panelPieceJointes = FormField::addPanel("Gestion des images");
        $pieceJointes = CollectionField::new("pieceJointes", "Pièces Jointes")
            ->setEntryType(PieceJointeType::class)
            ->setFormTypeOption("by_reference", false)
            ->onlyOnForms();
        $pieceJointesDetail = CollectionField::new("pieceJointes")
            ->setTemplatePath("images.html.twig")
            ->onlyOnDetail();


        if ($pageName === Crud::PAGE_INDEX || $pageName === Crud::PAGE_DETAIL) {
            $champs = [
                $panelProduit, $nom, $prix, $dispo, $description, $imageName, $pieceJointesDetail, $categorie, $sousCategorie,
            ];
        } else {
            $champs = [
                $panelProduit, $nom, $prix, $dispo, $description,
                $panelCategorie, $categorie, $sousCategorie, $marque,
                $panelPieceJointes, $imageFile, $pieceJointes,
                $panelTags,
                $tags,
                $panelFonctions,
                $fonctions
            ];
        }

        return $champs;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
