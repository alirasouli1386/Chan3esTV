@extends( 'layouts.app' )
<!-- Manage sliders-->
@section( 'content' )
	<div class="container">
		<br/>
		<form method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="row">
				<div class="form-group offset-md-2">
					<button type="button" class="btn btn-primary" onclick="addSlider(0,'','','','','','','','')">Add Slider</button>
					<button type="button" class="btn btn-secondary" onclick="removeSlider()">Remove Slider</button>
				</div>
			</div>
			<br/>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Order</th>
						<th>File</th>
						<th>Title</th>
						<th>Subtitle</th>
						<th class="text-right farsi">عنوان</th>
						<th class="text-right farsi">زیرعنوان</th>
						<th>HRef</th>
					</tr>
				</thead>
				<tbody id="sliders">
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

@section('body_scripts')
	<script>
	var nDB = 0;
	var nSlider = 0;

	function addSlider( id, order, file_path, file_name, title_au, subtitle_au, title_fa, subtitle_fa ,href) {
		nSlider++;
		var td_slider_file;
		if ( fileExists( file_path + file_name ) ) {
			td_slider_file = '<td>File already exists<input type="file" class="form-control" name="slider_file[]" accept="image/*" value="' + file_path + file_name + '" style="display:none;"/><input type="text" class="form-control" name="slider_id[]" value="' + id + '" style="display:none;"/></td>'
		} else {
			td_slider_file = '<td><input type="file" class="form-control" name="slider_file[]" accept="image/*" required/><input type="text" class="form-control" name="slider_id[]" value="' + id + '" style="display:none;"/></td>'
		}

		td_slider_titles_au = '<td><div class="input-group"><div class="input-group-prepend"><label class="input-group-text">Au:</label></div><input type="text" class="form-control" name="slider_title_au[]" value="' + title_au + '" required/></div></td><td><input type="text" class="form-control" name="slider_subtitle_au[]" value="' + subtitle_au + '"/></td>';

		td_slider_titles_fa = '<td><div class="input-group"><div class="input-group-prepend"><label class="input-group-text">Fa:</label></div><input type="text" class="form-control text-right farsi" name="slider_title_fa[]" value="' + title_fa + '" required/></div></td><td><input type="text" class="form-control text-right farsi" name="slider_subtitle_fa[]" value="' + subtitle_fa + '"/></td>';

		td_href = '<td><input type="url" class="form-control" name="slider_href[]" pattern="https?://.+" title="Include http://"  value="' + href + '"/></td>'

		$( '#sliders' ).append(
			'<tr id="slider_' + nSlider + '"><td width="5%"><input type="text" class="form-control" name="slider_order[]" value="' + order + '" required/></td>+' + td_slider_file + td_slider_titles_au + td_slider_titles_fa+td_href + '</tr>' );
		}

		function removeSlider() {
			if ( nSlider > nDB ) {
				$( '#slider_' + nSlider ).remove();
				nSlider--;
			}
		}

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
			@foreach( $sliders as $slider )
			addSlider( '{{$slider->id}}', '{{$slider->order}}', location.protocol + '//' + location.hostname + ( location.port ? ':' + location.port : '' ) + '/img/sliders/', '{{$slider->slider_route}}', '{{$slider->title_au}}', '{{$slider->subtitle_au}}', '{{$slider->title_fa}}', '{{$slider->subtitle_fa}}', '{{$slider->href}}' );
			nDB++;
			@endforeach
		} );
		</script>
	@endsection
