@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class='header'><h1>Citi Bike Stations</h1></div>
        @foreach($stations as $station)
          <div class='station'>
            <div class='station-description-container'>
              <span>{!! $station->number !!}</span>
              <span>{!! $station->name !!}</span>
            </div>
            <div class='favorites-button-container'>
              <form method='POST' action='/favorites'>
                <button type='submit' class='btn btn-primary'>Add to My Favorites</button>
                <input type="hidden" name="_token" id="_token" value="<?php echo csrf_token(); ?>">
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop