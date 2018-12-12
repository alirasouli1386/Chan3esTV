@extends('layouts.app')

@section('content')
  <div class="fluid-container" style="background:whitesmoke; padding:0;">
    <div class="text-center">
      {{$cover_type === "video"}}
      @if($cover_type === "video")
        <video width="100%" height="auto" controls>
          <source src="{{asset($cover_route)}}" type="video/mp4">
            Your browser does not support HTML5 video.
          </video>
        @else
          <img src="{{asset($cover_route)}}" width="100%" />
        @endif
      </div>
    </div>

    <section class="fluid-container background-image" style="background-image: url('{{asset($background_image_route)}}');">
      <br/>
      <div class="row">
        <div class="col-md-5 offset-md-1">
          <h2 class="text-white text-uppercase" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$name_au}}</h2>
          <div class="row">
            <div class="col-md-4">
              <img src="{{asset($thumbnail_image_route)}}" width="100%" height="auto" style="max-width:250px;" class="img-responsive float-left" />
            </div>
            <div class="col-md">
              <h3 class="text-left text-white">{{$name_au}}</h3>
              <h4 class="text-left text-white">Subject: {{$subject_au}}</h4>
              <h4 class="text-left text-white">Language: {{$language_au}}</h4>
              <h4 class="text-left text-white">Producer(s): {{$producers_au}}</h4>
              <h4 class="text-left text-white">Executive: {{$executive_au}}</h4>
              <h4 class="text-left text-white">Guest(s): {{$guests_au}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="text-left text-white">Description: </h4>
            <p class="text-left text-white">{{$description_au}}</p>
          </div>
        </div>
        <div class="col-md-5" style="direction:rtl">
          <h2 class="farsi text-right text-white" style="border-bottom-style:solid; border-bottom-color:red; border-bottom-width:5px;">{{$name_fa}}</h2>
          <div class="row">
            <div class="col-md-4">
              <img src="{{asset($thumbnail_image_route)}}" width="100%" height="auto" style="max-width:250px;" class="img-responsive float-right" />
            </div>
            <div class="col-md">
              <h3 class="farsi text-right text-white text-bold">{{$name_fa}}</h3>
              <h4 class="farsi text-right text-white">موضوع برنامه: {{$subject_fa}}</h4>
              <h4 class="farsi text-right text-white">زبان: {{$language_fa}}</h4>
              <h4 class="farsi text-right text-white">تهیه‌کننده(گان): {{$producers_fa}}</h4>
              <h4 class="farsi text-right text-white">مجری: {{$executive_fa}}</h4>
              <h4 class="farsi text-right text-white">مهمان(ان): {{$guests_fa}}</h4>
            </div>
          </div>
          <div class="row">
            <h4 class="farsi text-right text-white">توضیحات:</h4>
            <p class="farsi text-right text-white">{{$description_fa}}</p>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
      <br/>

      <!-- Playback section -->

      <br/>

      <!-- Comment submit -->
      @if($comment_status=='active')
        <hr/>
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md">
            <div class=""><h3 class="text-white">Send your comment:</h3></div>
            <div class="form-check">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="comment_language" onchange="comment_language_change('au')">
                <h4 class="text-white">I'm writing in English.</h4>
              </label>
            </div>
          </div>
          <div class="col-md" style="direction:rtl">
            <div class="text-right"><h3 class="farsi text-white">نظر خود را بنویسید:</h3></div>
            <div class="form-check text-right">
              <label class="form-check-label">
                <input type="radio" class="form-check-input" name="comment_language" onchange="comment_language_change('fa')" checked>
                <h4 class="text-white farsi">&nbsp;&nbsp;&nbsp;من به فارسی می‌نویسم.</h4>
              </label>
            </div>
          </div>
          <div class="col-md-1"></div>
        </div>
        <form action="{{ route('add_comment', ['content_type' => 'tvshow' , 'reference_id' => $tvshow_id ])}}" method="post">
          {{csrf_field()}}

          <div id="comment_section"></div>
        </form>
        <br/>
      @endif

      <!-- Comments -->
      @if($comment_status=='active' || $comment_status=='freeze')
        <div class="row text-white">
          <div class="col-md-5 offset-md-1"><h3>Comments:</h3></div>
          <div class="col-md-5 text-right" style="direction:rtl"><h3 class="farsi">نظرات:</h3></div>
        </div>
        <hr/>
        @foreach ($comments as $key => $value)
          @if($value->input_language=='au')
            <div class="row text-white">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <h5>{{$value->name}} has written:</h5>
                <h5>Subject: {{$value->subject}}</h5>
                <p>{{$value->content}}</p>
              </div>
              <div class="col-md-2"></div>
            </div>
            <hr/>
          @else
            <div class="row text-white text-right" style="direction:rtl">
              <div class="col-md-2"></div>
              <div class="col-md-8">
                <h5 class="farsi">{{$value->name}} نوشته است:</h5>
                <h5 class="farsi">موضوع: {{$value->subject}}</h5>
                <p class="farsi">{{$value->content}}</p>
              </div>
              <div class="col-md-2"></div>
            </div>
            <hr/>
          @endif
        @endforeach

        <br/>
      @endif
      <br/>
    </section>
  @endsection

  @section( 'body_scripts' )
    @if($comment_status=='active')
      <script>
      function comment_language_change( language ) {
        if ( language == 'au' ) {
          $('#comment_section').html('<input type="hidden" name="comment_language" value="au"><div class="form-group"><div class="row"><div class="col-md-1"></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark">Name:</label></div><input class="form-control" name="comment_name" type="text" required/></div></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark">email:</label></div><input class="form-control" name="comment_email" type="email"required/></div></div><div class="col-md-1"></div></div></div><div class="form-group"><div class="row"><div class="col-md-1"></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark">Subject:</label></div><input class="form-control" name="comment_subject" type="text" required/></div></div><div class="col-md-1"></div></div></div><div class="form-group"><div class="row"><div class="col-md-1"></div><div class="col-md-10"><textarea name="comment_content" style="min-width:100%;width:100%" rows="5"></textarea></div><div class="col-md-1"></div></div></div><div class="form-group"><div class="row"><div class="col-md-3"></div><div class="col-md-6"><button class="btn btn-success">Submit</button><button class="btn btn-danger" type="reset">Reset</button></div><div class="col-md-3"></div></div></div>');
        } else {
          $('#comment_section').html('<input type="hidden" name="comment_language" value="fa"><div class="form-group" style="direction:rtl"><div class="row"><div class="col-md-1"></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark farsi">نام شما:</label></div><input class="form-control farsi" name="comment_name" type="text" required/></div></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark farsi">ایمیل:</label></div><input class="form-control farsi" name="comment_email" type="email"required/></div></div><div class="col-md-1"></div></div></div><div class="form-group" style="direction:rtl"><div class="row"><div class="col-md-1"></div><div class="col-md"><div class="input-group"><div class="input-group-prepend"><label class="input-group-text text-dark farsi">موضوع:</label></div><input class="form-control farsi" name="comment_subject" type="text" required/></div></div><div class="col-md-1"></div></div></div><div class="form-group" style="direction:rtl"><div class="row"><div class="col-md-1"></div><div class="col-md-10"><textarea class="farsi" name="comment_content" style="min-width:100%;width:100%" rows="5"></textarea></div><div class="col-md-1"></div></div></div><div class="form-group text-right" style="direction:rtl"><div class="row"><div class="col-md-3"></div><div class="col-md-6"><button class="btn btn-success farsi">ارسال</button><button class="btn btn-danger farsi" type="reset">از نو</button></div><div class="col-md-3"></div></div></div>');
        }
      }
      $(document).ready(function(){
        comment_language_change( 'fa' );
      });
      </script>
    @endif
  @endsection
