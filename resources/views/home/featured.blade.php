@extends( 'layouts.app' )
<!-- Manage featured-->
@section( 'content' )
	<div class="container">
		<br/>
		<form method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group offset-md-2">
				<button type="button" class="btn btn-primary" onclick="addFeatured(0,'','','')">Select Featured</button>
				<button type="button" class="btn btn-secondary" onclick="removeFeatured()">Remove Featured</button>
			</div>
			<br/>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Order</th>
						<th>Content type</th>
						<th>Content</th>
					</tr>
				</thead>
				<tbody id="featured">
				</tbody>
			</table>
			<br/>
			<div class="form-group offset-md-3">
				<button type="submit" class="btn btn-success">Sumbit</button>
				<button type="reset" class="btn btn-danger">Reset</button>
				<a href="{{route('managetv')}}" type="button" class="btn btn-light">Close</a>
			</div>
		</form>
		<hr/>
		<br/>
		<br/>
		<br/>
		<br/>
	</div>
@endsection

@section( 'body_scripts' )
	<script>
	var nDB = 0;
	var nFeatured = 0;
	var contents = [];

	function addFeatured( id, order, content_type, reference_id ) {
		nFeatured++;

		let td_order = '<td width="5%"><input type="text" class="form-control" name="featured_id[]" value="' + id + '" style="display:none;"/><input type="text" class="form-control" name="featured_order[]" value="' + order + '" required/></td>';

		let td_content_types='<td><select class="form-control" name="content_type[]" id="content_type_'+nFeatured+'" onchange="changeContentType('+nFeatured+')" required><option value=""></option><option value="documentary">Documentary</option><option value="kids">Kids</option><option value="movie">Movie</option><option value="music">Music</option><option value="series">Series</option><option value="sport">Sport</option><option value="tvshow">TV Show</option></select></td>';

		let td_contents='<td><select class="form-control" name="reference_id[]" id="contents_'+nFeatured+'" required></select></td>'

		$( '#featured' ).append(
			'<tr id="featured_' + nFeatured + '">' + td_order+td_content_types+td_contents+'</tr>');

			if ( content_type != '' && reference_id !='') {
				switch(content_type){
					case 'documentary':
					$('#content_type_'+nFeatured).val('documentary').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'kids':
					$('#content_type_'+nFeatured).val('kids').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'movie':
					$('#content_type_'+nFeatured).val('movie').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'music':
					$('#content_type_'+nFeatured).val('music').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'series':
					$('#content_type_'+nFeatured).val('series').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'sport':
					$('#content_type_'+nFeatured).val('sport').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
					case 'tvshow':
					$('#content_type_'+nFeatured).val('tvshow').change();
					$('#contents_'+nFeatured).val(reference_id);
					break;
				}
			}
		}

		function removeFeatured() {
			if ( nFeatured > nDB ) {
				$( '#featured_' + nFeatured ).remove();
				nFeatured--;
			}
		}

		function changeContentType(nItem){
			$('#contents_'+nItem).html('');
			var value=$('#content_type_'+nItem).val();
			for(i=0;i<contents.length;i++)
			{
				if(contents[i]['content_type']==value){
					$('#contents_'+nItem).append('<option value='+contents[i]["reference_id"]+'>'+contents[i]["name"]+'</option>');
				}
			}
		}


		$( document ).ready( function () {
			constructContents();

			@foreach( $featured_data as $featured )

			addFeatured( '{{$featured->id}}', '{{$featured->order}}', '{{$featured->content_type}}', '{{$featured->reference_id}}' );
			nDB++;
			@endforeach
		} );

		function constructContents() {
			@foreach( $documentaries as $documentary )
			contents.push({
				'content_type': 'documentary',
				'reference_id': {{$documentary->id}},
				'name': '{{$documentary->name_exclusive}}'
			});
			@endforeach
			@foreach( $kids_data as $kids )
			contents.push({
				'content_type': 'kids',
				'reference_id': {{$kids->id}},
				'name': '{{$kids->name_exclusive}}'
			});
			@endforeach
			@foreach( $movies as $movie )
			contents.push({
				'content_type': 'movie',
				'reference_id': {{$movie->id}},
				'name': '{{$movie->name_exclusive}}'
			});
			@endforeach
			@foreach( $musics as $music )
			contents.push({
				'content_type': 'music',
				'reference_id': {{$music->id}},
				'name': '{{$music->name_exclusive}}'
			});
			@endforeach
			@foreach( $series_data as $series )
			contents.push({
				'content_type': 'series',
				'reference_id': {{$series->id}},
				'name': '{{$series->name_exclusive}}'
			});
			@endforeach
			@foreach( $sports as $sport )
			contents.push({
				'content_type': 'sport',
				'reference_id': {{$sport->id}},
				'name': '{{$sport->name_exclusive}}'
			});
			@endforeach
			@foreach( $tvshows as $tvshow )
			contents.push({
				'content_type': 'tvshow',
				'reference_id': {{$tvshow->id}},
				'name': '{{$tvshow->name_exclusive}}'
			});
			@endforeach
		}
		</script>
	@endsection
