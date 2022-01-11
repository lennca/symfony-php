<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class APIService {
  private $httpClient;

  public function __construct(HttpClientInterface $httpClient) {
    $this->httpClient = $httpClient;
  }

    
  /**
   * fetchProducts
   * Function that fetch json from API.
   * @return mixed Decoded json.
   */
  public function fetchProducts() {
    $response = $this->httpClient->request(
      'GET',
      'https://dev14.ageraehandel.se/sv/api/product'
    );

    $content = $response->getContent();
    $decode = json_decode($content);
    return $decode;
  }
}