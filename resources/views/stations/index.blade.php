@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class='header'><h1>All Citi Bike Stations</h1></div>
        @foreach($stations as $station)
          <div class='station'>
            <div class='station-description-container'>
              <div>{!! $station->name !!}</div>
              <div>Bikes Available: {!! $bikes[$station->number] !!}</div>
            </div>
            <div class='favorites-button-container'>
              {!! Form::model($favorite, array('action' => 'FavoritesController@store')) !!}
              {!! Form::hidden('number', $value = $station->number) !!}
              {!! Form::hidden('name', $value = $station->name) !!}
              {!! Form::hidden('latitude', $value = $station->latitude) !!}
              {!! Form::hidden('longitude', $value = $station->longitude) !!}
              <button type='submit' class='btn btn-primary'>Add to My Favorites</button>
              {!! Form::close() !!}
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop