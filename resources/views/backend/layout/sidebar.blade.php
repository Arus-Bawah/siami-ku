@php
    $fullurl = \Illuminate\Support\Facades\Request::fullUrl();
    $fullurl = urldecode($fullurl);
@endphp

<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="{{\App\Helpers\Auth::getSession('users_foto')}}" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{\App\Helpers\Auth::getSession('users_name')}}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-users font-size-sm"></i> &nbsp;{{\App\Helpers\Auth::getSession('users_privileges')}}
                        </div>
                    </div></div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">
                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                @foreach(\App\Helpers\Auth::usersModule() as $row)
                    <li class="nav-item  {{(count($row->sub_menu))?'nav-item-submenu':''}}">
                        <a href="{{(count($row->sub_menu))?'javascript:;':adminUrl($row->path)}}" class="nav-link {{(strpos($fullurl, adminUrl($row->path)) !== false)?'active':''}}"><i class="{{$row->icon}}"></i> <span>{{$row->name}}</span></a>
                        @if(count($row->sub_menu))
                        <ul class="nav nav-group-sub" data-submenu-title="sub-{{$row->id}}">
                            @foreach($row->sub_menu as $sub)
                            <li class="nav-item"><a href="{{adminUrl($sub->path)}}" class="nav-link {{(strpos($fullurl, adminUrl($sub->path)) !== false)?'active':''}}">{{$sub->name}}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                @endforeach
                @if(\App\Helpers\Auth::usersPrivilegesId()==1)
                    <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Super Admin</div> <i class="icon-menu" title="Super Admin"></i></li>
                    <li class="nav-item">
                        <a href="{{adminUrl('privileges')}}" class="nav-link {{(strpos($fullurl, adminUrl('privileges')) !== false)?'active':''}}">
                            <i class="icon-grid6"></i><span>Admin Role</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{adminUrl('users-admin')}}" class="nav-link {{(strpos($fullurl, adminUrl('users-admin')) !== false)?'active':''}}">
                            <i class="icon-grid52"></i><span>Users Management</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{adminUrl('menu-manajemen')}}" class="nav-link {{(strpos($fullurl, adminUrl('menu-manajemen')) !== false)?'active':''}}">
                            <i class="icon-menu3"></i><span>Menu Management</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
