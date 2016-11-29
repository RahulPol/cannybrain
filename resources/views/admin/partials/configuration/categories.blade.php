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
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div id="createResponse" class="form-group text-center" style="display:none">
                                                    <span class="help-block">        
                                                                                                        
                                                    </span>
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
                                            
                                                <table id="categoryDetails" class="table table-bordered table-hover" >
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                Name
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
                                        <div id='categoryDetailsOverlay' class="overlay" style="display:none">
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
            var url = "/a/configuration/categories",
                categoriesDetails = [];

            //setup token for session so that token mismatch error is avoided;
            //As this is done on function ready. This is a global setup for token.
            $.ajaxSetup({                                    
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            //Initialize Category page with category details using ajax call.
            var getAllCategories = function(){                

                var getAllCategoriesUrl = url + "/getAllCategories",
                    type= "Get",
                    dataType = "json";                
                
                $.ajax({
                    type:type,
                    url:getAllCategoriesUrl,
                    dataType:dataType,
                    beforeSend:function(){
                        $('#categoryDetailsOverlay').css('display','block');
                    },
                    success:function(resp){
                        //append categoryDetails to data table
                        $('#categoryDetails').DataTable().destroy();
                        $('tbody').html('');

                        //retrieve categories in categoriesDetails array
                        if(resp.length > 0){
                            resp.forEach(function(category){
                                $('tbody').append("<tr id ='row-"+ category.id +"'>" 
                                    +"<td>"
                                        + category.name
                                    +"</td>"
                                    +"<td>"
                                        + category.user.name
                                    +"</td>"
                                    +"<td>"
                                        + moment(category.updated_at).format("MMM Do YY")
                                    +"</td>" 
                                    +"<td>"
                                        +'<div class="btn-group" role="group" aria-label="...">'                                        
                                        +'<image src="{{ asset("build/img/icons/edit-record.png") }}" style="color:yellow;width:2em;height:2em" aria-hidden="true" data-update-id="'+category.id+'"></i>'                                        
                                        +'<image src="{{ asset("build/img/icons/delete-record.png") }}" style="padding-left:1em;width:2em;height:2em" aria-hidden="true" data-delete-id = "'+category.id+'"></i>'
                                        +'</div>'
                                    +"</td>" 
                                +"</tr>");
                            });
                            
                             $('#categoryDetails').DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "ordering": true,
                                "order": [[ 2, "desc" ]],
                                "info": true,
                                "autoWidth": false                  
                            });   
                            $('#categoryDetailsOverlay').css('display','none');
                            
                        }else{
                            // TODO: Add No Data Available Watermark 
                        }
                    },
                    error:function(err){
                        $('#categoryDetailsOverlay').css('display','none');
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
                        $('#createResponse span').html('Category created successfully.');
                        $('#createResponse').slideDown().delay(1500).slideUp();

                    },
                    error:function(err){
                        $('#createCategoryOverlay').css('display','none');
                        console.log('error for category post...',err);
                        $('#createResponse').addClass('has-error');
                        $('#createResponse span').html("Erro while creating category.");
                        $('#createResponse').slideDown().delay(1500).slideUp();

                    }
                });
                



            })

            getAllCategories();
        });
    </script>
@endsection



