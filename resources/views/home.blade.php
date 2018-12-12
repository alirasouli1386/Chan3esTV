@extends( 'layouts.app' )

@section( 'head_links' )
	<style>
		main {
			position: relative;
		}

		ul.nav-pills {
			position: fixed;
			position: sticky;
			top: 100px;
		}
	</style>
@endsection

@section( 'content' )
	<div class="container">
		<div class="row" style="background-color: whitesmoke">
			<div class="col-md-8">
				<h1>Manage Chan3es TV</h1>
			</div>
			<div class="col-md-4 justify-content-center align-self-center">
				<div class="input-group">
					<div class="input-group-prepend">
						<label class="input-group-text">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
											</div>
                @endif
                You are logged in! Logout here:
            </label>

					</div>
					<button class="form-control btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="fa fa-2x fa-sign-out"></i> Logout </button>
					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						{{ csrf_field() }}
					</form>
				</div>
			</div>
		</div>
		<br/>
		<hr/>
		<section class="container-fluid">
			<div class="row">
				<nav class="col-sm-3 d-none d-sm-block" id="myScrollspy" style="background-color: white;">
					<ul class="nav nav-pills flex-column">

						<li class="nav-item">
							<a class="nav-link" href="#sliders">Sliders</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#schedules">Schedules</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#featured">Featured</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#news">News</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#advertisements">Chan3es Ads</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#tvshows">TV Shows</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#documentaries">Documentaries</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#kids">Kids</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#movies">Movies</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#musics">Musics</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#series">Series</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#sports">Sports</a>
						</li>
					</ul>
				</nav>
				<div class="col-sm-9">
					<div id="sliders" class="bg-dark text-light">
						<h2>Manage Sliders</h2>
						<a href="{{route('manage_sliders')}}">Open sliders management panel</a>
					</div>
					<div id="schedules" class="bg-white">
						<h2>Manage Schedules</h2>
						<a href="{{route('manage_schedules')}}">Open schedules management panel</a>
					</div>
					<div id="featured" class="bg-dark text-light">
						<h2>Manage Featured</h2>
						<a href="{{route('manage_featured')}}">Open featured management panel</a>
					</div>
					<div id="news" class="bg-white">
						<h2>Manage News</h2>
						<a href="{{route('manage_news')}}">Open news management panel</a>
					</div>
					<div id="advertisements" class="bg-dark text-light">
						<h2>Manage Chan3es TV advertisements</h2>
						<a href="{{route('manage_chan3es')}}">Open Chan3es TV advertisement panel</a>
					</div>
					<div id="tvshows" class="bg-white">
						<h2>Manage TV Shows</h2>
						<a href="{{route('manage_tvshows')}}">Open TV shows management panel</a>
					</div>
					<div id="documentaries" class="bg-dark text-light">
						<h2>Manage Documentaries</h2>
						<a href="{{route('manage_documentaries')}}">Open documentaries management panel</a>
					</div>
					<div id="kids" class="bg-white">
						<h2>Manage Kids Contents</h2>
						<a href="{{route('manage_kids')}}">Open kids management panel</a>
					</div>
					<div id="movies" class="bg-dark text-light">
						<h2>Manage Movies</h2>
						<a href="{{route('manage_movies')}}">Open movies management panel</a>
					</div>
					<div id="musics" class="bg-white">
						<h2>Manage Musics</h2>
						<a href="{{route('manage_musics')}}">Open musics management panel</a>
					</div>
					<div id="series" class="bg-dark text-light">
						<h2>Manage Series</h2>
						<a href="{{route('manage_series')}}">Open series management panel</a>
					</div>
					<div id="sports" class="bg-white">
						<h2>Manage Sport Contents</h2>
						<a href="{{route('manage_sports')}}">Open sports management panel</a>
						<br/>
					</div>


				</div>
			</div>
		</section>
		<hr/>
		<br/>
	</div>
@endsection

@section('body_scripts')
<script>
$(document).ready(function() {
    $("main").on("click", "a", scroll_if_anchor); // Intercept all anchor clicks
});

/**
 * Check a href for an anchor. If exists, and in document, scroll to it.
 * If href argument ommited, assumes context (this) is HTML Element,
 *  which will be the case when invoked by jQuery after an event
 *  source: https://jsfiddle.net/ianclark001/aShQL/
 */
function scroll_if_anchor(href) {
    href = typeof(href) == "string" ? href : $(this).attr("href");

    var fromTop = 80;

    // If our Href points to a valid, non-empty anchor, and is on the same page (e.g. #foo)
    // Legacy jQuery and IE7 may have issues: http://stackoverflow.com/q/1593174
    if(href.indexOf("#") == 0) {
        var $target = $(href);

        // Older browser without pushState might flicker here, as they momentarily jump to the wrong position (IE < 10)
        if($target.length) {
            $('html, body').animate({ scrollTop: $target.offset().top - fromTop });
            if(history && "pushState" in history) {
                history.pushState({}, document.title, window.location.pathname + href);
                return false;
            }
        }
    }
}
</script>
@endsection
