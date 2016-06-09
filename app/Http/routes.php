<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    $citi_bike = new App\Adapters\CitiBikeApi;
    $response = $citi_bike->get_station_information();
    // $response->json = json_decode($response->body);
    // print_r($response);
foreach ($response as $resp) {
      foreach($resp->data->stations as $station)
      {
        print_r($station->name);
      }
  }
});
