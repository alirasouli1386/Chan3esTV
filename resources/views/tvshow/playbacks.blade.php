@extends( 'layouts.app' )
<!-- Manage tvshow playbacks -->
@section( 'content' )
  <div class="container">
    <br/>
    <form method="POST" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="row">
        <div class="form-group offset-md-2">
          <button type="button" class="btn btn-primary" onclick="addPlayback('')">Add Playback</button>
          <button type="button" class="btn btn-secondary" onclick="removePlayback()">Remove Playback</button>
        </div>
      </div>
      <br/>
      <table class="table table-hover table-striped">
        <thead>
          <tr>
            <th>Order</th>
            <th>Route</th>
          </tr>
        </thead>
        <tbody id="playbacks">
        </tbody>
      </table>
      <br/>
      <div class="form-group offset-md-3">
        <button type="submit" class="btn btn-success">Sumbit</button>
        <button type="reset" class="btn btn-danger">Reset</button>
        <a href="{{route('manage_tvshows')}}" type="button" class="btn btn-light">Close</a>
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
  var nPlayback = 0;

  function addPlayback( route){
    nPlayback++;
    $( '#playbacks' ).append('<tr id="playback_' + nPlayback + '"><td width="10%"><input type="hidden" class="form-control" name="playback_order[]" value="' + nPlayback + '" required/>'+nPlayback+'</td><td><input type="text" class="form-control" name="playback_route[]" value="' + route + '" required/></td></tr>' );
    }

    function removePlayback() {
      if ( nPlayback > 0) {
        $( '#playback_' + nPlayback ).remove();
        nPlayback--;
      }
    }

    $( document ).ready( function () {
      @foreach( $playback_casts as $playback )
      addPlayback( '{{$playback->route}}' );
      @endforeach
    } );
    </script>
  @endsection
