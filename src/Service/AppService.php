<?php


namespace App\Service;


use App\Entity\Categorie;
use App\Entity\LigneCommande;
use App\Entity\Marque;
use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\MarqueRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AppService
{
    /**
     * @var CategorieRepository
     */
    private $categorieRepository;
    /**
     * @var MarqueRepository
     */
    private $marqueRepository;
    /**
     * @var ProduitRepository
     */
    private $produitRepository;
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * AppService constructor.
     * @param CategorieRepository $categorieRepository
     * @param MarqueRepository $marqueRepository
     * @param ProduitRepository $produitRepository
     * @param SessionInterface $session
     */
    public function __construct(
        CategorieRepository $categorieRepository,
        MarqueRepository $marqueRepository,
        ProduitRepository $produitRepository,
        SessionInterface $session
    )
    {
        $this->categorieRepository = $categorieRepository;
        $this->marqueRepository = $marqueRepository;
        $this->produitRepository = $produitRepository;
        $this->session = $session;
    }

    /**
     * @param string $mot
     * @return string
     */
    public static function capitalize(string $mot): string
    {
        return ucwords(mb_strtolower(trim($mot)));
    }

    /**
     * @return Categorie[]
     */
    public function getListeCategories(): array
    {
        return $this->categorieRepository->findAll();
    }

    /**
     * @return Marque[]
     */
    public function getListeMarques(): array
    {
        return $this->marqueRepository->findAll();
    }

    /**
     * @return Produit[]
     */
    public function getListeProduits(): array
    {
        return $this->produitRepository->findAll();
    }

    public static function getImageUrl(string $imageUrl, int $taille = null)
    {
        $url = "/assets/img/produits/" . $imageUrl;
        if ($taille) {
            $url .= sprintf("?size=%dx%d", $taille, $taille);
        }
        return $url;
    }

    /**
     * Permet d'ajouter un produit au panier
     * @param int $id
     */
    public function ajouterAuPanier(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        $this->session->set('panier', $panier);
    }

    /**
     * Permet de recuperer le contenu du panier
     * @return array
     */
    public function contenuDuPanier(): array
    {
        $panier = $this->session->get('panier', []);
        $contenuDuPanier = [];
        foreach ($panier as $id => $quantite) {
            $ldc = new LigneCommande($quantite, $this->produitRepository->find($id));
            $contenuDuPanier[] = [
                "ligne_cmd" => $ldc
            ];
        }
        return $contenuDuPanier;
    }

    /**
     * Permet de supprimer un produit su panier
     * @param int $id
     */
    public function supprimerDuPanier(int $id)
    {
        $panier = $this->session->get('panier', []);
        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }
        $this->session->set('panier', $panier);
    }

    /**
     * Permet de calculer le prix total du panier
     * @return float
     */
    public function getTotalPanier(): float
    {
        $articles = $this->contenuDuPanier();
        $total = 0;
        foreach ($articles as $article) {
            $sous_total = $article["ligne_cmd"]->getSousTotal();
            $total += $sous_total;
        }
        return $total;
    }
}