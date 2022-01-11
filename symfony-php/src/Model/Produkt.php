<?php

namespace App\Model;

class Produkt {
  public string $artiklar_benamning;
  private string $artikelkategorier_id;
  private int $momssats;
  private int $lagersaldo;
  private int $nettoPris; #Pris före momssats. API returerar int.

  function __construct(string $artiklar_benamning, int $nettoPris, int $momssats, int $lagersaldo, string $artikelkategorier_id) {
    $this->artiklar_benamning = $artiklar_benamning == "" ? "Odefinierad artikel" : $artiklar_benamning;
    $this->nettoPris = $nettoPris;
    $this->momssats = $momssats;
    $this->lagersaldo = $lagersaldo;
    $this->artikelkategorier_id = $artikelkategorier_id == "" ? "Odefinierad kategori" : $artikelkategorier_id;
  }

  function getBruttoPris(): int {
    $momsProcent = ($this->momssats / 100) + 1;
    $total = $this->nettoPris * $momsProcent;
    return round($total);
  }

  public function getArtikelkategorierId(): string {
    return $this->artikelkategorier_id;
  }

  public function getLagersaldo(): string {
    return $this->lagersaldo;
  }
}