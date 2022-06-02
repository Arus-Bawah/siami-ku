<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="javascript:void(0)" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="javascript:void(0)" class="sidebar-mobile-expand">
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
                        <a href="javascript:void(0)">
                            <img src="{{ getSession()->foto }}" width="45" height="45" class="rounded-circle"
                                alt="Sidebar Picture">
                        </a>
                    </div>
                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ getSession()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user-tie font-size-sm"></i> &nbsp;{{ getSession()->jabatan }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header">
                    <div class="text-uppercase font-size-xs line-height-xs">Main</div>
                    <i class="icon-menu" title="Main"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard') }}"
                        class="nav-link {{ str_contains(request()->path(), 'dashboard') ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('ami') }}"
                        class="nav-link {{ str_contains(request()->path(), 'ami') ? 'active' : '' }}">
                        <i class="icon-file-text"></i>
                        <span>AMI</span>
                    </a>
                </li>


                @if (getSession()->role === 'LPM')
                    <!-- LPM Navigation -->
                    <li class="nav-item">
                        <a href="{{ url('penjadwalan') }}"
                            class="nav-link {{ str_contains(request()->path(), 'penjadwalan') ? 'active' : '' }}">
                            <i class="icon-calendar"></i>
                            <span>Penjadwalan</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('audit-template') }}"
                            class="nav-link {{ str_contains(request()->path(), 'audit-template') ? 'active' : '' }}">
                            <i class="icon-folder-open"></i>
                            <span>Audit Template</span>
                        </a>
                    </li>


                    <li
                        class="nav-item nav-item-submenu {{ str_contains(request()->path(), 'master') ? ' nav-item-expanded nav-item-open' : '' }}">
                        <a href="javascript:void(0)" class="nav-link">
                            <i class="icon-database"></i> <span>Master</span>
                        </a>
                        <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                            <li class="nav-item">
                                <a href="{{ url('master/users') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'master/users') ? 'active' : '' }}">
                                    <i class="icon-users"></i>
                                    <span>User</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('master/unit') }}"
                                    class="nav-link {{ str_contains(request()->path(), 'master/unit') ? 'active' : '' }}">
                                    <i class="icon-price-tags"></i>
                                    <span>Unit</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- /LPM Navigation -->
                @endif

            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->
