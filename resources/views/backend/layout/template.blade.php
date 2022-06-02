<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.layout.head')
    @stack('top')
</head>

<body>
    @include('backend.layout.header')
    <!-- Page content -->
    <div class="page-content">
        @include('backend.layout.sidebar')
        <!-- Main content -->
        <div class="content-wrapper">
            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    <div class="page-title d-flex">
                        <h4>
                            @if (request()->get('return_url'))
                                <a href="{{ request()->get('return_url') }}"><i class="icon-arrow-left52 mr-2"></i></a>
                                @endif <span
                                    class="font-weight-semibold">{{ isset($page_title) ? ucfirst($page_title) : ucfirst(request()->segment('2')) }}</span>
                        </h4>
                        <a href="#" class="header-elements-toggle text-default d-md-none"><i
                                class="icon-more"></i></a>
                    </div>
                    @if (isset($button['button_add']) && $button['button_add'])
                        <div class="header-elements d-none">
                            <div class="d-flex justify-content-center">
                                <a href="{{ request()->fullUrl() }}/add?return_url={{ request()->fullUrl() }}"
                                    class="btn btn-xs btn-secondary border-2 ml-1">New Data
                                    {{ isset($page_title) ? ucfirst($page_title) : ucfirst(request()->segment('2')) }}</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">
                @if (session()->has('message'))
                    <div
                        class="alert alert-{{ session()->get('type') }} alert-styled-left alert-arrow-left alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">{!! session()->get('message') !!}
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- /content area -->

            @include('backend.layout.footer')
        </div>
        <!-- /main content -->
    </div>
    <!-- /page content -->
    @include('backend.layout.scripts')
    @stack('bottom')

</body>

</html>
