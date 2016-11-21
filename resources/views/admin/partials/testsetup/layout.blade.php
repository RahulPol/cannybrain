@extends('admin.layout.master')

@section('customStyle')
    <style>
        .nav-tabs-custom>.nav-tabs>li.active{
            border-top-color:#00A65A;
        }

        .box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title{
            font-size:13px;
        }
    </style>

    
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Test Setup
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">                
            <li class="active"><a href="/a"><i class="fa fa-cogs"></i>Test Setup</a></li>                            
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class="active"><a href="#categories" data-toggle="tab"><b>Categories</b></a></li>
                    <li><a href="#chapters" data-toggle="tab"><b>Chapters</b></a></li>
                    <li><a href="#questionbank" data-toggle="tab"><b>Question Bank</b></a></li>                            
                    </ul>
                    <div class="tab-content">
                    <div class="tab-pane active" id="categories">
                       @include('admin.partials.testsetup.categories')
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="chapters">
                       
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="questionbank">
                       
                    </div>
                    <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection