<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "CannyBrain" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>   
    <link rel="icon" href="{!! url('build/img/favicon.ico') !!}"/>
    
    {!! Html::style(elixir('css/app.css')) !!}
    {!! Html::style(elixir('css/utility.css')) !!}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    @yield('customStyle')


</head>
<body class="hold-transition fixed skin-green sidebar-mini">
<div class="wrapper">

    <!-- Header -->
    @include('admin.layout.header')

    <!-- Sidebar -->
    @include('admin.layout.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div><!-- /.content-wrapper -->

    <!-- Footer -->
    @include('admin.layout.footer')

</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
{!! Html::script(elixir('js/app.js')) !!}
{!! Html::script(elixir('js/utility.js')) !!}
<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
@yield('customScript')      
</body>
</html>

