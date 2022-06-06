@extends('cms.template.panel')
@section('title', 'Users')

@push('top')
    <style></style>
@endpush

@section('module')
    <div class="page-title d-flex">
        <h4><i class="icon-users mr-2"></i> <span class="font-weight-semibold">Users</span></h4>
    </div>

    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ url('master/users/add') }}" class="btn btn-primary">
                <i class="icon-add"></i> &nbsp; <span>Add Data</span>
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <span class="breadcrumb-item active"><i class="icon-home2 mr-2"></i> Index</span>
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
                                            <a href="{{ url('master/users/edit/' . $row->id) }}" class="dropdown-item"
                                                onclick="showLoading()">
                                                <i class="icon-pencil5"></i> Edit
                                            </a>
                                            <a href="javascript:void(0)" class="dropdown-item">
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
                    to {{ $entries['end'] > $entries['total'] ? $entries['total'] : $entries['end'] }}
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
            }
        });
    </script>
@endpush
