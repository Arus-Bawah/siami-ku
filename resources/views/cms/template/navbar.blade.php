<!-- Main navbar -->
<div class="navbar navbar-expand-md navbar-light">

    <!-- Header with logos -->
    <div class="navbar-header d-none d-md-flex align-items-md-center">
        <a href="{{ url('dashboard') }}" class="d-inline-block">
            <div class="navbar-brand navbar-brand-md">
                <img src="{{ asset('assets/image/logo-lpm-mini.png') }}" alt="Navbar Logo">
                <span>SIAMI-KU</span>
            </div>
        </a>

        <div class="navbar-brand navbar-brand-xs">
            <a href="{{ url('dashboard') }}" class="d-inline-block">
                <img src="{{ asset('assets/image/logo-lpm-mini.png') }}" alt="Navbar Logo Mini">
            </a>
        </div>
    </div>
    <!-- /header with logos -->


    <!-- Mobile controls -->
    <div class="d-flex flex-1 d-md-none w-100">
        <div class="navbar-brand mr-auto">
            <a href="index.html" class="d-inline-block">
                <img src="{{ asset('assets/image/logo-lpm-mini.png') }}" alt="Navbar Logo Mobile">
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>

        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    <!-- /mobile controls -->


    <!-- Navbar content -->
    <div class="collapse navbar-collapse" id="navbar-mobile">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a href="javascript:void(0)"
                    class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
                    <i class="icon-paragraph-justify3"></i>
                </a>
            </li>
        </ul>

        <ul class="navbar-nav ml-md-auto">
            <li class="nav-item dropdown dropdown-user">
                <a href="javascript:void(0)" class="navbar-nav-link d-flex align-items-center dropdown-toggle"
                    data-toggle="dropdown">
                    <img src="{{ getSession()->foto }}" class="rounded-circle mr-2" height="34" alt="Profile Pict">
                    <span>{{ getSession()->name }}</span>
                </a>

                <div class="dropdown-menu dropdown-menu-right">
                    <a href="{{ url('profile') }}" class="dropdown-item">
                        <i class="icon-user-plus"></i> Profile
                    </a>
                    <a href="{{ url('profile/password') }}" class="dropdown-item">
                        <i class="icon-key"></i> Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="javascript:void(0)" class="dropdown-item" onclick="logout()">
                        <i class="icon-switch2"></i> Logout
                    </a>
                </div>
            </li>
        </ul>
    </div>
    <!-- /navbar content -->

</div>
<!-- /main navbar -->
