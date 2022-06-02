@extends('cms.template.main')

@section('page')
    @include('cms.template.navbar')

    <div class="page-content">

        @include('cms.template.sidebar')

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Page header -->
            <div class="page-header page-header-light">
                <div class="page-header-content header-elements-md-inline">
                    @yield('module')
                </div>

                <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
                    <div class="d-flex">
                        <div class="breadcrumb">
                            @yield('breadcrumb')
                        </div>
                    </div>
                </div>
            </div>
            <!-- /page header -->

            <!-- Content area -->
            <div class="content">
                @yield('content')
            </div>
            <!-- /content area -->

            @include('cms.template.footer')
        </div>
        <!-- /main content -->

    </div>
@endsection
