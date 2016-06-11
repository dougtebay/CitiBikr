<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class SearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $address = $this->format_address($request);
      $google = new App\Adapters\GoogleMapsGeocodingApi;
      $coordinates = $google->get_coordinates($address);
      $station = new App\Station;
      $stations = $station->find_nearby_stations($coordinates[0], $coordinates[1]);
      $citi_bike = new App\Adapters\CitiBikeApi;
      $bikes = $citi_bike->get_bikes();
      return view('searches.results')->with('stations', $stations)->with('bikes', $bikes);
    }

    private function format_address($request)
    {
      $address = str_replace(' ', '+', $request->get('search'));
      return str_replace('&', 'and', $address);
    }
}
