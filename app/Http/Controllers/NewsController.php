<?php

namespace App\Http\Controllers;

use App\ News as News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
	function __construct(News $news) {
		$this->news = $news;
	}

	public function index()
	{
		$data = [];
		$data[ 'news_data' ] = $this->news->all()->where( 'is_archived', 0 );//->orderBy('publish_date');
		return view('news/index',$data);
	}

	public

	function show( $news_language , $news_id) {
		$data = [];
		$news_data = $this->news->find( $news_id );
		//$data[ 'news_id' ] = $news_id;
		$data[ 'publish_date' ] = $news_data->publish_date;

		if ($news_language == 'au') {
			$data['news_language'] = 'au';
		} else {
			$data['news_language'] = 'fa';
		}

		$data[ 'title_au' ] = $news_data->title_au;
		$data[ 'subtitle_au' ] = $news_data->subtitle_au;
		$data[ 'content_au' ] = $news_data->content_au;
		$data[ 'title_fa' ] = $news_data->title_fa;
		$data[ 'subtitle_fa' ] = $news_data->subtitle_fa;
		$data[ 'content_fa' ] = $news_data->content_fa;

		return view( 'news/show', $data );
	}

	public

	function manage() {
		$data = [];
		$data[ 'news' ] = $this->news->all();
		return view( 'news/manage', $data );
	}

	public

	function create( Request $request, News $news ) {
		$data = [];
		$data[ 'publish_date' ] = $request->publish_date;
		$data[ 'title_au' ] = $request->title_au;
		$data[ 'title_fa' ] = $request->title_fa;
		$data[ 'subtitle_au' ] = $request->subtitle_au?$request->subtitle_au:'';
		$data[ 'subtitle_fa' ] = $request->subtitle_fa?$request->subtitle_fa:'';
		$data[ 'content_au' ] = $request->content_au ? $request->content_au : '';
		$data[ 'content_fa' ] = $request->content_fa ? $request->content_fa : '<div class="text-right farsi" style="direction:rtl"><br/></div>';


		if ( $request->isMethod( 'post' ) ) {
			$this->validate(
				$request, [
					'title_au' => 'required',
					'title_fa' => 'required',
					'publish_date' => 'required',
				]
			);

			$news->insert( $data );

			return redirect( '/managetv/news' );
		}

		$data[ 'modify' ] = 0;

		return view( 'news/CUform', $data );
	}

	public

	function update( $news_id ) {
		$data = [];
		$data[ 'news_id' ] = $news_id;
		$data[ 'modify' ] = 1;

		$news_data = $this->news->find( $news_id );
		$data[ 'publish_date' ] = $news_data->publish_date;
		$data[ 'title_au' ] = $news_data->title_au;
		$data[ 'title_fa' ] = $news_data->title_fa;
		$data[ 'subtitle_au' ] = $news_data->subtitle_au;
		$data[ 'subtitle_fa' ] = $news_data->subtitle_fa;
		$data[ 'content_au' ] = $news_data->content_au;
		$data[ 'content_fa' ] = $news_data->content_fa;

		return view( 'news/CUform', $data );
	}

	public

	function modify( $news_id, Request $request, News $news ) {
		$data = [];
		$data[ 'publish_date' ] = $request->publish_date;
		$data[ 'title_au' ] = $request->title_au;
		$data[ 'title_fa' ] = $request->title_fa;
		$data[ 'subtitle_au' ] = $request->subtitle_au?$request->subtitle_au:'';
		$data[ 'subtitle_fa' ] = $request->subtitle_fa?$request->subtitle_fa:'';
		$data[ 'content_au' ] = $request->content_au ? $request->content_au : '';
		$data[ 'content_fa' ] = $request->content_fa ? $request->content_fa : '';

		if ( $request->isMethod( 'post' ) ) {
			$this->validate(
				$request, [
					'title_au' => 'required',
					'title_fa' => 'required',
					'publish_date' => 'required',
				]
			);

			$news_data = $this->news->find( $news_id );
			$news_data->publish_date = $request->publish_date;
			$news_data->title_au = $request->title_au;
			$news_data->title_fa = $request->title_fa;
			$news_data->subtitle_au = $request->subtitle_au?$request->subtitle_au:'';
			$news_data->subtitle_fa = $request->subtitle_fa?$request->subtitle_fa:'';
			$news_data->content_au = $request->content_au ? $request->content_au : '';
			$news_data->content_fa = $request->content_fa ? $request->content_fa : '';

			$news_data->save();

			return redirect( '/managetv/news' );
		}

		$data[ 'modify' ] = 0;

		return view( 'news/CUform', $data );
	}

	public

	function toggle_archive( $news_id, News $news ) {
		$news_data = $this->news->find( $news_id );
		if ( $news_data->is_archived == false ) {
			$news_data->is_archived = true;
		} else {
			$news_data->is_archived = false;
		}

		$news_data->save();

		return redirect( '/managetv/news' );
	}

	public

	function destroy( $news_id, News $news ) {
		$this->news->destroy( $news_id );
		return redirect( '/managetv/news' );
	}
}
