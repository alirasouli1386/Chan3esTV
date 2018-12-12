<?php

namespace App\Http\Controllers;

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
use App\ Comment as Comment;
use Illuminate\ Http\ Request;
use Illuminate\ Support\ Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CommentController extends Controller
{
  public function __construct( Slider $sliders, Schedule $schedules, Featured $featured, Comment $comment, News $news, Chan3es $chan3es, TvShow $tvshow, Movie $movie, Series $series, Documentary $documentary, Music $music, Sport $sport, Kids $kids ) {
    $this->comment = $comment;
    $this->chan3es = $chan3es->where( 'is_archived', 0 );
    $this->tvshow = $tvshow->where( 'is_archived', 0 );
    $this->documentary = $documentary->where( 'is_archived', 0 );
    $this->kids = $kids->where( 'is_archived', 0 );
    $this->movie = $movie->where( 'is_archived', 0 );
    $this->music = $music->where( 'is_archived', 0 );
    $this->series = $series->where( 'is_archived', 0 );
    $this->sport = $sport->where( 'is_archived', 0 );
    $this->news = $news->where( 'is_archived', 0 );
  }

  public function add_comment( $content_type , $reference_id, Request $request, Comment $comment){
    $found=false;
    //['chan3es','tvshow','documentary','kids','movie','music','series','sport','news']

    switch ($content_type) {
      case'chan3es':
      $found=$this->chan3es->find($reference_id)?true:false;
      break;

      case 'tvshow':
      $found=$this->tvshow->find($reference_id)?true:false;
      break;

      case'documentary':
      $found=$this->documentary->find($reference_id)?true:false;
      break;

      case'kids':
      $found=$this->kids->find($reference_id)?true:false;
      break;

      case'movie':
      $found=$this->movie->find($reference_id)?true:false;
      break;

      case'music':
      $found=$this->music->find($reference_id)?true:false;
      break;

      case'series':
      $found=$this->series->find($reference_id)?true:false;
      break;

      case'sport':
      $found=$this->sport->find($reference_id)?true:false;
      break;

      case'news':
      $found=$this->news->find($reference_id)?true:false;
      break;
    }

    if ($found) {
      $data=[];
      $data['content_type']=$content_type;
      $data['reference_id']=(int)$reference_id;
      if($request->comment_language=='au') {
        $data['input_language']='au';
      } else {
        $data['input_language']='fa';
      }
      $data['name']=$request->comment_name;
      $data['email']=$request->comment_email;
      $data['subject']=$request->comment_subject;
      $data['content']=$request->comment_content;
      $data['reply']=json_encode('[{""}]');

      $comment->insert($data);
    }

    return redirect()->route('show_'.$content_type,[$reference_id]);
  }
}
