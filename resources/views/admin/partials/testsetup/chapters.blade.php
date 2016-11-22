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
                    <li><a href="/a/testsetup/categories"><b>Categories</b></a></li>
                    <li  class= "active"><a href="/a/testsetup/chapters"><b>Chapters</b></a></li>
                    <li><a href="#questionbank"><b>Question Bank</b></a></li>                                                
                    </ul>
                    <div class="tab-content">
                        <div  class =  "tab-pane active" id="categories">                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-default box-solid ">
                                        <div class="box-header ">
                                            <h6 class="box-title">Add Chapter</h6>
                                            <div class="box-tools pull-right">
                                                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Categoies Count">0</span>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <form  class="" data-parsley-validate="">   
                                                <div  class="form-group has-feedback" style="font-size:12px">                        
                                                    <div class="col-md-2 col-md-offset-1"> 
                                                        <div class="pull-right" style="padding-top:10px"> Chapter Name:</div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" required>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <button type="submit" class="btn btn-primary btn-flat btn-sm ">Add Chapter</button>
                                                    </div>                                         
                                                </div>
                                            </form>
                                        </div><!-- /.box-body -->
                                </div><!-- /.box -->
                                </div>


                                <div class="col-md-12">
                                    <div class="box box-default box-solid">
                                        <div class="box-header with-border">
                                            <h6 class="box-title">Chapters</h6>
                                            <div class="box-tools pull-right">                    
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            
                                        </div><!-- /.box-body -->
                                        <!--<div class="overlay">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>-->
                                </div><!-- /.box -->
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection