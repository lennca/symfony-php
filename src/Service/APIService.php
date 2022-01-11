<?php

namespace App\Service;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Config\Definition\Exception\Exception;

class APIService {
  private $httpClient;
  private $API_URL = "";

  public function __construct(HttpClientInterface $httpClient, string $projectDir) {
    $this->httpClient = $httpClient;

    $dotenv = new Dotenv();
    $dotenv->load($projectDir . '/.env');

    if(isset($_ENV["API_URL"]) && $_ENV["API_URL"]) {
      $this->API_URL = $_ENV["API_URL"];
    } else {
      throw new Exception("Please provide the api url in the .env file");
    }
  }

  /**
   * fetchProducts
   * Function that fetch json from API.
   * @return mixed Decoded json.
   */
  public function fetchProducts() {
    $response = $this->httpClient->request(
      'GET',
      $this->API_URL
    );

    $content = $response->getContent();
    $decode = json_decode($content);
    return $decode;
  }
}