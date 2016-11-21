@extends('admin.layout.master')


@section('content')
    <section class="content-header">
        <h1>
            Dashboard
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">                
            <li class="active"><a href="/a"><i class="fa fa-dashboard"></i>Dashboard</a></li>                            
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        
        
    </section><!-- /.content -->
@endsection