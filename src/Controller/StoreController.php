<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
     */
    public function accueil()
    {
        $titre_page = "Store";
        return $this->render('store/accueil.html.twig', [
            "titre_page" => $titre_page,
        ]);
    }
}
