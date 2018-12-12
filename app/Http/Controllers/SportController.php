<?php

namespace App\Http\Controllers;

use App\ Sport as Sport;
use Illuminate\Http\Request;
use Illuminate\ Support\ Facades\ Input;
use Illuminate\ Support\ Str;

class SportController extends Controller
{
  public function __construct( Sport $sport ) {
    $this->sport = $sport;
  }

  public function index() {
    $data = [];
    $data[ 'sports' ] = $this->sport->all()->where( 'is_archived', 0 );
    return view( 'sport/index', $data );
  }

  public function show( $sport_id ) {
    $content_data = $this->sport->find( $sport_id );

    if ($content_data !=null) {
      $data = [];
      $data[ 'sport_id' ] = $sport_id;
      $data[ 'name_au' ] = $content_data->name_au;
      $data[ 'name_fa' ] = $content_data->name_fa;
      $data[ 'match_date' ] = $content_data->match_date;
      $data[ 'match_place_au' ] = $content_data->match_place_au;
      $data[ 'match_place_fa' ] = $content_data->match_place_fa;
      $data[ 'field_au' ] = $content_data->field_au;
      $data[ 'field_fa' ] = $content_data->field_fa;
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

      $data[ 'thumbnail_image_route' ] = 'img/tv/sports/' . $content_data->thumbnail_image_route;

      if ($content_data->trailer_route!="" && file_exists( public_path() . '/tv/sports/' . $content_data->trailer_route ) ) {
        $data[ 'cover_route' ] = 'tv/sports/' . $content_data->trailer_route;
        $data[ 'cover_type' ] = 'video';
      } else if($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/sports/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/sports/' . $content_data->cover_image_route;
        $data[ 'cover_type' ] = 'image';
      } else if ($content_data->cover_image_route!="" && file_exists( public_path() . 'img/tv/defaults/tvshow_cover.png')) {
        $data[ 'cover_route' ] = 'img/tv/defaults/tvshow_cover.png';
        $data[ 'cover_type' ] = 'image';
      } else{
        $data[ 'cover_route' ] = 'img/tv/defaults/default_cover.png';
        $data[ 'cover_type' ] = 'image';
      }

      if($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/sports/' . $content_data->background_image_route )) {
        $data[ 'background_image_route' ] = 'img/tv/sports/' . $content_data->background_image_route;
      } else if (file_exists( public_path() . '/img/tv/defaults/sport_background.png' )) {
        $data[ 'background_image_route' ] = 'img/tv/defaults/sport_background.png';
      } else {
        $data[ 'background_image_route' ] = 'img/tv/defaults/default_background.png';
      }

      $data[ 'description_au' ] = $content_data->description_au;
      $data[ 'description_fa' ] = $content_data->description_fa;

      return view( 'sport/show', $data );
    }
    return redirect('sports');
  }

  public function manage() {
    $data = [];
    $data[ 'contents' ] = $this->sport->all();
    return view( 'sport/manage', $data );
  }

  public function create( Request $request, Sport $sport ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
    $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
    $data[ 'name_au' ] = $request->name_au;
    $data[ 'name_fa' ] = $request->name_fa;
    $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
    $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
    $data[ 'match_date' ] = $request->match_date;
    $data[ 'match_place_au' ] = $request->match_place_au?$request->match_place_au:'';
    $data[ 'match_place_fa' ] = $request->match_place_fa?$request->match_place_fa:'';
    $data[ 'field_au' ] = $request->field_au;
    $data[ 'field_fa' ] = $request->field_fa;
    $data[ 'genre_au' ] = $request->genre_au?$request->genre_au:'';
    $data[ 'genre_fa' ] = $request->genre_fa?$request->genre_fa:'';
    $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
    $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
    $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $request->cover_image_route;
    $data[ 'background_image_route' ] = $request->background_image_route;
    $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';
    $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
    $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

    if ( $request->isMethod( 'post' ) ) {
      $this->validate(
        $request, [
          'name_exclusive' => 'required|min:2',
          'name_au' => 'required|min:2',
          'name_fa' => 'required|min:2',
          'field_au' => 'required|min:2',
          'field_fa' => 'required|min:2',
          'match_date' => 'required',
          'thumbnail_image_route' => 'required',
          'cover_image_route' => 'required',
        ]);

        $data[ 'thumbnail_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
        $request->thumbnail_image_route->move( public_path() . '/img/tv/sports/', $data[ 'thumbnail_image_route' ] );

        $data[ 'cover_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
        $request->cover_image_route->move( public_path() . '/img/tv/sports/', $data[ 'cover_image_route' ] );

        if($data[ 'background_image_route' ]!=null){
          $data[ 'background_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/sports/', $data[ 'background_image_route' ] );
        }
        else {
          $data[ 'background_image_route' ]='';
        }

        $data['playback_casts'] = json_encode('[{"order":"1","route":""},{"order":"2","route":""}]');
        $data['external_resources'] = json_encode('[{"imdb":{"rate":"0.0","url":""}}]');

        $sport->insert( $data );

        return redirect( '/managetv/sports' );
      }

      $data[ 'modify' ] = 0;

      return view( 'sport/CUform', $data );
    }

    public function update( $sport_id ) {
      $content_data = $this->sport->find( $sport_id );

      if ($content_data != null) {
        $data = [];
        $data[ 'modify' ] = 1;
        $data[ 'sport_id' ] = $sport_id;
        $data[ 'name_exclusive' ] = $content_data->name_exclusive;
        $data[ 'groupname_au' ] = $content_data->groupname_au;
        $data[ 'groupname_fa' ] = $content_data->groupname_fa;
        $data[ 'name_au' ] = $content_data->name_au;
        $data[ 'name_fa' ] = $content_data->name_fa;
        $data[ 'cue_au' ] = $content_data->cue_au;
        $data[ 'cue_fa' ] = $content_data->cue_fa;
        $data[ 'match_date' ] = $content_data->match_date;
        $data[ 'match_place_au' ] = $content_data->match_place_au;
        $data[ 'match_place_fa' ] = $content_data->match_place_fa;
        $data[ 'field_au' ] = $content_data->field_au;
        $data[ 'field_fa' ] = $content_data->field_fa;
        $data[ 'genre_au' ] = $content_data->genre_au;
        $data[ 'genre_fa' ] = $content_data->genre_fa;
        $data[ 'language_au' ] = $content_data->language_au;
        $data[ 'language_fa' ] = $content_data->language_fa;
        $data[ 'thumbnail_image_route' ] = $content_data->thumbnail_image_route;
        $data[ 'cover_image_route' ] = $content_data->cover_image_route;
        $data[ 'background_image_route' ] = $content_data->background_image_route;
        $data[ 'trailer_route' ] = $content_data->trailer_route;
        $data[ 'description_au' ] = $content_data->description_au;
        $data[ 'description_fa' ] = $content_data->description_fa;

        return view( 'sport/CUform', $data );
      }
      return redirect('managetv/sports');
    }

    public function modify( $sport_id, Request $request, Sport $sport ) {
      $data = [];
      $data[ 'name_exclusive' ] = $request->name_exclusive;
      $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
      $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
      $data[ 'name_au' ] = $request->name_au;
      $data[ 'name_fa' ] = $request->name_fa;
      $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
      $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
      $data[ 'match_date' ] = $request->match_date;
      $data[ 'match_place_au' ] = $request->match_place_au?$request->match_place_au:'';
      $data[ 'match_place_fa' ] = $request->match_place_fa?$request->match_place_fa:'';
      $data[ 'field_au' ] = $request->field_au;
      $data[ 'field_fa' ] = $request->field_fa;
      $data[ 'genre_au' ] = $request->genre_au?$request->genre_au:'';
      $data[ 'genre_fa' ] = $request->genre_fa?$request->genre_fa:'';
      $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
      $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
      $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
      $data[ 'cover_image_route' ] = $request->cover_image_route;
      $data[ 'background_image_route' ] = $request->background_image_route;
      $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';
      $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
      $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

      if ( $request->isMethod( 'post' ) ) {
        $this->validate(
          $request, [
            'name_exclusive' => 'required|min:2',
            'name_au' => 'required|min:2',
            'name_fa' => 'required|min:2',
            'field_au' => 'required|min:2',
            'field_fa' => 'required|min:2',
            'match_date' => 'required',
          ]
        );

        $content_data = $this->sport->find( $sport_id );
        $content_data->name_exclusive = $request->name_exclusive;
        $content_data->groupname_au = $request->groupname_au?$request->groupname_au:'';
        $content_data->groupname_fa = $request->groupname_fa?$request->groupname_fa:'';
        $content_data->name_au = $request->name_au;
        $content_data->name_fa = $request->name_fa;
        $content_data->cue_au = $request->cue_au?$request->cue_au:'';
        $content_data->cue_fa = $request->cue_fa?$request->cue_fa:'';
        $content_data->match_date = $request->match_date;
        $content_data->match_place_au = $request->match_place_au?$request->match_place_au:'';
        $content_data->match_place_fa = $request->match_place_fa?$request->match_place_fa:'';
        $content_data->field_au = $request->field_au;
        $content_data->field_fa = $request->field_fa;
        $content_data->genre_au = $request->genre_au?$request->genre_au:'';
        $content_data->genre_fa = $request->genre_fa?$request->genre_fa:'';
        $content_data->language_au = $request->language_au?$request->language_au:'';
        $content_data->language_fa = $request->language_fa?$request->language_fa:'';
        $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';
        $content_data->description_au = $request->description_au ? $request->description_au : '';
        $content_data->description_fa = $request->description_fa ? $request->description_fa : '';

        if ( $request->thumbnail_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/sports/' . $content_data->thumbnail_image_route ) ) {
            unlink( public_path() . '/img/tv/sports/' . $content_data->thumbnail_image_route );
          }
          $content_data->thumbnail_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
          $request->thumbnail_image_route->move( public_path() . '/img/tv/sports/', $content_data->thumbnail_image_route );
        }

        if ( $request->cover_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/sports/' . $content_data->cover_image_route ) ) {
            unlink( public_path() . '/img/tv/sports/' . $content_data->cover_image_route );
          }
          $content_data->cover_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
          $request->cover_image_route->move( public_path() . '/img/tv/sports', $content_data->cover_image_route );
        }

        if ( $request->background_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/sports/' . $content_data->background_image_route ) ) {
            unlink( public_path() . '/img/tv/sports/' . $content_data->background_image_route );
          }
          $content_data->background_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/sports', $content_data->background_image_route );
        }

        $content_data->save();

        return redirect( '/managetv/sports' );
      }

      $data[ 'modify' ] = 0;
      return view( 'sport/CUform', $data );
    }

    public function toggle_archive( $sport_id, Sport $sport ) {
      $content_data = $this->sport->find( $sport_id );

      if ($content_data != null) {
        if ( $content_data->is_archived == false ) {
          $content_data->is_archived = true;
        } else {
          $content_data->is_archived = false;
        }
        $content_data->save();
      }

      return redirect( '/managetv/sports' );
    }

    public function destroy( $sport_id, Sport $sport ) {
      $content_data = $this->sport->find( $sport_id );

      if ($content_data != null) {
        if ($content_data->thumbnail_image_route!="" && file_exists( public_path() . '/img/tv/sports/' . $content_data->thumbnail_image_route ) ) {
          unlink( public_path() . '/img/tv/sports/' . $content_data->thumbnail_image_route );
        }
        if ($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/sports/' . $content_data->cover_image_route ) ) {
          unlink( public_path() . '/img/tv/sports/' . $content_data->cover_image_route );
        }
        if ($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/sports/' . $content_data->background_image_route ) ) {
          unlink( public_path() . '/img/tv/sports/' . $content_data->background_image_route );
        }
        if ($content_data->trailer_route!="" && file_exists( public_path() . 'tv/sports/' . $content_data->trailer_route ) ) {
          unlink( public_path() . 'tv/sports/' . $content_data->trailer_route );
        }

        $this->sport->destroy( $sport_id );
      }

      return redirect( '/managetv/sports' );
    }
  }
