<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CannyBrain | @yield('title') </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
    {!! Html::style(elixir('css/app.css')) !!}
	{!! Html::style(elixir('css/utility.css')) !!}

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!--Write Custom Styles Here-->
    @yield('customStyle')
</head>

<body class= "@yield('bodyClass')">
    @yield('content')

    <!-- REQUIRED JS SCRIPTS -->
{!! Html::script(elixir('js/app.js')) !!}
{!! Html::script(elixir('js/utility.js')) !!}

@yield('customScript')
</body>