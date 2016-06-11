@extends('layout')

@section('content')
  <div class='container'>
    <div class='row'>
      <div class="col-md-1"></div>
      <div class="col-md-10">
      <div style="width:100%;max-width:100%;overflow:hidden;height:700px;color:red;">
        <div id="gmap_canvas" style="height:100%; width:100%;max-width:100%;">
          <iframe
            style="height:100%;width:100%;border:0;"
            frameborder="0"
            src="https://www.google.com/maps/embed/v1/place?q=New+York,+NY,+United+States&key=AIzaSyAN0om9mFmy1QN6Wf54tXAowK4eT0ZUPrU"></iframe>
        </div>
      </div>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
@stop