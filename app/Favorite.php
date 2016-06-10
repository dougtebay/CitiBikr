<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
  protected $fillable = [
      'name', 'number', 'latitude', 'longitude'
  ];

  public function users()
  {
    return $this->belongsToMany('App\User', 'favorite_user');
  }
}
