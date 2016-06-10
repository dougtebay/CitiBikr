@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class='header'><h1>My Favorite Stations</h1></div>
        @foreach($favorites as $favorite)
          <div class='station'>
            <div class='station-description-container'>
              <span>{!! $favorite->number !!}</span>
              <span>{!! $favorite->name !!}</span>
            </div>
            <div class='favorites-button-container'>
              <form method='POST' action='favorites/{!! $favorite->id !!}'>
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{!! csrf_token(); !!}">
                <button type='submit' class='btn btn-primary'>Delete Station</button>
              </form>
            </div>
          </div>
        @endforeach
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop