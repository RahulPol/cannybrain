@extends('admin.layout.master')

@section('customStyle')
{!! Html::style(elixir('css/dataTables.css')) !!}
    <style>
        .nav-tabs-custom>.nav-tabs>li.active{
            border-top-color:#00A65A;
        }

        .box-header>.fa, .box-header>.glyphicon, .box-header>.ion, .box-header .box-title{
            font-size:13px;
        }

        .table{
            font-size:12px;
        }

        .box.box-solid.box-custom>.box-header{
            color: black;            
            background-color: white !important;
            border-bottom:1px solid rgba(0,0,0,0.1)
        }

        #btnAddQuestion{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        .dropdown-menu li:hover{
            background-color:rgba(0,166,90,0.4) !important;
            color:white !important;
        }
    </style>

    
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Configuration
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">                
            <li><a href="/a/dashboard"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="/a/configuration/categories"><i class="fa fa-cogs"></i>Configuration</a></li>
            <li class="active"><i class="fa fa-book"></i>Question Bank</li>                                
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li><a href="/a/configuration/categories"><b>Categories</b></a></li>
                    <li><a href="/a/configuration/chapters"><b>Chapters</b></a></li>
                    <li class= "active" ><a href="/a/configuration/questionbank"><b>Question Bank</b></a></li>                                                
                    </ul>
                    <div class="tab-content">
                        <div  class =  "tab-pane active" id="categories">                       
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="box box-default box-solid box-custom">
                                        <div class="box-header with-border">
                                            <h6 class="box-title"><b>Question Details</b></h6>
                                            <div class="box-tools pull-right">                                                                    
                                                <div class="btn-group open">
                                                    <button type="button" class="btn btn-success"> <i class="fa fa-plus"></i> Add Question </button>
                                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu">
                                                        <li><a href="/a/configuration/questionbank/mcq?action=create">MCQ</a></li>
                                                        <li><a href="/a/configuration/questionbank/tf">True/False</a></li>
                                                        <li><a href="/a/configuration/questionbank/essay">Essay</a></li>                                                        
                                                    </ul>
                                                </div>                                              
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            
                                        </div><!-- /.box-body -->
                                        <div id='questionDetailsOverlay' class="overlay" style="display:none">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>
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

@section('customScript')
{!! Html::script(elixir('js/dataTables.js')) !!}

<script>
    $(function(){
        $('#btnAddQuestion').on('click',function(){
            var mcqUrl = "/a/configuration/questionbank/mcq?action=create";
            window.location.href = mcqUrl;
        });
    });
</script>

@endsection