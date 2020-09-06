<?php

namespace App\Controller;

use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="store_")
 * Class StoreController
 * @package App\Controller
 */
class StoreController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     * @param AppService $service
     * @return Response
     */
    public function accueil(AppService $service)
    {
        $categories = $service->getListeCategories();
        $marques = $service->getListeMarques();
        $produits = $service->getListeProduits();
        $titre_page = "Store";

        return $this->render('store/accueil.html.twig', [
            "titre_page" => $titre_page,
            "categories" => $categories,
            "marques" => $marques,
            "produits" => $produits,
        ]);
    }
}
