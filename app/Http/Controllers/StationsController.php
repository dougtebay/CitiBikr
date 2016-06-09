<?php

namespace App\Http\Controllers;

use App;

class StationsController extends Controller
{
    public function index()
    {
      $citi_bike = new App\Adapters\CitiBikeApi;
      $response = $citi_bike->get_stations_data();
      print_r($response);
    }
}
