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
            Configuration
            <small>{{ $page_description or null }}</small>
        </h1>
        <!-- You can dynamically generate breadcrumbs here -->
        <ol class="breadcrumb">                
            <li><a href="/a/dashboard"><i class="fa fa-home"></i>Home</a></li>
            <li><a href="/a/configuration/categories"><i class="fa fa-cogs"></i>Configuration</a></li>
            <li class="active"><i class="fa fa-book"></i>Categoies</li>                            
        </ol>            
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- Custom Tabs -->
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                    <li class= "active"><a href="/a/configuration/categories"><b>Categories</b></a></li>
                    <li><a href="/a/configuration/chapters"><b>Chapters</b></a></li>
                    <li><a href="/a/configuration/questionbank"><b>Question Bank</b></a></li>                                                
                    </ul>
                    <div class="tab-content">
                        <div  class = "tab-pane active" id="categories" >                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-default box-solid ">
                                        <div class="box-header ">
                                            <h6 class="box-title">Add Category</h6>
                                            <div class="box-tools pull-right">
                                                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Categoies Count">0</span>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <form  id="categoryForm" class="" data-parsley-validate=""> 
                                                
                                                <div id="createResponse" class="form-group">
                                                    <span class="help-block"></span>
                                                </div>

                                                <div  class="form-group has-feedback" style="font-size:12px">                        
                                                    <div class="col-md-2 col-md-offset-1"> 
                                                        <div class="pull-right" style="padding-top:10px"> Category Name:</div>
                                                    </div> 
                                                    <div class="col-md-6">
                                                        <input id="categoryName" type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" required>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <button id="btnSubmitCategory" type="submit" class="btn btn-primary btn-flat btn-sm ">Add Category</button>
                                                    </div>                                         
                                                </div>
                                            </form>
                                        </div><!-- /.box-body -->
                                        <div id="createCategoryOverlay" class="overlay" style="display:none" > 
                                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                        </div>
                                </div><!-- /.box -->
                                </div>


                                <div class="col-md-12">
                                    <div class="box box-default box-solid">
                                        <div class="box-header with-border">
                                            <h6 class="box-title">Categories</h6>
                                            <div class="box-tools pull-right">                    
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            
                                        </div><!-- /.box-body -->
                                        <div class="overlay">
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
    <meta name="_token" content="{!! csrf_token() !!}" />

@endsection

@section('customScript')
<script>
        $(function(){            
            var url = "/a/configuration/categories";

            //setup token for session so that token mismatch error is avoided;
            //As this is done on function ready. This is a global setup for token.
            $.ajaxSetup({                                    
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //Initialize Category page with category details using ajax call.
            var getAllCategories = function(){
                var categoriesDetails =[]; 

                var getAllCategoriesUrl = url + "/getAllCategories",
                    type= "Get",
                    dataType = "json";

                $.ajax({
                    type:type,
                    url:getAllCategoriesUrl,
                    dataType:dataType,
                    success:function(resp){
                        console.log("Categories details...",resp);
                    },
                    error:function(err){

                    }
                });
            }

            //Create new category
            $('#btnSubmitCategory').on('click',function(e){   
                e.preventDefault(); //STOP default action
                
                var createCategoryUrl = url ,
                formData = {
                    categoryName: $('#categoryName').val()          
                },
                type="Post",
                dataType="json";                

                $.ajax({
                    type:type,
                    url:createCategoryUrl,
                    data:formData,
                    dataType:dataType,
                    beforeSend:function(){
                        $('#createCategoryOverlay').css('display','block');
                    },
                    success:function(resp){
                        console.log('response...',resp);
                        $('#createCategoryOverlay').css('display','none');
                        $('#createResponse').addClass('has-success');
                        $('#createResponse span').append('Category created successfully.')
                    },
                    error:function(err){
                        $('#createCategoryOverlay').css('display','none');
                        console.log('error for category post...',err);
                        $('#createResponse').addClass('has-error');
                        $('#createResponse span').append(err.responseJSON.message);
                    }
                });
                



            })

            getAllCategories();
        });
    </script>
@endsection



