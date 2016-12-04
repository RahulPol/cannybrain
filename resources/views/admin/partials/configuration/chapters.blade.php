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

        #btnSubmitChapter{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        #btnEditChapter:hover{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        /* Override select 2*/

        /* remove border radius added by select2 to main select */
        .select2-container--default .select2-selection--single{
            border-radius:0px !important;
            border: 1px solid rgba(0,0,0,0.2);
        }

        /* provide theme background color for highlighted elements in select2 dropdown */
        .select2-container--default .select2-results__option--highlighted[aria-selected]{
            background-color:rgba(0,166,90,0.4) !important;            
        }

        /* placeholder style*/
        .select2-container .select2-selection--single .select2-selection__rendered{
            padding-left:0px !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__placeholder{
            line-height:25px !important;
        }

        /*End of placeholder*/

        /* End of Override*/
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
            <li class="active"><i class="fa fa-book"></i>Chapters</li>                            
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
                    <li  class= "active"><a href="/a/configuration/chapters"><b>Chapters</b></a></li>
                    <li><a href="/a/configuration/questionbank"><b>Question Bank</b></a></li>                                                
                    </ul>
                    <div class="tab-content">
                        <div  class =  "tab-pane active" id="categories">                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="box box-default box-custom box-solid ">
                                        <div class="box-header ">
                                            <h6 class="box-title"><b>Add Chapter</b></h6>
                                            <div class="box-tools pull-right">
                                                <span data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Categoies Count">0</span>
                                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            <form  class="">   
                                                <div  class="form-group has-feedback" style="font-size:12px">
                                                    <meta name="_token" content="{!! csrf_token() !!}" />   
                                                    <div id="createResponse" class="form-group text-center" style="display:block;height:10px;">
                                                        <span class="help-block">                                                                                                        
                                                        </span>
                                                    </div>                                                                                                                                
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <input id="chapterName" type="text" placeholder="Enter Chapter Name" class="form-control input-sm" name="name" required>
                                                    </div>
                                                    <br>
                                                    <br>                                                                                                        
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <select id="categorySelect" class="form-control select2" style="width: 100%;">
                                                        </select>
                                                    </div>
                                                    <br>
                                                    <br>
                                                                                                        
                                                    <div class="col-md-6 col-md-offset-3">
                                                        <button id="btnSubmitChapter" type="submit" class="btn btn-flat btn-sm col-md-3 pull-left">Add Chapter</button>
                                                    </div>                                         
                                                </div>
                                            </form>
                                        </div><!-- /.box-body -->
                                        <div id="createChapterOverlay" class="overlay" style="display:none" > 
                                            <i class="fa fa-spinner fa-pulse fa-fw"></i>
                                        </div>                                        
                                </div><!-- /.box -->
                                </div>


                                <div class="col-md-12">
                                    <div class="box box-default box-custom box-solid">
                                        <div class="box-header with-border">
                                            <h6 class="box-title"><b>Chapters</b></h6>
                                            <div class="box-tools pull-right">                    
                                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                                            </div><!-- /.box-tools -->
                                        </div><!-- /.box-header -->
                                        <div class="box-body">
                                            
                                        </div><!-- /.box-body -->
                                        <div id='chapterDetailsOverlay' class="overlay" style="display:none">
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
        var url = "/a/configuration/chapters",
                categoriesDetails = [],
                chaptersDetails =[];

        //setup token for session so that token mismatch error is avoided;
        //As this is done on function ready. This is a global setup for token.
        $.ajaxSetup({                                    
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

         //Initialize Category Select2 with category details using ajax call.
        var getAllCategories = function(){                
            
            var getAllCategoriesUrl = "/a/configuration/categories/getCategoriesDropdown",
                type= "Get",
                dataType = "json";                
                                
            $.ajax({
                type:type,
                url:getAllCategoriesUrl,
                dataType:dataType,
                beforeSend:function(){
                    $('#createChapterOverlay').css('display','block');
                },
                success:function(resp){
                    console.log('category details...',resp);
                    categoriesDetails = resp;
                    //retrieve categories in categoriesDetails array
                    if(resp.length > 0){
                        resp.forEach(function(category){
                            $("#categorySelect").append("<option value="+category.id+">"+category.name+"</option>")
                        })                            
                    }
                    
                    //Create category seclect 2
                    $("#categorySelect").select2({
                        placeholder:"Select Category"                                              
                    });

                    //use following for resetting select2
                    $("#categorySelect").val('').trigger('change');

                    
                    $('#createChapterOverlay').css('display','none');
                },
                error:function(err){                        
                    $('#createChapterOverlay').css('display','none');

                    console.log('error in fetching category..',err);
                }
            });
        };

        getAllCategories();

        var getAllChapters = function(){                
            
            var getAllChaptersUrl = url + "/getAllChapters",
                type= "Get",
                dataType = "json";                
                                
            $.ajax({
                type:type,
                url:getAllChaptersUrl,
                dataType:dataType,
                beforeSend:function(){
                    $('#chapterDetailsOverlay').css('display','block');
                },
                success:function(resp){
                    console.log('chapter details...',resp);
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

        getAllChapters();        

        //Create new category
        $('#btnSubmitChapter').on('click',function(e){   
            e.preventDefault(); //STOP default action
            
            
            var formData = {
                name: $('#chapterName').val(),
                category_id:$('#categorySelect').val()     
            },
            type="POST",
            dataType="json";
            console.log("form data...",formData);

            if(formData.name == '' || formData.name == 'null' || formData.name == 'undefined'){
                $('#createResponse').addClass('has-error');
                $('#createResponse span').html("Invalid chapter name.");
                setTimeout(" $('#createResponse').removeClass('has-error');$('#createResponse span').html('');",1500);
                
                return;
            }   

            if(formData.category_id == '' || formData.category_id == null || formData.category_id == undefined){
                $('#createResponse').addClass('has-error');
                $('#createResponse span').html("Invalid category name.");
                setTimeout(" $('#createResponse').removeClass('has-error');$('#createResponse span').html('');",1500);
                
                return;
            }     

            function successCallback(){
                $('#createResponse span').html('');
                $('#createResponse').removeClass('has-success');
                $('#chapterName').val('');
                //getAllChapters();
            }

            function errorCallback(){         
                $('#createResponse').removeClass('has-error');
                $('#createResponse span').html('');    
                $('#chapterName').val("");                                                         
            } 
            
            $.ajax({
                type:type,
                url:url,
                data:formData,
                dataType:dataType,
                beforeSend:function(){
                    $('#createChapterOverlay').css('display','block');
                },
                success:function(resp){                        
                    $('#createChapterOverlay').css('display','none');
                    $('#createResponse').addClass('has-success');
                    $('#createResponse span').html('<i class="fa fa-check"></i><b>Chapter created successfully.</b>'); 
                    setTimeout(successCallback,1500);
                },
                error:function(err){
                    $('#createChapterOverlay').css('display','none');
                    console.log('Add Error...',err);
                    $('#createResponse').addClass('has-error');
                    var errMessage = err.responseJSON != undefined ? err.responseJSON.errors : 'Error while createing chapter';
                    $('#createResponse span').html(errMessage);
                    setTimeout(errorCallback,2000);                                            
                }
            });                                
        });        
        

      
    });
</script>
@endsection