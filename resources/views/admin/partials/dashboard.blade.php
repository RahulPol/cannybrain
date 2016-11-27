@extends('admin.layout.master')


@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">
            <li class="active"><a href="/a/dashboard"><i class="fa fa-home"></i>Home</a></li>                
            <li class="active"><i class="fa fa-dashboard"></i>Dashboard</li>                            
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        
        
    </section><!-- /.content -->
@endsection