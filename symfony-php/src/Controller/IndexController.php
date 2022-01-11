<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\APIService;
use App\Model\Produkt;
use App\Repository\ProduktRepository;

class IndexController extends AbstractController {
  /**
   * @Route("/", name="index")
   */
  public function index(APIService $apiService): Response {
    $response = $apiService->fetchProducts();

    $registry = new ProduktRepository();

    foreach ($response->products as $artikel) {
      $artiklar_benamning = property_exists($artikel, 'artiklar_benamning') ? $artikel->artiklar_benamning : '';
      $lagersaldo = property_exists($artikel, 'lagersaldo') ? $artikel->lagersaldo : 0;
      $momssats = property_exists($artikel, 'momssats') ? $artikel->momssats : 0;
      $pris = property_exists($artikel, 'pris') ? $artikel->pris : 0;
      $artikelkategorier_id = property_exists($artikel, 'artikelkategorier_id') ? $artikel->artikelkategorier_id : '';

      $produkt = new Produkt($artiklar_benamning, $pris, $momssats, $lagersaldo, $artikelkategorier_id);
      $registry->addProdukt($produkt);
    }

    #Sort articles
    $sorteradeArtiklar = $registry->sortArray($registry->getProdukter(), 'artiklar_benamning');
    $registry->setProdukter($sorteradeArtiklar);

    $grupperadeArtiklar = $registry->grupperaArtiklar();
    $sorteradeKategorier = $registry->sortArray($grupperadeArtiklar, 'kategoriBenamning');

    return $this->render('base.html.twig', [
      'produkter' => $sorteradeKategorier,
      'antal_artiklar' => $registry->getAntalArtiklar(),
      'min_pris' => $registry->getMinPris(),
      'max_pris' => $registry->getMaxPris()
    ]);
  }
}