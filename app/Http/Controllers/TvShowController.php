<?php

namespace App\Http\Controllers;

use App\ TvShow as TvShow;
use App\ Comment as Comment;
use Illuminate\Http\Request;
use Illuminate\ Support\ Facades\ Input;
use Illuminate\ Support\ Str;

class TvShowController extends Controller
{
  public function __construct( TvShow $tvshow, Comment $comment) {
    $this->tvshow = $tvshow;
    $this->comment = $comment->where('content_type','tvshow')->orderBy('created_at','desc')->get();
  }

  public function index() {
    $data = [];
    $data[ 'tvshows' ] = $this->tvshow->all()->where( 'is_archived', 0 );
    return view( 'tvshow/index', $data );
  }

  public function index_kooch() {
    $data = [];
    $data[ 'tvshows' ] = $this->tvshow->all()->where( 'is_archived', 0 )->where('groupname_au','Kooch');
    return view( 'tvshow/index_kooch', $data );
  }

  public function show( $tvshow_id ) {
    $data = [];
    $data[ 'tvshow_id' ] = $tvshow_id;

    $content_data = $this->tvshow->find( $tvshow_id );

    if($content_data!=null){
      $data[ 'groupname_au' ] = $content_data->groupname_au;
      $data[ 'groupname_fa' ] = $content_data->groupname_fa;
      $data[ 'name_au' ] = $content_data->name_au;
      $data[ 'name_fa' ] = $content_data->name_fa;
      $data[ 'subject_au' ] = $content_data->subject_au;
      $data[ 'subject_fa' ] = $content_data->subject_fa;
      $data[ 'language_au' ] = $content_data->language_au;
      $data[ 'language_fa' ] = $content_data->language_fa;
      $data[ 'producers_au' ] = $content_data->producers_au;
      $data[ 'producers_fa' ] = $content_data->producers_fa;
      $data[ 'executive_au' ] = $content_data->executive_au;
      $data[ 'executive_fa' ] = $content_data->executive_fa;
      $data[ 'guests_au' ] = $content_data->guests_au;
      $data[ 'guests_fa' ] = $content_data->guests_fa;

      $data[ 'thumbnail_image_route' ] =  'img/tv/tvshows/' . $content_data->thumbnail_image_route;

      if ($content_data->trailer_route!="" && file_exists( public_path() . '/tv/tvshows/' . $content_data->trailer_route ) ) {
        $data[ 'cover_route' ] = 'tv/tvshows/' . $content_data->trailer_route;
        $data[ 'cover_type' ] = 'video';
      } else if($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/tvshows/' . $content_data->cover_image_route;
        $data[ 'cover_type' ] = 'image';
      } else if ($content_data->cover_image_route!="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route )) {
        $data[ 'cover_route' ] = 'img/tv/defaults/tvshow_cover.png';
        $data[ 'cover_type' ] = 'image';
      } else{
        $data[ 'cover_route' ] = 'img/tv/defaults/default_cover.png';
        $data[ 'cover_type' ] = 'image';
      }

      if($content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->background_image_route )) {
        $data[ 'background_image_route' ] = 'img/tv/tvshows/' . $content_data->background_image_route;
      } else if(file_exists( public_path() . '/img/tv/defaults/tvshow_background.png')) {
        $data[ 'background_image_route' ] = 'img/tv/defaults/tvshow_background.png';
      } else {
        $data[ 'background_image_route' ] = 'img/tv/defaults/default_background.png';
      }

      $data[ 'description_au' ] = $content_data->description_au;
      $data[ 'description_fa' ] = $content_data->description_fa;
      $data[ 'playback_casts' ] = $content_data->playback_casts;
      $data[ 'comment_status' ] = $content_data->comment_status;
      $data[ 'comments' ] = $this->comment;

      return view( 'tvshow/show', $data );
    }

    return redirect('tvshows');
  }

  public function manage() {
    $data = [];
    $data[ 'contents' ] = $this->tvshow->all();
    return view( 'tvshow/manage', $data );
  }

  public function create( Request $request, TvShow $tvshow ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'groupname_au' ] = $request->groupname_au;
    $data[ 'groupname_fa' ] = $request->groupname_fa;
    $data[ 'name_au' ] = $request->name_au;
    $data[ 'name_fa' ] = $request->name_fa;
    $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
    $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
    $data[ 'production_date' ] = $request->production_date?$request->production_date:'';
    $data[ 'subject_au' ] = $request->subject_au?$request->subject_au:'';
    $data[ 'subject_fa' ] = $request->subject_fa?$request->subject_fa:'';
    $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
    $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
    $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
    $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
    $data[ 'executive_au' ] = $request->executive_au?$request->executive_au:'';
    $data[ 'executive_fa' ] = $request->executive_fa?$request->executive_fa:'';
    $data[ 'guests_au' ] = $request->guests_au?$request->guests_au:'';
    $data[ 'guests_fa' ] = $request->guests_fa?$request->guests_fa:'';

    $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $request->cover_image_route;
    $data[ 'background_image_route' ] = $request->background_image_route ? $request->background_image_route : '';
    $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';

    $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
    $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

    if ( $request->isMethod( 'post' ) ) {
      $this->validate(
        $request, [
          'name_exclusive' => 'required|min:2',
          'groupname_au' => 'required|min:2',
          'groupname_fa' => 'required|min:2',
          'name_au' => 'required|min:2',
          'name_fa' => 'required|min:2',
          'production_date' => 'required',
          'subject_au' => 'required|min:2',
          'subject_fa' => 'required|min:2',
          'thumbnail_image_route' => 'required',
          'cover_image_route' => 'required',
        ]
      );

      $data[ 'thumbnail_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
      $request->thumbnail_image_route->move( public_path() . '/img/tv/tvshows/', $data[ 'thumbnail_image_route' ] );

      $data[ 'cover_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
      $request->cover_image_route->move( public_path() . '/img/tv/tvshows/', $data[ 'cover_image_route' ] );

      if($data[ 'background_image_route' ]!=null){
        $data[ 'background_image_route' ] = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
        $request->background_image_route->move( public_path() . '/img/tv/tvshows/', $data[ 'background_image_route' ] );
      }
      else {
        $data[ 'background_image_route' ]='';
      }

      $data['playback_casts'] = json_encode('[{"order":"1","route":""},{"order":"2","route":""}]');

      $tvshow->insert( $data );

      return redirect( '/managetv/tvshows' );
    }

    $data[ 'modify' ] = 0;

    return view( 'tvshow/CUform', $data );
  }

  public function update( $tvshow_id ) {
    $data = [];
    $data[ 'tvshow_id' ] = $tvshow_id;
    $data[ 'modify' ] = 1;

    $content_data = $this->tvshow->find( $tvshow_id );
    $data[ 'name_exclusive' ] = $content_data->name_exclusive;
    $data[ 'groupname_au' ] = $content_data->groupname_au;
    $data[ 'groupname_fa' ] = $content_data->groupname_fa;
    $data[ 'name_au' ] = $content_data->name_au;
    $data[ 'name_fa' ] = $content_data->name_fa;
    $data[ 'cue_au' ] = $content_data->cue_au;
    $data[ 'cue_fa' ] = $content_data->cue_fa;
    $data[ 'production_date' ] = $content_data->production_date;
    $data[ 'subject_au' ] = $content_data->subject_au;
    $data[ 'subject_fa' ] = $content_data->subject_fa;
    $data[ 'language_au' ] = $content_data->language_au;
    $data[ 'language_fa' ] = $content_data->language_fa;
    $data[ 'producers_au' ] = $content_data->producers_au;
    $data[ 'producers_fa' ] = $content_data->producers_fa;
    $data[ 'executive_au' ] = $content_data->executive_au;
    $data[ 'executive_fa' ] = $content_data->executive_fa;
    $data[ 'guests_au' ] = $content_data->guests_au;
    $data[ 'guests_fa' ] = $content_data->guests_fa;
    $data[ 'thumbnail_image_route' ] = $content_data->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $content_data->cover_image_route;
    $data[ 'background_image_route' ] = $content_data->background_image_route;
    $data[ 'trailer_route' ] = $content_data->trailer_route;
    $data[ 'description_au' ] = $content_data->description_au;
    $data[ 'description_fa' ] = $content_data->description_fa;

    return view( 'tvshow/CUform', $data );
  }

  public function modify( $tvshow_id, Request $request, TvShow $tvshow ) {
    $data = [];
    $data[ 'name_exclusive' ] = $request->name_exclusive;
    $data[ 'groupname_au' ] = $request->groupname_au;
    $data[ 'groupname_fa' ] = $request->groupname_fa;
    $data[ 'name_au' ] = $request->name_au;
    $data[ 'name_fa' ] = $request->name_fa;
    $data[ 'cue_au' ] = $request->cue_au?$request->cue_au:'';
    $data[ 'cue_fa' ] = $request->cue_fa?$request->cue_fa:'';
    $data[ 'production_date' ] = $request->production_date?$request->production_date:'';
    $data[ 'subject_au' ] = $request->subject_au;
    $data[ 'subject_fa' ] = $request->subject_fa;
    $data[ 'language_au' ] = $request->language_au?$request->language_au:'';
    $data[ 'language_fa' ] = $request->language_fa?$request->language_fa:'';
    $data[ 'producers_au' ] = $request->producers_au?$request->producers_au:'';
    $data[ 'producers_fa' ] = $request->producers_fa?$request->producers_fa:'';
    $data[ 'executive_au' ] = $request->executive_au?$request->executive_au:'';
    $data[ 'executive_fa' ] = $request->executive_fa?$request->executive_fa:'';
    $data[ 'guests_au' ] = $request->guests_au?$request->guests_au:'';
    $data[ 'guests_fa' ] = $request->guests_fa?$request->guests_fa:'';
    $data[ 'thumbnail_image_route' ] = $request->thumbnail_image_route;
    $data[ 'cover_image_route' ] = $request->cover_image_route;
    $data[ 'background_image_route' ] = $request->background_image_route ? $request->background_image_route : '';
    $data[ 'trailer_route' ] = $request->trailer_route ? $request->trailer_route : '';
    $data[ 'description_au' ] = $request->description_au ? $request->description_au : '';
    $data[ 'description_fa' ] = $request->description_fa ? $request->description_fa : '';

    if ( $request->isMethod( 'post' ) ) {
      $this->validate(
        $request, [
          'name_exclusive' => 'required|min:2',
          'groupname_au' => 'required|min:2',
          'groupname_fa' => 'required|min:2',
          'name_au' => 'required|min:2',
          'name_fa' => 'required|min:2',
          'production_date' => 'required',
          'subject_au' => 'required|min:2',
          'subject_fa' => 'required|min:2',
        ]
      );

      $content_data = $this->tvshow->find( $tvshow_id );
      $content_data->name_exclusive = $request->name_exclusive;
      $content_data->groupname_au = $request->groupname_au;
      $content_data->groupname_fa = $request->groupname_fa;
      $content_data->name_au = $request->name_au;
      $content_data->name_fa = $request->name_fa;
      $content_data->cue_au = $request->cue_au?$request->cue_au:'';
      $content_data->cue_fa = $request->cue_fa?$request->cue_fa:'';
      $content_data->production_date = $request->production_date?$request->production_date:'';
      $content_data->subject_au = $request->subject_au;
      $content_data->subject_fa = $request->subject_fa;
      $content_data->language_au = $request->language_au?$request->language_au:'';
      $content_data->language_fa = $request->language_fa?$request->language_fa:'';
      $content_data->producers_au = $request->producers_au?$request->producers_au:'';
      $content_data->producers_fa = $request->producers_fa?$request->producers_fa:'';
      $content_data->executive_au = $request->executive_au?$request->executive_au:'';
      $content_data->executive_fa = $request->executive_fa?$request->executive_fa:'';
      $content_data->guests_au = $request->guests_au?$request->guests_au:'';
      $content_data->guests_fa = $request->guests_fa?$request->guests_fa:'';
      $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';
      $content_data->description_au = $request->description_au ? $request->description_au : '';
      $content_data->description_fa = $request->description_fa ? $request->description_fa : '';
      $content_data->trailer_route = $request->trailer_route ? $request->trailer_route : '';
      $content_data->description_au = $request->description_au ? $request->description_au : '';
      $content_data->description_fa = $request->description_fa ? $request->description_fa : '';

      if ( $request->thumbnail_image_route != null ) {
        if ( file_exists( public_path() . '/img/tv/tvshows/' . $content_data->thumbnail_image_route ) ) {
          unlink( public_path() . '/img/tv/tvshows/' . $content_data->thumbnail_image_route );
        }
        $content_data->thumbnail_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->thumbnail_image_route->getClientOriginalExtension() );
        $request->thumbnail_image_route->move( public_path() . '/img/tv/tvshows/', $content_data->thumbnail_image_route );
      }

      if ( $request->cover_image_route != null ) {
        if ( file_exists( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route ) ) {
          unlink( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route );
        }
        $content_data->cover_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->cover_image_route->getClientOriginalExtension() );
        $request->cover_image_route->move( public_path() . '/img/tv/tvshows', $content_data->cover_image_route );
      }

      if ( $request->background_image_route != null ) {
        if ( $content_data->background_image_route !='' && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->background_image_route ) ) {
          unlink( public_path() . '/img/tv/tvshows/' . $content_data->background_image_route );
        }
        $content_data->background_image_route = ( ( string )Str::uuid() ) . '.' . ( $request->background_image_route->getClientOriginalExtension() );
        $request->background_image_route->move( public_path() . '/img/tv/tvshows', $content_data->background_image_route );
      }

      $content_data->save();

      return redirect( '/managetv/tvshows' );
    }

    $data[ 'modify' ] = 0;

    return view( 'tvshow/CUform', $data );
  }

  public function toggle_archive( $tvshow_id, TvShow $tvshow ) {
    $content_data = $this->tvshow->find( $tvshow_id );
    if ( $content_data->is_archived == false ) {
      $content_data->is_archived = true;
    } else {
      $content_data->is_archived = false;
    }

    $content_data->save();

    return redirect( '/managetv/tvshows' );
  }

  public function playback_casts($tvshow_id, Request $request, TvShow $tvshow){
    $data = [];
    $data[ 'playback_casts' ] = json_decode($this->tvshow->find($tvshow_id)->playback_casts);
    //$data['playback_casts'] = json_decode('[{"order": "1","route": ""},{"order": "2","route": ""}]');

    if($request->isMethod( 'post' ))
    {
      $content_data = $this->tvshow->find( $tvshow_id );
      $post_data = [];
      for ( $i = 0; $i < count( $request->playback_order ); $i++ ) {
        if(( int )$request->playback_order[ $i ]!=null && $request->playback_route[ $i ]!=null) {
          $post_data[]=array('order' => $request->playback_order[ $i ], 'route' => $request->playback_route[ $i ]);
        }
      }
      //dd(json_encode($post_data));
      $content_data->playback_casts = json_encode($post_data);
      $content_data->save();

      return redirect( '/managetv/tvshows' );
    }
    return view( 'tvshow/playbacks', $data );
  }

  public function destroy( $tvshow_id, TvShow $tvshow ) {
    $content_data = $this->tvshow->find( $tvshow_id );
    if ( $content_data->thumbnail_image_route !="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->thumbnail_image_route ) ) {
      unlink( public_path() . '/img/tv/tvshows/' . $content_data->thumbnail_image_route );
    }
    if ( $content_data->cover_image_route !="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route ) ) {
      unlink( public_path() . '/img/tv/tvshows/' . $content_data->cover_image_route );
    }
    if ( $content_data->background_image_route!="" && file_exists( public_path() . '/img/tv/tvshows/' . $content_data->background_image_route ) ) {
      unlink( public_path() . '/img/tv/tvshows/' . $content_data->background_image_route );
    }
    if ( $content_data->trailer_route!="" && file_exists( public_path() . 'tv/tvshows/' . $content_data->trailer_route ) ) {
      unlink( public_path() . 'tv/tvshows/' . $content_data->trailer_route );
    }

    $this->tvshow->destroy( $tvshow_id );
    return redirect( '/managetv/tvshows' );
  }
}
