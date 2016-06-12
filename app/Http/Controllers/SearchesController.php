<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Adapters\GoogleMapsGeocodingApi;
use App\Station;
use App\Adapters\CitiBikeApi;

class SearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
      $address = $this->format_address($request);
      $coordinates = $this->get_coordinates($address);
      $stations = $this->find_nearby_stations($coordinates);
      $bikes = $this->get_bikes();
      return view('searches.results')->with('stations', $stations)->with('bikes', $bikes);
    }

    private function format_address($request)
    {
      $address = str_replace(' ', '+', $request->get('search'));
      return str_replace('&', 'and', $address);
    }

    private function get_coordinates($address)
    {
      $google = new GoogleMapsGeocodingApi;
      return $google->get_coordinates($address);
    }

    private function find_nearby_stations($coordinates)
    {
      $station = new Station;
      return $station->find_nearby_stations($coordinates[0], $coordinates[1]);
    }

    private function get_bikes()
    {
      $citi_bike = new CitiBikeApi;
      return $citi_bike->get_bikes();
    }
}
