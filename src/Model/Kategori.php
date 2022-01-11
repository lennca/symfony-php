<?php

namespace App\Model;

class Kategori {
  public string $kategoriBenamning = "";
  private array $artiklar = array();

  public function __construct($artikelkategorier_id) {
    $this->kategoriBenamning = $artikelkategorier_id;
  }

  public function getKategoriBenamning(): string {
    return $this->kategoriBenamning;
  }

  public function addProdukt(Produkt $produkt) {
    array_push($this->artiklar, $produkt);
  }

  public function getProdukter(): array {
    return $this->artiklar;
  }

  public function setProdukter(array $nyaArtiklar) {
    return $this->artiklar = $nyaArtiklar;
  }
}