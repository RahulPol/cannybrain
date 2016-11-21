  <style>
    /*Override admin lte header user box*/
    .skin-green .main-header li.user-header{
      background-color:#fff;
    }
    .navbar-nav>.user-menu>.dropdown-menu>li.user-header>p{
      color:#a1a1a1;
    }
    .navbar-nav>.user-menu>.dropdown-menu>.user-footer{
      border-top:1px solid #c2c2c2;
    }


    .navbar-nav>.user-menu>.dropdown-menu>li.user-header>img{
      border:1px solid #00A65A;
    }

    /*Override Complete*/
  </style>

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>B</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Canny</b>Brain</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{!! url('build/img/adminlte/avatar5.png') !!}" class="user-image" alt="User Image">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{!! url('build/img/adminlte/avatar5.png') !!}" class="img-circle" alt="User Image">

                <p>
                  {{Auth::user()->name}} - Admin
                  <small>Member since {{Auth::user()->created_at->format('Y/m/d')}}</small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-success btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="/auth/logout" class="btn btn-danger btn-flat">Logout</a>
                </div>
              </li>
            </ul>
          </li>
          
        </ul>
      </div>
    </nav>
  </header>