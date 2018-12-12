@extends('layouts.app')

@section('content')
  <br/>
  <br/>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">

          <div class="card-body">
            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <h6>
                  Your registered email-id is {{$user['email']}} , Please click on the below link to verify your email account
                </h6>
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <a class="btn btn-primary" href="{{url('user/verify', $user->verifyUser->token)}}">
                  Verify email
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
  <br/>
@endsection
