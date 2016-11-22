
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
                <form  class="" data-parsley-validate="">   
                    <div  class="form-group has-feedback" style="font-size:12px">                        
                        <div class="col-md-2 col-md-offset-1"> 
                            <div class="pull-right" style="padding-top:10px"> Category Name:</div>
                        </div> 
                        <div class="col-md-6">
                            <input type="text" class="form-control input-sm" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary btn-flat btn-sm ">Add Category</button>
                        </div>                                         
                    </div>
                </form>
            </div><!-- /.box-body -->
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
                {{ Request::get('configurationname') }}
            </div><!-- /.box-body -->
            <!--<div class="overlay">
                <i class="fa fa-refresh fa-spin"></i>
            </div>-->
    </div><!-- /.box -->
    </div>
</div>