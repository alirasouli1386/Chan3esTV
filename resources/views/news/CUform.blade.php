@extends( 'layouts.app' )
	<!-- Create/Update News Form   -->

@section( 'head_links' )
	<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet"> @endsection @section( 'content' )
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-md-9">
				<h4>{{ $modify == 1 ? 'Modify News' : 'New News' }}</h4>
			</div>
		</div>
		<hr/>
		<br/>

		<section>
			<form action="{{ $modify == 1 ? route('update_news', [ 'news_id' => $news_id ]) : route('create_news') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group" style="min-width: 100%; width: 100%">
								<div class="input-group-prepend">
									<label class="input-group-text">
									Title:
									</label>
								</div>
								<input class="form-control" name="title_au" type="text" value="{{ old('title_au') ? old('title_au') : $title_au }}" required/>
								<small class="error"><br/>{{$errors->first('title_au')}}</small>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group" style="min-width: 100%; width: 100%">
								<div class="input-group-prepend">
									<label class="input-group-text">
									Subtitle:
									</label>
								</div>
								<input class="form-control" name="subtitle_au" type="text" value="{{ old('subtitle_au') ? old('subtitle_au') : $subtitle_au }}"/>
								<small class="error"><br/>{{$errors->first('subtitle_au')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group" style="min-width: 100%; width: 100%">
								<div class="input-group-prepend">
									<label class="input-group-text">
									Publish date:
									</label>
								</div>
								<input class="form-control" name="publish_date" type="date" value="{{ old('publish_date') ? old('publish_date') : $publish_date }}" required/>
								<small class="error"><br/>{{$errors->first('publish_date')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">عنوان:</label>
								</div>
								<input class="form-control farsi" name="title_fa" type="text" value="{{ old('title_fa') ? old('title_fa') : $title_fa }}" required/>
								<small class="error"><br/>{{$errors->first('title_fa')}}</small>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">زیرعنوان:</label>
								</div>
								<input class="form-control farsi" name="subtitle_fa" type="text" value="{{ old('subtitle_fa') ? old('subtitle_fa') : $subtitle_fa }}"/>
								<small class="error"><br/>{{$errors->first('subtitle_fa')}}</small>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<h4>News contents</h4>
							<textarea id="content_au" name="content_au">{{ old('content_au') ? old('content_au') : $content_au }}</textarea>
							<br/>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<h4 class="text-right farsi">محتوی خبر</h4>
							<textarea id="content_fa" name=content_fa style="direction:rtl">{{ old('content_fa') ? old('content_fa') : $content_fa }}</textarea>
							<br/>
						</div>
					</div>
				</div>

				<div class="form-group col-md-4 offset-md-2">
					<button class="btn {{$modify==1?'btn-warning':'btn-success'}}" type="submit">{{$modify==1?'Modify News':'Save News'}}</button>
					<a class="btn btn-info" href="{{route('manage_movies')}}" type="button">Close</a>
				</div>
			</form>
		</section>
		<br/>
	</div>
@endsection

@section( 'body_scripts' )
	<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
<script src="{{asset('js/summernote-ext-rtl.js')}}"></script>
<script>
	$( document ).ready( function () {
		$( '#content_au' ).summernote( {
			height: 300,
			toolbar: [
				[ 'file', [ 'undo', 'redo' ] ],
				[ 'style', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear' ] ],
				[ 'size', [ 'fontsize', 'height' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ul', 'ol', 'paragraph' ] ],
				[ 'insert', [ 'hr', 'picture', 'link', 'video', 'table' ] ],
				[ 'code', [ 'codeview' ] ]
			]
		} );
		$( '#content_fa' ).summernote( {
			height: 300,
			toolbar: [
				[ 'file', [ 'undo', 'redo' ] ],
				[ 'style', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear' ] ],
				[ 'size', [ 'fontsize', 'height' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ul', 'ol', 'paragraph'] ],
				[ 'insert', [ 'hr', 'picture', 'link', 'video', 'table' ] ],
				[ 'code', [ 'codeview' ] ]
			],
		} );
	} );
</script>
@endsection
