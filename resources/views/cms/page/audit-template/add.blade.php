@extends('cms.template.panel')
@section('title', 'Add Template')

@push('top')
    <style>
        textarea {
            resize: none;
        }
    </style>
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4>
            <a href="{{ route('audit-template.index', []) }}" class="text-dark">
                <i class="icon-arrow-left52 mr-2"></i>
            </a>
            <span class="font-weight-semibold">Audit Template</span> - Add
        </h4>
    </div>
@endsection

@section('breadcrumb')
    <a href="{{ route('audit-template.index', []) }}" class="breadcrumb-item">
        <i class="icon-folder-open mr-2"></i> Index
    </a>
    <span class="breadcrumb-item active">Add</span>
@endsection

@section('content')
    <!-- Wizard with validation -->
    <div class="card">
        <div class="card-body">
            <form id="formAdd" action="{{ route('audit-template.save') }}" method="POST" enctype="multipart/form-data" v-on:submit.prevent="submitForm">
                <div class="row">
                    @include('cms.page.audit-template.component.information')

                    @include('cms.page.audit-template.component.tujuan')

                    @include('cms.page.audit-template.component.lingkup')

                    @include('cms.page.audit-template.component.kriteria')

                    @include('cms.page.audit-template.component.document')
                </div>
            </form>
        </div>
    </div>
    <!-- /wizard with validation -->
@endsection

@push('bottom')
    <script>
        new Vue({
            el: '#app',
            data: {
                loading: false,
                notification: null,
                master: {
                    unit: {!! json_encode($unit) !!}
                },
                form: {
                    information: {
                        name: "",
                        tipe_id: "",
                        fakultas_id: "", // required if prodi
                        unit_id: "",
                        jenjang_id: "",
                        tujuan: [{
                            value: ""
                        }],
                        lingkup: [{
                            value: ""
                        }],
                        kriteria: [{
                            value: ""
                        }],
                    },
                    dokumen: [{
                        kriteria: "Visi Misi Tujuan dan Sasaran",
                        document: [{
                            kriteria: "SK Pendirian Fakultas/Program Studi",
                            nama_dokumen: "Ijin Pengabungan Program-Program Studi pada 4 Sekolah Tinggi dan Penambahan Program Studi baru ke Dalam Universitas Dian Nuswantoro Semarang, Ijin Penyelengaraan Program Studi Desain Komunikasi Visual (S1)",
                        }]
                    }, {
                        kriteria: "Visi Misi Tujuan dan Sasaran",
                        document: [{
                            kriteria: "SK Pendirian Fakultas/Program Studi",
                            nama_dokumen: "Ijin Pengabungan Program-Program Studi pada 4 Sekolah Tinggi dan Penambahan Program Studi baru ke Dalam Universitas Dian Nuswantoro Semarang, Ijin Penyelengaraan Program Studi Desain Komunikasi Visual (S1)",
                        }]
                    }],
                    capaian: [],
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
                 * Change Select
                 */
                changeTipe() {
                    this.form.information.fakultas_id = "";
                    this.form.information.unit_id = "";
                    this.form.information.jenjang_id = "";
                },
                changeFakultas() {
                    this.form.information.unit_id = "";
                    this.form.information.jenjang_id = "";
                },
                changeUnit() {
                    his.form.information.jenjang_id = "";
                },

                /**
                 * Tujuan
                 */
                addTujuan() {
                    this.form.information.tujuan.push({
                        value: ''
                    });
                },
                removeTujuan(i) {
                    let value = this.form.information.tujuan[i].value;
                    if (value == '') {
                        this.form.information.tujuan.splice(i, 1);
                    } else {
                        let c = confirm("Apakah anda yakin ingin menghapus record ini?")
                        if (c) {
                            this.form.information.tujuan.splice(i, 1);
                        }
                    }
                },

                /**
                 * Lingkup
                 */
                addLingkup() {
                    this.form.information.lingkup.push({
                        value: ''
                    });
                },
                removeLingkup(i) {
                    let value = this.form.information.lingkup[i].value;
                    if (value == '') {
                        this.form.information.lingkup.splice(i, 1);
                    } else {
                        let c = confirm("Apakah anda yakin ingin menghapus record ini?")
                        if (c) {
                            this.form.information.lingkup.splice(i, 1);
                        }
                    }
                },

                /**
                 * Kriteria
                 */
                addKriteria() {
                    this.form.information.kriteria.push({
                        value: ''
                    });
                },
                removeKriteria(i) {
                    let value = this.form.information.kriteria[i].value;
                    if (value == '') {
                        this.form.information.kriteria.splice(i, 1);
                    } else {
                        let c = confirm("Apakah anda yakin ingin menghapus record ini?")
                        if (c) {
                            this.form.information.kriteria.splice(i, 1);
                        }
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
                        url: "{{ route('audit-template.save', []) }}",
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'multipart/form-data',
                        },
                        data: formData,
                    }).then((response) => {
                        if (response.data.status) {
                            console.log(response.data.message);
                            window.location.href = "{{ route('audit-template.index', []) }}";
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
