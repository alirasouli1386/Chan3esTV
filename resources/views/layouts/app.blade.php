<!DOCTYPE html>
<?php
session_start();
?>
<html lang="en">
<head>
  <link rel="icon" type="image/png" sizes="32x32" href='{{asset("favicon.png")}}'>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Welcome to Chan3es TV</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
  integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"
  integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ"
  crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"
  integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm"
  crossorigin="anonymous"></script>


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style type="text/css" media="all">
  @font-face {
    font-family: 'Lato';
    src: url('{{asset("fonts/Lato-Reg.ttf")}}') format('truetype');
    font-weight: normal;
    font-style: normal;
  }

  @font-face {
    font-family: 'Oswald';
    src: url('{{asset("fonts/Oswald-Regular.otf")}}') format('truetype');
    font-weight: normal;
    font-style: normal;
  }

  @font-face {
    font-family: 'RobotoSlab';
    src: url('{{asset("fonts/RobotoSlab-Regular.ttf")}}') format('truetype');
    font-weight: normal;
    font-style: normal;
  }

  @font-face {
    font-family: 'Myrid';
    src: url('{{asset("fonts/MYRIADPRO-REGULAR.OTF")}}') format('truetype');
    font-weight: normal;
    font-style: normal;
  }

  @font-face {
    font-family: 'Farsi Sans';
    src: url('{{asset("fonts/Farsi-Regular.woff")}}') format('woff');
    font-weight: normal;
    font-style: normal;
  }

  @font-face {
    font-family: 'B Roya';
    src: url('{{asset("fonts/BRoya.eot?#")}}') format('eot'), /* IE6–8 */ url('{{asset("fonts/BRoya.woff")}}') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('{{asset("fonts/BRoya.ttf")}}') format('truetype');  /* Saf3—5, Chrome4+, FF3.5, Opera 10+ */
  }

  @font-face {
    font-family: 'B Yekan';
    src: url('{{asset("fonts/BYekan.eot?#")}}') format('eot'), /* IE6–8 */ url('{{asset("fonts/BYekan.woff")}}') format('woff'), /* FF3.6+, IE9, Chrome6+, Saf5.1+*/ url('{{asset("fonts/BYekan.ttf")}}') format('truetype');  /* Saf3—5, Chrome4+, FF3.5, Opera 10+ */
  }

  .farsi{
    font-family: 'B Yekan','Farsi Sans','B Roya','Sans serif';
    font-weight: 1.3em;
  }

  .btn-live {
    background-color: #3768b1;
    border: none;
    padding: 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 2em;
    margin: 4px 2px;
    border-radius: 50%;
  }

  .btn-live:hover{
    background-color: #ec1e27;
    text-decoration: none;
  }
  </style>

  <link rel="stylesheet" href='{{asset("css/Chan3esTV.css")}}' media="all">
  @yield('head_links')
</head>

<body>
  <section class="d-none d-sm-none d-md-block">
    <nav class="jumbotron jumbotron-fluid navbar navbar-expand-md fixed-top navbar-dark">
      <a class="navbar-brand" href="{{route('home')}}" style="padding-left: 10px;">
        <span class="text-center">
          <img src="{{asset("img/logo.png")}}" height="80px" width="auto" alt="logo" class="mx-auto"/>
          <!--
          <h6 style="font-weight: bold">
          Chan3es TV</h6>-->
        </span>
      </a>
      <ul class="navbar-nav mr-auto">
        <li class="nav-item nav-line">
          <a class="nav-link" href="{{route('tvshows')}}">TV show</a>
        </li>
        <li class="nav-item nav-line">
          <a class="nav-link" href="{{route('movies')}}">Movie</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('series')}}">Series</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('musics')}}">Music</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('documentaries')}}">Documentary</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('kids')}}">Kids</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('sports')}}">Sport</a>
        </li>
        <li class="nav-item nav-line">
          <a class="nav-link" href="{{route('news')}}">News</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="https://www.instagram.com/chan3estv/"><i class="fa fa-2x fa-instagram"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://www.facebook.com/Chancestv/"><i class="fa fa-2x fa-facebook"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="https://t.me/chan3estvofficial"><i class="fa fa-2x fa-telegram"></i>&nbsp;&nbsp;&nbsp;&nbsp;</a>
        </li>
        <li class="nav-item nav-line">
          <a class="nav-link" href="{{route('login')}}" class="nav-line">&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-2x fa-sign-in"></i></a>
        </li>
      </ul>
    </nav>
  </section>

  <section class="d-block d-sm-block d-md-none">
    <nav class="jumbotron jumbotron-fluid navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="{{route('home')}}" style="padding-left: 10px;">
        <div class="text-center">
          <img src="{{asset("img/logo.png")}}" height="70px" width="auto" alt="logo" class="mx-auto"/>
        </div>
      </a>
      <br/>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse bg-dark" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{route('live')}}"><h3>Live</h3></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('news')}}">News</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('tvshows')}}">TV show</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('movies')}}">Movie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('series')}}">Series</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('musics')}}">Music</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('documentaries')}}">Documentary</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('kids')}}">Kids</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('sports')}}">Sport</a>
          </li>
        </ul>
      </div>
    </nav>
  </section>

  <main id="main" class="main-bgimg">
    @yield('content')

    <section class="d-none d-sm-none d-md-block">
      <a href="{{route('live')}}" class="btn-live" style="position:fixed; bottom: 40px; right: 40px;"><span class="text-white">Live</span></a>
    </section>
  </main>

  <footer class="jumbotron jumbotron-fluid background-dark" style="margin: auto; padding:0">
      <br/>
      <div class="row">
        <div class="mx-auto">
          <details class="text-center">
            <summary class="text-light">Copyright © <script>document.write((new Date()).getFullYear());</script> Chan3es bright international, All right reserved</summary>
            <article class="text-center"><span class="text-muted">Design and development: </span><a href="http://prog4eng.com" class="light-anchor">Ali Rasouli</a></article>
          </details>
          <br/>
        </div>
      </div>
  </footer>

  <script src="{{asset('js/Chan3esTV.js')}}"></script>

  @yield('body_scripts')
</body>
</html>
