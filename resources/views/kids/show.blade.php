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
              <h4 class="text-left text-white">Genre: {{$genre_au}}</h4>
              <h4 class="text-left text-white">Age limit: {{$age_limit}} years</h4>
              <h4 class="text-left text-white">Production Year: {{$production_year}}</h4>
              <h4 class="text-left text-white">Production Country: {{$production_country_au}}</h4>
              <h4 class="text-left text-white">Producer(s): {{$producers_au}}</h4>
              <h4 class="text-left text-white">Director(s): {{$directors_au}}</h4>
              <h4 class="text-left text-white">Actors(s): {{$actors_au}}</h4>
              <h4 class="text-left text-white">Language: {{$language_au}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="text-left text-white">Mini Story: </h4>
            <p class="text-left text-white">{{$mini_story_au}}</p>
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
              <h4 class="farsi text-right text-white">ژانر: {{$genre_fa}}</h4>
              <h4 class="farsi text-right text-white">محدودیت سنی: {{$age_limit}} سال</h4>
              <h4 class="farsi text-right text-white">سال ساخت: {{$production_year}}</h4>
              <h4 class="farsi text-right text-white">کشور سازنده: {{$production_country_au}}</h4>
              <h4 class="farsi text-right text-white">تهیه‌کننده(گان){{$producers_au}}</h4>
              <h4 class="farsi text-right text-white">کارگردان(ان) {{$directors_au}}</h4>
              <h4 class="farsi text-right text-white">هنرپیشگان {{$actors_au}}</h4>
              <h4 class="farsi text-right text-white">زبان: {{$language_fa}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="farsi text-right text-white">داستان کوتاه:</h4>
            <p class="farsi text-right text-white">{{$mini_story_fa}}</p>
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
