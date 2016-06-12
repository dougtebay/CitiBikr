<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

  protected $fillable = [
      'user_id', 'session_id'
  ];

  public function sessionId()
  {
    return \Session::getId();
  }

  public function userId()
  {
    return \Auth::user()->id;
  }

  public function persistSession()
  {
    if(count(Session::where('session_id', $this->sessionId())->get()) == 0)
    {
      $session = new Session;
      $session->user_id = $this->userId();
      $session->session_id = $this->sessionId();
      $session->save();
    }
  }

  public function userHasMultipleSessions()
  {
    if($this->thisSession() && $this->newestSessionByUser())
    {
      return $this->thisSession()->session_id != $this
      ->newestSessionByUser()->session_id;
    }
    else
    {
      return false;
    }
  }

  public function thisSession()
  {
    return Session::where('user_id', $this->userId())
    ->where('session_id', $this->sessionId())->get()->first();
  }

  public function newestSessionByUser()
  {
    return Session::where('user_id', $this->thisSession()->user_id)
    ->where('created_at', '>', $this->thisSession()->created_at)
    ->get()->first();
  }
}
