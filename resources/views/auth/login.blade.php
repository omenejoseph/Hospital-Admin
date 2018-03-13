@extends('layouts.login')


@section('content')

<form method="POST" action="{{ route('login') }}">
                        @csrf
      <div class="form-group has-feedback">
        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="invalid-feedback">
                     <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback">
      <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
        <div class="checkbox">
            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
        </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          
        </div>
        <div class="col-xs-8">
          <a class="btn btn-link" href="{{ route('password.request') }}">
                Forgot Your Password?
          </a>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-4">
                   <a href="{{url('/redirect')}}" class="btn btn-primary">Login with Facebook</a>
          </div>
        </div>
        <!-- /.col -->
      </div>
    </form>


@stop