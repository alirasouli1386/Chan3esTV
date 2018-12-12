@extends( 'layouts.app' )

@section( 'content' )
	<div class="container">
		<br/>
		<div class="row">
			<div class="col-md-6">
				<h4>Manage News</h4>
			</div>
			<div class="col-md-4">
				<a class="btn btn-success" href="{{ route('create_news') }}">ADD NEWS</a>
			</div>
			<div class="col-md-2">
				<a class="btn btn-primary" href="{{ route('managetv') }}">Manage TV</a>
			</div>
		</div>
		<hr/>
		<br/>

		<section class="row">
			<h4>Current News</h4>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Title</th>
						<th>Date</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach( $news as $news )
					<tr>
						<td>{{ $news->title_au }}</td>
						<td>{{ $news->publish_date }}</td>
						<td>
							<a class="btn btn-secondary" href="{{ route('update_news', ['news_id' => $news->id ]) }}">EDIT</a> &nbsp; @if ($news->is_archived == false)
							<button class="btn btn-info" onclick="archiveNewsConfirmation('{{ route('toggle_archive_news', ['news_id' => $news->id ]) }}')">ARCHIVE</button> @else
							<a class="btn btn-primary" href="{{ route('toggle_archive_news', ['news_id' => $news->id ]) }}">DEARCHIVE</a> @endif

							<button class="btn btn-danger" onclick="destroyNewsConfirmation('{{ route('destroy_news', ['news_id' => $news->id ]) }}')">DESTROY</button>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</section>
	</div>

<script>
	function archiveNewsConfirmation( url ) {
		if ( confirm( "Do you want to archive the news?" ) ) {
			location.href = url;
		}
	}

	function destroyNewsConfirmation( url ) {
		if ( confirm( "Do you want to destroy the news?" ) ) {
			if ( confirm( "This task is irreversible. Destroy?" ) ) {
				location.href = url;
			}
		}
	}
</script>
@endsection