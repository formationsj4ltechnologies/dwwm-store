<?php

namespace App\Controller;

use App\Service\AppService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/panier", name="panier_")
 * Class PanierController
 * @package App\Controller
 */
class PanierController extends AbstractController
{
    /**
     * @Route("/", name="contenu")
     * @param AppService $service
     * @return JsonResponse
     */
    public function index(AppService $service)
    {
        $contenuPanier = $service->contenuDuPanier();
        return $this->json($contenuPanier);
    }

    /**
     * @Route("/ajouter/{id}", name="ajouter")
     * @param int $id
     * @param AppService $service
     * @return RedirectResponse
     */
    public function ajouter(int $id, AppService $service)
    {
        $service->ajouterAuPanier($id);
        return $this->redirectToRoute("panier_contenu");
    }

    /**
     * @Route("/diminuer/{id}", name="diminuer")
     * @param int $id
     * @param AppService $service
     * @return RedirectResponse
     */
    public function diminuer(int $id, AppService $service)
    {
        $service->diminuerQtePanier($id);
        return $this->redirectToRoute("panier_contenu");
    }

    /**
     * @Route("/supprimer/{id}", name="supprimer")
     * @param int $id
     * @param AppService $service
     * @return RedirectResponse
     */
    public function supprimer(int $id, AppService $service)
    {
        $service->supprimerDuPanier($id);
        return $this->redirectToRoute("panier_contenu");
    }
}
