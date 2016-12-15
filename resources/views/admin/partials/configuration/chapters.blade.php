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

        #btnEditChapter{
            background-color:rgba(0,166,90,0.8) !important;
            color:white;
        }

        

        tbody tr:hover{
            background-color:rgba(0,166,90,0.1) !important;
        }

        /*Override style of paging in datatable*/
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
            background-color: rgba(0,166,90,0.8) !important;
            border-color: gray;
        }
        /*End of Override*/

        .edit-chapter-modal .modal-dialog{
            margin-top:10% !important;
        }


        .edit-chapter-modal .modal-body .overlay{
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

         .edit-chapter-modal .modal-body .overlay .fa{
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
                                                <span id="chapterCount" data-toggle="tooltip" title="" class="badge bg-light-blue" data-original-title="Chapters Count">0</span>
                                            <button  class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
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
                                            <table id="chaptersDetails" class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            Name
                                                        </th>
                                                        <th>
                                                            Category
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

      <div class="edit-chapter-modal">
        <div id="editChapterModal" class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Chapter</h4>
              </div>
              <div class="modal-body">
                <form id="editChapterForm">
                    <div  class="form-group has-feedback" style="font-size:12px">
                        <meta name="_token" content="{!! csrf_token() !!}" />   
                        <div id="editResponse" class="form-group text-center" style="display:block;height:10px;">
                            <span class="help-block">                                                                                                        
                            </span>
                        </div>                                                                                                                                
                        <div class="col-md-10 col-md-offset-1">
                            <input id="newChapterName" type="text" placeholder="Enter Chapter Name" class="form-control input-sm" name="name" required>
                        </div>
                        <br>
                        <br>                                                                                                        
                        <div class="col-md-10 col-md-offset-1">
                            <select id="newCategorySelect" class="form-control select2" style="width: 100%;">
                            </select>
                        </div>
                        <br>
                        <br>
                                                                                                                                          
                    </div>                    
                </form>
                <div class="overlay"><i class="fa fa-refresh fa-spin fa-lg"></i></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button id="btnEditChapter" type="button" class="btn btn-sm">Save</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
      </div>
      <!-- /.example-modal -->
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
                    chaptersDetails = resp;
                    //append chapterDetails to data table
                    $('#chaptersDetails').DataTable().destroy();
                    $('tbody').html('');

                    //retrieve categories in categoriesDetails array
                    if(resp.length > 0){
                        $('#chapterCount').html(resp.length);

                        resp.forEach(function(chapter){
                            $('tbody').append("<tr>" 
                                +"<td id=chapter-name-"+chapter.id+">"
                                    + chapter.name
                                +"</td>"
                                +"<td>"
                                    + chapter.category.name
                                +"</td>"                                
                                +"<td>"
                                    + chapter.company.name
                                +"</td>"
                                +"<td>"
                                    + chapter.user.name
                                +"</td>"
                                +"<td>"
                                    + moment(chapter.updated_at).format("MMM Do YY")
                                +"</td>" 
                                +"<td>"
                                    +'<div class="btn-group" role="group" aria-label="...">'
                                    +'<span  class="editChapter" style="cursor:pointer"> <i class="fa fa-lg fa-pencil" data-update-id="'+chapter.id+'"></i></span>'                                        
                                    +'<span  class="deleteChapter" style="cursor:pointer;padding-left:10px"> <i class="fa fa-lg fa-trash" data-delete-id="'+chapter.id+'"></i></span>'
                                    +'</div>'
                                +"</td>" 
                            +"</tr>");
                        });
                        
                            $('#chaptersDetails').DataTable({
                            "paging": true,
                            "lengthChange": true,
                            "searching": true,
                            "ordering": true,
                            "order": [[ 4, "desc" ]],
                            "info": true,
                            "autoWidth": false,
                            "columnDefs": [ {
                                "targets": 5,
                                "orderable": false
                            } ]             
                        });   

                        $('.editChapter').bind('click',editChapter);

                        $('.deleteChapter').bind('click',deleteChapter);                            
                        
                    }else{
                        // TODO: Add No Data Available Watermark 
                    }
                    $('#chapterDetailsOverlay').css('display','none');
                },
                error:function(err){                        
                    $('#chapterDetailsOverlay').css('display','none');
                    console.log('chapter details error...',err);
                }
            });
        };

        getAllChapters();        

        //Create new chapter
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
                getAllChapters();
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

        //Edit Chapter
        //step 1: setup modal
        function editChapter(event){ 
            
            var target = $(event.target);                
            var chapter = {};
            chaptersDetails.forEach(function(row){
                if(row.id == target.attr('data-update-id')){
                    chapter = row;
                }
            });

            $('#editChapterModal').modal('show');

            $('#newChapterName').val(chapter.name);
            
            $("#newCategorySelect").html('');
            categoriesDetails.forEach(function(category){
                $("#newCategorySelect").append("<option id='"+category.name+"' value="+category.id+">"+category.name+"</option>");                
            })

            //Create category seclect 2
            $("#newCategorySelect").select2();//.select2("val",chapter.category.name);            
            
            //use following for resetting select2                        
            $("#newCategorySelect").select2('val',chapter.category.id.toString());


            //step 2: wire db call
            $('#btnEditChapter').off('click');
            $('#btnEditChapter').on('click',function(){
                var updateChapterUrl = url ,
                    formData = {  
                        chapter_id:chapter.id,                  
                        category_id:parseInt($("#newCategorySelect").select2('val')),
                        name: $('#newChapterName').val()       
                    },
                    type="PUT",
                    dataType="json";
                
                    function successCallback(){                                                                        
                        $('#editResponse').removeClass('has-success');
                        $('#editResponse').css('display','none');
                        $('#editResponse span').html('');
                        $('#editChapterModal').modal('hide');
                        getAllChapters();
                    }

                    function errorCallback(){                              
                        $('#editResponse').removeClass('has-error');
                        $('#editResponse').css('display','none');
                        $('#editResponse span').html('');  
                        $('#newChapterName').val(chapter.name);                      
                    }

                    $.ajax({
                        type:type,
                        url:updateChapterUrl,
                        data:formData,
                        dataType:dataType,
                        beforeSend:function(){
                            $('.edit-chapter-modal .modal-body .overlay').css("display","block");
                        },
                        success:function(resp){                       
                            $('.edit-chapter-modal .modal-body .overlay').css("display","none");     
                            $('#editResponse').addClass('has-success');
                            $('#editResponse span').html("Chapter updated successfully.");
                            $('#editResponse').css('display','block');
                            setTimeout(successCallback,1500);
                            
                        },
                        error:function(err){                                                      
                            $('.edit-chapter-modal .modal-body .overlay').css("display","none");
                            $('#editResponse').addClass('has-error');
                            var errMessage = err.responseJSON != undefined ? err.responseJSON.errors : 'Error while createing chapter';
                            $('#editResponse span').html(errMessage);
                            $('#editResponse').css('display','block');
                            setTimeout(errorCallback,2500);
                            console.log("Update error...",err);
                        }
                    })                   
                })
        
        }

        //Delete Chapter
        function deleteChapter(event){
            var target = $(event.target);
            var chapter = {};
            chaptersDetails.forEach(function(row){
                if(row.id == target.attr('data-delete-id')){
                    chapter = row;
                }
            });

            
            $.confirm({
                title: 'Delete chapter!',
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
                            var deletechapterUrl = url ,
                                formData = {
                                    chapterId:chapter.id                                               
                                },
                                type="DELETE",
                                dataType="json";

                            $.ajax({
                                type:type,
                                url:deletechapterUrl,
                                data:formData,
                                dataType:dataType,
                                beforeSend:function(){
                                    $('#chapterDetailsOverlay').css('display','block');
                                },
                                success:function(resp){                            
                                    $('#chapterDetailsOverlay').css('display','none');
                                    getAllChapters();
                                },
                                error:function(err){
                                    $('#chapterDetailsOverlay').css('display','none');
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