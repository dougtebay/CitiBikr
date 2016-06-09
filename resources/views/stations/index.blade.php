@extends('layout')

@section('content')

<h1>Stations Index</h1>
@foreach($stations as $station)
  <div>
  <span>{!! $station['number'] !!}</span>
  <span>{!! $station['name'] !!}</span>
  </div>
@endforeach


@stop