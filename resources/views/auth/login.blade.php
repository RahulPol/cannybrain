@extends('auth.layout')

@section('title','Login')

@section('customStyle')
<style>	
	/*background image for login page*/
	.login-page {
		background-image: url("/build/img/background/cannybrain-background-9.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;			
	}

	/*Override default margin to login box of Admin LTE*/
	.login-box{
		margin:9% auto;
	}

	.login-logo a{
		color:#fff;
	}

	.login-box-body{
		opacity:0.9;
	}

	/*End of Override*/
</style>
@endsection

@section('bodyClass','hold-transition login-page')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>CannyBrain</b> Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in as CannyBrain Admin</p>
    @if (count($errors) > 0)
    <div class="form-group has-error">						      					       
          <label class="control-lebel">
            Incorrect Email Address or Password. Try Again..
          </label>       
    </div>					
    @endif

    <form action="{{ url('/auth/login') }}" method="post" data-parsley-validate="">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required> 
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" required minlength=6>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox">
            <label>
              <input type="checkbox" name="remember"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-success btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    <br>
    

    <a href="{{ url('/password/email') }}">I forgot my password</a><br>
    <a href="/auth/register" class="text-center">Register a new membership</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@endsection


