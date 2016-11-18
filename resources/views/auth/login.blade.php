<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />    
    
    {!! Html::style(elixir('css/app.css')) !!}

	  {!! Html::style(elixir('css/utility.css')) !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!--Write Custom Styles Here-->
  <style>	
  	  /*background image for login page*/
	  .login-page {
			background-image: url("/build/img/background/cannybrain-background-3.jpg");
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;			
		}

		/*Override default margin to login box of Admin LTE*/
		.login-box{
			margin:3% auto;
		}

		.login-logo a{
			color:#fff;
		}

		.login-box-body{
			opacity:0.8;
		}

		/*End of Override*/
  </style>

</head>
<body class="hold-transition login-page">
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

<!-- REQUIRED JS SCRIPTS -->
{!! Html::script(elixir('js/app.js')) !!}
{!! Html::script(elixir('js/utility.js')) !!}

</body>
</html>
