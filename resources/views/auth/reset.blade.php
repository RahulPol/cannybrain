<html>
<head>
    <meta charset="UTF-8">
    <title>Cannybrain | Reset Password</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>   
    
    {!! Html::style(elixir('css/app.css')) !!}
	{!! Html::style(elixir('css/utility.css')) !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<style>
		body{
			background-color:#ECF0F5
		}
		.reset-box{
			position:absolute;
			top:20%;
			bottom:0;
			left:35%;
			right:0;
			margin:auto;
		}
	</style>

</head>
<body class="hold-transition skin-green">

<div class=''>
  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">      
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
     
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
         <li><a href="/auth/register">Register</a></li>
		 <li><a href="/auth/login">Login</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="reset-box">
  	<div class="col-xs-6 col-offset-xs-5">	
	  <div class="box box-default">
	  <div class="box-header with-border">
          <h3 class="box-title">Reset Password</h3>
        </div>
	  	<div class="box-body">

			@if (count($errors) > 0)
			<div class="form-group has-error">						      					       
				<label class="control-lebel">
					Incorrect Email Address. Try Again..
				</label>       
			</div>					
			@endif

			<form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Reset Password
								</button>
							</div>
						</div>
					</form>

		</div>		
	  </div>
	</div>
  </div>

</div>

<!-- REQUIRED JS SCRIPTS -->
{!! Html::script(elixir('js/app.js')) !!}
{!! Html::script(elixir('js/utility.js')) !!}
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>