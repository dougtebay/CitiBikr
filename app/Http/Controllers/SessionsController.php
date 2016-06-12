<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Session;

class SessionsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function store(Request $request)
  {
    $session = new Session;
    $session->user_id = \Auth::user()->id;
    $session->session_id = \Session::getId();
    $sessionInstance = new Session;
    $session->save();
    return redirect()->action('FavoritesController@index');
  }
}
