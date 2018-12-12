@extends( 'layouts.app' )

@section( 'content' )
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-md">
				<h4>Manage Series</h4>
			</div>
			<div class="col-md">
				<div class="form-group">
					<a class="btn btn-success" href="{{ route('create_series') }}">ADD NEW SERIES</a>
					<a class="btn btn-primary" href="{{ route('managetv') }}">Manage TV</a>
				</div>
			</div>
		</div>
		<hr/>
		<br/>

		<section class="row">
			<h4>Current Series</h4>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Exclusive Name</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $contents as $content )
					<tr>
						<td>{{ $content->name_exclusive }}</td>
						<td>
							<a class="btn btn-secondary" href="{{ route('update_series', ['series_id' => $content->id ]) }}">EDIT</a> &nbsp; @if ($content->is_archived == false)
							<button class="btn btn-info" onclick="archiveContentConfirmation('{{ route('toggle_archive_series', ['series_id' => $content->id ]) }}')">ARCHIVE</button> @else
							<a class="btn btn-primary" href="{{ route('toggle_archive_series', ['series_id' => $content->id ]) }}">DEARCHIVE</a> @endif

							<button class="btn btn-danger" onclick="destroyContentConfirmation('{{ route('destroy_series', ['series_id' => $content->id ]) }}')">DESTROY</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</section>
	</div>

<script>
	function archiveContentConfirmation( url ) {
		if ( confirm( "Do you want to archive the series?" ) ) {
			location.href = url;
		}
	}

	function destroyContentConfirmation( url ) {
		if ( confirm( "Do you want to destroy the series?" ) ) {
			if ( confirm( "This task is irreversible. Destroy?" ) ) {
				location.href = url;
			}
		}
	}
</script>
@endsection
