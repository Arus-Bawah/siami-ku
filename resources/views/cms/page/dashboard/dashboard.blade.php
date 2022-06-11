@extends('cms.template.panel')
@section('title', 'Dashboard')

@push('top')
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4><i class="icon-home4 mr-2"></i> <span class="font-weight-semibold">Dashboard</span></h4>
    </div>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Index</span>
@endsection

@section('content')

@endsection

@push('bottom')
    <script>
        new Vue({
            el: '#app',
            data: {
                loading: false,
                notification: null,
            },
            created: function() {
                this.init();
            },
            methods: {
                /**
                 * Controller
                 */
                init() {
                    console.log("Page has loaded");

                    // setup variable
                    this.notification = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                },
                info(message) {
                    this.notification.fire({
                        icon: 'info',
                        title: message
                    });
                },
                success(message) {
                    this.notification.fire({
                        icon: 'success',
                        title: message
                    });
                },
                warning(message) {
                    this.notification.fire({
                        icon: 'warning',
                        title: message
                    });
                },
                error(message) {
                    this.notification.fire({
                        icon: 'error',
                        title: message
                    });
                },
                callAPI() {
                    this.loading = true;
                    showLoading();
                },
                closeAPI() {
                    this.loading = false;
                    hideLoading();
                },

                /**
                 * API
                 */
            }
        });
    </script>
@endpush
