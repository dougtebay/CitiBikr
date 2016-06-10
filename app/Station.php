<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Station extends Model
{
  public function stations()
  {
    $citi_bike = new App\Adapters\CitiBikeApi;
    return $citi_bike->get_stations();
  }

  public function geotools()
  {
    return new \League\Geotools\Geotools();
  }

  public function find_nearby_stations($latitude, $longitude)
  {
    $nearby_stations = array();
    $target_coordinates = $this->station_coordinates($latitude, $longitude);
    foreach($this->stations() as $station)
    {
      if($this->station_nearby($target_coordinates, $station))
        array_push($nearby_stations, $station);
    }
    return $nearby_stations;
  }

  public function station_coordinates($latitude, $longitude)
  {
    return new \League\Geotools\Coordinate\Coordinate([$latitude, $longitude]);
  }

  public function station_nearby($target_coordinates, $station)
  {
    $station_coordinates = $this->station_coordinates($station->latitude, $station->longitude);
    $distance = $this->geotools()->distance()->setFrom($target_coordinates)->setTo($station_coordinates);
    return $distance->in('mi')->vincenty() < 0.25;
  }
}
