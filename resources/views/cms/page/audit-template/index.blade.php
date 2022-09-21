@extends('cms.template.panel')
@section('title', 'Audit Template')

@push('top')
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4><i class="icon-folder-open mr-2"></i> <span class="font-weight-semibold">Audit Template</span></h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('audit-template.add') }}" class="btn btn-primary">
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
                'filter' => false,
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
            ],
        ])

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Template</th>
                        <th>Tipe</th>
                        <th>Unit</th>
                        <th>Jenjang</th>
                        <th class="text-center" style="width: 30px;"><i class="icon-menu-open2"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->tipe->tipe }}</td>
                            <td>{{ $row->unit->unit }}</td>
                            <td>{{ empty($row->jenjang->jenjang) ? '-' : $row->jenjang->jenjang }}</td>
                            <td class="text-center">
                                <div class="list-icons">
                                    <div class="dropdown">
                                        <a href="javascript:void(0)" class="list-icons-item" data-toggle="dropdown">
                                            <i class="icon-menu9"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('audit-template.edit', ['id' => $row->id]) }}" class="dropdown-item" onclick="showLoading()">
                                                <i class="icon-pencil5"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item" @click="deleteData({{ $row->id }})">
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
                            url: `{{ route('audit-template.delete', ['id' => null]) }}/${id}`,
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
