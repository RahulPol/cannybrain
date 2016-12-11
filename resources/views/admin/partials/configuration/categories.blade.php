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

        #btnSubmitCategory{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        #btnEditCategory:hover{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        .curtain-class{
            position: fixed;
            background: black;
            opacity: 0.5;
            top: 0px;
            left: 0px;
            height: 100%;
            width: 100%;
            z-index: 998;
            display: 'block';
        }


        .custom-popover.popover{
            z-index: 999;
        }

        .custom-popover.popover .popover-content{
            width: 17em;
            padding-left: 10px;
        }
        .custom-popover .popover-title{
            color: white;
            background: #00A65A;
        }
        .sharp-borders{
            border-radius: 0px !important;
        }

        .custom-popover h3.popover-title{
            line-height: 18px;
            padding-bottom: 8px
        }
        .custom-popover-modal.modal{
            z-index:9999 !important;
        }

        .custom-popover .btn{
            border-radius: 0px !important;
        }

        .custom-popover .closeBtn{
            position: absolute;
            top: -11px;
            right: -11px;
            width: 22px;
            height: 22px;
            border: 2px solid;
            border-radius: 15px !important;
            text-align: center;            
            box-shadow: 2px 2px 6px#111;
        }

        .custom-popover.popover .popover-content .overlay{
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

         .custom-popover.popover .popover-content .overlay .fa{
            position: absolute;
            top: 50%;
            left: 50%;
            margin-left: -15px;
            margin-top: -15px;
            color: #000;
        }

        .static-element{
            position: relative;
            z-index: 9999 !important;
            background: #F3F3F3;
            box-shadow:0px 0px 28px 0px rgba(50, 50, 50, 0.75);
        }

        tbody tr:hover{
            background-color:rgba(0,166,90,0.1) !important;
        }

        /*Override style of paging in datatable*/
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
            background-color: rgba(0,166,90,0.8) !important;
            border-color: gray;
        }
        /*Override Complete*/
        
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
                                    <div class="box box-custom box-default box-solid ">
                                        <div class="box-header ">
                                            <h6 class="box-title"><b>Add Category</b></h6>
                                            <div class="box-tools pull-right">
                                                <span id="categoryCount" data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Categoies Count">0</span>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                        

                                            <form  id="categoryForm" class=""> 
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <div id="createResponse" class="form-group text-center" style="display:block;height:10px;">
                                                    <span class="help-block">                                                                                                        
                                                    </span>
                                                </div>
                                                
                                                <div  class="form-group has-feedback" style="font-size:12px">                        
                                                    
                                                    <div class="col-md-6 col-md-offset-2">
                                                        <input id="categoryName" type="text" placeholder="Enter Category Name" class="form-control input-sm" name="name"  required>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <button id="btnSubmitCategory" type="submit" class="btn  btn-flat btn-sm ">Add Category</button>
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
                                    <div class="box box-custom box-default box-solid">
                                        <div class="box-header with-border">
                                            <h6 class="box-title"><b>Categories</b></h6>
                                            <div class="box-tools pull-right">                    
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            
                                            <table id="categoryDetails" class="table table-bordered table-hover">
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
{!! Html::script(elixir('js/dataTables.js')) !!}
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
                        console.log('category details...',resp);
                        categoriesDetails = resp;
                        //append categoryDetails to data table
                        $('#categoryDetails').DataTable().destroy();
                        $('tbody').html('');

                        //retrieve categories in categoriesDetails array
                        if(resp.length > 0){
                            $('#categoryCount').html(resp.length);

                            resp.forEach(function(category){
                                $('tbody').append("<tr>" 
                                    +"<td id=category-name-"+category.id+">"
                                        + category.name
                                    +"</td>"
                                    +"<td>"
                                        + category.company.name
                                    +"</td>"
                                    +"<td>"
                                        + category.user.name
                                    +"</td>"
                                    +"<td>"
                                        + moment(category.updated_at).format("MMM Do YY")
                                    +"</td>" 
                                    +"<td>"
                                        +'<div class="btn-group" role="group" aria-label="...">'
                                        +'<span  class="editCategory" style="cursor:pointer"> <i class="fa fa-lg fa-pencil" data-update-id="'+category.id+'"></i></span>'                                        
                                        +'<span  class="deleteCategory" style="cursor:pointer;padding-left:10px"> <i class="fa fa-lg fa-trash" data-delete-id="'+category.id+'"></i></span>'
                                        +'</div>'
                                    +"</td>" 
                                +"</tr>");
                            });
                            
                             $('#categoryDetails').DataTable({
                                "paging": true,
                                "lengthChange": true,
                                "searching": true,
                                "ordering": true,
                                "order": [[ 3, "desc" ]],
                                "info": true,
                                "autoWidth": false,
                                "columnDefs": [ {
                                    "targets": 4,
                                    "orderable": false
                                } ]             
                            });   

                            $('.editCategory').bind('click',editCategory);

                            $('.deleteCategory').bind('click',deleteCategory);                            
                            
                        }else{
                            // TODO: Add No Data Available Watermark 
                        }
                        $('#categoryDetailsOverlay').css('display','none');
                    },
                    error:function(err){                        
                        $('#categoryDetailsOverlay').css('display','none');
                    }
                });
            };
            getAllCategories();

            //Create new category
            $('#btnSubmitCategory').on('click',function(e){   
                e.preventDefault(); //STOP default action
                
                
                var createCategoryUrl = url ,
                formData = {
                    name: $('#categoryName').val()          
                },
                type="POST",
                dataType="json";

                if(formData.name == '' || formData.name == 'null' || formData.name == 'undefined'){
                    $('#createResponse').addClass('has-error');
                    $('#createResponse span').html("Invalid category name.");
                    setTimeout(" $('#createResponse').removeClass('has-error');$('#createResponse span').html('');",1500);
                   
                    return;
                }               

                function successCallback(){
                   $('#createResponse span').html('');
                   $('#createResponse').removeClass('has-success');
                   $('#categoryName').val('');
                   getAllCategories();
                }

                function errorCallback(){         
                    $('#createResponse').removeClass('has-error');
                    $('#createResponse span').html('');    
                    $('#categoryName').val("");                                                         
                } 
                
                $.ajax({
                    type:type,
                    url:createCategoryUrl,
                    data:formData,
                    dataType:dataType,
                    beforeSend:function(){
                        $('#createCategoryOverlay').css('display','block');
                    },
                    success:function(resp){                        
                        $('#createCategoryOverlay').css('display','none');
                        $('#createResponse').addClass('has-success');
                        $('#createResponse span').html('<i class="fa fa-check"></i><b>Category created successfully.</b>'); 
                        setTimeout(successCallback,1500);
                    },
                    error:function(err){
                        $('#createCategoryOverlay').css('display','none');
                        console.log('Add Error...',err);
                        $('#createResponse').addClass('has-error');
                        $('#createResponse span').html(err.responseJSON.errors);
                        setTimeout(errorCallback,2000);                                            
                    }
                });                                
            });

            //Edit category
            function editCategory(event){ 
                
                var target = $(event.target);                
                var category = {};
                categoriesDetails.forEach(function(row){
                    if(row.id == target.attr('data-update-id')){
                        category = row;
                    }
                });

                var popoverTemplate = "<div id='' class=\"popover custom-popover sharp-borders\"> <div class=\"arrow\"></div>   <h3 class=\"popover-title sharp-borders\"></h3> <div class=\"popover-content container-fluid\"></div></div>";                    
                var popoverContent =
                    '<form id="categoryEditForm" data-parsley-validate="">'+
                    '<div id="editResponse" class="form-group text-center" style="display:none;height:10px;">'+
                    '<span class="help-block"></span>'+                                                                                                                                                            
                    '</div>'+
                    '<input type="hidden" name="_token" value="{{ csrf_token() }}">'+
                    '<div  class="form-group has-feedback" style="font-size:12px">'+                    
                    '<div><input id="categoryEditName" type="text" class="form-control input-sm" name="name" value="'+ category.name +'" required></div>'+
                    '<br>'+
                    '<div class="pull-right">'+
                    '<button id="btnEditCategory" type="submit" class="btn  btn-xs">Update</button>'+                    
                    '</div>'+
                    '</div>'+                    
                    '</form>'+
                    '<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>';

                var nameField = $('#category-name-'+category.id);

                 nameField.popover({
                    title: 'Category Name<button class=\" btn btn-danger btn-xs pull-right closeBtn\">X</button>',
                    template: popoverTemplate,
                    content: popoverContent,
                    html: true,
                    placement: 'top',
                    trigger:'click',
                    container: 'body'
                });
                
                nameField.popover('show');
                
                $('body').append('<div class="curtain-class"></div>');

                $('.curtain-class').on('click',function(){
                    nameField.popover('hide');
                    $('.curtain-class').remove();
                });          

                $('.custom-popover .closeBtn').on('click',function(){
                    nameField.popover('hide');
                    $('.curtain-class').remove();
                });

                $('.custom-popover #btnEditCategory').off('click');
                $('.custom-popover #btnEditCategory').on('click',function(e){                    
                    e.preventDefault();

                    var updateCategoryUrl = url ,
                        formData = {
                            category_id:category.id,
                            name: $('#categoryEditName').val()       
                        },
                        type="PUT",
                        dataType="json";

                    if(formData.name == '' || formData.name == 'null' || formData.name == 'undefined'){
                        $('#editResponse').addClass('has-error');
                        $('#editResponse span').html("Invalid category name.");
                        $('#editResponse').css('display','block');
                        setTimeout(" $('#editResponse').removeClass('has-error');$('#editResponse').css('display','none');$('#editResponse span').html('');$('#categoryEditName').val('"+category.name+"');",1500);

                        return;
                    } 

                    function successCallback(){
                        nameField.popover('hide');
                        $('.curtain-class').remove();                        
                        $('#editResponse').removeClass('has-success');
                        $('#editResponse').css('display','none');
                        $('#editResponse span').html('');
                        getAllCategories();
                    }

                    function errorCallback(){                              
                        $('#editResponse').removeClass('has-error');
                        $('#editResponse').css('display','none');
                        $('#editResponse span').html('');  
                        $('#categoryEditName').val(category.name);                      
                    }

                    $.ajax({
                        type:type,
                        url:updateCategoryUrl,
                        data:formData,
                        dataType:dataType,
                        beforeSend:function(){
                            $('.custom-popover.popover .popover-content .overlay').css("display","block");
                        },
                        success:function(resp){                       
                            $('.custom-popover.popover .popover-content .overlay').css("display","none");     
                            $('#editResponse').addClass('has-success');
                            $('#editResponse span').html("Category updated successfully.");
                            $('#editResponse').css('display','block');
                            setTimeout(successCallback,1500);
                            
                        },
                        error:function(err){                                                      
                            $('.custom-popover.popover .popover-content .overlay').css("display","none");
                            $('#editResponse').addClass('has-error');
                            $('#editResponse span').html(err.responseJSON.errors);
                            $('#editResponse').css('display','block');
                            setTimeout(errorCallback,1500);
                            console.log("Update error...",err);
                        }
                    })                   
                })
            }

            //Delete category
            function deleteCategory(event){
                var target = $(event.target);
                var category = {};
                categoriesDetails.forEach(function(row){
                    if(row.id == target.attr('data-delete-id')){
                        category = row;
                    }
                });

               
                $.confirm({
                    title: 'Delete Category!',
                    content: 'Are you sure?',
                    animation: 'scaleY',
                    icon:'fa fa-warning',
                    type:'red',
                    theme:'light',
                    typeAnimated: true,
                    backgroundDismiss: true,
                    closeIcon: true,
                    closeIconClass: 'fa fa-close', 
                    buttons: {
                        confirm:{
                            text:'Okay',
                            btnClass:'btn-danger',
                            action:function() {                                
                                var deleteCategoryUrl = url ,
                                    formData = {
                                        category_id:category.id                                               
                                    },
                                    type="DELETE",
                                    dataType="json";

                                $.ajax({
                                    type:type,
                                    url:deleteCategoryUrl,
                                    data:formData,
                                    dataType:dataType,
                                    beforeSend:function(){
                                        $('#categoryDetailsOverlay').css('display','block');
                                    },
                                    success:function(resp){                            
                                        $('#categoryDetailsOverlay').css('display','none');
                                        getAllCategories();
                                    },
                                    error:function(err){
                                        $('#categoryDetailsOverlay').css('display','none');
                                        console.log("Delete error...",err);
                                    }
                                });
                            }
                        },
                        
                    }
                });



            }
            
        });
    </script>
@endsection



