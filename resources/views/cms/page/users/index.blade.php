@extends('cms.template.panel')
@section('title', 'Users')

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
        <h4><i class="icon-users mr-2"></i> <span class="font-weight-semibold">Users</span></h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('master.users.add') }}" class="btn btn-primary">
                <i class="icon-add"></i> &nbsp; <span>Add Data</span>
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active">Index</span>
@endsection

@section('content')
    <div class="card">
        @include('cms.component.index_header', [
            'show' => [
                'search' => true,
                'filter' => true,
                'limit' => true,
            ],
            'query' => $query,
            'limit' => $limit,
            'search' => $search,
            'filter' => $filter,
            'filter_form' => [
                'name' => [
                    'label' => 'Nama',
                    'type' => 'text',
                ],
                'email' => [
                    'label' => 'Email',
                    'type' => 'text',
                ],
                'jabatan' => [
                    'label' => 'Jabatan',
                    'type' => 'text',
                ],
            ],
        ])

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto Profile</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jabatan</th>
                        <th>Tanda Tangan</th>
                        <th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>
                                @if ($row->foto)
                                    <a href="{{ url($row->foto) }}" data-lightbox="image-1"
                                        data-title="Signature : {{ $row->name }}" data-lightbox="roadtrip">
                                        <img src="{{ url($row->foto) }}" class="img-fluid img-thumbnail"
                                            alt="Signature : {{ $row->name }}">
                                    </a>
                                @endif
                            </td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->jabatan }}</td>
                            <td>
                                @if ($row->tanda_tangan)
                                    <a href="{{ url($row->tanda_tangan) }}" data-lightbox="image-1"
                                        data-title="Signature : {{ $row->name }}" data-lightbox="roadtrip">
                                        <img src="{{ url($row->tanda_tangan) }}" class="img-fluid img-thumbnail"
                                            alt="Signature : {{ $row->name }}">
                                    </a>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('master.users.edit', ['id' => $row->id]) }}"
                                                class="dropdown-item" onclick="showLoading()">
                                                <i class="icon-pencil5"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item"
                                                @click="deleteData({{ $row->id }})">
                                                <i class="icon-trash text-danger"></i> Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer d-flex justify-content-between align-items-center">
            <p class="mb-0">
                @if ($entries['start'] > $entries['total'])
                    Empty Data
                @else
                    Showing {{ $entries['start'] }}
                    to
                    {{ $entries['end'] < $entries['total'] ? $entries['end'] : $entries['total'] }}
                    of {{ $entries['total'] }} entries
                @endif
            </p>

            {!! $data->appends($query)->links() !!}
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
                deleteData(id) {
                    let c = confirm("Apakah anda yakin ingin menghapus data ini ?");

                    if (c) {
                        this.callAPI();
                        axios({
                            method: "POST",
                            url: `{{ route('master.users.delete', ['id' => null]) }}/${id}`,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                                'Accept': 'application/json',
                            },
                            data: null,
                        }).then((response) => {
                            console.log(response.data);
                            if (response.data.status) {
                                console.log(response.data.message);
                                window.location.reload();
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
                    }
                },
            }
        });
    </script>
@endpush
