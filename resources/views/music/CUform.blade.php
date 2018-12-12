@extends( 'layouts.app' )
<!-- Create/Update from  -->
@section( 'content' )
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-md-9">
				<h4>{{ $modify == 1 ? 'Modify Music' : 'New Music' }}</h4>
			</div>
		</div>
		<hr/>
		<br/>

		<section class="row">
			<form class="w-100" action="{{ $modify == 1 ? route('update_music', [ 'music_id' => $music_id ]) : route('create_music') }}" method="post" enctype="multipart/form-data">
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
								<input class="form-control" name="production_year" type="number" min="1888" value="{{ old('production_year') ? old('production_year') : $production_year }}" required/>
								<small class="error"><br/>{{$errors->first('production_year')}}</small>
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
								<input class="form-control" name="groupname_au" type="text" value="{{ old('groupname_au') ? old('groupname_au') : $groupname_au }}"/>
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
								<input class="form-control farsi" name="groupname_fa" type="text" value="{{ old('groupname_fa') ? old('groupname_fa') : $groupname_fa }}"/>
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
										Production country:
									</label>
								</div>
								<input class="form-control" name="production_country_au" type="text" value="{{ old('production_country_au') ? old('production_country_au') : $production_country_au }}"/>
								<small class="error"><br/>{{$errors->first('production_country_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										کشور سازنده:
									</label>
								</div>
								<input class="form-control farsi" name="production_country_fa" type="text" value="{{ old('production_country_fa') ? old('production_country_fa') : $production_country_fa }}"/>
								<small class="error"><br/>{{$errors->first('production_country_fa')}}</small>
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
										Genre:
									</label>
								</div>
								<input class="form-control" name="genre_au" type="text" value="{{ old('genre_au') ? old('genre_au') : $genre_au }}" required/>
								<small class="error"><br/>{{$errors->first('genre_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										ژانر:
									</label>
								</div>
								<input class="form-control farsi" name="genre_fa" type="text" value="{{ old('genre_fa') ? old('genre_fa') : $genre_fa }}" required/>
								<small class="error"><br/>{{$errors->first('genre_fa')}}</small>
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
										Singer:
									</label>
								</div>
								<input class="form-control" name="singer_au" type="text" value="{{ old('singer_au') ? old('singer_au') : $singer_au }}"/>
								<small class="error"><br/>{{$errors->first('singer_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										سراینده:
									</label>
								</div>
								<input class="form-control farsi" name="singer_fa" type="text" value="{{ old('singer_fa') ? old('singer_fa') : $singer_fa }}"/>
								<small class="error"><br/>{{$errors->first('singer_fa')}}</small>
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
										Composer:
									</label>
								</div>
								<input class="form-control" name="composer_au" type="text" value="{{ old('composer_au') ? old('composer_au') : $composer_au }}"/>
								<small class="error"><br/>{{$errors->first('composer_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										آهنگ‌‌ساز:
									</label>
								</div>
								<input class="form-control farsi" name="composer_fa" type="text" value="{{ old('composer_fa') ? old('composer_fa') : $composer_fa }}"/>
								<small class="error"><br/>{{$errors->first('composer_fa')}}</small>
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
										Artist:
									</label>
								</div>
								<input class="form-control" name="artist_au" type="text" value="{{ old('artist_au') ? old('artist_au') : $artist_au }}"/>
								<small class="error"><br/>{{$errors->first('artist_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										موسیقی‌دان:
									</label>
								</div>
								<input class="form-control farsi" name="artist_fa" type="text" value="{{ old('artist_fa') ? old('artist_fa') : $artist_fa }}"/>
								<small class="error"><br/>{{$errors->first('artist_fa')}}</small>
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
										Album:
									</label>
								</div>
								<input class="form-control" name="album_au" type="text" value="{{ old('album_au') ? old('album_au') : $album_au }}"/>
								<small class="error"><br/>{{$errors->first('album_au')}}</small>
							</div>
						</div>
						<div class="col-md">
							<div class="input-group" style="direction: rtl">
								<div class="input-group-prepend">
									<label class="input-group-text farsi">
										آلبوم:
									</label>
								</div>
								<input class="form-control farsi" name="album_fa" type="text" value="{{ old('album_fa') ? old('album_fa') : $album_fa }}"/>
								<small class="error"><br/>{{$errors->first('album_fa')}}</small>
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
						<div class="col-md">
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
								Mini story:
							</label>
						</div>
						<textarea class="form-control" name="mini_story_au">{{old('mini_story_au') ? old('mini_story_au') : $mini_story_au }}</textarea>
						<small class="error"><br/>{{$errors->first('mini_story_au')}}</small>
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
								داستان کوتاه:
							</label>
						</div>
						<textarea class="form-control farsi" name="mini_story_fa">{{ old('mini_story_fa') ? old('mini_story_fa') : $mini_story_fa }}</textarea>
						<small class="error"><br/>{{$errors->first('mini_story_fa')}}</small>
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
					<button class="btn {{$modify==1?'btn-warning':'btn-success'}}" type="submit">{{$modify==1?'Modify Music':'Save Music'}}</button>
					<a class="btn btn-info" href="{{route('manage_musics')}}" type="button">Close</a>
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
		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/musics/{{$thumbnail_image_route}}' ) ) {
			$( '#thumbnail_image' ).text( 'Thumbnail exists; Replace:' );
		}

		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/musics/{{$cover_image_route}}' ) ) {
			$( '#cover_image' ).text( 'Cover exists; Replace:' );
		}

		if ( fileExists( location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/tv/musics/{{$background_image_route}}' ) ) {
			$( '#background_image' ).text( 'Background exists; Replace:' );
		}
	} );
	</script>
@endsection
