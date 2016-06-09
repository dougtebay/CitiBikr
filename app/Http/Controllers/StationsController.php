<?php

namespace App\Http\Controllers;

use App;

class StationsController extends Controller
{
    public function index()
    {
      $citi_bike = new App\Adapters\CitiBikeApi;
      $stations = $citi_bike->get_stations();
      return view('stations.index')->with('stations', $stations);
    }
}
