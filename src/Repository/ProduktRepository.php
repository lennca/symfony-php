<?php

namespace App\Repository;
use App\Model\Kategori;

class ProduktRepository {
  private $produkter = array();

  public function addProdukt($produkt) {
    array_push($this->produkter, $produkt);
  }

  public function getMaxPris(): int {
    $max = 0;

    if(count($this->produkter) > 0) {
      foreach ($this->produkter as $current) {
        $bruttoPris = $current->getBruttoPris();
        if($bruttoPris > $max) $max = $bruttoPris;
      }
    }

    return round($max);
  }

  public function getMinPris(): int {
    $min = 0;

    if(count($this->produkter) > 0) {
      foreach ($this->produkter as $current) {
        $bruttoPris = $current->getBruttoPris();
        if($bruttoPris < $min) $min = $bruttoPris;
      }
    }

    return round($min);
  }

  public function getAntalArtiklar(): int {
    return count($this->produkter);
  }

  /**
   * sortArray
   * Generic function that sorts given array.
   * @param  array $unsortedArray Array to be sorted
   * @param  string $key Property of object in array to be compared.
   * @return array
   */
  public function sortArray(array $unsortedArray, string $key) {
    $sortedArray = array_merge(array(), $unsortedArray);
    
    #$sortedArray = $this->isertionSort($sortedArray, $key);
    usort($sortedArray, fn($curr, $next) => strcmp(strtolower($curr->{$key}), strtolower($next->{$key})));
    return $sortedArray;
  }

  public function grupperaArtiklar(): array {
    $grupperadeArtiklar = array();
    for ($i=0; $i < count($this->produkter); $i++) {
      $produkt = $this->produkter[$i];
      $artikelkategorier_id = $produkt->getArtikelkategorierId();
        
      $kategoriExists = false;
      foreach ($grupperadeArtiklar as $key => $kategori) {
        if(strtolower($kategori->getKategoriBenamning()) == strtolower($artikelkategorier_id)) {
          $kategoriExists = true;
          break;
        }
      }

      if($kategoriExists) {
        $grupperadeArtiklar[$key]->addProdukt($produkt);
      } else {
        $kategori = new Kategori($produkt->getArtikelkategorierId());
        $kategori->addProdukt($produkt);
        array_push($grupperadeArtiklar, $kategori);
      }
    }
    return $grupperadeArtiklar;
  }
    
  /**
   * isertionSort
   * Sorting function using the 'insertion sort' algorithm.
   * @param  array $produkter Array to be sorted.
   * @return array Sorted array.
   */
  private function isertionSort(array $produkter, string $key) {
    for ($i = 1; $i < count($produkter); $i++) { 
      #Loop backwards for as long as the current is lower than previous
      $j = $i - 1;
      $current = $produkter[$i];
		  $start = true;
        
		  while ($j >= 0 && $start) {
        #Loop through the characters in the string
        $move = 0;
        $previous = $produkter[$j];

        for ($charInd = 0; $charInd < strlen($current->{$key}); $charInd++) {
          #If reached - all characters are the same but previous is shorter.
          if(!isset($previous->{$key}[$charInd])) {
            $move = 0;
            $start = false;
            break;
          }

          $currentAscii = ord(strtolower($current->{$key})[$charInd]);
          $previousAscii = ord(strtolower($previous->{$key})[$charInd]);
              
          #If reached - previous is lower and should not move
          if ($currentAscii > $previousAscii) {
            $move = 0;
            $start = false;
            break;
          }
            
          # If same, run next character
          if($currentAscii == $previousAscii) {
            $move = 1;
            $start = true;
            continue;
          }

          #If reached - current is lower and should switch
          if ($currentAscii < $previousAscii) {
            $move = 1;
            $start = true;
            break;
          }
        }
        if($move == 1) {
          $produkter[$j + 1] = $produkter[$j];
          $j = $j - 1;
        }
      }
      $produkter[$j + 1] = $current;
    }
    return $produkter;
  }

  public function getProdukter(): array {
    return $this->produkter;
  }

  public function setProdukter(array $newArray) {
    $this->produkter = $newArray;
  }
}