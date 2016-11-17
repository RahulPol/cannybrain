<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CannyBrain| Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    
    
    {!! Html::style(elixir('css/app.css')) !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page">						
		<div class="register-box">
			<div class="register-logo">
				<a href="../../index2.html"><b>Canny</b>Brain</a>
			</div>

			<div class="register-box-body">
				<p class="login-box-msg">Register a new membership</p>
				@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}" onsubmit="return validateNewUser();" >
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group has-feedback">
						<input type="text" class="form-control" placeholder="Full name" name="name" value="{{ old('name') }}">
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password" name="password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
						<span class="glyphicon glyphicon-log-in form-control-feedback"></span>
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
						<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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
	<!-- REQUIRED JS SCRIPTS -->
	{!! Html::script(elixir('js/app.js')) !!}
</body>
</html>

