@extends('light-bootstrap-dashboard::layouts.auth')

@section('content')
<div class="row" >
  <div class="col-md-8 col-md-offset-2" >
    <div class="auth-card card">      
      <div class="header">
        <img src="{{URL::to('images/logo-toko-aisyah.png')}}" height="110px" width="720px" id="logo-toko-aisyah">
        <hr>
        <h4 class="title text-center">Login</h4>        
      </div>      
      <div class="content">
        <form action="{{ route('login') }}" method="POST">
          {{ csrf_field() }}
            <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
              <label for="username">Username</label>
              <input name="username" type="username" class="form-control" required>
              @if ($errors->has('username'))
              <span class="help-block">{{ $errors->first('username') }}</span>
              @endif
            </div>
            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control" required>
              @if ($errors->has('password'))
              <span class="help-block">{{ $errors->first('password') }}</span>
              @endif
            </div>
            <div class="form-group">
              <div>
                <label class="checkbox">
                  <input type="checkbox" data-toggle="checkbox"> Remember
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-fill btn-lg btn-success btn-block">Login</button>
            {{-- <a href="{{ route('register') }}" class="btn btn-fill btn-lg btn-default btn-block">Register</a> --}}
            {{-- <div class="text-right">
              <a href="{{ route('password.request') }}" class="text-muted">Forgot Password</a>
            </div> --}}
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
