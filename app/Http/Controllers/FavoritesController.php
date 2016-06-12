<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Adapters\CitiBikeApi;
use App\Favorite;
use App\Session;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $favorites = \Auth::user()->favorites()->get();
      $citi_bike = new CitiBikeApi;
      $bikes = $citi_bike->get_bikes();
      return view('favorites.index')->with('favorites', $favorites)->with('bikes', $bikes);
    }

    public function store(Request $request)
    {
      $favorite = new Favorite;
      $favorite->fill(['name' => $request->get('name')])->fill(['number' => $request->get('number')])->fill(['latitude' => $request->get('latitude')])->fill(['longitude' => $request->get('longitude')])->save();
      \Auth::user()->favorites()->attach($favorite);
      return redirect()->action('FavoritesController@index');
    }

    public function destroy($id)
    {
      $favorite = Favorite::find($id);
      \Auth::user()->favorites()->detach($favorite);
      $favorite->delete();
      return redirect()->action('FavoritesController@index');
    }
}
