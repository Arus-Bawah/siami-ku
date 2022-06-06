@extends('cms.template.panel')
@section('title', 'Add Users')

@push('top')
    <style>
        .img-profile {
            object-fit: cover;
            width: 150px;
            height: 150px;
            max-width: 150px;
            max-height: 150px;
        }

        .img-signature {
            width: 100%;
            height: 150px;
            object-fit: contain;
            border: 1px solid #eaeaea;
            padding: 10px;
        }

        canvas {
            border: 1px dashed black;
            border-radius: 4px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.02) inset;
        }

        #signature_draw {
            display: none;
        }

        .btn-signature-reset {
            position: absolute;
            right: 20px;
            top: 10px;
        }

    </style>
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4>
            <a href="{{ url('master/users') }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
            <span class="font-weight-semibold">Users</span> - Add
        </h4>
    </div>
@endsection

@section('breadcrumb')
    <a href="{{ url('master/users') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Index</a>
    <span class="breadcrumb-item active">Add</span>
@endsection

@section('content')
    <div class="card">
        <div class="card-header header-elements-inline">
            <h5 class="card-title">Multiple columns</h5>
            <div class="header-elements">
                <div class="list-icons">
                    <a class="list-icons-item" data-action="collapse"></a>
                    <a class="list-icons-item" data-action="reload"></a>
                    <a class="list-icons-item" data-action="remove"></a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form id="formAdd" action="{{ url('master/users/save') }}" method="POST" enctype="multipart/form-data"
                v-on:submit.prevent="submitForm">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="font-weight-semibold"><i class="icon-reading mr-2"></i> Personal Details</legend>

                            <div class="form-group d-flex align-items-center">
                                <div class="card-img-actions d-inline-block">
                                    <img class="img-fluid rounded-circle img-profile" width="200" height="200"
                                        alt="Profile Picture" :src="(isEmpty(form.foto) ? imagePlaceholder : form.foto)">
                                </div>
                                <div class="ml-3 w-100">
                                    <p>Profile Picture :</p>
                                    <input type="file" name="foto" id="foto" class="form-input-styled" data-fouc
                                        accept="image/png, image/jpg, image/jpeg" @change="changeProfilePicture">
                                    <span class="form-text text-muted">
                                        Format yang bisa digunakan: png, jpg, jpeg. Max file size 2Mb
                                    </span>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nama<span class="text-danger">*</span> :</label>
                                <input type="text" name="nama" id="nama" class="form-control"
                                    placeholder="Muhammad Alfian Dzikri" required v-model="form.nama">
                            </div>

                            <div class="form-group">
                                <label>Jabatan<span class="text-danger">*</span> :</label>
                                <input type="text" name="jabatan" id="jabatan" class="form-control" placeholder="Dekan"
                                    required v-model="form.jabatan">
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-6">
                        <fieldset>
                            <legend class="font-weight-semibold"><i class="icon-key mr-2"></i> Account Details</legend>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email<span class="text-danger">*</span> :</label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Dekan" required v-model="form.email">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password<span class="text-danger">*</span> :</label>
                                        <input type="password" name="password" id="password" placeholder="******"
                                            class="form-control" minlength="5" required v-model="form.password">
                                        <span class="form-text text-muted">
                                            Password miminal berisi 5 karakter
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend class="font-weight-semibold"><i class="icon-pencil7 mr-2"></i> Signatures</legend>

                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="signature_type" v-model="form.signature_type">
                                    <ul class="nav nav-tabs nav-tabs-bottom border-bottom-0 nav-justified">
                                        <li class="nav-item">
                                            <a href="#signatureUpload" class="nav-link" data-toggle="tab"
                                                @click="changeSignatureType('upload')">
                                                Upload
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#signatureDraw" class="nav-link active" data-toggle="tab"
                                                @click="changeSignatureType('draw')">
                                                Draw
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane fade" id="signatureUpload">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>
                                                            Upload Tanda Tangan<span class="text-danger">*</span> :
                                                        </label>
                                                        <input type="file" name="signature" id="signature"
                                                            class="form-input-styled"
                                                            accept="image/png, image/jpg, image/jpeg"
                                                            @change="changeSignatureUpload">
                                                        <span class="form-text text-muted">
                                                            Format yang bisa digunakan: png, jpg, jpeg. Max file size 2Mb.
                                                            Pastikan background berwarna putih.
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <img v-if="form.signature_base64 != null" :src="form.signature_base64"
                                                        alt="Users Signature" class="img-signature">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade show active" id="signatureDraw">
                                            <div class="row">
                                                <div class="col">
                                                    <p>
                                                        Use a touchpad, mouse, phone, tablet or other mobile devices to draw
                                                        a free downloadable electronic signature.
                                                        Customize smoothing, color and more.
                                                    </p>
                                                </div>
                                                <div class="col relative">
                                                    <canvas></canvas>
                                                    <button type="button" class="btn btn-xs btn-signature-reset"
                                                        @click="resetSignatureDraw">
                                                        <i class="icon icon-reset"></i>
                                                    </button>
                                                </div>
                                                <textarea name="signature_draw" id="signature_draw" cols="30" rows="10" v-model="form.signature_draw"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="text-right mt-2">
                    <button type="submit" class="btn btn-primary">Save Data <i class="icon-floppy-disk ml-2"></i></button>
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
@endsection

@push('bottom')
    <script>
        new Vue({
            el: '#app',
            data: {
                loading: false,
                notification: null,
                imagePlaceholder: "/global_assets/images/placeholders/placeholder.jpg",
                signaturePad: null,
                form: {
                    foto: null,
                    nama: null,
                    jabatan: null,
                    email: null,
                    password: null,
                    signature: null,
                    signature_base64: null,
                    signature_draw: null,
                    signature_type: "upload", // [upload, drawing]
                },
            },
            created: function() {
                this.init();

                window.addEventListener("resize", this.setSignature);
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
                    });

                    // setup canvas drawing
                    setTimeout(() => {
                        this.setSignature();
                    }, 500);
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
                isEmpty(value) {
                    return value === undefined || value === null || value === "";
                },

                /**
                 * Signature Canvas
                 */
                setSignature() {
                    const canvas = document.querySelector("canvas");
                    const parentWidth = $(canvas).parent().width();
                    canvas.setAttribute("width", parentWidth);
                    this.signaturePad = new SignaturePad(canvas, {
                        penColor: "rgb(51, 51, 51)"
                    });
                    this.signaturePad.addEventListener("afterUpdateStroke", () => {
                        this.changeSignatrueDraw();
                    });
                },

                /**
                 * Update Form
                 */
                onFileChange(e) {
                    const file = e.target.files[0];
                    return URL.createObjectURL(file);
                },
                changeProfilePicture(e) {
                    this.form.foto = this.onFileChange(e);
                },
                changeSignatureType(type) {
                    this.form.signature_type = type;
                },
                changeSignatureUpload(e) {
                    this.form.signature_base64 = null; // set empty to handling if onfilchange error
                    this.form.signature_base64 = this.onFileChange(e);
                },
                changeSignatrueDraw() {
                    this.form.signature_draw = this.signaturePad.toDataURL("image/png");
                },
                resetSignatureDraw() {
                    this.signaturePad.clear();
                    this.form.signature_draw = null;
                },

                /**
                 * API
                 */
                submitForm() {
                    let form = document.getElementById('formAdd');
                    let formData = new FormData(form);
                    this.callAPI();
                    axios({
                        method: "POST",
                        url: "{{ url('master/users/save') }}",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'multipart/form-data',
                        },
                        data: formData,
                    }).then((response) => {
                        if (response.data.status) { // direct to dashboard
                            console.log(response.data.message);
                            window.location.href = "{{ url('master/users') }}";
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
                },
            }
        });
    </script>
@endpush
