<?php
namespace App\Adapters;

use GuzzleHttp\Client;
use App;

class CitiBikeApi {
  protected $client;
  public function __construct()
  {
    $client = new Client(['base_uri' => 'https://gbfs.citibikenyc.com/gbfs/en/']);
    $this->client = $client;
  }

  public function get_stations()
  {
    $body = $this->client->request('GET', 'station_information.json')->getBody();
    $body->json = json_decode($body);
    return $this->build_stations($body);
  }

  public function get_bikes()
  {
    $body = $this->client->request('GET', 'station_status.json')->getBody();
    $body->json = json_decode($body);
    return $this->build_bikes($body);
  }

  public function build_stations($body)
  {
    $stations = array();
    foreach($body as $last_updated) {
      foreach($last_updated->data->stations as $station_data)
      {
        $station = new App\Station;
        $station->name = $station_data->name;
        $station->number = $station_data->station_id;
        $station->latitude = $station_data->lat;
        $station->longitude = $station_data->lon;
        array_push($stations, $station);
      }
    }
    return $stations;
  }

  public function build_bikes($body)
  {
  $bikes = array();
  foreach($body as $last_updated) {
    foreach($last_updated->data->stations as $station_data)
    {
      $number = $station_data->station_id;
      $bikes_available = $station_data->num_bikes_available;
      $bikes[$number] = $bikes_available;
    }
  }
  return $bikes;
  }
}
