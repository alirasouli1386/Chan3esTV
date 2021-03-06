@extends('layouts.app')

@section('head_links')
  <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
  <div class="jumbotron" style="background:whitesmoke;">
    <h1 class="display-4 offset-md-1" ><strong>MOVIES</strong></h1>
  </div>

  <section>
    <div class="d-none d-sm-block">
      <div class="row" style="margin-left: 15vw;margin-right:15vw;">
        @foreach($movies as $movie)
          <div class="col-sm-4 col-md-3 py-sm-1">
            <div class="card h-100">
              <a class="card-anchor" href="{{route('show_movie', [ 'movie_id' => $movie->id ])}}">
                <img src="{{asset('img/tv/movies/'.$movie->thumbnail_image_route)}}" class="card-img-top"/>
                <div class="card-body">
                  <h4 class="card-title">
                    {{$movie->name_au}}
                  </h4>
                </div>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!------------------------------------------------------------------------------------>
    <div class="d-block d-sm-none">
      <div class="owl-carousel owl-theme" id="owl-demo">
        @foreach($movies as $movie)
          <div class="item">
            <div class="card h-100">
              <a class="card-anchor" href="{{route('show_movie', [ 'movie_id' => $movie->id ])}}">
                <img src="{{asset('img/tv/movies/'.$movie->thumbnail_image_route)}}" class="card-img-top"/>
                <div class="card-body">
                  <!--
                  <p class="card-text">
                  Genre:
                </p>
              -->
              <h4 class="card-title">
                {{$movie->name_au}}
              </h4>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>
</section>

@endsection

@section( 'body_scripts' )
  <script src="{{asset('js/owl.carousel.min.js')}}"></script>
  <script>
  $( document ).ready( function () {
    $( "#owl-demo" ).owlCarousel( {
      itemsCustom: [
        [ 0, 2 ],
        [ 450, 3 ],
        [ 1000, 6 ]
      ],
      navigation: true
    } );
  } );
</script>
@endsection
