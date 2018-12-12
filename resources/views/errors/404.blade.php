@extends( 'layouts.app' )

@section( 'head_links' )

@endsection

@section( 'content' )
  <div class="container">
    <br/>
    <br/>
    <div class="row">
      <img class="mx-auto" src="{{asset("img/logo.png")}}" height="300px" width="auto" alt="logo"/>
    </div>
    <div class="row">
      <br/>
      <div class="col-md offset-md-1">
        <h3>
          The requested page is not found.
        </h3>
      </div>
      <div class="col-md" style="direction:rtl;">
        <h3 class="text-right farsi">
          صفحه درخواست شده یافت نشد.
        </h3>
      </div>
      <div class="col-md-1"></div>
    </div>
  </div>
  <hr/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
</div>
@endsection
