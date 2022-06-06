@extends('cms.template.panel')
@section('title', 'Add Unit')

@push('top')
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4>
            <a href="{{ url('master/unit') }}" class="text-dark"><i class="icon-arrow-left52 mr-2"></i></a>
            <span class="font-weight-semibold">Unit</span> - Add
        </h4>
    </div>
@endsection

@section('breadcrumb')
    <a href="{{ url('master/unit') }}" class="breadcrumb-item"><i class="icon-price-tags mr-2"></i> Index</a>
    <span class="breadcrumb-item active">Add</span>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <form id="formAdd" action="{{ url('master/unit/save') }}" method="POST" enctype="multipart/form-data"
                v-on:submit.prevent="submitForm">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend class="font-weight-semibold"><i class="icon-price-tags mr-2"></i> Unit Details</legend>

                            <div class="form-group">
                                <label>Tipe <span class="text-danger">*</span> :</label>
                                <select name="tipe" id="tipe" class="form-control" v-model="form.tipe" required
                                    @change=checkJenjang>
                                    <option value="">Please select tipe</option>
                                    @foreach ($tipe as $row)
                                        <option value="{{ $row->id }}">{{ $row->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group" v-if="form.tipe == 2">
                                <label>Fakultas <span class="text-danger">*</span> :</label>
                                <select name="fakultas" id="fakultas" class="form-control" v-model="form.fakultas"
                                    :required="form.tipe == 2 ? true : false">
                                    <option value="">Please select fakultas</option>
                                    @foreach ($fakultas as $row)
                                        <option value="{{ $row->id }}">{{ $row->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Unit <span class="text-danger">*</span> :</label>
                                <input type="text" name="unit" id="unit" class="form-control"
                                    placeholder="Teknik Informatika" required v-model="form.unit">
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-6" v-if="form.tipe == 2">
                        <fieldset>
                            <legend class="font-weight-semibold"><i class="icon-list mr-2"></i> Jenjang</legend>
                            <div class="row">
                                <div class="col-12">
                                    <label>Pilih Jenjang <span class="text-danger">*</span> :</label>
                                    @foreach ($jenjang as $row)
                                        <div class="form-check">
                                            <input class="form-check-input" name="jenjang[]" type="checkbox"
                                                id="jenjang{{ ucwords($row->value) }}" value="{{ $row->id }}"
                                                :required="jenjangRequired ? true : false" @change=checkJenjang>
                                            <label class="form-check-label" for="jenjang{{ ucwords($row->value) }}">
                                                {{ $row->value }}
                                            </label>
                                        </div>
                                    @endforeach
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
                jenjangRequired: false,
                form: {
                    tipe: "",
                    fakultas: "",
                    unit: "",
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
                    });
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
                 * Helpers
                 */
                checkJenjang() {
                    let val = $('input[name="jenjang[]"]:checked').val();

                    if (this.form.tipe == 2) {
                        if (typeof val === 'undefined') {
                            this.jenjangRequired = true;
                        } else {
                            this.jenjangRequired = false;
                        }
                    } else {
                        this.jenjangRequired = false;
                    }
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
                        url: "{{ url('master/unit/save') }}",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'multipart/form-data',
                        },
                        data: formData,
                    }).then((response) => {
                        if (response.data.status) {
                            window.location.href = "{{ url('master/unit') }}";
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
