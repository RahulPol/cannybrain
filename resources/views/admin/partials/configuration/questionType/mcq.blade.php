@extends('admin.layout.master')

@section('customStyle')
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

        .content #questionOverlay.overlay{
            z-index: 9999;
            background: rgba(255,255,255,0.7);
            border-radius: 3px;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display:none;
        }

         .content #questionOverlay.overlay .fa{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -15px;
            margin-top: -15px;
            color: #000;
        }

    </style>

    
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Add Question
            <small>{{ $page_title or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">                
            <li><a href="/a/dashboard"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="/a/configuration/categories"><i class="fa fa-cogs"></i>Configuration</a></li>
            <li><a href="/a/configuration/questionbank"><i class="fa fa-book"></i>Question Bank</a></li>
            <li class="active"><i class="fa fa-plus"></i>Add Question</li>                                
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class= "active"><a href="/a/configuration/questionbank/mcq"><b>MCQ</b></a></li>
                    <li><a href="/a/configuration/questionbank/tf"><b>True False</b></a></li>
                    <li><a href="/a/configuration/questionbank/essay"><b>Essay</b></a></li>                                                
                    </ul>
                    <div class="tab-content">
                        <div  class =  "tab-pane active" id="categories">                       
                            <div class="row">
                                
                                <div id="mcq-container" class="mcq-container col-md-12">                                                                                                                                                
                                </div>                                

                                <div id="questionOverlay" class="overlay" style="display:none" > 
                                    <i class="fa fa-spinner fa-pulse fa-fw fa-3x"></i>
                                </div>

                                <div class="col-md-12">
                                    <div class="box box-custom box-default box-solid">
                                        <div class="box-header with-border">
                                            <h6 class="box-title"><b>Questions</b></h6>
                                            <div class="box-tools pull-right">                    
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <table id="questionDetails" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Name
                                                        </th>
                                                        <th>
                                                            Organization
                                                        </th>
                                                        <th>
                                                            Created By
                                                        </th>

                                                        <th>
                                                            Last Modified On
                                                        </th>

                                                        <th>
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div><!-- /.box-body -->
                                        <div id='questionDetailsOverlay' class="overlay" style="display:none">
                                            <i class="fa fa-refresh fa-spin"></i>
                                        </div>
                                </div><!-- /.box -->
                                </div>                                
                            </div>
                        </div>
                    <meta name="_token" content="{!! csrf_token() !!}" />   
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@section('customScript')
{!! Html::script(elixir('js/react.js')) !!}
<script src="{!! url('build/js/ckeditor/ckeditor.js') !!}"></script>
<script type="text/babel" src="{!! url('build/jsx/category.jsx') !!}"></script>
<script type="text/babel" src="{!! url('build/jsx/chapter.jsx') !!}"></script>
<script type="text/babel" src="{!! url('build/jsx/answerSelection.jsx') !!}"></script>
<script type="text/babel" src="{!! url('build/jsx/marks.jsx') !!}"></script>
<script type="text/babel" src="{!! url('build/jsx/mcq.jsx') !!}"></script>
<script>
    $(function(){
    
        $('#btnAddQuestion').on('click',function(){
            var mcqUrl = window.location.protocol + "//" +  window.location.hostname + "/ReactCKEditor/mcq.html"
            window.location.href = mcqUrl;
        });
    });
</script>

<script type="text/babel">    
        ReactDOM.render(
            <Board action="create" questionId="-1"></Board>,
            document.getElementById('mcq-container')
        );
    </script>

@endsection