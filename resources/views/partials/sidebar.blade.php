@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

             

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            <li>
                <a href="{{url('admin/calendar')}}">
                  <i class="fa fa-calendar"></i>
                  <span class="title">
                    Calendar
                  </span>
                </a>
            </li>
        
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('quickadmin.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('quickadmin.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('quickadmin.user-actions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('designation_access')
            <li>
                <a href="{{ route('admin.designations.index') }}">
                    <i class="fa fa-joomla"></i>
                    <span>@lang('quickadmin.designation.title')</span>
                </a>
            </li>
            @endcan
            @can('training_access')
                <li>
                    <a href="{{ route('admin.training_types.index') }}">
                        <i class="fa fa-joomla"></i>
                        <span>Types of training</span>
                    </a>
                </li>
            @endcan
            
            @can('participant_access')
            <li>
                <a href="{{ route('admin.participants.index') }}">
                    <i class="fa fa-users"></i>
                    <span>@lang('quickadmin.participant.title')</span>
                </a>
            </li>@endcan
            
            @can('training_access')
            <li>
                <a href="{{ route('admin.trainings.index') }}">
                    <i class="fa fa-book"></i>
                    <span>@lang('quickadmin.training.title')</span>
                </a>
            </li>
                <li>
                    <a href="{{ route('admin.facilities.index') }}">
                        <i class="fa fa-book"></i>
                        <span>facilities</span>
                    </a>
                </li>

            @endcan



            @can('user_management_access')
                <li class="treeview">
                    <a href="#t">
                        <i class="fa fa-users"></i>
                        <span>Survey and feedbacks</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                    </a>
                    <ul class="treeview-menu">
                        @can('role_access')
                            <li>
                                <a href="{{ route('admin.categories.index') }}">
                                    <i class="fa fa-briefcase"></i>
                                    <span>Categories</span>
                                </a>
                            </li>@endcan
                            @can('role_access')
                                <li>
                                    <a href="{{ route('admin.subcategories.index') }}">
                                        <i class="fa fa-briefcase"></i>
                                        <span>Sub category</span>
                                    </a>
                                </li>@endcan

                        @can('user_access')
                            <li>
                                <a href="{{ route('admin.assessments.index') }}">
                                    <i class="fa fa-user"></i>
                                    <span>Feedback Report</span>
                                </a>
                            </li>@endcan
<<<<<<< HEAD
=======
                            <li>
                                <a href="{{ route('admin.reports.index') }}">
                                    <i class="fa fa-user"></i>
                                    <span>Training Report</span>
                                </a>
                            </li>
>>>>>>> 61d2400fe89070e3c429b2b1df45b4380afd931e

                        @can('user_action_access')
                            @endcan

                    </ul>
                </li>@endcan
            

            

            



            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

