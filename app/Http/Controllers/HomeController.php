<?php

namespace App\ Http\ Controllers;

use App\ Slider as Slider;
use App\ Schedule as Schedule;
use App\ Featured as Featured;
use App\ News as News;
use App\ Chan3es as Chan3es;
use App\ TvShow as TvShow;
use App\ Movie as Movie;
use App\ Series as Series;
use App\ Documentary as Documentary;
use App\ Music as Music;
use App\ Sport as Sport;
use App\ Kids as Kids;
use Illuminate\ Http\ Request;
use Illuminate\ Support\ Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class HomeController extends Controller {
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct( Slider $sliders, Schedule $schedules, Featured $featured, News $news, Chan3es $chan3es, TvShow $tvshow, Movie $movie, Series $series, Documentary $documentary, Music $music, Sport $sport, Kids $kids ) {
		//$this->middleware('auth');
		$this->sliders = $sliders;
		$this->schedules = $schedules;
		$this->featured = $featured;
		$this->news = $news->where( 'is_archived', 0 );
		$this->chan3es = $chan3es->where( 'is_archived', 0 );
		$this->tvshow = $tvshow->where( 'is_archived', 0 );
		$this->movie = $movie->where( 'is_archived', 0 );
		$this->series = $series->where( 'is_archived', 0 );
		$this->documentary = $documentary->where( 'is_archived', 0 );
		$this->music = $music->where( 'is_archived', 0 );
		$this->sport = $sport->where( 'is_archived', 0 );
		$this->kids = $kids->where( 'is_archived', 0 );
	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index() {
		$data = [];
		$data[ 'sliders' ] = $this->sliders->orderBy( 'order' )->get();
		$data[ 'schedules' ] = $this->schedules->where('schedule_date',date("Y-m-d"))->orderBy( 'order' )->get();
		$data[ 'kooch_data' ] = $this->tvshow->where('groupname_au','Kooch')->orderBy('created_at','desc')->take(6)->get();
		$data[ 'chan3es_data' ] = $this->chan3es->orderBy('publish_date','desc')->take(6)->get();
		$data[ 'featured_data' ] = $this->generateFeatured( $this->featured->orderBy( 'order' )->get() );
		$data[ 'news_data' ] = $this->news->orderBy('publish_date','desc')->take(10)->get();

		return view( 'home/home', $data );
	}

	private function generateFeatured( $featured_data ) {
		$featured_content=[];
		foreach ( $featured_data as $featured ) {
			switch ( $featured->content_type ) {
				case 'movie':
				$content = $this->movie->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_movie', [ 'movie_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/movies/' . $content->thumbnail_image_route
				];
				break;
				case 'music':
				$content = $this->music->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_music', [ 'music_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/musics/' . $content->thumbnail_image_route
				];
				break;
				case 'series':
				$content = $this->series->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_series', [ 'series_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/series/' . $content->thumbnail_image_route
				];
				break;
				case 'documentary':
				$content = $this->documentary->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_documentary', [ 'documentary_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/documentaries/' . $content->thumbnail_image_route
				];
				break;
				case 'tvshow':
				$content = $this->tvshow->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_tvshow', [ 'tvshow_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/tvshows/' . $content->thumbnail_image_route
				];
				break;
				case 'sport':
				$content = $this->sport->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_sport', [ 'sport_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/sports/' . $content->thumbnail_image_route
				];
				break;
				case 'kids':
				$content = $this->kids->find( $featured->reference_id );
				$featured_content[] = [
					'name_au' => $content->name_au,
					'name_fa' => $content->name_fa,
					'cue_au' => $content->cue_au,
					'cue_fa' => $content->cue_fa,
					'route' => route( 'show_kids', [ 'kids_id' => $content->id ] ),
					'thumbnail_image_route' => url( '/' ) . '/img/tv/kids/' . $content->thumbnail_image_route
				];
				break;
			}
		}
		return $featured_content;
	}

	public function manage_sliders() {
		$data = [];
		$data[ 'sliders' ] = $this->sliders->orderBy( 'order' )->get();
		return view( 'home/sliders', $data );
	}

	public function post_sliders( Slider $slider, Request $request ) {
		for ( $i = 0; $i < count( $request->slider_order ); $i++ ) {
			if ( $request->slider_id[ $i ] != 0 ) {
				$slider_data = [];
				$slider_data = $this->sliders->find( $request->slider_id[ $i ] );

				if ( $slider_data != null ) {
					$slider_image = $slider_data->slider_route;

					if ( $request->slider_order[ $i ] < 0 ) {
						if ( file_exists( public_path() . '/img/sliders/' . $slider_image ) ) {
							unlink( public_path() . '/img/sliders/' . $slider_image );
						}

						$slider_data->delete();
					} else {
						if(( int )$request->slider_order[ $i ]!=null && $request->slider_title_au[ $i ]!=null && $request->slider_title_fa[ $i ]!=null)
						{
							$slider_data->order = ( int )$request->slider_order[ $i ];
							$slider_data->title_au = $request->slider_title_au[ $i ];
							$slider_data->subtitle_au = $request->slider_subtitle_au[ $i ]?$request->slider_subtitle_au[ $i ]:'';
							$slider_data->title_fa = $request->slider_title_fa[ $i ];
							$slider_data->subtitle_fa = $request->slider_subtitle_fa[ $i ]?$request->slider_subtitle_fa[ $i ]:'';
							$slider_data->href = $request->slider_href[ $i ]?$request->slider_href[ $i ]:'';

							if ( !file_exists( public_path() . '/img/sliders/' . $slider_image ) ) {
								$slider_data->slider_route = ( ( string )Str::uuid() ) . '.' . ( $request->slider_file[ $i ]->getClientOriginalExtension() );

								$request->slider_file[ $i ]->move( public_path() . '/img/sliders', $slider_data->slider_route );
							}

							$slider_data->save();
						}
					}
				}
			} else {
				$data = [];
				if(( int )$request->slider_order[ $i ]!=null && $request->slider_title_au[ $i ]!=null && $request->slider_title_fa[ $i ]!=null && $request->slider_file[ $i ]!=null)
				{
					$data[ 'order' ] = ( int )$request->slider_order[ $i ];
					$data[ 'title_au' ] = $request->slider_title_au[ $i ];
					$data[ 'subtitle_au' ] = $request->slider_subtitle_au[ $i ]?$request->slider_subtitle_au[ $i ]:'';
					$data[ 'title_fa' ] = $request->slider_title_fa[ $i ];
					$data[ 'subtitle_fa' ] = $request->slider_subtitle_fa[ $i ]?$request->slider_subtitle_fa[ $i ]:'';
					$data[ 'href' ] = $request->slider_href[ $i ]?$request->slider_href[ $i ]:'';

					$originalExtension = $request->slider_file[ $i ]->getClientOriginalExtension();
					$data[ 'slider_route' ] = ( ( string )Str::uuid() ) . '.' . $originalExtension;

					$slider->insert( $data );
					$request->slider_file[ $i ]->move( public_path() . '/img/sliders', $data[ 'slider_route' ] );
				}
			}
		}

		return redirect( 'managetv' );
	}

	public function manage_schedules() {
		$data = [];
		$data[ 'schedules' ] = $this->schedules->orderBy( 'schedule_date' )->orderBy( 'order' )->get();
		return view( 'home/schedules', $data );
	}

	public function post_schedules( Schedule $schedule, Request $request ) {
		for ( $i = 0; $i < count( $request->schedule_order ); $i++ ) {
			if ( $request->schedule_id[ $i ] > 0 ) {
				$schedule_data = [];
				$schedule_data = $this->schedules->find( $request->schedule_id[ $i ] );

				if ( $schedule_data != null ) {
					if ( $request->schedule_order[ $i ] < 0 ) {
						$schedule_data->delete();

					} else {
						$schedule_data->order = ( int )$request->schedule_order[ $i ];
						$schedule_data->title_au = $request->schedule_title_au[ $i ];
						$schedule_data->title_fa = $request->schedule_title_fa[ $i ];
						$schedule_data->schedule_date = $request->schedule_date[ $i ];
						$schedule_data->schedule_time = $request->schedule_time[ $i ];

						$schedule_data->save();
					}
				}
			} else {
				$data = [];
				$data[ 'order' ] = ( int )$request->schedule_order[ $i ];
				$data[ 'title_au' ] = $request->schedule_title_au[ $i ];
				$data[ 'title_fa' ] = $request->schedule_title_fa[ $i ];
				$data[ 'schedule_date' ] = $request->schedule_date[ $i ];
				$data[ 'schedule_time' ] = $request->schedule_time[ $i ];

				$schedule->insert( $data );
			}
		}

		return redirect( 'managetv/schedules' );
	}

	public function manage_featured() {
		$data = [];
		$data[ 'featured_data' ] = $this->featured->orderBy( 'order' )->get();
		$data[ 'movies' ] = $this->movie;
		$data[ 'musics' ] = $this->music;
		$data[ 'series_data' ] = $this->series;
		$data[ 'documentaries' ] = $this->documentary;
		$data[ 'tvshows' ] = $this->tvshow;
		$data[ 'sports' ] = $this->sport;
		$data[ 'kids_data' ] = $this->kids;
		return view( 'home/featured', $data );
	}

	public function post_featured( Featured $featured, Request $request ) {
		for ( $i = 0; $i < count( $request->featured_order ); $i++ ) {
			try {
				if ( $request->featured_id[ $i ] != 0 ) {
					$featured_data = [];
					$featured_data = $this->featured->find( $request->featured_id[ $i ] );

					if ( $featured_data != null ) {
						if ( $request->featured_order[ $i ] < 0 ) {
							$featured_data->delete();

						} else {
							$featured_data->order = ( int )$request->featured_order[ $i ];
							$featured_data->content_type = $request->content_type[ $i ];
							$featured_data->reference_id = $request->reference_id[ $i ];

							$featured_data->save();
						}
					}
				} else {
					$data = [];
					$data[ 'order' ] = ( int )$request->featured_order[ $i ];
					$data[ 'content_type' ] = $request->content_type[ $i ];
					$data[ 'reference_id' ] = $request->reference_id[ $i ];

					$featured->insert( $data );
				}

			} catch ( Exception $e ) {;
			}
		}

		return redirect( 'managetv' );
	}

	public function about() {
		return view( 'home/about' );
	}

	public function contact() {
		return view( 'home/contact' );
	}

	public function live() {
		return view( 'live' );
	}

	public function managetv() {
		return view( 'home' );
	}
}
