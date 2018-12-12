<?php
// Home

Route::get('/', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/contact', 'HomeController@contact')->name('contact');

//Route::get('/live', 'HomeController@live')->name('live');
Route::get('/live', function(){
  return '<script>location.href="http://live.chan3estv.com"</script>';
  //return '<script>location.href="https://iframe.dacast.com/b/111645/c/472459"</script>';
  //return '<script id="111645_c_472459" width="1280" height="720" src="//player.dacast.com/js/player.js"  class="dacast-video"></script>';
})->name('live');

// Movie
Route::get('/tvshows', 'TvShowController@index')->name('tvshows');
Route::get('/kooch', 'TvShowController@index_kooch')->name('kooch');
Route::get('/tvshow/{tvshow_id}', 'TvShowController@show')->name('show_tvshow');

Route::get('/documentaries', 'DocumentaryController@index')->name('documentaries');
Route::get('/documentary/{documentary_id}', 'DocumentaryController@show')->name('show_documentary');
Route::get('/kids', 'KidsController@index')->name('kids');
Route::get('/kids/{kids_id}', 'KidsController@show')->name('show_kids');
Route::get('/movies', 'MovieController@index')->name('movies');
Route::get('/movie/{movie_id}', 'MovieController@show')->name('show_movie');
Route::get('/musics', 'MusicController@index')->name('musics');
Route::get('/music/{music_id}', 'MusicController@show')->name('show_music');
Route::get('/series', 'SeriesController@index')->name('series');
Route::get('/series/{series_id}', 'SeriesController@show')->name('show_series');
Route::get('/series/{series_id}/{series_season}', 'SeriesController@showSeason')->name('show_series_season');
Route::get('/sports', 'SportController@index')->name('sports');
Route::get('/sport/{sport_id}', 'SportController@show')->name('show_sport');

Route::get('/news', 'NewsController@index')->name('news');
Route::get('/news/{news_language}/{news_id}', 'NewsController@show')->name('show_news');
Route::get('/chan3es/{chan3es_id}', 'Chan3esController@show')->name('show_chan3es');

Route::post('/comments/add/{content_type}/{reference_id}', 'CommentController@add_comment')->name('add_comment');

Route::get('/user/verify/{token}', 'Auth\RegisterController@verifyUser');

// ManageTV
Route::middleware('auth')->group(function () {
  Route::get('/home', 'HomeController@managetv');
  Route::get('/managetv', 'HomeController@managetv')->name('managetv');
  Route::get('/managetv/sliders', 'HomeController@manage_sliders')->name('manage_sliders');
  Route::post('/managetv/sliders', 'HomeController@post_sliders');
  Route::get('/managetv/schedules', 'HomeController@manage_schedules')->name('manage_schedules');
  Route::post('/managetv/schedules', 'HomeController@post_schedules');
  Route::get('/managetv/featured', 'HomeController@manage_featured')->name('manage_featured');
  Route::post('/managetv/featured', 'HomeController@post_featured');

  Route::get('/managetv/news', 'NewsController@manage')->name('manage_news');
  Route::get('/managetv/news/create', 'NewsController@create')->name('create_news');
  Route::post('/managetv/news/create', 'NewsController@create');
  Route::get('/managetv/news/update/{news_id}', 'NewsController@update')->name('update_news');
  Route::post('/managetv/news/update/{news_id}', 'NewsController@modify');
  Route::get('/managetv/news/toggle-archive/{news_id}', 'NewsController@toggle_archive')->name('toggle_archive_news');
  Route::get('/managetv/news/destroy/{news_id}', 'NewsController@destroy')->name('destroy_news');

  Route::get('/managetv/tvshows', 'TvShowController@manage')->name('manage_tvshows');
  Route::get('/managetv/tvshow/create', 'TvShowController@create')->name('create_tvshow');
  Route::post('/managetv/tvshow/create', 'TvShowController@create');
  Route::get('/managetv/tvshow/update/{tvshow_id}', 'TvShowController@update')->name('update_tvshow');
  Route::post('/managetv/tvshow/update/{tvshow_id}', 'TvShowController@modify');
  Route::get('/managetv/tvshow/toggle-archive/{tvshow_id}', 'TvShowController@toggle_archive')->name('toggle_archive_tvshow');
  Route::get('/managetv/tvshow/playback-casts/{tvshow_id}', 'TvShowController@playback_casts')->name('playback_casts_tvshow');
  Route::post('/managetv/tvshow/playback-casts/{tvshow_id}', 'TvShowController@playback_casts');
  Route::get('/managetv/tvshow/tags/{tvshow_id}', 'TvShowController@tags')->name('tags_tvshow');
  Route::post('/managetv/tvshow/tags/{tvshow_id}', 'TvShowController@tags');
  Route::get('/managetv/tvshow/comments/{tvshow_id}', 'TvShowController@comments')->name('comments_tvshow');
  Route::post('/managetv/tvshow/comments/{tvshow_id}', 'TvShowController@comments');
  Route::get('/managetv/tvshow/destroy/{tvshow_id}', 'TvShowController@destroy')->name('destroy_tvshow');

  Route::get('/managetv/series', 'SeriesController@manage')->name('manage_series');
  Route::get('/managetv/series/create', 'SeriesController@create')->name('create_series');
  Route::post('/managetv/series/create', 'SeriesController@create');
  Route::get('/managetv/series/update/{series_id}', 'SeriesController@update')->name('update_series');
  Route::post('/managetv/series/update/{series_id}', 'SeriesController@modify');
  Route::get('/managetv/series/toggle-archive/{series_id}', 'SeriesController@toggle_archive')->name('toggle_archive_series');
  Route::get('/managetv/series/destroy/{series_id}', 'SeriesController@destroy')->name('destroy_series');

  Route::get('/managetv/movies', 'MovieController@manage')->name('manage_movies');
  Route::get('/managetv/movie/create', 'MovieController@create')->name('create_movie');
  Route::post('/managetv/movie/create', 'MovieController@create');
  Route::get('/managetv/movie/update/{movie_id}', 'MovieController@update')->name('update_movie');
  Route::post('/managetv/movie/update/{movie_id}', 'MovieController@modify');
  Route::get('/managetv/movie/toggle-archive/{movie_id}', 'MovieController@toggle_archive')->name('toggle_archive_movie');
  Route::get('/managetv/movie/destroy/{movie_id}', 'MovieController@destroy')->name('destroy_movie');

  Route::get('/managetv/documentaries', 'documentaryController@manage')->name('manage_documentaries');
  Route::get('/managetv/documentary/create', 'documentaryController@create')->name('create_documentary');
  Route::post('/managetv/documentary/create', 'documentaryController@create');
  Route::get('/managetv/documentary/update/{documentary_id}', 'documentaryController@update')->name('update_documentary');
  Route::post('/managetv/documentary/update/{documentary_id}', 'documentaryController@modify');
  Route::get('/managetv/documentary/toggle-archive/{documentary_id}', 'documentaryController@toggle_archive')->name('toggle_archive_documentary');
  Route::get('/managetv/documentary/destroy/{documentary_id}', 'documentaryController@destroy')->name('destroy_documentary');

  Route::get('/managetv/musics', 'MusicController@manage')->name('manage_musics');
  Route::get('/managetv/music/create', 'MusicController@create')->name('create_music');
  Route::post('/managetv/music/create', 'MusicController@create');
  Route::get('/managetv/music/update/{music_id}', 'MusicController@update')->name('update_music');
  Route::post('/managetv/music/update/{music_id}', 'MusicController@modify');
  Route::get('/managetv/music/toggle-archive/{music_id}', 'MusicController@toggle_archive')->name('toggle_archive_music');
  Route::get('/managetv/music/destroy/{music_id}', 'MusicController@destroy')->name('destroy_music');

  Route::get('/managetv/sports', 'SportController@manage')->name('manage_sports');
  Route::get('/managetv/sport/create', 'SportController@create')->name('create_sport');
  Route::post('/managetv/sport/create', 'SportController@create');
  Route::get('/managetv/sport/update/{sport_id}', 'SportController@update')->name('update_sport');
  Route::post('/managetv/sport/update/{sport_id}', 'SportController@modify');
  Route::get('/managetv/sport/toggle-archive/{sport_id}', 'SportController@toggle_archive')->name('toggle_archive_sport');
  Route::get('/managetv/sport/destroy/{sport_id}', 'SportController@destroy')->name('destroy_sport');

  Route::get('/managetv/kids', 'KidsController@manage')->name('manage_kids');
  Route::get('/managetv/kids/create', 'KidsController@create')->name('create_kids');
  Route::post('/managetv/kids/create', 'KidsController@create');
  Route::get('/managetv/kids/update/{kids_id}', 'KidsController@update')->name('update_kids');
  Route::post('/managetv/kids/update/{kids_id}', 'KidsController@modify');
  Route::get('/managetv/kids/toggle-archive/{kids_id}', 'KidsController@toggle_archive')->name('toggle_archive_kids');
  Route::get('/managetv/kids/destroy/{kids_id}', 'KidsController@destroy')->name('destroy_kids');

  Route::get('/managetv/chan3es', 'Chan3esController@manage')->name('manage_chan3es');
  Route::get('/managetv/chan3es/create', 'Chan3esController@create')->name('create_chan3es');
  Route::post('/managetv/chan3es/create', 'Chan3esController@create');
  Route::get('/managetv/chan3es/update/{chan3es_id}', 'Chan3esController@update')->name('update_chan3es');
  Route::post('/managetv/chan3es/update/{chan3es_id}', 'Chan3esController@modify');
  Route::get('/managetv/chan3es/toggle-archive/{chan3es_id}', 'Chan3esController@toggle_archive')->name('toggle_archive_chan3es');
  Route::get('/managetv/chan3es/destroy/{chan3es_id}', 'Chan3esController@destroy')->name('destroy_chan3es');


});

Auth::routes();
