@extends('cms.template.main')

@section('title', 'Login')

@push('top')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <style>
        #img-left {
            background-image: url('{{ asset('assets/image/logo-lpm.png') }}');
            background-size: 80%;
            background-position: center;
        }

        .ftco-section {
            min-height: 100vh;
        }

        .error {
            margin-top: 5px;
            font-size: 10px;
            color: red;
        }

        .btn-login {
            background-color: var(--blue);
            color: var(--white);
        }

        .btn-login:hover,
        .btn-login:active,
        .btn-login:focus {
            background-color: var(--blue);
            color: var(--white);
            opacity: 0.8;
        }
    </style>
@endpush

@section('page')
    <section class="ftco-section d-flex flex-column justify-content-center align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div id="img-left" class="img"></div>
                        <div class="login-wrap p-4 p-md-5">
                            <form class="signin-form" method="post" v-on:submit.prevent="doLogin">
                                {{ csrf_field() }}
                                <div class="form-group mb-3">
                                    <label class="label" for="name">Email</label>
                                    <input type="text" class="form-control" placeholder="Email" name="email" required
                                        v-model="login.email">
                                    @if ($errors->has('email'))
                                        <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>
                                <div class="form-group mb-3">
                                    <label class="label" for="password">Password</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password"
                                        required v-model="login.password">
                                    @if ($errors->has('password'))
                                        <div class="error">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-login rounded submit px-3 mt-3">
                                        Sign In
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('bottom')
    <script>
        new Vue({
            el: '#app',
            data: {
                loading: false,
                notification: null,
                login: {
                    email: "",
                    password: "",
                },
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
                doLogin() {
                    if (!this.loading) {
                        this.callAPI();
                        axios({
                            method: "POST",
                            url: "{{ route('auth.login.submit', []) }}",
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            data: {
                                email: this.login.email,
                                password: this.login.password
                            }
                        }).then((response) => {
                            if (response.data.status) { // direct to dashboard
                                console.log(response.data.message);
                                window.location.href = "{{ route('dashboard.index', []) }}";
                            } else { // alert failed
                                this.closeAPI();
                                this.warning(response.data.message);
                            }
                        }).catch((error) => {
                            this.closeAPI();
                            if (typeof error.response.data.status === "undefined") {
                                // this.warning(error.message);
                                this.error("Terjadi kesalahan, silakan coba beberapa saat lagi.");
                            } else {
                                this.warning(error.response.data.message);
                            }
                            console.log(error); // show error logs
                        });
                    } else {
                        // alert notif if another activity has running in background process
                        this.error("Proses sedang berlangsung, silakan tunggu atau muat ulang halaman.")
                    }
                },
            }
        });
    </script>
@endpush
