<?php

namespace App\Http\Controllers;

use App\ Music as Music;
use Illuminate\Http\Request;
use Illuminate\ Support\ Facades\ Input;
use Illuminate\ Support\ Str;

class MusicController extends Controller
{
  public function __construct( Music $music ) {
    $this->music = $music;
  }

  public function index() {
    $data = [];
    $data[ 'musics' ] = $this->music->all()->where( 'is_archived', 0 );
    return view( 'music/index', $data );
  }

  public function show( $music_id ) {
    $content_data = $this->music->find( $music_id );

    if ($content_data !=null) {
      $data = [];
      $data[ 'music_id' ] = $music_id;
      $data[ 'name_au' ] = $content_data->name_au;
      $data[ 'name_fa' ] = $content_data->name_fa;
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
      $data[ 'singer_au' ] = $content_data->singer_au;
      $data[ 'singer_fa' ] = $content_data->singer_fa;
      $data[ 'composer_au' ] = $content_data->composer_au;
      $data[ 'composer_fa' ] = $content_data->composer_fa;
      $data[ 'artist_au' ] = $content_data->artist_au;
      $data[ 'artist_fa' ] = $content_data->artist_fa;
      $data[ 'album_au' ] = $content_data->album_au;
      $data[ 'album_fa' ] = $content_data->album_fa;

      $data[ 'thumbnail_image_route' ] = 'img/tv/musics/' . $content_data->thumbnail_image_route;

      if ($content_data->trailer_route!="" && file_exists( public_path() . '/tv/musics/' . $content_data->trailer_route ) ) {
        $data[ 'cover_route' ] = 'tv/musics/' . $content_data->trailer_route;
        $data[ 'cover_type' ] = 'video';
      } else if($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/musics/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/musics/' . $content_data->cover_image_route;
        $data[ 'cover_type' ] = 'image';
      } else if ($content_data->cover_image_route!="" && file_exists( public_path() . 'img/tv/defaults/tvshow_cover.png')) {
        $data[ 'cover_route' ] = 'img/tv/defaults/tvshow_cover.png';
        $data[ 'cover_type' ] = 'image';
      } else{
        $data[ 'cover_route' ] = 'img/tv/defaults/default_cover.png';
        $data[ 'cover_type' ] = 'image';
      }

      if($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/musics/' . $content_data->background_image_route )) {
        $data[ 'background_image_route' ] = 'img/tv/musics/' . $content_data->background_image_route;
      } else if (file_exists( public_path() . '/img/tv/defaults/music_background.png' )) {
        $data[ 'background_image_route' ] = 'img/tv/defaults/music_background.png';
      } else {
        $data[ 'background_image_route' ] = 'img/tv/defaults/default_background.png';
      }

      $data[ 'mini_story_au' ] = $content_data->mini_story_au;
      $data[ 'description_au' ] = $content_data->description_au;
      $data[ 'mini_story_fa' ] = $content_data->mini_story_fa;
      $data[ 'description_fa' ] = $content_data->description_fa;

      return view( 'music/show', $data );
    }
    return redirect('musics');
  }

  public function manage() {
    $data = [];
    $data[ 'contents' ] = $this->music->all();
    return view( 'music/manage', $data );
  }

  public function create( Request $request, Music $music ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
    $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
    $data[ 'name_au' ] = $request->name_au;
    $data[ 'name_fa' ] = $request->name_fa;
    $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
    $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
    $data[ 'production_year' ] = $request->production_year;
    $data[ 'production_country_au' ] = $request->production_country_au?$request->production_country_au:'';
    $data[ 'production_country_fa' ] = $request->production_country_fa?$request->production_country_fa:'';
    $data[ 'genre_au' ] = $request->genre_au;
    $data[ 'genre_fa' ] = $request->genre_fa;
    $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
    $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
    $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
    $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
    $data[ 'singer_au' ] = $request->singer_au?$request->singer_au:'';
    $data[ 'singer_fa' ] = $request->singer_fa?$request->singer_fa:'';
    $data[ 'composer_au' ] = $request->composer_au?$request->composer_au:'';
    $data[ 'composer_fa' ] = $request->composer_fa?$request->composer_fa:'';
    $data[ 'artist_au' ] = $request->artist_au?$request->artist_au:'';
    $data[ 'artist_fa' ] = $request->artist_fa?$request->artist_fa:'';
    $data[ 'album_au' ] = $request->album_au?$request->album_au:'';
    $data[ 'album_fa' ] = $request->album_fa?$request->album_fa:'';
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
          'thumbnail_image_route' => 'required',
          'cover_image_route' => 'required',
        ]);

        $data[ 'thumbnail_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
        $request->thumbnail_image_route->move( public_path() . '/img/tv/musics/', $data[ 'thumbnail_image_route' ] );

        $data[ 'cover_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
        $request->cover_image_route->move( public_path() . '/img/tv/musics/', $data[ 'cover_image_route' ] );

        if($data[ 'background_image_route' ]!=null){
          $data[ 'background_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/musics/', $data[ 'background_image_route' ] );
        }
        else {
          $data[ 'background_image_route' ]='';
        }

        $data['playback_casts'] = json_encode('[{"order":"1","route":""},{"order":"2","route":""}]');
        $data['external_resources'] = json_encode('[{"imdb":{"rate":"0.0","url":""}}]');

        $music->insert( $data );

        return redirect( '/managetv/musics' );
      }

      $data[ 'modify' ] = 0;

      return view( 'music/CUform', $data );
    }

    public function update( $music_id ) {
      $content_data = $this->music->find( $music_id );

      if ($content_data != null) {
        $data = [];
        $data[ 'modify' ] = 1;
        $data[ 'music_id' ] = $music_id;
        $data[ 'name_exclusive' ] = $content_data->name_exclusive;
        $data[ 'groupname_au' ] = $content_data->groupname_au;
        $data[ 'groupname_fa' ] = $content_data->groupname_fa;
        $data[ 'name_au' ] = $content_data->name_au;
        $data[ 'name_fa' ] = $content_data->name_fa;
        $data[ 'cue_au' ] = $content_data->cue_au;
        $data[ 'cue_fa' ] = $content_data->cue_fa;
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
        $data[ 'singer_au' ] = $content_data->singer_au;
        $data[ 'singer_fa' ] = $content_data->singer_fa;
        $data[ 'composer_au' ] = $content_data->composer_au;
        $data[ 'composer_fa' ] = $content_data->composer_fa;
        $data[ 'artist_au' ] = $content_data->artist_au;
        $data[ 'artist_fa' ] = $content_data->artist_fa;
        $data[ 'album_au' ] = $content_data->album_au;
        $data[ 'album_fa' ] = $content_data->album_fa;
        $data[ 'thumbnail_image_route' ] = $content_data->thumbnail_image_route;
        $data[ 'cover_image_route' ] = $content_data->cover_image_route;
        $data[ 'background_image_route' ] = $content_data->background_image_route;
        $data[ 'trailer_route' ] = $content_data->trailer_route;
        $data[ 'mini_story_au' ] = $content_data->mini_story_au;
        $data[ 'description_au' ] = $content_data->description_au;
        $data[ 'mini_story_fa' ] = $content_data->mini_story_fa;
        $data[ 'description_fa' ] = $content_data->description_fa;

        return view( 'music/CUform', $data );
      }
      return redirect('managetv/musics');
    }

    public function modify( $music_id, Request $request, Music $music ) {
      $data = [];
      $data[ 'name_exclusive' ] = $request->name_exclusive;
      $data[ 'groupname_au' ] = $request->groupname_au?$request->groupname_au:'';
      $data[ 'groupname_fa' ] = $request->groupname_fa?$request->groupname_fa:'';
      $data[ 'name_au' ] = $request->name_au;
      $data[ 'name_fa' ] = $request->name_fa;
      $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
      $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
      $data[ 'production_year' ] = $request->production_year;
      $data[ 'production_country_au' ] = $request->production_country_au?$request->production_country_au:'';
      $data[ 'production_country_fa' ] = $request->production_country_fa?$request->production_country_fa:'';
      $data[ 'genre_au' ] = $request->genre_au;
      $data[ 'genre_fa' ] = $request->genre_fa;
      $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
      $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
      $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
      $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
      $data[ 'singer_au' ] = $request->singer_au?$request->singer_au:'';
      $data[ 'singer_fa' ] = $request->singer_fa?$request->singer_fa:'';
      $data[ 'composer_au' ] = $request->composer_au?$request->composer_au:'';
      $data[ 'composer_fa' ] = $request->composer_fa?$request->composer_fa:'';
      $data[ 'artist_au' ] = $request->artist_au?$request->artist_au:'';
      $data[ 'artist_fa' ] = $request->artist_fa?$request->artist_fa:'';
      $data[ 'album_au' ] = $request->album_au?$request->album_au:'';
      $data[ 'album_fa' ] = $request->album_fa?$request->album_fa:'';
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
          ]
        );

        $content_data = $this->music->find( $music_id );
        $content_data->name_exclusive = $request->name_exclusive;
        $content_data->groupname_au = $request->groupname_au?$request->groupname_au:'';
        $content_data->groupname_fa = $request->groupname_fa?$request->groupname_fa:'';
        $content_data->name_au = $request->name_au;
        $content_data->name_fa = $request->name_fa;
        $content_data->cue_au = $request->cue_au?$request->cue_au:'';
        $content_data->cue_fa = $request->cue_fa?$request->cue_fa:'';
        $content_data->production_year = $request->production_year;
        $content_data->production_country_au = $request->production_country_au?$request->production_country_au:'';
        $content_data->production_country_fa = $request->production_country_fa?$request->production_country_fa:'';
        $content_data->genre_au = $request->genre_au;
        $content_data->genre_fa = $request->genre_fa;
        $content_data->language_au = $request->language_au?$request->language_au:'';
        $content_data->language_fa = $request->language_fa?$request->language_fa:'';
        $content_data->producers_au = $request->producers_au?$request->producers_au:'';
        $content_data->producers_fa = $request->producers_fa?$request->producers_fa:'';
        $content_data->singer_au = $request->singer_au?$request->singer_au:'';
        $content_data->singer_fa = $request->singer_fa?$request->singer_fa:'';
        $content_data->composer_au = $request->composer_au?$request->composer_au:'';
        $content_data->composer_fa = $request->composer_fa?$request->composer_fa:'';
        $content_data->artist_au = $request->artist_au?$request->artist_au:'';
        $content_data->artist_fa = $request->artist_fa?$request->artist_fa:'';
        $content_data->album_au = $request->album_au?$request->album_au:'';
        $content_data->album_fa = $request->album_fa?$request->album_fa:'';
        $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';
        $content_data->mini_story_au = $request->mini_story_au ? $request->mini_story_au : '';
        $content_data->description_au = $request->description_au ? $request->description_au : '';
        $content_data->mini_story_fa = $request->mini_story_fa ? $request->mini_story_fa : '';
        $content_data->description_fa = $request->description_fa ? $request->description_fa : '';

        if ( $request->thumbnail_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/musics/' . $content_data->thumbnail_image_route ) ) {
            unlink( public_path() . '/img/tv/musics/' . $content_data->thumbnail_image_route );
          }
          $content_data->thumbnail_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
          $request->thumbnail_image_route->move( public_path() . '/img/tv/musics/', $content_data->thumbnail_image_route );
        }

        if ( $request->cover_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/musics/' . $content_data->cover_image_route ) ) {
            unlink( public_path() . '/img/tv/musics/' . $content_data->cover_image_route );
          }
          $content_data->cover_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
          $request->cover_image_route->move( public_path() . '/img/tv/musics', $content_data->cover_image_route );
        }

        if ( $request->background_image_route != null ) {
          if ( file_exists( public_path() . '/img/tv/musics/' . $content_data->background_image_route ) ) {
            unlink( public_path() . '/img/tv/musics/' . $content_data->background_image_route );
          }
          $content_data->background_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/musics', $content_data->background_image_route );
        }

        $content_data->save();

        return redirect( '/managetv/musics' );
      }

      $data[ 'modify' ] = 0;
      return view( 'music/CUform', $data );
    }

    public function toggle_archive( $music_id, Music $music ) {
      $content_data = $this->music->find( $music_id );

      if ($content_data != null) {
        if ( $content_data->is_archived == false ) {
          $content_data->is_archived = true;
        } else {
          $content_data->is_archived = false;
        }
        $content_data->save();
      }

      return redirect( '/managetv/musics' );
    }

    public function destroy( $music_id, Music $music ) {
      $content_data = $this->music->find( $music_id );

      if ($content_data != null) {
        if ($content_data->thumbnail_image_route!="" && file_exists( public_path() . '/img/tv/musics/' . $content_data->thumbnail_image_route ) ) {
          unlink( public_path() . '/img/tv/musics/' . $content_data->thumbnail_image_route );
        }
        if ($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/musics/' . $content_data->cover_image_route ) ) {
          unlink( public_path() . '/img/tv/musics/' . $content_data->cover_image_route );
        }
        if ($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/musics/' . $content_data->background_image_route ) ) {
          unlink( public_path() . '/img/tv/musics/' . $content_data->background_image_route );
        }
        if ($content_data->trailer_route!="" && file_exists( public_path() . 'tv/musics/' . $content_data->trailer_route ) ) {
          unlink( public_path() . 'tv/musics/' . $content_data->trailer_route );
        }

        $this->music->destroy( $music_id );
      }

      return redirect( '/managetv/musics' );
    }
  }
