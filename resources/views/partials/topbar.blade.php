<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo"
       style="font-size: 16px;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">
           @lang('quickadmin.quickadmin_title')</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">
           @lang('quickadmin.quickadmin_title')</span>
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
        <div class="pull-right">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">{{auth()->user()->name}}
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
             
                  <li>
                    <a class="" href="#logout" onclick="$('#logout').submit();">
                        <i class="fa fa-key"></i>
                        <span class="title">@lang('quickadmin.qa_logout')</span>
                    </a>
                     </li>
                 
                </ul>
              </div>
           
            
        </div>   


    </nav>
  
</header>




