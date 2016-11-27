@extends('auth.layout')

@section('title','Registration')

@section('customStyle')
<!--Write Custom Styles Here-->
<style>	
	/*background image for register page*/
	.register-page {
		background-image: url("/build/img/background/cannybrain-background-9.jpg");
		background-repeat: no-repeat;
		background-attachment: fixed;
		background-size: cover;			
	}

	/*Override default margin to register box of Admin LTE*/
	.register-box{
		margin:5% auto;
	}

	.register-logo a{
		color:#fff;
	}

	.register-box-body{
		opacity:0.9;
	}
	
	/*End of Override*/

	/* Remove icon for dropdown*/
	.roleSelect {
		position: relative;
		display: block;		
	}

	select{
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
	}
	.roleSelect:after {
		content:"\f2bb";
		font-family: FontAwesome;
		color: #000;
		padding: 12px 8px;
		position: absolute; right: 15px; top: -4px;		
		z-index: 1;
		text-align: center;
		width: 10%;
		height: 100%;      
		pointer-events: none;
		box-sizing: border-box;
		font-weight: lighter !important;  		
	}

	
</style>
@endsection

@section('bodyClass','hold-transition register-page')

@section('content')						
<div class="register-box">
	<div class="register-logo">
		<a href="/"><b>Canny</b>Brain</a>
	</div>

	<div class="register-box-body">
		<p class="login-box-msg">Register a new membership</p>
		@if (count($errors) > 0)
		<div class="form-group has-error">						
			<strong>Whoops!</strong> There were problems with input.<br>					
				@foreach ($errors->all() as $error)
					<label class="control-lebel">
						<i class="fa fa-times-circle-o"></i>{{ $error }}
					</label>
				@endforeach
		</div>					
		@endif

			<!--@if (count($errors) > 0)
					{{ implode('', $errors->all('<div>:message</div>')) }}
			@endif-->


		<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" data-parsley-validate="" >
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}" required maxlength="255">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}" required>
				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<input class="form-control" placeholder="Mobile No." name="mobile_number"  value="{{ old('mobile_number') }}" required data-parsley-pattern="/^(\+\d{1,3}[- ]?)?\d{10}$/">
				<span class="fa fa-mobile fa-2x form-control-feedback"></span>
			</div>

			<div class="form-group">
				<label class="roleSelect">
					<select class="form-control" style="width: 100%;font-family:FontAwesome,Arial;font-weight: lighter;" name="role" required data-parsley-group='["user", "admin"]'>
						<!-- icon for choose a role &#xf2bb;-->
						<option value='' default>Choose a Role </option>
						<option value='user'>User</option>
						<option value='admin'>Admin</option>					
					</select>
				</label>								
			</div>			

			<div class="form-group has-feedback">
				<input id="userPassword" type="password" class="form-control" placeholder="Password" name="password" required minlength=6>
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Retype password" name="password_confirmation" data-parsley-equalto="#userPassword">
				<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
			</div>

			<div class="form-group has-feedback">
				<div class="col-md-6 ">
					{!! app('captcha')->display() !!}

					@if($errors->has('g-recaptcha-response'))
						<span class="help-block">
							<strong>{{$errors->first('g-recaptcha-response') }}</strong>
						</span>
					@endif
				</div>
			</div>

			<div class="row">
				<div class="col-xs-8">
				<!--<div class="checkbox icheck">
					<label>
					<input type="checkbox"> I agree to the <a href="#">terms</a>
					</label>
				</div>-->
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
				<button type="submit" class="btn btn-success btn-block btn-flat">Register</button>
				</div>
				<!-- /.col -->
			</div>
		</form>

		<div class="social-auth-links text-center">
		<!--<p>- OR -</p>
		<a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using
			Facebook</a>
		<a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign up using
			Google+</a>
		</div>-->

		<a href="/auth/login" class="text-center">I already have a membership</a>
	</div>
	<!-- /.form-box -->
	</div>
	<!-- /.register-box -->
</div>					
@endsection	

@section('customScript')
<script>
	//nnnynn$('.select2').select2();
</script>
@endsection