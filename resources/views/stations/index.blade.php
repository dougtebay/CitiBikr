@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      {!! Form::open() !!}
      {!! Form::close() !!}
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
                <input type="hidden" name="station->number" value="{!! $station->number !!}">
                <input type="hidden" name="name" value="{!! $station->name !!}">
                <input type="hidden" name="latitude" value="{!! $station->latitude !!}">
                <input type="hidden" name="longitude" value="{!! $station->longitude !!}">
                <input type="hidden" name="_token" id="_token" value="{!! csrf_token(); !!}">
                <button type='submit' class='btn btn-primary'>Add to My Favorites</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop