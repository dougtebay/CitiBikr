<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
      $favorites = \Auth::user()->favorites()->get();
      return view('favorites.index')->with('favorites', $favorites);
    }

    public function store(Request $request)
    {
      $favorite = new App\Favorite;
      $favorite->fill(['name' => $request->get('name')])->fill(['number' => $request->get('number')])->fill(['latitude' => $request->get('latitude')])->fill(['longitude' => $request->get('longitude')])->save();
      \Auth::user()->favorites()->attach($favorite);
      return redirect()->action('FavoritesController@index');
    }

    public function destroy($id)
    {
      $favorite = App\Favorite::find($id);
      \Auth::user()->favorites()->detach($favorite);
      $favorite->delete();
      return redirect()->action('FavoritesController@index');
    }
}
