@extends('layouts.app')

@section('content')
  <div class="fluid-container" style="background:whitesmoke; padding:0;">
    <div class="text-center">
      {{$cover_type === "video"}}
      @if($cover_type === "video")
        <video width="100%" height="auto" controls>
          <source src="{{asset($cover_route)}}" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>
        @else
          <img src="{{asset($cover_route)}}" width="100%" />
        @endif
      </div>
    </div>

    <section class="fluid-container background-image" style="background-image: url('{{asset($background_image_route)}}');">
      <br/>
      <div class="row">
        <div class="col-md-5 offset-md-1">
          <h2 class="text-white text-uppercase" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$name_au}}</h2>
          <div class="row">
            <div class="col-md-4">
              <img src="{{asset($thumbnail_image_route)}}" width="100%" height="auto" style="max-width:250px;" class="img-responsive float-left" />
            </div>
            <div class="col-md">
              <h3 class="text-left text-white">{{$name_au}}</h3>
              <h4 class="text-left text-white">Field: {{$field_au}}</h4>
              <h4 class="text-left text-white">Genre: {{$genre_au}}</h4>
              <h4 class="text-left text-white">Match date: {{$match_date}}</h4>
              <h4 class="text-left text-white">Match palce: {{$match_place_au}}</h4>
              <h4 class="text-left text-white">Language: {{$language_au}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="text-left text-white">Description: </h4>
            <p class="text-left text-white">{{$description_au}}</p>
          </div>
        </div>
        <div class="col-md-5" style="direction:rtl">
          <h2 class="farsi text-right text-white" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$name_fa}}</h2>
          <div class="row">
            <div class="col-md-4">
              <img src="{{asset($thumbnail_image_route)}}" width="100%" height="auto" style="max-width:250px;" class="img-responsive float-right" />
            </div>
            <div class="col-md">
              <h3 class="farsi text-right text-white text-bold">{{$name_fa}}</h3>
              <h4 class="farsi text-right text-white">رشته ورزشی: {{$field_fa}}</h4>
              <h4 class="farsi text-right text-white">ژانر: {{$genre_fa}}</h4>
              <h4 class="farsi text-right text-white">زمان بازی: <script>document.write((function(str){return (str.toString()).split('-').join('/')})('{{$match_date}}'))</script></h4>
              <h4 class="farsi text-right text-white">محل بازی: {{$match_place_fa}}</h4>
              <h4 class="farsi text-right text-white">زبان: {{$language_fa}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="farsi text-right text-white">توضیحات:</h4>
            <p class="farsi text-right text-white">{{$description_fa}}</p>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
      <br/>

      <!-- Playback section -->

      <br/>
    </section>
  @endsection
