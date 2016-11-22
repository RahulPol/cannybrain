<style>
/*Override admin lte sidebar style*/
    .user-panel>.image>img{
        border:1px solid #00A65A;
    }
/*Override Complete*/
</style>

<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! url('build/img/adminlte/avatar5.png') !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->name}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <!--<form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                    <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                    </span>
            </div>
        </form>-->
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">            
            <!-- Optionally, you can add icons to the links -->
            <li><a href="/a/dashboard"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>

            <li class="header">TEST</li> 
            <li><a href="/u"><i class="fa fa-pencil-square-o"></i><span>Create Test</span></a></li>
            <li><a href="/u"><i class="fa fa-eye"></i><span>View Test</span></a></li>

            <li class="header">CONFIGURATION</li> 
            <li><a href="/a/configuration/categories"><i class="fa fa-tag"></i><span>Categories</span></a></li>
            <li><a href="/a/configuration/chapters"><i class="fa fa-book"></i><span>Chapters</span></a></li>
            <li><a href="/a/configuration/questionbank"><i class="fa fa-list-ol"></i><span>Question Bank</span></a></li>

            <li class="header">USER MENU </li>
            <li><a href="/u"><i class="fa fa-user"></i><span>Profile</span></a></li> 
            <li><a href="/auth/logout"><i class="fa fa-sign-out"></i><span>Logout</span></a></li>
    
           
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

