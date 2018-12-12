@extends( 'layouts.app' )
<!-- Create/Update from  -->
@section( 'content' )
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-md-9">
				<h4>{{ $modify == 1 ? 'Modify TVShow' : 'New TVShow' }}</h4>
			</div>
		</div>
		<hr/>
		<br/>

		<section class="row">
			<form class="w-100" action="{{ $modify == 1 ? route('update_tvshow', [ 'tvshow_id' => $tvshow_id ]) : route('create_tvshow') }}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Exclusive Name:
									</label>
								</div>
								<input class="form-control" name="name_exclusive" type="text" value="{{ old('name_exclusive') ? old('name_exclusive') : $name_exclusive }}" required/>
								<small class="error"><br/>{{$errors->first('name_exclusive')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Production Year:
									</label>
								</div>
								<input class="form-control" name="production_date" type="date" value="{{ old('production_date') ? old('production_date') : $production_date }}" required/>
								<small class="error"><br/>{{$errors->first('production_date')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Name:
									</label>
								</div>
								<input class="form-control" name="name_au" type="text" value="{{ old('name_au') ? old('name_au') : $name_au }}" required/>
								<small class="error"><br/>{{$errors->first('name_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										نام:
									</label>
								</div>
								<input class="form-control farsi" name="name_fa" type="text" value="{{ old('name_fa') ? old('name_fa') : $name_fa }}" required/>
								<small class="error"><br/>{{$errors->first('name_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Groupname:
									</label>
								</div>
								<input class="form-control" name="groupname_au" type="text" value="{{ old('groupname_au') ? old('groupname_au') : $groupname_au }}" required/>
								<small class="error"><br/>{{$errors->first('groupname_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										نام گروه:
									</label>
								</div>
								<input class="form-control farsi" name="groupname_fa" type="text" value="{{ old('groupname_fa') ? old('groupname_fa') : $groupname_fa }}" required/>
								<small class="error"><br/>{{$errors->first('groupname_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Cue:
									</label>
								</div>
								<input class="form-control" name="cue_au" type="text" value="{{ old('cue_au') ? old('cue_au') : $cue_au }}"/>
								<small class="error"><br/>{{$errors->first('cue_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										اشاره:
									</label>
								</div>
								<input class="form-control farsi" name="cue_fa" type="text" value="{{ old('cue_fa') ? old('cue_fa') : $cue_fa }}"/>
								<small class="error"><br/>{{$errors->first('cue_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Language:
									</label>
								</div>
								<input class="form-control" name="language_au" type="text" value="{{ old('language_au') ? old('language_au') : $language_au }}"/>
								<small class="error"><br/>{{$errors->first('language_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										زبان:
									</label>
								</div>
								<input class="form-control farsi" name="language_fa" type="text" value="{{ old('language_fa') ? old('language_fa') : $language_fa }}"/>
								<small class="error"><br/>{{$errors->first('language_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Subject:
									</label>
								</div>
								<input class="form-control" name="subject_au" type="text" value="{{ old('subject_au') ? old('subject_au') : $subject_au }}" required/>
								<small class="error"><br/>{{$errors->first('subject_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										موضوع برنامه:
									</label>
								</div>
								<input class="form-control farsi" name="subject_fa" type="text" value="{{ old('subject_fa') ? old('subject_fa') : $subject_fa }}" required/>
								<small class="error"><br/>{{$errors->first('subject_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Producers:
									</label>
								</div>
								<input class="form-control" name="producers_au" type="text" value="{{ old('producers_au') ? old('producers_au') : $producers_au }}"/>
								<small class="error"><br/>{{$errors->first('producers_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										تهیه‌کننده:
									</label>
								</div>
								<input class="form-control farsi" name="producers_fa" type="text" value="{{ old('producers_fa') ? old('producers_fa') : $producers_fa }}"/>
								<small class="error"><br/>{{$errors->first('producers_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Executive:
									</label>
								</div>
								<input class="form-control" name="executive_au" type="text" value="{{ old('executive_au') ? old('executive_au') : $executive_au }}"/>
								<small class="error"><br/>{{$errors->first('executive_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										مجری:
									</label>
								</div>
								<input class="form-control farsi" name="executive_fa" type="text" value="{{ old('executive_fa') ? old('executive_fa') : $executive_fa }}"/>
								<small class="error"><br/>{{$errors->first('executive_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Guest(s):
									</label>
								</div>
								<input class="form-control" name="guests_au" type="text" value="{{ old('guests_au') ? old('guests_au') : $guests_au }}"/>
								<small class="error"><br/>{{$errors->first('guests_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										مهمان(ان):
									</label>
								</div>
								<input class="form-control farsi" name="guests_fa" type="text" value="{{ old('guests_fa') ? old('guests_fa') : $guests_fa }}"/>
								<small class="error"><br/>{{$errors->first('guests_fa')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" id="thumbnail_image">
										Thumbnail image:
									</label>
								</div>
								<input class="form-control" name="thumbnail_image_route" type="file" value="{{ old('thumbnail_image_route') ? old('thumbnail_image_route') : $thumbnail_image_route }}" {{ $modify == 0 ? "required": "" }}/>
								<small class="error"><br/>{{$errors->first('thumbnail_image_route')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" id="cover_image">
										Cover image:
									</label>
								</div>
								<input class="form-control" name="cover_image_route" type="file" value="{{ old('cover_image_route') ? old('cover_image_route') : $cover_image_route }}" {{ $modify == 0 ? "required": "" }}/>
								<small class="error"><br/>{{$errors->first('cover_image_route')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text" id="background_image">
										Background image:
									</label>
								</div>
								<input class="form-control" name="background_image_route" type="file" value="{{ old('background_image_route') ? old('background_image_route') : $background_image_route }}"/>
								<small class="error"><br/>{{$errors->first('background_image_route')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group">
								<div class="input-group-prepend">
									<label class="input-group-text">
										Trailer route:
									</label>
								</div>
								<input class="form-control" name="trailer_route" type="text" value="{{ old('trailer_route') ? old('trailer_route') : $trailer_route }}"/>
								<small class="error"><br/>{{$errors->first('trailer_route')}}</small>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group">
						<div class="input-group-prepend">
							<label class="input-group-text">
								Description:
							</label>
						</div>
						<textarea class="form-control" name="description_au">{{ old('description_au') ? old('description_au') : $description_au }}</textarea>
						<small class="error"><br/>{{$errors->first('description_au')}}</small>
					</div>
				</div>

				<div class="form-group">
					<div class="input-group" style="direction: rtl">
						<div class="input-group-prepend">
							<label class="input-group-text farsi">
								توضیحات:
							</label>
						</div>
						<textarea class="form-control farsi" name="description_fa">{{ old('description_fa') ? old('description_fa') : $description_fa }}</textarea>
						<small class="error"><br/>{{$errors->first('description_fa')}}</small>
					</div>
				</div>

				<div class="form-group col-md-4 offset-md-2">
					<button class="btn {{$modify==1?'btn-warning':'btn-success'}}" type="submit">{{$modify==1?'Modify TVShow':'Save TVShow'}}</button>
					<a class="btn btn-info" href="{{route('manage_tvshows')}}" type="button">Close</a>
				</div>
			</form>

		</section>
		<br/>
	</div>
@endsection

@section( 'body_scripts' )
	<script>
	function fileExists( file_url ) {
		if ( file_url ) {
			var req = new XMLHttpRequest();
			req.open( 'GET', file_url, false );
			req.send();
			return req.status == 200;
		} else {
			return false;
		}
	}

	$( document ).ready( function () {
		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/tvshows/{{$thumbnail_image_route}}' ) ) {
			$( '#thumbnail_image' ).text( 'Thumbnail exists; Replace:' );
		}

		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/tvshows/{{$cover_image_route}}' ) ) {
			$( '#cover_image' ).text( 'Cover exists; Replace:' );
		}

		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/tvshows/{{$background_image_route}}' ) ) {
			$( '#background_image' ).text( 'Background exists; Replace:' );
		}
	} );
	</script>
@endsection
