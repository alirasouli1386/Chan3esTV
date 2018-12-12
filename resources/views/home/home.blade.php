@extends('layouts.app')

@section('head_links')
	<!-- Carousel style-->
	<style>
	.carousel-item img {
		min-width: 100%;
		width: 100%;
		height: auto;
		max-height: 1000px;
		overflow: hidden;
		object-fit: cover
	}

	.carousel-item .carousel-caption {
		color: white;
		text-shadow: 1px 1px 2px black, 0 0 25px black, 0 0 5px darkblue;
		bottom: 5%;
		top: auto;
	}

	.carousel-caption .carousel-title {
		text-align: left;
		font-size: 3em;
	}

	.carousel-caption .carousel-subtitle {
		text-align: left;
		font-size: 1.5em;
		font-style: oblique;
	}

	.carousel-control-prev {
		position: absolute;
		left: 0;
		width: 8%;
	}

	.carousel-control-next {
		position: absolute;
		right: 0;
		width: 8%;
	}

	.kooch:hover{
		text-decoration: none;
	}
</style>
<link href="{{asset('css/jquery.easy_slides.css')}}" rel="stylesheet"
type="text/css" />
<link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet"
type="text/css" />
<link href="{{asset('css/owl.theme.css')}}" rel="stylesheet"
type="text/css" />
@endsection

@section('content')
	<!-- Prog4Eng Carousel-->
	<section id="prog4eng-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			@foreach($sliders as $slider)
				<div class="carousel-item">
					<img src="{{asset('img/sliders/'.$slider->slider_route)}}" />
					<div class="d-none d-sm-none d-md-block">
						<a href="{{$slider->href}}" >
							<div class="carousel-caption">
								<h1 class="carousel-title">{{$slider->title_au}}</h1>
								<h2 class="carousel-subtitle">{{$slider->subtitle_au}}</h2>
							</div>
						</a>
					</div>
				</div>
			@endforeach
		</div>

		<a class="carousel-control-prev" href="#prog4eng-carousel" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		</a>
		<a class="carousel-control-next" href="#prog4eng-carousel" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
		</a>
	</section>
	<br />

	<section class="d-none d-sm-block">
		<div class="row">
			<div class="col-md offset-md-1">
				<h4 style="color: mediumblue">&nbsp;&nbsp;Tonight	on Chan3es</h4>
			</div>
		</div>

		<div class="row">
			<div class="offset-sm-2">
				<div class="slider slider_four_in_line" style="margin: 10px;">
					@foreach($schedules as $schedule)
						<div>
							{{$schedule->title_au}} <br /> <strong>{{$schedule->schedule_time}}</strong>
						</div>
					@endforeach
					<div class="next_button">&nbsp;</div>
					<div class="prev_button">&nbsp;</div>
				</div>
			</div>
		</div>
		<br />

		<div class="row">
			<div class="offset-sm-9">
				<h4 class="text-danger">Daily Schedule</h4>
			</div>
		</div>
		<br />
	</section>

	@if($kooch_data->count()>0)
		<section class="background-dark">
			<br/>
			<a href="{{route('kooch')}}" class="kooch">
				<div class="row">
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<h2 class="text-white">Kooch</h2>
					</div>
					<div class="col-md-5">
						<h2 class="text-white text-right farsi">کوچ</h2>
					</div>
					<div class="col-md-1"></div>
				</div>
			</a>
			<hr/>
			<br/>
			<div class="row" style="margin-left: 15vw; margin-right: 15vw;">
				@foreach($kooch_data as $tvshow)
					<div class="col-sm-6 col-md-4 py-sm-1">
						<div class="card card-transparent h-100">
							<a class="light-anchor" href="{{route('show_tvshow',['tvshow_id'=>$tvshow['id']])}}">
								<img src="{{asset('/img/tv/tvshows/' . $tvshow['thumbnail_image_route'])}}" class="card-img-top" />
								<div class="card-body">
									<div class="row">
										<div class="col-md text-left">
											<p class="card-text">{{$tvshow['name_au']}}</p>
											<h6 class="card-title">{{$tvshow['cue_au']}}</h6>
										</div>
										<div class="col-md text-right">
											<p class="card-text farsi">{{$tvshow['name_fa']}}</p>
											<h6 class="card-title farsi">{{$tvshow['cue_fa']}}</h6>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
			<br/>
		</section>
	@endif

	@if($chan3es_data->count()>0)
		<section class="">
			<br/>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<h2 class="text-white">Chan3es special</h2>
				</div>
				<div class="col-md-5">
					<h2 class="text-white text-right farsi">اختصاصی چنسس</h2>
				</div>
				<div class="col-md-1"></div>
			</div>
			<div class="d-none d-sm-block">
				<div class="row" style="margin-left: 15vw; margin-right: 15vw;">
					@foreach($chan3es_data as $chan3es)
						<div class="col-sm-6 col-md-4 py-sm-1">
							<div class="card card-transparent h-100">
								<a class="light-anchor" href="{{route('show_chan3es',['chan3es_id'=>$chan3es['id']])}}">
									<img src="{{asset('/img/tv/chan3es/' . $chan3es['thumbnail_image_route'])}}" class="card-img-top" />
									<div class="card-body">
										<div class="row">
											<div class="col-md text-left">
												<p class="card-text text-dark">{{$chan3es['title_au']}}</p>
												<h6 class="card-title text-dark">{{$chan3es['subtitle_au']}}</h6>
											</div>
											<div class="col-md text-right">
												<p class="card-text text-dark farsi">{{$chan3es['title_fa']}}</p>
												<h6 class="card-title text-dark farsi">{{$chan3es['subtitle_fa']}}</h6>
											</div>
										</div>
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
					@foreach($chan3es_data as $chan3es)
						<div class="item">
							<div class="card card-transparent h-100">
								<a class="light-anchor" href="{{route('show_chan3es',['chan3es_id'=>$chan3es['id']])}}">
									<img src="{{asset('/img/tv/chan3es/' . $chan3es['thumbnail_image_route'])}}" class="card-img-top" />
									<div class="card-body">
										<div class="row">
											<div class="col-md text-left">
												<p class="card-text text-dark">{{$chan3es['title_au']}}</p>
												<h6 class="card-title text-dark">{{$chan3es['subtitle_au']}}</h6>
											</div>
											<div class="col-md text-right">
												<p class="card-text text-dark farsi">{{$chan3es['title_fa']}}</p>
												<h6 class="card-title text-dark farsi">{{$chan3es['subtitle_fa']}}</h6>
											</div>
										</div>
									</div>
								</a>
							</div>
						</div>
					@endforeach
				</div>
			</div>
			<br/>
		</section>
	@endif

	<img src="{{asset('img/ad-bar.jpg')}}" width="100%" height="auto"/>

	<section class="background-dark">
		<br/>
		<div class="d-none d-sm-block">
			<div class="row" style="margin-left: 15vw; margin-right: 15vw;">
				@foreach($featured_data as $featured)
					<div class="col-sm-4 col-md-3 py-sm-1">
						<div class="card card-transparent h-100">
							<a class="light-anchor" href="{{$featured['route']}}">
								<img src="{{$featured['thumbnail_image_route']}}" class="card-img-top" />
								<div class="card-body">
									<p class="card-text text-center">{{$featured['cue_au']}}</p>
									<h6 class="card-title text-center">{{$featured['name_au']}}</h6>
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
				@foreach($featured_data as $featured)
					<div class="item">
						<div class="card card-transparent h-100">
							<a class="light-anchor" href="{{$featured['route']}}">
								<img src="{{$featured['thumbnail_image_route']}}" class="card-img-top" />
								<div class="card-body">
									<p class="card-text text-center">{{$featured['cue_au']}}</p>
									<h6 class="card-title text-center">{{$featured['name_au']}}</h6>
								</div>
							</a>
						</div>
					</div>
				@endforeach
			</div>
		</div>
		<br/>
	</section>

	@if($news_data->count()>0)
		<br/>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md">
				<h1 class="text-white">News</h1>
			</div>
			<div class="col-md">
				<h1 class="text-white farsi text-right">اخبار</h1>
			</div>
			<div class="col-md-1"></div>
		</div>

		<hr/>
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
		<br/>
	@endif
@endsection

@section('body_scripts')
	<script src="{{asset('js/jquery.easy_slides.js')}}"></script>
	<script src="{{asset('js/owl.carousel.min.js')}}"></script>
	<script defer>
	$(document).ready(function () {
		document.querySelector('.carousel-inner .carousel-item').classList.add('active');
		$('.slider_four_in_line').EasySlides({'autoplay': true, 'show': 5});
	});

	$("#owl-demo").owlCarousel({

		// Define custom and unlimited items depending from the width
		// If this option is set, itemsDeskop, itemsDesktopSmall, itemsTablet, itemsMobile etc. are disabled
		// For better preview, order the arrays by screen size, but it's not mandatory
		// Don't forget to include the lowest available screen size, otherwise it will take the default one for screens lower than lowest available.
		// In the example there is dimension with 0 with which cover screens between 0 and 450px

		itemsCustom: [
			[0, 2],
			[450, 3],
			[1000, 6]
		],
		navigation: true
	});
	</script>
@endsection
