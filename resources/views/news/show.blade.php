@extends( 'layouts.app' )

@section( 'content' )
	<section class="container">
		<br/>
		@if ($news_language == 'au')
			<div class="row">
				<div class="col-sm-10 offset-sm-1">
					<header>
						<h1>{{$title_au}}</h1>
					</header>
					{!! $content_au !!}
					<footer>
						<blockquote class="blockquote-footer">Publish date: {{$publish_date}}</blockquote>
					</footer>
				</div>
			</div>
		@else
			<div class="row" style="direction:rtl">
				<div class="col-sm-1"></div>
				<div class="col-sm-10 farsi text-right">
					<header>
						<h1 class="farsi">{{$title_fa}}</h1>
					</header>
					{!! $content_fa !!}
					<footer>
						<footer><blockquote class="blockquote-footer farsi">تاریخ انتشار: <script>document.write((function(str){return (str.toString()).split('-').join('/')})('{{$publish_date}}'))</script></blockquote></footer>
					</footer>
				</div>
				<div class="col-sm-1"></div>
			</div>
		@endif
		<br/>
	</section>

@endsection
