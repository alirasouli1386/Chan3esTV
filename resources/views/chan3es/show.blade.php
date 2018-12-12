@extends('layouts.app')

@section('content')
  <div class="fluid-container" style="background:whitesmoke; padding:0;">
    <div class="text-center">
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
          <h2 class="text-white text-uppercase" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$title_au}}</h2>
        </div>
        <div class="col-md-5" style="direction:rtl">
          <h2 class="farsi text-right text-white" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$title_fa}}</h2>
        </div>
      </div>

      <div class="row" style="direction:rtl">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-2">
              <img src="{{asset($thumbnail_image_route)}}" width="100%" height="auto" style="max-width:250px;" class="img-responsive float-right" />
            </div>
            <div class="col-md">
              <h3 class="farsi text-right text-white text-bold">{{$subtitle_fa}}</h3>
              <!--
              <h4 class="farsi text-right text-white">زمان انتشار: {{$publish_date}}</h4>
            -->
              <p class="farsi text-right text-white">{{$content_fa}}</p>
            </div>
          </div>
        </div>
      </div>
      <br/>
    </section>
  @endsection
