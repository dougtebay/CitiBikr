<?php
namespace App\Adapters;
use GuzzleHttp\Client;

class CitiBikeApi {
  protected $client;
  public function __construct()
  {
    $client = new Client(['base_uri' => 'https://gbfs.citibikenyc.com/gbfs/en/']);
    $this->client = $client;
  }

  public function get_station_information()
  {
    $body = $this->client->request('GET', 'station_information.json')->getBody();
    $body->json = json_decode($body);
    return $body;
  }
}