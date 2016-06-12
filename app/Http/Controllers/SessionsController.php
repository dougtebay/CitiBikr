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
}
