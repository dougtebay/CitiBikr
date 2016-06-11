@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class='header'><h1>Nearby Stations</h1></div>
        @foreach($stations as $station)
          <div class='station'>
            <div class='station-description-container'>
              <div>{!! $station->name !!}</div>
              <div>Bikes Available: {!! $bikes[$station->number] !!}</div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop