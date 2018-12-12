<?php

namespace App\Http\Controllers;

use App\ Chan3es as Chan3es;
use Illuminate\Http\Request;
use Illuminate\ Support\ Facades\ Input;
use Illuminate\ Support\ Str;

class Chan3esController extends Controller
{
  public function __construct( Chan3es $chan3es ) {
    $this->chan3es = $chan3es;
  }

  public function show( $chan3es_id ) {
    $content_data = $this->chan3es->find( $chan3es_id );

    if ($content_data != null) {
      $data = [];
      $data[ 'chan3es_id' ] = $chan3es_id;
      $data[ 'publish_date' ] = $content_data->publish_date;
      $data[ 'title_au' ] = $content_data->title_au;
      $data[ 'subtitle_au' ] = $content_data->subtitle_au;
      $data[ 'content_au' ] = $content_data->content_au;
      $data[ 'title_fa' ] = $content_data->title_fa;
      $data[ 'subtitle_fa' ] = $content_data->subtitle_fa;
      $data[ 'content_fa' ] = $content_data->content_fa;
      $data[ 'href' ] = $content_data->href;

      $data[ 'thumbnail_image_route' ] = 'img/tv/chan3es/' . $content_data->thumbnail_image_route;

      if ($content_data->trailer_route!="" && file_exists( public_path() . '/tv/chan3es/' . $content_data->trailer_route ) ) {
        $data[ 'cover_route' ] = 'tv/chan3es/' . $content_data->trailer_route;
        $data[ 'cover_type' ] = 'video';
      } else if($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/chan3es/' . $content_data->cover_image_route;
        $data[ 'cover_type' ] = 'image';
      } else {
        $data[ 'cover_route' ] = 'img/tv/defaults/chan3es_cover.png';
        $data[ 'cover_type' ] = 'image';
      }

      if($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->background_image_route )) {
        $data[ 'background_image_route' ] = 'img/tv/chan3es/' . $content_data->background_image_route;
      } else {
        $data[ 'background_image_route' ] = 'img/tv/defaults/chan3es_background.png';
      }

      return view( 'chan3es/show', $data );
    }

    return redirect('home');
  }

  public function manage() {
    $data = [];
    $data[ 'contents' ] = $this->chan3es->all();
    return view( 'chan3es/manage', $data );
  }

  public function create( Request $request, Chan3es $chan3es ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'publish_date' ] = $request->publish_date;
    $data[ 'title_au' ] = $request->title_au;
    $data[ 'subtitle_au' ] = $request->subtitle_au ? $request->subtitle_au : '';
    $data[ 'content_au' ] = $request->content_au ? $request->content_au : '';
    $data[ 'title_fa' ] = $request->title_fa;
    $data[ 'subtitle_fa' ] = $request->subtitle_fa? $request->subtitle_fa : '';
    $data[ 'content_fa' ] = $request->content_fa ? $request->content_fa : '';
    $data[ 'href' ] = $request->href ? $request->href : '';
    $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $request->cover_image_route;
    $data[ 'background_image_route' ] = $request->background_image_route ? $request->background_image_route : '';
    $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';

dd($data);
    if ( $request->isMethod( 'post' ) ) {
      $this->validate(
        $request, [
          'name_exclusive' => 'required|min:3',
          'publish_date' => 'required',
          'title_au' => 'required|min:2',
          'title_fa' => 'required|min:2',
          'thumbnail_image_route' => 'required',
          'cover_image_route' => 'required',
        ]);

        $data[ 'thumbnail_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
        $request->thumbnail_image_route->move( public_path() . '/img/tv/chan3es/', $data[ 'thumbnail_image_route' ] );

        $data[ 'cover_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
        $request->cover_image_route->move( public_path() . '/img/tv/chan3es/', $data[ 'cover_image_route' ] );

        if($data[ 'background_image_route' ]!=null){
          $data[ 'background_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/chan3es/', $data[ 'background_image_route' ] );
        }
        else {
          $data[ 'background_image_route' ]='';
        }

        $chan3es->insert( $data );

        return redirect( '/managetv/chan3es' );
      }

      $data[ 'modify' ] = 0;

      return view( 'chan3es/CUform', $data );
    }

    public function update( $chan3es_id ) {

      $content_data = $this->chan3es->find( $chan3es_id );
      if ($content_data != null) {
        $data = [];
        $data[ 'chan3es_id' ] = $chan3es_id;
        $data[ 'modify' ] = 1;
        $data[ 'name_exclusive' ] = $content_data->name_exclusive;
        $data[ 'publish_date' ] = $content_data->publish_date;
        $data[ 'title_au' ] = $content_data->title_au;
        $data[ 'subtitle_au' ] = $content_data->subtitle_au;
        $data[ 'content_au' ] = $content_data->content_au;
        $data[ 'title_fa' ] = $content_data->title_fa;
        $data[ 'subtitle_fa' ] = $content_data->subtitle_fa;
        $data[ 'content_fa' ] = $content_data->content_fa;
        $data[ 'href' ] = $content_data->href;
        $data[ 'thumbnail_image_route' ] = $content_data->thumbnail_image_route;
        $data[ 'cover_image_route' ] = $content_data->cover_image_route;
        $data[ 'background_image_route' ] = $content_data->cover_image_route;
        $data[ 'trailer_route' ] = $content_data->trailer_route;

        return view( 'chan3es/CUform', $data );
      }
      return redirect( '/managetv/chan3es' );
    }

    public function modify( $chan3es_id, Request $request, Chan3es $chan3es ) {
      $data = [];

      $data[ 'name_exclusive' ] = $request->name_exclusive;
      $data[ 'publish_date' ] = $request->publish_date;
      $data[ 'title_au' ] = $request->title_au;
      $data[ 'subtitle_au' ] = $request->subtitle_au ? $request->subtitle_au : '';
      $data[ 'content_au' ] = $request->content_au ? $request->content_au : '';
      $data[ 'title_fa' ] = $request->title_fa;
      $data[ 'subtitle_fa' ] = $request->subtitle_fa? $request->subtitle_fa : '';
      $data[ 'content_fa' ] = $request->content_fa ? $request->content_fa : '';
      $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
      $data[ 'cover_image_route' ] = $request->cover_image_route;
      $data[ 'background_image_route' ] = $request->background_image_route ? $request->background_image_route : '';
      $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';

      if ( $request->isMethod( 'post' ) ) {
        $this->validate(
          $request, [
            'name_exclusive' => 'required|min:3',
            'publish_date' => 'required',
            'title_au' => 'required|min:2',
            'title_fa' => 'required|min:2',
          ]
        );

        $content_data = $this->chan3es->find( $chan3es_id );

        $content_data->name_exclusive = $request->name_exclusive;
        $content_data->publish_date = $request->publish_date;
        $content_data->title_au = $request->title_au;
        $content_data->subtitle_au = $request->subtitle_au ? $request->subtitle_au : '';
        $content_data->content_au = $request->content_au ? $request->content_au : '';
        $content_data->title_fa = $request->title_fa;
        $content_data->subtitle_fa = $request->subtitle_fa? $request->subtitle_fa : '';
        $content_data->content_fa = $request->content_fa ? $request->content_fa : '';
        $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';


        if ( $request->thumbnail_image_route != null ) {
          if ( $content_data->thumbnail_image_route !='' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->thumbnail_image_route ) ) {
            unlink( public_path() . '/img/tv/chan3es/' . $content_data->thumbnail_image_route );
          }
          $content_data->thumbnail_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
          $request->thumbnail_image_route->move( public_path() . '/img/tv/chan3es/', $content_data->thumbnail_image_route );
        }

        if ( $request->cover_image_route != null ) {
          if ( $content_data->cover_image_route !='' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->cover_image_route ) ) {
            unlink( public_path() . '/img/tv/chan3es/' . $content_data->cover_image_route );
          }
          $content_data->cover_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
          $request->cover_image_route->move( public_path() . '/img/tv/chan3es', $content_data->cover_image_route );
        }

        if ( $request->background_image_route != null ) {
          if ( $content_data->background_image_route !='' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->background_image_route ) ) {
            unlink( public_path() . '/img/tv/chan3es/' . $content_data->background_image_route );
          }
          $content_data->background_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
          $request->background_image_route->move( public_path() . '/img/tv/chan3es', $content_data->background_image_route );
        }

        $content_data->save();

        return redirect( '/managetv/chan3es' );
      }

      $data[ 'modify' ] = 0;

      return view( 'chan3es/CUform', $data );
    }

    public function toggle_archive( $chan3es_id, Chan3es $chan3es ) {
      $content_data = $this->chan3es->find( $chan3es_id );

      if ($content_data != null) {
        if ( $content_data->is_archived == false ) {
          $content_data->is_archived = true;
        } else {
          $content_data->is_archived = false;
        }

        $content_data->save();
      }

      return redirect( '/managetv/chan3es' );
    }

    public function destroy( $chan3es_id, Chan3es $chan3es ) {
      $content_data = $this->chan3es->find( $chan3es_id );

      if ($content_data != null) {
        if ( $content_data->thumbnail_image_route !='' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->thumbnail_image_route ) ) {
          unlink( public_path() . '/img/tv/chan3es/' . $content_data->thumbnail_image_route );
        }
        if ( $content_data->cover_image_route != '' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->cover_image_route ) ) {
          unlink( public_path() . '/img/tv/chan3es/' . $content_data->cover_image_route );
        }
        if ( $content_data->background_image_route != '' && file_exists( public_path() . '/img/tv/chan3es/' . $content_data->background_image_route ) ) {
          unlink( public_path() . '/img/tv/chan3es/' . $content_data->background_image_route );
        }
        if ( $content_data->trailer_route != '' && file_exists( public_path() . 'tv/chan3es/' . $content_data->trailer_route ) ) {
          unlink( public_path() . 'tv/chan3es/' . $content_data->trailer_route );
        }

        $this->chan3es->destroy( $chan3es_id );
      }
      return redirect( '/managetv/chan3es' );
    }
  }
