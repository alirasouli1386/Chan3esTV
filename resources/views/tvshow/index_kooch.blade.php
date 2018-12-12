@extends('layouts.app')

@section('head_links')
  <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
  <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
  <div class="jumbotron" style="background:whitesmoke;">
    <h1 class="display-4 offset-md-1" ><strong>KOOCH</strong></h1>
  </div>

  <section>
    <div class="d-none d-sm-block">
      <div class="row" style="margin-left: 15vw;margin-right:15vw;">
        @foreach($tvshows as $tvshow)
          <div class="col-sm-4 col-md-3 py-sm-1">
            <div class="card h-100">
              <a class="card-anchor" href="{{route('show_tvshow', [ 'tvshow_id' => $tvshow->id ])}}">
                <img src="{{asset('img/tv/tvshows/'.$tvshow->thumbnail_image_route)}}" class="card-img-top"/>
                <div class="card-body">
                  <h4 class="card-title">
                    {{$tvshow->name_au}}
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
        @foreach($tvshows as $tvshow)
          <div class="item">
            <div class="card h-100">
              <a class="card-anchor" href="{{route('show_tvshow', [ 'tvshow_id' => $tvshow->id ])}}">
                <img src="{{asset('img/tv/tvshows/'.$tvshow->thumbnail_image_route)}}" class="card-img-top"/>
                <div class="card-body">
                  <!--
                  <p class="card-text">
                  Genre:
                </p>
              -->
              <h4 class="card-title">
                {{$tvshow->name_au}}
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
