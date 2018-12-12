@extends('layouts.app' )
<!-- Manage schedules-->
@section('content' )
	<div class="container">
		<br/>
		<form class="row" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group offset-md-2">
				<button type="button" class="btn btn-primary" onclick="addSchedule(0,'','','','','')">Add Schedule</button>
				<button type="button" class="btn btn-secondary" onclick="removeSchedule()">Remove Schedule</button>
			</div>
			<br/>
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Order</th>
						<th>Title</th>
						<th class="text-right farsi">عنوان</th>
						<th>Schedule Date</th>
						<th>Schedule time</th>
					</tr>
				</thead>
				<tbody id="schedules">
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
	var nSchedule = 0;

	function addSchedule(id, order, title_au, title_fa, schedule_date, schedule_time) {
		nSchedule++;
		$('#schedules').append(
			'<tr id="schedule_' + nSchedule + '"><td width="5%"><input type="text" class="form-control" name="schedule_id[]" value="' + id + '" style="display:none;"/><input type="text" class="form-control" name="schedule_order[]" value="' + order +
			'" required/></td><td><div class="input-group"><div class="input-group-prepend"><label class="input-group-text">Au:</label></div><input type="text" class="form-control" name="schedule_title_au[]" value="' + title_au +
			'" required/></div></td><td><div class="input-group"><div class="input-group-prepend"><label class="input-group-text">Fa:</label></div><input type="text" class="form-control text-right farsi" name="schedule_title_fa[]" value="' + title_fa +
			'" required/></div></td><td><input type="date" class="form-control" name="schedule_date[]" value="' + schedule_date + '" required/></td><td><input type="time" class="form-control" name="schedule_time[]" value="' + schedule_time + '" required/></td></tr>');
		}

		function removeSchedule() {
			if (nSchedule > nDB) {
				$('#schedule_' + nSchedule).remove();
				nSchedule--;
			}
		}


		$(document).ready(function() {
			@foreach( $schedules as $schedule )
			addSchedule('{{$schedule->id}}', '{{$schedule->order}}', '{{$schedule->title_au}}', '{{$schedule->title_fa}}', '{{$schedule->schedule_date}}','{{$schedule->schedule_time}}'); nDB++;
			@endforeach
		});
		</script>
	@endsection
