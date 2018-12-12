@extends('layouts.app')

@section('head_links')
    <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/owl.theme.css')}}" rel="stylesheet" type="text/css"/>

@endsection

@section('content')
    <div class="jumbotron" style="background:whitesmoke;">
        <h1 class="display-4 offset-md-1" ><strong>NEWS</strong></h1>
    </div>

    <section>
		<div class="form-group">
      @foreach($news_data as $news)
  			<div class="row">
  				<div class="col-md-1"></div>
  				<div class="col-md-5">
  					<h2>{{$news->title_au}}</h2>
  					<h5>{{$news->subtitle_au}}</h5>
  					<footer><blockquote class="blockquote-footer">Publish date: {{$news->publish_date}}</blockquote></footer>
  					<a href="{{route('show_news',['news_language'=>'au','news_id'=>$news->id])}}">Read more...</a>
  				</div>
  				<div class="col-md-5 text-right farsi" style="direction:rtl;">
  					<h2 class="farsi">{{$news->title_fa}}</h2>
  					<h5 class="farsi">{{$news->subtitle_fa}}</h5>
  					<footer><blockquote class="blockquote-footer">تاریخ انتشار: <script>document.write((function(str){return (str.toString()).split('-').join('/')})('{{$news->publish_date}}'))</script></blockquote></footer>
  					<a href="{{route('show_news',['news_language'=>'fa','news_id'=>$news->id])}}">مشاهده خبر...</a>
  				</div>
  				<div class="col-md-1"></div>
  			</div>
  			<br/>
  		@endforeach
		</div>
    </section>

@endsection
