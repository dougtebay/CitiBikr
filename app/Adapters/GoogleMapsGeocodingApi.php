<?php
namespace App\Adapters;

use GuzzleHttp\Client;

class GoogleMapsGeocodingApi {
  protected $client;
  public function __construct()
  {
    $client = new Client(['base_uri' => 'https://maps.googleapis.com/maps/api/geocode/']);
    $this->client = $client;
  }

  public function get_coordinates($address)
  {
    if($address) {
      $body = $this->client->request('GET', "json?address={$address}")->getBody();
      $body->json = json_decode($body);
      $latitude = $body->json->results[0]->geometry->location->lat;
      $longitude = $body->json->results[0]->geometry->location->lng;
      return [$latitude, $longitude];
    }
  }
}
