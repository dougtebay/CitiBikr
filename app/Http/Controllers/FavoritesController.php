<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class FavoritesController extends Controller
{
    public function index()
    {
      $favorites = App\Favorite::all();
      return view('favorites.index')->with('favorites', $favorites);
    }

    public function store(Request $request)
    {
      $favorite = new App\Favorite;
      $favorite->fill(['name' => $request->get('name')])->fill(['number' => $request->get('number')])->fill(['latitude' => $request->get('latitude')])->fill(['longitude' => $request->get('longitude')])->save();
      return redirect()->action('FavoritesController@index');
    }
}
