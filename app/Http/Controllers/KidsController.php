<?php

namespace App\Http\Controllers;

use App\ Kids as Kids;
use Illuminate\Http\Request;
use Illuminate\ Support\ Facades\ Input;
use Illuminate\ Support\ Str;

class KidsController extends Controller
{
  public function __construct( Kids $kids ) {
    $this->kids = $kids;
  }

  public function index() {
    $data = [];
    $data[ 'kids_contents' ] = $this->kids->all()->where( 'is_archived', 0 );
    return view( 'kids/index', $data );
  }

  public function show( $kids_id ) {
    $content_data = $this->kids->find( $kids_id );

    if ($content_data !=null) {
      $data = [];
      $data[ 'kids_id' ] = $kids_id;
      $data[ 'name_au' ] = $content_data->name_au;
      $data[ 'name_fa' ] = $content_data->name_fa;
      $data[ 'age_limit' ] = $content_data->age_limit;
      $data[ 'production_year' ] = $content_data->production_year;
      $data[ 'production_country_au' ] = $content_data->production_country_au;
      $data[ 'production_country_fa' ] = $content_data->production_country_fa;
      $data[ 'genre_au' ] = $content_data->genre_au;
      $data[ 'genre_fa' ] = $content_data->genre_fa;
      $data[ 'language_au' ] = $content_data->language_au;
      $data[ 'language_fa' ] = $content_data->language_fa;
      $data[ 'producers_au' ] = $content_data->producers_au;
      $data[ 'producers_fa' ] = $content_data->producers_fa;
      $data[ 'directors_au' ] = $content_data->directors_au;
      $data[ 'directors_fa' ] = $content_data->directors_fa;
      $data[ 'actors_au' ] = $content_data->actors_au;
      $data[ 'actors_fa' ] = $content_data->actors_fa;

      $data[ 'thumbnail_image_route' ] = 'img/tv/kids/' . $content_data->thumbnail_image_route;

      if ($content_data->trailer_route!="" && file_exists( public_path() . '/tv/kids/' . $content_data->trailer_route ) ) {
        $data[ 'cover_route' ] = 'tv/kids/' . $content_data->trailer_route;
        $data[ 'cover_type' ] = 'video';
      } else if($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/kids/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/kids/' . $content_data->cover_image_route;
        $data[ 'cover_type' ] = 'image';
      } else if ($content_data->cover_image_route!="" && file_exists( public_path() . 'img/tv/defaults/tvshow_cover.png')) {
        $data[ 'cover_route' ] = 'img/tv/defaults/tvshow_cover.png';
        $data[ 'cover_type' ] = 'image';
      } else{
        $data[ 'cover_route' ] = 'img/tv/defaults/default_cover.png';
        $data[ 'cover_type' ] = 'image';
      }

      if($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/kids/' . $content_data->background_image_route )) {
        $data[ 'background_image_route' ] = 'img/tv/kids/' . $content_data->background_image_route;
      } else if (file_exists( public_path() . '/img/tv/defaults/kids_background.png' )) {
        $data[ 'background_image_route' ] = 'img/tv/defaults/kids_background.png';
      } else {
        $data[ 'background_image_route' ] = 'img/tv/defaults/default_background.png';
      }

      $data[ 'mini_story_au' ] = $content_data->mini_story_au;
      $data[ 'description_au' ] = $content_data->description_au;
      $data[ 'mini_story_fa' ] = $content_data->mini_story_fa;
      $data[ 'description_fa' ] = $content_data->description_fa;

      return view( 'kids/show', $data );
    }
    return redirect('kids');
  }

  public function manage() {
    $data = [];
    $data[ 'contents' ] = $this->kids->all();
    return view( 'kids/manage', $data );
  }

  public function create( Request $request, Kids $kids ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
    $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
    $data[ 'name_au' ] = $request->name_au;
    $data[ 'name_fa' ] = $request->name_fa;
    $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
    $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
    $data[ 'age_limit' ] = $request->age_limit;
    $data[ 'production_year' ] = $request->production_year;
    $data[ 'production_country_au' ] = $request->production_country_au?$request->production_country_au:'';
    $data[ 'production_country_fa' ] = $request->production_country_fa?$request->production_country_fa:'';
    $data[ 'genre_au' ] = $request->genre_au;
    $data[ 'genre_fa' ] = $request->genre_fa;
    $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
    $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
    $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
    $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
    $data[ 'directors_au' ] = $request->directors_au?$request->directors_au:'';
    $data[ 'directors_fa' ] = $request->directors_fa?$request->directors_fa:'';
    $data[ 'actors_au' ] = $request->actors_au?$request->actors_au:'';
    $data[ 'actors_fa' ] = $request->actors_fa?$request->actors_fa:'';
    $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $request->cover_image_route;
    $data[ 'background_image_route' ] = $request->background_image_route;
    $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';
    $data[ 'mini_story_au' ] = $request->mini_story_au ? $request->mini_story_au : '';
    $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
    $data[ 'mini_story_fa' ] = $request->mini_story_fa ? $request->mini_story_fa : '';
    $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

    if ( $request->isMethod( 'post' ) ) {
      $this->validate(
        $request, [
          'name_exclusive' => 'required|min:2',
          'name_au' => 'required|min:2',
          'name_fa' => 'required|min:2',
          'genre_au' => 'required|min:2',
          'genre_fa' => 'required|min:2',
          'production_year' => 'required|min:4|max:4',
          'age_limit' => 'required',
          'thumbnail_image_route' => 'required',
          'cover_image_route' => 'required',
        ]);

        $data[ 'thumbnail_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
        $request->thumbnail_image_route->move( public_path() . '/img/tv/kids/', $data[ 'thumbnail_image_route' ] );

        $data[ 'cover_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
        $request->cover_image_route->move( public_path() . '/img/tv/kids/', $data[ 'cover_image_route' ] );

        if($data[ 'background_image_route' ]!=null){
          $data[ 'background_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/kids/', $data[ 'background_image_route' ] );
        }
        else {
          $data[ 'background_image_route' ]='';
        }

        $data['playback_casts'] = json_encode('[{"order":"1","route":""},{"order":"2","route":""}]');
        $data['external_resources'] = json_encode('[{"imdb":{"rate":"0.0","url":""}}]');

        $kids->insert( $data );

        return redirect( '/managetv/kids' );
      }

      $data[ 'modify' ] = 0;

      return view( 'kids/CUform', $data );
    }

    public function update( $kids_id ) {
      $content_data = $this->kids->find( $kids_id );

      if ($content_data != null) {
        $data = [];
        $data[ 'modify' ] = 1;
        $data[ 'kids_id' ] = $kids_id;
        $data[ 'name_exclusive' ] = $content_data->name_exclusive;
        $data[ 'groupname_au' ] = $content_data->groupname_au;
        $data[ 'groupname_fa' ] = $content_data->groupname_fa;
        $data[ 'name_au' ] = $content_data->name_au;
        $data[ 'name_fa' ] = $content_data->name_fa;
        $data[ 'cue_au' ] = $content_data->cue_au;
        $data[ 'cue_fa' ] = $content_data->cue_fa;
        $data[ 'age_limit' ] = $content_data->age_limit;
        $data[ 'production_year' ] = $content_data->production_year;
        $data[ 'production_country_au' ] = $content_data->production_country_au;
        $data[ 'production_country_fa' ] = $content_data->production_country_fa;
        $data[ 'genre_au' ] = $content_data->genre_au;
        $data[ 'genre_fa' ] = $content_data->genre_fa;
        $data[ 'language_au' ] = $content_data->language_au;
        $data[ 'language_fa' ] = $content_data->language_fa;
        $data[ 'producers_au' ] = $content_data->producers_au;
        $data[ 'producers_fa' ] = $content_data->producers_fa;
        $data[ 'directors_au' ] = $content_data->directors_au;
        $data[ 'directors_fa' ] = $content_data->directors_fa;
        $data[ 'actors_au' ] = $content_data->actors_au;
        $data[ 'actors_fa' ] = $content_data->actors_fa;
        $data[ 'thumbnail_image_route' ] = $content_data->thumbnail_image_route;
        $data[ 'cover_image_route' ] = $content_data->cover_image_route;
        $data[ 'background_image_route' ] = $content_data->background_image_route;
        $data[ 'trailer_route' ] = $content_data->trailer_route;
        $data[ 'mini_story_au' ] = $content_data->mini_story_au;
        $data[ 'description_au' ] = $content_data->description_au;
        $data[ 'mini_story_fa' ] = $content_data->mini_story_fa;
        $data[ 'description_fa' ] = $content_data->description_fa;

        return view( 'kids/CUform', $data );
      }
      return redirect('managetv/kids');
    }

    public function modify( $kids_id, Request $request, Kids $kids ) {
      $data = [];
      $data[ 'name_exclusive' ] = $request->name_exclusive;
      $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
      $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
      $data[ 'name_au' ] = $request->name_au;
      $data[ 'name_fa' ] = $request->name_fa;
      $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
      $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
      $data[ 'age_limit' ] = $request->age_limit;
      $data[ 'production_year' ] = $request->production_year;
      $data[ 'production_country_au' ] = $request->production_country_au?$request->production_country_au:'';
      $data[ 'production_country_fa' ] = $request->production_country_fa?$request->production_country_fa:'';
      $data[ 'genre_au' ] = $request->genre_au;
      $data[ 'genre_fa' ] = $request->genre_fa;
      $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
      $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
      $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
      $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
      $data[ 'directors_au' ] = $request->directors_au?$request->directors_au:'';
      $data[ 'directors_fa' ] = $request->directors_fa?$request->directors_fa:'';
      $data[ 'actors_au' ] = $request->actors_au?$request->actors_au:'';
      $data[ 'actors_fa' ] = $request->actors_fa?$request->actors_fa:'';
      $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
      $data[ 'cover_image_route' ] = $request->cover_image_route;
      $data[ 'background_image_route' ] = $request->background_image_route;
      $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';
      $data[ 'mini_story_au' ] = $request->mini_story_au ? $request->mini_story_au : '';
      $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
      $data[ 'mini_story_fa' ] = $request->mini_story_fa ? $request->mini_story_fa : '';
      $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

      if ( $request->isMethod( 'post' ) ) {
        $this->validate(
          $request, [
            'name_exclusive' => 'required|min:2',
            'name_au' => 'required|min:2',
            'name_fa' => 'required|min:2',
            'genre_au' => 'required|min:2',
            'genre_fa' => 'required|min:2',
            'production_year' => 'required|min:4|max:4',
            'age_limit' => 'required',
          ]
        );

        $content_data = $this->kids->find( $kids_id );
        $content_data->name_exclusive = $request->name_exclusive;
        $content_data->groupname_au = $request->groupname_au?$request->groupname_au:'';
        $content_data->groupname_fa = $request->groupname_fa?$request->groupname_fa:'';
        $content_data->name_au = $request->name_au;
        $content_data->name_fa = $request->name_fa;
        $content_data->cue_au = $request->cue_au?$request->cue_au:'';
        $content_data->cue_fa = $request->cue_fa?$request->cue_fa:'';
        $content_data->age_limit = $request->age_limit;
        $content_data->production_year = $request->production_year;
        $content_data->production_country_au = $request->production_country_au?$request->production_country_au:'';
        $content_data->production_country_fa = $request->production_country_fa?$request->production_country_fa:'';
        $content_data->genre_au = $request->genre_au;
        $content_data->genre_fa = $request->genre_fa;
        $content_data->language_au = $request->language_au?$request->language_au:'';
        $content_data->language_fa = $request->language_fa?$request->language_fa:'';
        $content_data->producers_au = $request->producers_au?$request->producers_au:'';
        $content_data->producers_fa = $request->producers_fa?$request->producers_fa:'';
        $content_data->directors_au = $request->directors_au?$request->directors_au:'';
        $content_data->directors_fa = $request->directors_fa?$request->directors_fa:'';
        $content_data->actors_au = $request->actors_au?$request->actors_au:'';
        $content_data->actors_fa = $request->actors_fa?$request->actors_fa:'';
        $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';
        $content_data->mini_story_au = $request->mini_story_au ? $request->mini_story_au : '';
        $content_data->description_au = $request->description_au ? $request->description_au : '';
        $content_data->mini_story_fa = $request->mini_story_fa ? $request->mini_story_fa : '';
        $content_data->description_fa = $request->description_fa ? $request->description_fa : '';

        if ( $request->thumbnail_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/kids/' . $content_data->thumbnail_image_route ) ) {
            unlink( public_path() . '/img/tv/kids/' . $content_data->thumbnail_image_route );
          }
          $content_data->thumbnail_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
          $request->thumbnail_image_route->move( public_path() . '/img/tv/kids/', $content_data->thumbnail_image_route );
        }

        if ( $request->cover_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/kids/' . $content_data->cover_image_route ) ) {
            unlink( public_path() . '/img/tv/kids/' . $content_data->cover_image_route );
          }
          $content_data->cover_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
          $request->cover_image_route->move( public_path() . '/img/tv/kids', $content_data->cover_image_route );
        }

        if ( $request->background_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/kids/' . $content_data->background_image_route ) ) {
            unlink( public_path() . '/img/tv/kids/' . $content_data->background_image_route );
          }
          $content_data->background_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/kids', $content_data->background_image_route );
        }

        $content_data->save();

        return redirect( '/managetv/kids' );
      }

      $data[ 'modify' ] = 0;
      return view( 'kids/CUform', $data );
    }

    public function toggle_archive( $kids_id, Kids $kids ) {
      $content_data = $this->kids->find( $kids_id );

      if ($content_data != null) {
        if ( $content_data->is_archived == false ) {
          $content_data->is_archived = true;
        } else {
          $content_data->is_archived = false;
        }
        $content_data->save();
      }

      return redirect( '/managetv/kids' );
    }

    public function destroy( $kids_id, Kids $kids ) {
      $content_data = $this->kids->find( $kids_id );

      if ($content_data != null) {
        if ($content_data->thumbnail_image_route!="" && file_exists( public_path() . '/img/tv/kids/' . $content_data->thumbnail_image_route ) ) {
          unlink( public_path() . '/img/tv/kids/' . $content_data->thumbnail_image_route );
        }
        if ($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/kids/' . $content_data->cover_image_route ) ) {
          unlink( public_path() . '/img/tv/kids/' . $content_data->cover_image_route );
        }
        if ($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/kids/' . $content_data->background_image_route ) ) {
          unlink( public_path() . '/img/tv/kids/' . $content_data->background_image_route );
        }
        if ($content_data->trailer_route!="" && file_exists( public_path() . 'tv/kids/' . $content_data->trailer_route ) ) {
          unlink( public_path() . 'tv/kids/' . $content_data->trailer_route );
        }

        $this->kids->destroy( $kids_id );
      }

      return redirect( '/managetv/kids' );
    }
  }
