<?php

use App\Station;

class StationTest extends PHPUnit_Framework_TestCase
{

  protected $station;

  public function setUp()
  {
    parent::setUp();
    $this->station = new Station();
  }

  // public function testReturnsStations()
  // {
  //   $stations = $this->station->stations();
  //   $this->assertGreaterThan(0, count($stations));
  // }

  // public function testStationsHaveData()
  // {
  //   $stations = $this->station->stations();
  //   $this->assertNotEmpty($stations[0]->name);
  //   $this->assertNotEmpty($stations[0]->number);
  //   $this->assertNotEmpty($stations[0]->latitude);
  //   $this->assertNotEmpty($stations[0]->longitude);
  // }

  // public function testInstantiatesGeotools()
  // {
  //   $geotools = $this->station->geotools();
  //   $this->assertInstanceOf('League\Geotools\Geotools', $geotools);
  // }

  // public function testReturnsNearbyStations()
  // {
  //   $nearby_stations = $this->station->find_nearby_stations(40.76727216, -73.99392888);
  //   $this->assertEquals(2, count($nearby_stations));
  //   $this->assertEquals('W 52 St & 11 Ave', $nearby_stations[0]->name);
  //   $this->assertEquals(72, $nearby_stations[0]->number);
  //   $this->assertEquals(40.76727216, $nearby_stations[0]->latitude);
  //   $this->assertEquals(-73.99392888, $nearby_stations[0]->longitude);
  //   $this->assertEquals('W 53 St & 10 Ave', $nearby_stations[1]->name);
  //   $this->assertEquals(480, $nearby_stations[1]->number);
  //   $this->assertEquals(40.76669671, $nearby_stations[1]->latitude);
  //   $this->assertEquals(-73.99061728, $nearby_stations[1]->longitude);
  // }

  // public function testReturnsCoordinates()
  // {
  //   $coordinates = $this->station->station_coordinates(40.76727216, -73.99392888);
  //   $this->assertEquals(40.76727216, $coordinates->getLatitude());
  //   $this->assertEquals(-73.99392888, $coordinates->getLongitude());
  // }
}